<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Peserta_model extends CI_Model
{

    public $table = 'peserta';
    public $id = 'kode_peserta';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    function get_karyawan(){
        $q = $this->db->query("select nik, concat(nama,' (',nik,')') as nama from karyawan where nik not in (select nik from peserta where kode_jadwal = 'JD.0001')");
        return $q->result();
    }

    function get_data_peserta($id)
    {
        $q = $this->db->query("select k.nik as nik, ifnull(nama,'-') as nama, concat(jabatan,' ',dinas) as jabatan, ifnull(divisi, subdit) as unit_kerja
            from peserta p 
            right join jadwal w on w.kode_jadwal = p.kode_jadwal 
            join materi t on t.kode_materi = w.kode_materi
            left join karyawan k on k.nik = p.nik
            left join status_test st on st.kode_status_test = p.status_test
            left join status_test sh on sh.kode_status_test = p.status_hasil
            where w.kode_jadwal = '$id' ");
        return $q->result();
    }

    function get_materi($id){
        $q = $this->db->query("select j.kode_materi as kode_materi, j.kode_jadwal as kode_jadwal, judul_materi from materi m join jadwal j on m.kode_materi = j.kode_materi where j.kode_jadwal = '$id' ");
        return $q->result();
    }

    function get_last_data_peserta($kj){
        $q = $this->db->query("select p.nik as nik, nama, email, judul_materi, tanggal_mulai, tanggal_selesai from materi m join jadwal j on m.kode_materi = j.kode_materi join peserta p on p.kode_jadwal = j.kode_jadwal join karyawan k on k.nik = p.nik where j.kode_jadwal = '$kj' and waktu_undang >= now() ");
        return $q->result();
    }

    function add($datap)
    {
        $this->db->insert('pertanyaan', $datap);
    }

}