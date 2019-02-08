<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pertanyaan_model extends CI_Model
{

    public $table = 'pertanyaan';
    public $id = 'kode_pertanyaan';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $q = $this->db->query("select * from pertanyaan");
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
        $q = $this->db->query("select kode_materi, judul_materi from materi where kode_materi='".$kode_materi."' ");
        return $q->result_array();
    }

    function get_nomor_soal($kode_materi)
    {
        $q = $this->db->query("select ifnull(max(nomor_soal),0)+1 as nomor_soal, kode_materi from pertanyaan where kode_materi = '".$kode_materi."' ");
        return $q->result_array();
    }

    function add($datap)
    {
        $this->db->insert('pertanyaan', $datap);
    }

    function update($id, $data)
    {
        $this->db->where('kode_jabatan', $id);
        $this->db->update('jabatan', $data);
    }

}