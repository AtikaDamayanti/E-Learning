<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Materi_model extends CI_Model
{

    public $table = 'materi';
    public $id = 'kode_materi';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_data_materi()
    {
        $q = $this->db->query("select * from materi");
        return $q->result();
    }

    function read_data_materi($id)
    {
        $q = $this->db->query("select * from materi where kode_materi = '$id' ");
        return $q->result();
    }

    function get_data_quiz_pt($kode_materi)
    {
        $q = $this->db->query("select p.kode_pertanyaan as kode_pertanyaan, concat(nomor_soal, '. ', text_pertanyaan) as pertanyaan, judul_materi from materi m left join pertanyaan p on p.kode_materi = m.kode_materi where m.kode_materi = '".$kode_materi."' ");
        return $q->result();
    }

    function get_data_quiz_jb($id)
    {   
        $a = implode("','", $id);
        $q = $this->db->query("select concat(abjad_jawaban, '. ', text_jawaban) as jawaban from pertanyaan p join jawaban j on j.kode_pertanyaan = p.kode_pertanyaan where j.kode_pertanyaan in ('".$a."') ");
        return $q->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function add($newName)
    {
        $data = array(
            'kode_materi' => $this->input->post('kode_materi'),
            'judul_materi' => $this->input->post('judul_materi'),
            'deskripsi_materi' => $this->input->post('deskripsi_materi'),
            'file_materi' => $newName,
            'tanggal_upload' => date("Y-m-d H:i:s")
        );
        $this->db->insert('materi', $data);
    }

    function update($id, $data)
    {
        $this->db->where('kode_materi', $id);
        $this->db->update('materi', $data);
    }

}