<div class="col-md-12">
  <div class="card">
    <div class="card-header card-header-primary">
      <h3 id="card-title">Daftar Quiz</h3>
    </div>
    <div class="card-body">
      <section class="panel" id="panel_hari_ini">
        <header class="panel-heading">
          <div class="panel-actions">
            <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
            <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss=""></a>
          </div>
        </header>
        <div class="panel-body" style="display: block;">
          <div class="table-responsive">

            <?php if($_SESSION['nama'] == "Administrator") { ?>

            <table class="table table-striped table-bordered" id="tbl_quiz_today" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Materi</th>
                  <th>Tanggal Mulai</th>
                  <th>Tanggal Selesai</th>
                  <th>Jumlah Peserta</th>
                </tr>
              </thead>
            </table>
            <?php } else { ?>
            <table class="table table-striped table-bordered" id="tbl_history_user" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Materi</th>
                  <th>Tanggal Mulai</th>
                  <th>Tanggal Selesai</th>
                  <th>Tanggal Test</th>
                  <th>Nilai Pre</th>
                  <th>Nilai Post</th>
                  <th>Status Hasil</th>
                </tr>
              </thead>
            </table>
            <?php } ?>
          </div>
        </div>
      </section>

      <section class="panel" id="panel_peserta" style="display: none;">
        <header class="panel-heading">
          <div class="panel-actions">
            <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
            <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss=""></a>
          </div>
          <h2 class="panel-title">Daftar Peserta</h2>
        </header>
        <div class="panel-body" style="display: block;">
          <div class="table-responsive">
            <table class="table table-striped table-bordered" id="tbl_peserta" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>NIK</th>
                  <th>Nama</th>
                  <th>Unit Kerja</th>
                  <th>Status Tes</th>
                  <th>Pre Test</th>
                  <th>Post Test</th>
                  <th>Hasil Akhir</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
        <button onclick="back()" class="btn pull-right btn-success btn-block">Kembali</button>
        </section>

      </div>
    </div>
  </div>

<script type="text/javascript">

var base_url = "<?= site_url() ?>";
var kode_jadwal;
var table;

function getPeserta(id) {
  var table = $('#tbl_peserta').DataTable({
    "destroy" : true,
    "dom" : 'Bfrtip',
    "processing" : true,
    "buttons" : ['copy', 'excel'],
    "ajax": { 
      "url" : base_url+"/dashboard/data_peserta/"+id,
      "type" : "GET"
    }
  });

  $('#panel_hari_ini').hide(100);
  $('#panel_peserta').show(100);
};

$(document).ready(function() {
  $('#tbl_quiz_today').DataTable({
    "dom" : 'Bfrtip',
    "processing" : true,
    "buttons" : ['copy', 'excel'],
    "ajax": { 
      "url" : base_url+"/dashboard/data_hari_ini/",
      "type" : "GET",
    }
  });

  $('#tbl_history_user').DataTable({
    "dom" : 'Bfrtip',
    "processing" : true,
    "buttons" : ['copy', 'excel'],
    "ajax": { 
      "url" : base_url+"/dashboard/data_hari_ini",
      "type" : "GET"
    }
  });
});

function back(){
  $('#panel_peserta').hide(100);
  $('#panel_hari_ini').show(100);
}

function refresh() {
    table.ajax.reload(null,false); //reload datatable ajax 
  }

  </script>
</section><!-- /.x_content