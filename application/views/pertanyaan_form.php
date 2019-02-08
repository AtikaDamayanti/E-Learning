<!-- Main content -->
<div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-primary">
            <p id="card-title"></p>
            <h4 class="card-category"><?php echo $nama_materi.' ('.$kode_materi.')'; ?></h4>
        </div>
        <div class="card-body">
          <form id="pertanyaan_form" method="post" data-parsley-validate class="form-horizontal form-label-left" action="javascript:void(0)">

        <div class="row">
          <div class="col-md-12">
          <div class="form-group">
            <button type="button" class="btn btn-success btn-xs h5">No. <span class="nomor"></span></button>
            <input type="hidden" id="nomor" name="nomor">
            <input type="hidden" class="form-control" id="kode_materi" name="kode_materi" value="<?php echo $kode_materi; ?>">
          </div>
        </div>
        </div>

        <div class="row">
          <div class="col-md-12">
          <div class="form-group">
            <h5>Pertanyaan</h5>
            <textarea class="form-control" rows="3" id="text_pertanyaan" name="text_pertanyaan"></textarea>
          </div>
          </div>
        </div>

      <div class="row">
          <div class="col-md-12">
          <div class="form-group">
            <h5>Jawaban</h5>
            <table id="jawaban_tbl" class="table table-striped table-bordered" style="text-align:center">
              <th>Abjad</th>
              <th>Jawaban</th>
              <th>Point</th>
              <th>Aksi</th>
            </table>
        </div>
        </div>
      </div>
      
      <div class="row">
          <div class="col-md-4">
            <div class="form-group">
            <button class="btn btn-primary btn-block h5" type="button" data-dismiss="modal" onclick="location.href = '<?php echo site_url('materi')?>' ">Back</button>
            </div>
          </div>
          <div class="col-md-4">
            <button class="btn btn-default btn-block h5" type="reset" onclick="refresh('Reset','success')">Reset</button>
          </div>
          <div class="col-md-4">
            <button type="submit" class="btn btn-success btn-block h5" id="btnSubmit" onclick="simpan()">Submit</button>
          </div>
      </div>
        </form>

        </div>
    </div>
</div>

<script type="text/javascript">

  var no = 1; var xno;
  var base_url = "<?= site_url() ?>";
  var no = "<?php echo $nomor; ?>";
  var save_method = 'add';

  $(document).ready(function() {

    $("#btnSubmit").click(function(){
      getNomor(no);
    });

    getNomor(no);
    $('#pertanyaan_form')[0].reset();
    $('#card-title').text('Tambah Soal Quiz');
  });

  
  function getNomor(no){
    $(".nomor").html(no);
    $("#nomor").attr('value',no);
  }

  $("#jawaban_tbl").append("<tr class='baris'><td class='point-fit'><input type='text' class='form-control' name='abjad[]' style='text-transform:uppercase'></td><td><textarea rows='1' class='form-control' name='text_jawaban[]'></textarea></td><td class='point-fit'><input type='number' class='form-control' name='point[]'></td><td class='no-fit'><button id='add' class='btn btn-success btn-sm'><i class='fa fa-plus'></i></td></tr>");

  $(function() {
    //tambah baris inputan jawaban
    xno = no;
    $("#add").click(function(e) {
      e.preventDefault();
      xno++;
      $("#jawaban_tbl").append("<tr class='baris'><td class='point-fit'><input type='text' class='form-control' name='abjad[]' style='text-transform:uppercase'></td><td><textarea rows='1' class='form-control' name='text_jawaban[]'></textarea></td><td class='point-fit'><input type='number' class='form-control' name='point[]'></td><td class='no-fit'><button id='remove' class='btn btn-danger btn-sm'><i class='fa fa-minus'></i></td></tr>");
    });
  });

  //hapus baris jawaban
  $(document).on('click', '#remove', function( e ) {
    e.preventDefault();
    $(this).closest('.baris').remove();
    no--;
  });

  function simpan(){
    $('#btnSubmit').text('Menyimpan...'); //change button text
    $('#btnSubmit').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
       url = base_url + "/pertanyaan/add";
    } else {
        url = base_url + "/pertanyaan/update";
    }

    $.ajax({
        url : url,
        type: "POST",
        //data : new FormData($("#pertanyaan_form")[0]),
        data: $('#pertanyaan_form').serialize(),
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
    $('#pertanyaan_form')[0].reset();
    swal({
      title : teks,
      type: tipe,
      showCancelButton: false,
      confirmButtonColor: "#8bdb6b",
      confirmButtonText: "OK",
      closeOnConfirm: true
    }).then(function() {
      window.location.reload();
    })
  }
</script>
</section><!-- /.x_content