<!-- Main content -->
<div class="col-md-12">
    <div class="x_panel">
        <div class="x_title">
          <?php 
          foreach ($hasil as $key) {
             $judul = $key->judul_materi;
             $km = $key->kode_materi;
             $kj = $key->kode_jadwal;
            }

          ?>
            <h2>Daftar Peserta Quiz <b><?php echo $judul.' ('.$km.')' ?></b></h2>
                <div class="clearfix"></div>
        </div>
        <div class="x_content">

        <form method="post" id="peserta_form" action="javascript:void(0)">
        
        <input type="hidden" class="form-control" name="kode_peserta" 
        value="<?php // echo gen_id("pt", "peserta", "kode_peserta", "4", "4");?>" />

        <input type="hidden" class="form-control" name="kode_jadwal" 
        value="<?php echo $kj ?>" />

        <div class="form-group">
        <label class="col-md-2">Peserta</label>
          <div class="col-md-12">
            <?php echo cb_peserta('peserta',$kj); ?>
          </div>
        </div>

        <div class="form-group row">
        <div class="col-md-6">
          <button class="btn pull-right btn-primary btn-block" type="button" data-dismiss="modal" onclick="location.href = '<?php echo site_url('jadwal')?>' ">Back</button>
        </div>
        <div class="col-md-6">
          <button type="submit" id="btnSubmit" class="btn pull-right btn-success btn-block" onclick="simpan()">Submit</button>
        </div>
      </div>

      </form>
      <div class="ln_solid"></div>
        <!-- Tabel -->
        <div class="table-responsive">
        <table class="table table-striped table-bordered" id="tbl_peserta" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>No</th>
              <th>NIK</th>
              <th>Nama</th>
              <th>Jabatan</th>
              <th>Unit Kerja</th>
            </tr>
          </thead>
        </table>
        </div>

        </div>
    </div>
</div>

</section>

<script type="text/javascript">  
  var base_url = "<?= site_url() ?>";
  var jk = "<?php echo $kj; ?>";
  $(document).ready(function() {
    $('#tbl_peserta').DataTable({
      "dom" : 'Bfrtip',
      "processing" : true,
      "buttons" : ['copy', 'excel'],
      "ajax": { 
        "url" : base_url + '/peserta/peserta_list/' + jk,
        "type" : "GET"
      }
    });
  });

  function simpan(){
    $.ajax({
      url : base_url + '/peserta/add/',
      type: "POST",
      data: $('#peserta_form').serialize(),
      dataType : "JSON",
      success: function(data)
      {
        if(data.status) {
          alert("sukes");
          refresh('Data Disimpan','success');
        } else {
          for (var i = 0; i < data.inputerror.length; i++)  {
            $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
            refresh('Data Gagal Disimpan','warning');
          }
        }
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
          $('#btnSubmit').text('Simpan'); //change button text
          $('#btnSubmit').attr('disabled',false); //set button enable 
      }
    });
  }

  function refresh(teks,tipe){
    $('#peserta_form')[0].reset();
    swal({
      title : teks,
      type: tipe,
      showCancelButton: false,
      confirmButtonColor: "#8bdb6b",
      confirmButtonText: "OK",
      closeOnConfirm: true
    }).then(function() {
      var tabel = $("#tbl_peserta").DataTable();
      tabel.ajax.reload();
      $("input[name=peserta]").tagsinput('removeAll');
    })
  }
</script>