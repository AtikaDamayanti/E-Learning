<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jadwal extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Jadwal_model','model');
        $this->load->library('form_validation');
        $this->load->helper('form','url');
    }

    public function index()
    {   
        $data = array(
            'button' => 'Create'
        );
        $this->template->load('template','jadwal_form',$data);
    }

    public function data_jadwal(){
        $result = $this->model->get_data_jadwal();
        $data = array();
        $no = 1;
        foreach ($result as $value) {
            $row = array();
            $row[] = $no;
            $row[] = $value->judul_materi;
            $row[] = date("d F Y", strtotime($value->tanggal_mulai));
            $row[] = date("d F Y", strtotime($value->tanggal_selesai));
            $row[] = $value->durasi_test.' Menit';
            $row[] = $value->nilai_min_lv1;
            $row[] = $value->nilai_min_lv2;
            $row[] = '<a href="peserta/index/'.$value->kode_jadwal.'"><i class="fa fa-list fa-2x" title="Lihat"></i></a>';
            $row[] = '<a href="javascript:void(0)" onclick=ubah('."'".$value->kode_jadwal."'".')><i class="fa fa-edit fa-2x" title="Ubah"></i></a>';
            $data[] = $row;
            $no++;
        }
        echo json_encode(['data' => $data]);
    }

    public function edit($id){
        $data = $this->model->read_data_jadwal($id);
        echo json_encode($data);
    }

    public function update(){
        $id = $this->input->post('kode_jadwal');
        $data = array(
            'tanggal_mulai' => $this->input->post('tanggal_mulai'),
            'tanggal_selesai' => $this->input->post('tanggal_selesai'),
            'durasi_test' => $this->input->post('durasi_test'),
            'nilai_min_lv1' => $this->input->post('nilai_lv1'),
            'nilai_min_lv2' => $this->input->post('nilai_lv2')
        );
        $this->model->update($id,$data);
        echo json_encode(array("status" => TRUE));
    }

    public function add(){
        $kj = $this->input->post('kode_jadwal');
        $m = $this->input->post('materi');
        $tm = $this->input->post('tanggal_mulai');
        $ts = $this->input->post('tanggal_selesai');
        $dt = $this->input->post('durasi_test');
        $n1 = $this->input->post('nilai_lv1');
        $n2 = $this->input->post('nilai_lv2');

        $data = array (
            'kode_jadwal' => $kj,
            'kode_materi' => $m,
            'tanggal_mulai' => date("Y-m-d", strtotime($tm)),
            'tanggal_selesai' => date("Y-m-d", strtotime($ts)),
            'durasi_test' => $dt,
            'nilai_min_lv1' => $n1,
            'nilai_min_lv2' => $n2
            );
        $result = $this->db->insert('jadwal', $data);
        echo json_encode(array("status" => TRUE));
    }
}