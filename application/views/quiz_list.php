<!-- Main content -->
<div class="col-md-12">
    <div class="x_panel">
        <div class="x_title">
          <?php foreach ($result as $key) {
            $judul = $key->judul_materi;
          }
          ?>
            <h2>Daftar Quiz <b><?php echo $judul ?></b></h2>
                <div class="clearfix"></div>
        </div>
        <div class="x_content">
        
        <!-- Tabel -->
        <div class="table-responsive">
        <table class="table table-striped table-bordered" id="tbl_quiz" cellspacing="0" width="100%">
        <?php 
          // menampilkan pertanyaan
          foreach ($result as $key) {
            echo "<tr><td>$key->pertanyaan</td></tr>";

            // menampilkan jawaban
            $dj = $this->db->query("select concat(abjad_jawaban, '. ', text_jawaban) as jawaban from pertanyaan p join jawaban j on j.kode_pertanyaan = p.kode_pertanyaan where j.kode_pertanyaan in ('".$key->kode_pertanyaan."') ")->result();

            foreach ($dj as $key) {
              echo "<tr><td>&emsp;$key->jawaban</td></tr>";
            }
          }
        ?>
        </table>
        <button class="btn btn-primary" type="button" data-dismiss="modal" onclick="location.href = '<?php echo site_url('materi')?>' ">Back</button>
        </div>

        </div>
    </div>
</div>

<script type="text/javascript">
  
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
          element.val(null);
          $(this).parents(".input-file").find('input').val('');
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