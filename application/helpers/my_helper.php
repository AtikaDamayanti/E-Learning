<?php
function gen_id($kd, $table, $kolom, $panjang, $awal)
{
  $ci =& get_instance();
  $query = $ci->db->query("select ifnull(max(substr(".$kolom.",".$awal.")),0)+1 as max_id from ".$table."");
  $id = $query->row_array();
  $max = $id["max_id"];
  return strtoupper($kd).".".str_pad($max,$panjang,"0",STR_PAD_LEFT);
  //Penggunaan echo gen_id("kode awal", "nama tabel", "nama kolom", "panjang karakter setelah - ", "untuk substring, karakter '-' ke kiri dihapus");
}

function gen_id_pt()
{
  $ci =& get_instance();
  $query = $ci->db->query("select kode_materi, right(kode_pertanyaan,1)+1 as max_id from pertanyaan order by 2 desc limit 1");
  $result = $query->row_array();
  $max = $result["max_id"];
  $kd = $result["kode_materi"];
  return $kd.".".str_pad($max,2,"0",STR_PAD_LEFT);
}

function rp($angka)
{
	return "Rp ".number_format($angka, "0", ",", ".");
	//Cange number to rupiah format
}

function cb_materi($id,$selected){
    $ci = get_instance();
    $load = $ci->load->model('Jadwal_model','jd');
    $cmb = "<select name='$id' id='$id'>";
    $data = $ci->jd->get_all();
    $cmb .= "<option>Pilih Materi</option>";
    foreach ($data as $d){
        $cmb .="<option value='".$d->kode_materi."'";
        $cmb .= $selected==$d->kode_materi?" selected='selected'":'';
        $cmb .=">".$d->judul_materi."</option>";
    }
    $cmb .="</select>";
    return $cmb;
}

function cb_peserta($selected,$kj){
    $ci = get_instance();
    $load = $ci->load->model('Peserta_model','pm');
    $cmb = "<select name='peserta[]' multiple='multiple'>";
    $data = $ci->pm->get_karyawan($kj);
    foreach ($data as $d){
        $cmb .="<option value='".$d->nik."'";
        $cmb .= $selected==$d->nik?" selected='selected'":'';
        $cmb .=">".$d->nama."</option>";
    }
    $cmb .="</select>";
    return $cmb;
}