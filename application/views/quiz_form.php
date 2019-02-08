<div class="col-md-12">
  <div class="card">

    <section class="panel" id="panel_start_pre_test" style="display:none" >
      <div class="card-header card-header-primary">
        <h4>Informasi Pre Test</h4>
      </div>
      <div class="card-body">
        <ul>
          <li>Quiz Berlangsung Selama <b><span class="waktu"></span> Menit</b></li>
          <li>Nilai Minimal Gol. A, B, C Adalah <b><span class="abc"></span></b></li>
          <li>Nilai Minimal Gol. D, E, F Adalah <b><span class="def"></span></b></li>
          <li>Nilai Dibawah Minimal Saat Pre Test, Tidak Mempengaruhi Hasil Kelulusan</li>
          <li>Unduh dan Pelajari Materi Setelah Pre Test</li>
          <li>Kerjakan Post Test Setelah Belajar Materi</li>
        </ul>
      </div>
      <div class="form-group">
        <div id="btn_quiz_pre"></div>
      </div>
    </section>

    <section class="panel" id="panel_start_post_test" style="display:none">
      <div class="card-header card-header-primary">
        <h4>Informasi Post Test</h4>
      </div>
      <div class="card-body">
        <ul>
          <li>Quiz Berlangsung Selama <b><span class="waktu"></span></b>Menit</li>
          <li>Nilai Minimal Gol. A, B, C Adalah <b><span class="abc"></span></b></li>
          <li>Nilai Minimal Gol. D, E, F Adalah <b><span class="def"></span></b></li>
          <li>Nilai Dibawah Minimal Saat Post Test, Akan Mempengaruhi Hasil Kelulusan</li>
          <li>Apabila Tidak Lulus, Silahkan Ikuti Test Berikutnya</li>
        </ul>
      </div>
      <div class="form-group">
        <div id="btn_quiz_post">
        </div>
      </div>
    </section>

    <section class="panel" id="panel_quiz" style="display: none;">
    <input type="text" class="form-control" id="demo">
    <div class="card-body">
      <div class="row col-md-12">
        <input type="hidden" id="kode_materi">
        <button type="button" class="btn btn-sm btn-success" id="no_soal" style="font-size:20px"></button>&emsp;
        <h3 id="pertanyaan"></h3>
      </div>
    </div>
    <!-- isi check box -->
    <div class="card-body">
      <form id="quiz_content" method="post" action="javascript:void(0)">
      </form>
    </div>
    <!-- next prev -->
    <div class="form-group row">
      <div class="col-md-6" id="btn_quiz_prev"></div>
      <div class="col-md-6" id="btn_quiz_next"></div>
    </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Review Jawaban</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="table-responsive">
            <table class="table table-striped table-bordered" id="tbl_hasil" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Jawaban</th>
                </tr>
              </thead>
            </table>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="btnSkor">Submit</button>
          </div>
        </div>
      </div>
    </div>

    <!-- lihat skor -->
    <section class="panel" id="panel_skor" style="display: none;">
      <div class="row">

      <div class="col-md-6" style="text-align:center">
        <div class="card">
        <div class="card-header card-header-primary">
          <h4>Hasil Nilai</h4>
        </div>
        <div class="card-body" style="padding-top:50px">
         <strong id="skor" style="font-size:100px"></strong>
         <div class="dropdown-divider"></div>
         <strong class="text-muted" style="font-size:25px">&ensp;Nilai Minimum&ensp;</strong>
         <strong id="nilai_min" style="font-size:25px"></strong>
        </div>
        </div>
      </div>

      <div class="col-md-6" style="text-align:center">
        <div class="card">
        <div class="card-header card-header-primary">
          <h4>Download Materi</h4>
        </div>
        <div class="card-body" style="padding-top:30px">
         <strong id="judul_materi" style="font-size:20px"></strong>
         <div id="link_download"></div>
        </div>
        </div>
      </div>
      </div>
    </section>

  </div>
</div>

<script type="text/javascript">
  var base_url = "<?= site_url() ?>";
  var status_tes = "<?php echo $status; ?>";
  var kode_materi = "<?php echo $kode_materi; ?>";
  var no_prev, km_prev, nox, nov, no_max, no_sl, x;

  $(document).ready(function() {

    if(status_tes == "pre"){
      $('#panel_start_pre_test').show(100);
    } else {
      $('#panel_start_post_test').show(100);
    }

    $.ajax({
      url : base_url + "/quiz/ambil_info/" + kode_materi, //kode materi
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
        var km = data[0].kode_materi;
        var no = data[0].nomor_soal;
        $('.waktu').html(data[0].durasi_test);
        $('.abc').html(data[0].nilai_min_lv1);
        $('.def').html(data[0].nilai_min_lv2);
        $('#btn_quiz_pre').html("<button class='btn btn-primary btn-block' type='submit' onclick='get_quiz("+'"'+no+'","'+km+'"'+")'>Mulai Quiz</button>");
        $('#btn_quiz_post').html("<button class='btn btn-primary btn-block' type='submit' onclick='get_quiz("+'"'+no+'","'+km+'"'+")'>Mulai Quiz</button>");
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        refresh('Gagal Ambil Data','danger');
      }
    });

    $("#btn_quiz_next").click(function(){
      if(nox == no_max + 1){
        save_hasil();
        review_hasil(km_prev);
      } else {
        save_hasil();
      }
    });

    $("#btnSkor").click(function(){
      $("#reviewModal").modal('hide');
      //$('#panel_quiz').hide(100);
      //$('#panel_skor').show(100);
      get_skor(km_prev);
    });

    $("#btn_quiz_prev").click(function(){
      get_hasil(no_prev, km_prev);
    });

  });
  
    function get_quiz(no,km){
      getDurasi(km);
      get_soal(no,km);
      if(status_tes == "pre"){
      $('#panel_start_pre_test').hide(100);
    } else {
      $('#panel_start_post_test').hide(100);
    }
      $('#panel_quiz').show(100);
    }

    function get_soal(no,km) {
      $.ajax({
          url : base_url + "/quiz/get_soal/" + no + "/" + km,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
            no_sl = parseInt(data[0].nomor_soal);
            nox = no_sl + 1;
            nov = no_sl - 1;
            no_max = parseInt(data[0].no_max); //nomor soal maksimal dari materi
            
            km_prev = km; //kode materi untuk fungsi previous
            no_prev = nov; //nomor soal untuk fungsi previous

            $('#pertanyaan').html(data[0].text_pertanyaan);
            $('#no_soal').html(data[0].nomor_soal);

            if(no_sl == no_max){
              $("#next_btn").prop("disabled",false);//GAK MAU DISABLED
            } else {
              $('#btn_quiz_next').html("<button id='next_btn' class='btn btn-primary btn-block' type='submit' onclick='get_soal("+'"'+nox+'",'+'"'+km+'"'+")'>Next</button>");
            }

            if(no_sl == 1){
              $("#prev_btn").prop("disabled",false);//GAK MAU DISABLED
            } else {
              $('#btn_quiz_prev').html("<button id='prev_btn' class='btn btn-primary btn-block' type='submit' onclick='get_soal("+'"'+nov+'",'+'"'+km+'"'+")'>Previous</button>");
            }

            get_jawaban(data[0].kode_pertanyaan);
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
             refresh('Gagal Ambil Data','danger');
         }
     });
    }

    function getDurasi(km){
      $.ajax({
        url : "<?php echo site_url('quiz/getDurasiTest/')?>" + km,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          x = data[0].durasi_test;
          showDurasi(x);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Masalah saat mengambil data');
        }
      });
    }
    function showDurasi(x){

    var curdate = new Date($.now());
    curdate.setMinutes(curdate.getMinutes() + parseInt(x));
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
        get_skor(km_prev);
      }
    }, 1000);
    }

    function refresh(teks,tipe){
    swal({
      title : teks,
      type: tipe,
      showCancelButton: false,
      confirmButtonColor: "#8bdb6b",
      confirmButtonText: "OK"
    }),
    function(){ 
      history.go(0);
      }
    }

    function get_jawaban(id) {
      $.ajax({
          url : base_url + "/quiz/get_jawaban/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
            $('#quiz_content').html(data.data);
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
             refresh('Gagal Ambil Data','danger');
         }
     });
    }

    function save_hasil(){
      $.ajax({
        url : base_url + "/quiz/save_hasil/",
        type: "POST",
        data: $('#quiz_content').serialize(),
        dataType : "JSON",
        // success: function(data)
        // {
        //   alert('ok');
        // }
      });
    }

    function get_hasil(no_prev, km_prev) {
    $.ajax({
        url : base_url + "/quiz/get_hasil/" + no_prev + "/" + km_prev,
        type: "GET",
        success: function(data)
        {
          // KOK GAK GELEM CHECKED YOO
          $('input:radio[name=jwb][value="'+data[0].kode_jawaban+'"]').prop('checked',true);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
           refresh('Gagal Ambil Data','danger');
       }
    });
    }

    function review_hasil(km_prev) {
      $("#reviewModal").modal('show');
      var table = $('#tbl_hasil').DataTable({
        bFilter : false,
        processing : true,
        bLengthChange : false,
        ajax: {
          url : base_url + "/quiz/review_hasil/" + km_prev,
          dataSrc : ""
        }
      });
      table.buttons().disable();
    }

    function get_skor(km_prev){
      $('#panel_quiz').hide(100);
      $('#panel_skor').show(100);
      $.ajax({
        url : base_url + "/quiz/get_skor/" + km_prev,
        type: "GET",
        dataType : "JSON",
        success: function(data)
        {
          var x = parseInt(data[0].nilai);
          var y = parseInt(data[0].nilai_min);
          var z = data[0].file_materi;
          
          $("#skor").html(x);
          $("#nilai_min").html(y);
          $("#judul_materi").html(z);

          if(x <= y){
            $("#skor").addClass('text-danger');
          } else if (x >= y) {
            $("#skor").addClass('text-success');
          }
          $('<a>',{
            "id" : 'btn_download',
            "text" : 'Download Materi',
            "class" : 'btn btn-success btn-md btn-round',
            "href" : "<?php echo base_url(); ?>uploads/" + data[0].file_materi
          }).appendTo("#link_download");

        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
        } 
      });
    }

</script>