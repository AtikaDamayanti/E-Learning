function confirm_delete(id, link){
var base_url = "<?= site_url() ?>"; 
  swal({
      title: "Hapus Data Ini?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Ya",
      closeOnConfirm: false
    },
    function(){
        $.ajax({
            url : base_url + link + id,
            type: "POST"
        });
      swal("Dihapus!", "Data telah dihapus", "success");
    });
}

function confirm_add(){
    swal({
        title : "Data Telah Disimpan",
        type: "success",
        showCancelButton: false,
        confirmButtonColor: "#8bdb6b",
        confirmButtonText: "OK",
        closeOnConfirm: true
    });
}
