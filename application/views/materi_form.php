<!-- Main content -->
<div class="col-md-12">
     <div class="card">
        <div class="card-header card-header-primary">
          <h3 class="card-title"></h3>
        </div>
        <div class="card-body">
          <form method="post" enctype="multipart/form-data" id="materi_form" data-parsley-validate class="form-horizontal form-label-left" action="javascript:void(0)">
        
        <div class="row">
          <div class="col-md-12">
          <div class="form-group">
            <h5>Kode Materi</h5>
            <input class="form-control" type="text" name="kode_materi" id="kode_materi">
          </div>
        </div>
        </div>

        <div class="row">
          <div class="col-md-12">
          <div class="form-group">
            <h5>Judul Materi</h5>
            <input class="form-control" type="text" name="judul_materi" id="judul_materi">
          </div>
        </div>
        </div>

        <div class="row">
          <div class="col-md-12">
          <div class="form-group">
            <h5>Deskripsi Materi</h5>
            <textarea class="form-control" rows="3" name="deskripsi_materi" id="deskripsi_materi"></textarea>
          </div>
        </div>
        </div>

        <div class="row">
          <div class="col-md-12">
          <div class="form-group">
            <h5>File Materi (PPT, DOC, PDF, ZIP, RAR) *Maks. 40 MB
          </h5>
          <div class="input-group input-file">
            <span class="input-group-btn">
                  <button class="btn btn-default btn-choose" type="button">Choose</button>
              </span>
              <input type="text" id="file_mtr" class="form-control" placeholder='Choose a file...' />
              <span class="input-group-btn">
                <button class="btn btn-warning btn-reset" type="button">Reset</button>
              </span>
          </div>
        </div>
        </div>
        </div>
      
      <div class="form-group row">
        <div class="col-md-6">
          <button class="btn btn-default btn-block h5" type="reset" onclick="refresh('Reset','success')">Reset</button>
        </div>
        <div class="col-md-6">
          <button type="submit" class="btn btn-success btn-block h5" id="btnSubmit" onclick="simpan()">Simpan</button>
        </div>
      </div>
      
      </form>
        
        <h2>Daftar Materi</h2>
        <div class="table-responsive">
        <button class="btn btn-primary btn-md" onclick="refresh('Data Diperbarui','success');">refresh</button>
        <table class="table table-striped table-bordered" id="tbl_mt" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Judul</th>
              <th>Deskripsi</th>
              <th>Tanggal Upload</th>
              <th>Quiz</th>
              <th>Aksi</th>
            </tr>
          </thead>
        </table>
        </div>

        </div>
    </div>
</div>

<script type="text/javascript">

  var base_url = "<?= site_url() ?>";
  var save_method = 'add';
  var btn_method = 'reset';
  
  $(document).ready(function() {

    $('#materi_form')[0].reset();
    $('.card-title').text('Unggah Materi Baru');

    $('#tbl_mt').DataTable({
      "dom" : 'Bfrtip',
      "processing" : true,
      "buttons" : ['copy', 'excel'],
      "ajax": { 
        "url" : "<?php echo site_url('materi/data_materi'); ?>",
        "type" : "GET"
      }
    });

  });

  function ubah(id) {
    save_method = 'update';
    $('#card-title').text('Ubah Materi');
    $.ajax({
        url : base_url + "/materi/edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('#kode_materi').val(data[0].kode_materi).attr("disabled", true);
            $('#judul_materi').val(data[0].judul_materi);
            $('#deskripsi_materi').val(data[0].deskripsi_materi);
            $('#file_mtr').attr('disabled', 'disabled');
            $('.btn-choose').attr('disabled', 'disabled');
            $('.btn-reset').text("Edit");
            btn_method = 'edit';
        },
        error: function (jqXHR, textStatus, errorThrown){
           refresh('Gagal Ambil Data','danger');
       }
   });
  }

  function simpan(){
    $('#btnSubmit').text('Menyimpan...'); //change button text
    $('#btnSubmit').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
       url = base_url + "/materi/add";
    } else {
        url = base_url + "/materi/update";
    }

    $.ajax({
        url : url,
        type: "POST",
        processData : false,
        contentType : false,
        data : new FormData($("#materi_form")[0]),
        //data: $('#materi_form').serialize(),
        dataType : "JSON",
        success: function(data)
        {
          if(data.status) {
            refresh('Data Disimpan','success');
          } else {
						refresh('Data Gagal Disimpan','warning');
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
    $('#materi_form')[0].reset();
    // $('[name="materi"]').attr("disabled",false);
    // $('[name="materi"]').trigger('change');
    swal({
      title : teks,
      type: tipe,
      showCancelButton: false,
      confirmButtonColor: "#8bdb6b",
      confirmButtonText: "OK",
      closeOnConfirm: true
    }).then(function() {
      var tabel = $("#tbl_mt").DataTable();
        tabel.ajax.reload();
    })
  }
  
  function bs_input_file() {
  $(".input-file").before(
    function() {
      if ( ! $(this).prev().hasClass('input-ghost') ) {
        var element = $("<input type='file' id='file_materi' name='file_materi' class='input-ghost' style='visibility:hidden; height:0'>");
        element.attr("name",$(this).attr("name"));
        element.change(function(){
          element.next(element).find('input').val((element.val()).split('\\').pop());
        });
        $(this).find("button.btn-choose").click(function(){
          element.click();
        });
        $(this).find("button.btn-reset").click(function(){
          if(btn_method == 'reset') {
            element.val(null);
            $(this).parents(".input-file").find('input').val('');
          } else if(btn_method == 'edit'){
            $('#file_mtr').attr('disabled', false);
            $('.btn-choose').attr('disabled', false);
            $('.btn-reset').text("Reset");
          }
        });
        $(this).find('input').css("cursor","pointer");
        $(this).find('input').mousedown(function() {
          $(this).parents('.input-file').prev().click();
          return false;
        });
        return element;
      }
    }
  );
  }
  $(function() {
    bs_input_file();
  });
</script>
</section><!-- /.x_content