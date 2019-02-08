<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pertanyaan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pertanyaan_model','pt');
        $this->load->library('form_validation');
        $this->load->helper('form','url');
    }

    public function index($kode_materi)
    {   
        $query = $this->pt->get_data_materi($kode_materi);
        foreach ($query as $key) {
            $nama_materi = $key['judul_materi'];
        }

        $query = $this->pt->get_nomor_soal($kode_materi);
        foreach ($query as $key) {
            $nomor = $key['nomor_soal'];
        }

        $this->x = $kode_materi;

        $data = array(
            'button' => 'Create',
            'kode_materi' => $kode_materi,
            'nama_materi' => $nama_materi,
            'nomor' => $nomor
        );
        $this->template->load('template','pertanyaan_form',$data);
    }

    // public function get_nomor(){
    //     $data = $this->pt->get_nomor_soal($this->x);
    //     echo json_encode($data);
    // }

    public function add(){
        $kodem = $this->input->post('kode_materi');
        $tp = $this->input->post('text_pertanyaan');
        $tj = $this->input->post('text_jawaban');
        $a = $this->input->post('abjad');
        $p = $this->input->post('point');
        $n = $this->input->post('nomor');

        $datap = array (
            'kode_pertanyaan' => $kodem.'.'.$n,
            'kode_materi' => $kodem,
            'nomor_soal' => $n,
            'text_pertanyaan' => $tp
            );
        $this->pt->add($datap);

        $dataj = array();
        $ctj = count($tj);
        for ($i = 0; $i < $ctj; $i++) {
            $dataj[] = array(
                'kode_jawaban' => $kodem.'.'.$n.'.'.$a[$i],
                'kode_pertanyaan' => $kodem.'.'.$n,
                'abjad_jawaban' => strtoupper($a[$i]),
                'text_jawaban' => $tj[$i],
                'point_jawaban' => $p[$i]
                );
        }
        $result = $this->db->insert_batch('jawaban', $dataj);
        echo json_encode(array("status" => TRUE));
        // if($result){
        //     redirect(site_url('peserta/index/'.$kj), 'refresh'); 
        // } else {
        //     redirect(site_url('peserta/index/'.$kj), 'refresh');
        // }
    }
}