<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Quiz_model extends CI_Model
{

    public $table = 'pertanyaan';
    public $id = 'kode_pertanyaan';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    function get_all()
    {
        $q = $this->db->query("select * from pertanyaan");
        return $q->result();
    }

    function get_durasi_tes($id){
        $q = $this->db->query("select * from jadwal where kode_materi = '$id' ");
        return $q->result();
    }

    function ambil_informasi($id)//kode materi
    {
        $q = $this->db->query("SELECT j.kode_materi, durasi_test, nilai_min_lv1, nilai_min_lv2, nomor_soal from jadwal j join materi m on j.kode_materi = m.kode_materi join pertanyaan p on p.kode_materi = m.kode_materi 
            where j.kode_materi = '".$id."'
            limit 1");
        return $q->result();
    }

    function get_soal($no,$km)
    {
        $q = $this->db->query("select p.kode_pertanyaan as kode_pertanyaan, nomor_soal, text_pertanyaan, judul_materi, (select max(nomor_soal) from pertanyaan where kode_materi = '".$km."') as no_max from materi m left join pertanyaan p on p.kode_materi = m.kode_materi where m.kode_materi = '".$km."' and nomor_soal = '".$no."' ");
        return $q->result();
    }

    function get_jawaban($id)
    {
        //$a = implode("','", $id);
        $q = $this->db->query("select j.kode_pertanyaan as kode_pertanyaan, kode_jawaban, abjad_jawaban, concat(abjad_jawaban, '. ', text_jawaban) as jawaban from pertanyaan p join jawaban j on j.kode_pertanyaan = p.kode_pertanyaan where j.kode_pertanyaan in ('".$id."')");
        return $q->result();
    }

    function get_nomor_soal($kode_materi)
    {
        $q = $this->db->query("select ifnull(max(nomor_soal),0)+1 as nomor_soal from pertanyaan where kode_materi = '".$kode_materi."' ");
        return $q->result_array();
    }

    function add($datap)
    {
        $this->db->insert('pertanyaan', $datap);
    }

    function cek_hasil($p, $n){
        $q = $this->db->query("select kode_pertanyaan, nik from hasil where kode_pertanyaan = '$p' and nik = '$n' ");
        return $q->row();
    }

    function get_hasil($no, $km, $n){
        $q = $this->db->query("select kode_jawaban from hasil h join pertanyaan p on h.kode_pertanyaan = p.kode_pertanyaan where nomor_soal = '$no' and kode_materi = '$km' and nik = '$n' ");
        return $q->result();
    }

    function review_hasil($km, $n){
        $q = $this->db->query("select nomor_soal, concat(abjad_jawaban, ' - ', text_jawaban) as jwb 
            from hasil h join jawaban j on h.kode_jawaban = j.kode_jawaban join pertanyaan p on p.kode_pertanyaan = j.kode_pertanyaan
            where kode_materi = '$km' and nik = '$n' ");
        return $q->result();
    }

    function get_skor($km, $n){
        $q = $this->db->query("select sum(point_jawaban) as nilai,
            case when golongan in ('D','E','F') then nilai_min_lv1
            when golongan in ('A','B','C') then nilai_min_lv2
            end as nilai_min,
            file_materi
            from jawaban j join hasil h on j.kode_jawaban = h.kode_jawaban 
            join pertanyaan p on p.kode_pertanyaan = j.kode_pertanyaan 
            join jadwal w on w.kode_materi = p.kode_materi
            join karyawan k on k.nik = h.nik
            join materi m on m.kode_materi = w.kode_materi
            where h.nik = '$n' and p.kode_materi = '$km' ");
        return $q->result();
    }

    function cek_test($km, $n){
        $q = $this->db->query("select kode_materi, nik, p.kode_jadwal as kj, nilai_pre, nilai_post
            from peserta p join jadwal j on p.kode_jadwal = j.kode_jadwal
            where nik = '$n' and kode_materi = '$km'");
        return $q->result();
    }

}