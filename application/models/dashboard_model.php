<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_hari_ini()
    {
        $q = $this->db->query("SELECT p.kode_jadwal as kode_jadwal, judul_materi, tanggal_mulai, tanggal_selesai, 
if (count(p.nik) = 0, null,  count(p.nik)) as jumlah
FROM jadwal j join peserta p on j.kode_jadwal = p.kode_jadwal
            join materi m on m.kode_materi = j.kode_materi
            where cast(now() as date)  BETWEEN tanggal_mulai and tanggal_selesai");
        return $q->result();
    }

    function get_history_user($nik)
    {
        $q = $this->db->query("SELECT p.kode_jadwal as kode_jadwal, judul_materi, j.kode_materi as kode_materi, tanggal_mulai, tanggal_selesai, tanggal_test, nilai_pre, nilai_post, ts.kode_status_test as kode_status_test, st.nama_status_test as status_hasil
            FROM jadwal j join peserta p on j.kode_jadwal = p.kode_jadwal
            join materi m on m.kode_materi = j.kode_materi
            join status_test ts on ts.kode_status_test = p.status_test
            join status_test st on st.kode_status_test = p.status_hasil
            where cast(now() as date)  BETWEEN tanggal_mulai and tanggal_selesai and nik = '$nik' ");
        return $q->result();
    }

    function get_data_peserta($id)
    {
        $q = $this->db->query("select k.nik as nik, nama, divisi as unit_kerja, ifnull(st.nama_status_test,'-') as status_tes, nilai_pre, nilai_post, ifnull(sh.nama_status_test,'-') as status_hasil
            from peserta p 
            right join jadwal w on w.kode_jadwal = p.kode_jadwal 
            join materi t on t.kode_materi = w.kode_materi
            left join karyawan k on k.nik = p.nik
            left join status_test st on st.kode_status_test = p.status_test
            left join status_test sh on sh.kode_status_test = p.status_hasil
            where w.kode_jadwal = '$id' ");
        return $q->result();
    }

}