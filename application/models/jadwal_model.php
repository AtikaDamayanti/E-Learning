<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jadwal_model extends CI_Model
{

    public $table = 'jadwal';
    public $id = 'kode_jadwal';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $q = $this->db->query("select * from materi");
        return $q->result();
    }

    function get_karyawan(){
        $q = $this->db->query("select nik, concat(nama,' (',nik,')') as nama from karyawan where nik not in (select nik from peserta where kode_jadwal = 'JD.0001')");
        return $q->result();
    }

    function read_data_jadwal($id)
    {
        $q = $this->db->query("select * from jadwal where kode_jadwal = '$id' ");
        return $q->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function get_data_materi($kode_materi)
    {
        $q = $this->db->query("select judul_materi from materi where kode_materi='".$kode_materi."' ");
        return $q->result_array();
    }

    function get_data_jadwal()
    {
        $q = $this->db->query("select j.*, judul_materi from jadwal j join materi m on j.kode_materi = m.kode_materi");
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

    function update($id, $data)
    {
        $this->db->where('kode_jadwal', $id);
        $this->db->update('jadwal', $data);
    }

}