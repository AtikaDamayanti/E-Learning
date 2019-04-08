<!-- Main content -->
<div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-primary">
          <h3 id="card-title"></h3>
        </div>
        <div class="card-body">
          <form method="post" enctype="multipart/form-data" id="quiz_form" data-parsley-validate class="form-horizontal form-label-left" action="javascript:void(0)">
          
        <div class="form-group">
          <input type="hidden" class="form-control" name="kode_jadwal" value="<?php 
            if ($button == "Create") {
              echo gen_id("jd", "jadwal", "kode_jadwal", "4", "4");
            }else{
              echo $kode_jadwal;
            }
            ?>" />
        </div>
        
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
            <h5>Materi</h5>
              <?php echo cb_materi('materi','materi') ?>
            </div>
        </div>
        </div>
      
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <h5>Tanggal Mulai</h5>
              <input type="date" class="form-control h5" name="tanggal_mulai" id="tanggal_mulai" />   
              <!--<span class="input-group-addon">
                  <span class="glyphicon glyphicon-time"></span>
              </span>-->
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-group">
              <h5>Tanggal Selesai</h5>
              <input type="date" class="form-control h5" name="tanggal_selesai" id="tanggal_selesai" />
              <!--<span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>-->
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <h5>Durasi Test (Max. 120 Menit)</h5>
              <div class='input-group'>
                <input type="number" max="120" class="form-control h5" name="durasi_test" id="durasi_test" />
                <span class="input-group-addon"><span class="fa fa-clock-o"></span></span>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <h5>Nilai Minimal Gol. A B C</h5>
              <input type="number" class="form-control h5" name="nilai_lv1" id="nilai_lv1" placeholder="Gol. A B C"/>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <h5>Nilai Minimal Gol. D E F</h5>
              <input type="number" class="form-control h5" name="nilai_lv2" id="nilai_lv2" placeholder="Gol. D E F"/>
            </div>
          </div>
        </div>

        <!-- <input type="text" class="form-control" id="demo" /> -->

      <div class="form-group row">
        <div class="col-md-6">
          <button class="btn btn-default btn-block h5" type="reset" onclick="refresh('Reset','success')">Reset</button>
        </div>
        <div class="col-md-6">
          <button type="submit" class="btn btn-success btn-block h5" id="btnSubmit" onclick="simpan()">Simpan</button>
        </div>
      </div>
    </form>

        <div class="ln_solid"></div>
  
          <div class="card-title">
            <h2>Daftar Quiz</h2>
          </div>
        
        
        <!-- Tabel -->
        <div class="table-responsive">
        <button class="btn btn-primary" onclick="refresh('Data Diperbarui','success')">refresh</button>
        <table class="table table-striped table-bordered" id="tbl_tr" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Materi</th>
              <th>Tanggal Mulai</th>
              <th>Tanggal Selesai</th>
              <th>Durasi</th>
              <th>Nilai Level 1</th>
              <th>Nilai Level 2</th>
              <th>Peserta</th>
              <th>Aksi</th>
            </tr>
          </thead>
        </table>
        </div>
    
        </div>
    </div>
  </div>

<?php 
  // durasi test : waktu sekarang + jumlah menit kemudian di countdown
  // $curtime = "10:00:00";
  // $endtime = strtotime("+20 Minute", strtotime($curtime));
  // echo date('h:i:s', $endtime);
?>

<script type="text/javascript">
  
  var base_url = "<?= site_url() ?>";
  var save_method = 'add';

  $(document).ready(function() {

    $('#quiz_form')[0].reset();
    $('#card-title').text('Tambah Jadwal Quiz');

    $('#tbl_tr').DataTable({
      "dom" : 'Bfrtip',
      "processing" : true,
      "buttons" : ['copy', 'excel'],
      "ajax": { 
        "url" : base_url + "/jadwal/data_jadwal",
        "type" : "GET"
      }
    });
  });

  function ubah(id) {
    save_method = 'update';
    $('#form_title').text('Ubah Jadwal Quiz');
    $.ajax({
        url : base_url + "/jadwal/edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            //alert(data[0].durasi_test);
            $('[name="kode_jadwal"]').val(data[0].kode_jadwal);
            $('[name="materi"]').val(data[0].kode_materi).trigger('change').attr("disabled",true);
            $('[name="tanggal_mulai"]').val(data[0].tanggal_mulai);
            $('[name="tanggal_selesai"]').val(data[0].tanggal_selesai);
            $('#durasi_test').val(data[0].durasi_test);
            $('[name="nilai_lv1"]').val(data[0].nilai_min_lv1);
            $('[name="nilai_lv2"]').val(data[0].nilai_min_lv2);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
           refresh('Gagal Ambil Data','danger');
       }
   });
  }

  function simpan(){
    $('#btnSubmit').text('Menyimpan...'); //change button text
    $('#btnSubmit').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
       url = base_url + "/jadwal/add";
    } else {
        url = base_url + "/jadwal/update";
    }

    $.ajax({
        url : url,
        type: "POST",
        data: $('#quiz_form').serialize(),
        dataType : "JSON",
        success: function(data)
        {
          if(data.status) {
            refresh('Data Disimpan','success');
          } else {
            for (var i = 0; i < data.inputerror.length; i++)  {
              $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
              refresh('Data Gagal Disimpan','warning');
            }
          }
          $('#btnSubmit').text('Simpan'); //change button text
          $('#btnSubmit').attr('disabled',false); //set button enable 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            // notification('Gagal Simpan Data','danger');
            $('#btnSubmit').text('Simpan'); //change button text
            $('#btnSubmit').attr('disabled',false); //set button enable 
        }
    });
  }

  function refresh(teks,tipe){
    $('#quiz_form')[0].reset();
    $('[name="materi"]').attr("disabled",false);
    $('[name="materi"]').trigger('change');
    swal({
      title : teks,
      type: tipe,
      showCancelButton: false,
      confirmButtonColor: "#8bdb6b",
      confirmButtonText: "OK",
      closeOnConfirm: true
    }).then(function() {
      var tabel = $("#tbl_tr").DataTable();
        tabel.ajax.reload();
    })
  }

  var a;
  function getDurasiTes(id){
  $.ajax({
      url : "<?php echo site_url('jadwal/getDurasiTest/')?>/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
        a = data.durasi_test;
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
          alert('Masalah saat mengambil data');
      }
  });

  var curdate = new Date($.now());
  curdate.setMinutes(curdate.getMinutes() + a);
  // var a isi nya adalah hasil penjumlahan waktu dari atas
  var a = curdate.getTime();

  var b = setInterval(function() {
    var now = new Date().getTime();
    var distance = a - now;

    var day = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hour = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minute = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var second = Math.floor((distance % (1000 * 60)) / 1000);

    $("#demo").val(hour + " Jam " + minute + " Menit " + second + " Detik");

    // jika waktunya habis maka auto submit ubah status jadi submitted dari temporary
    if(distance < 0){
      clearInterval(b);
      $("#demo").val("Time Over");
    }
  }, 1000);
}
</script>
</section><!-- /.x_content