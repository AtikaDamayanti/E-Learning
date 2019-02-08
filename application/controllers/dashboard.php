<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('dashboard_model','dm');
        $this->load->library('form_validation');
        $this->load->helper('form','url');
    }

    public function index()
    {
        $data = array(
            'button' => 'Create'
        );
        $this->template->load('template','dashboard_form',$data);
    }

    public function data_hari_ini(){
        $nama = $this->session->userdata('nama');
        $nik = $this->session->userdata('nik');

        if($nama == "Administrator") {
            $result = $this->dm->get_hari_ini();
            $data = array();
            $no = 1;
            foreach ($result as $value) {
                $row = array();
                $row[] = $no;
                $row[] = $value->judul_materi;
                $row[] = $value->tanggal_mulai;
                $row[] = $value->tanggal_selesai;
                $row[] = '<a href="javascript:void(0)" onclick="getPeserta('."'".$value->kode_jadwal."'".')" class="btn btn-success btn-xs">'.$value->jumlah.'</button>';
                $data[] = $row;
                $no++;
            }
            echo json_encode(['data' => $data]);
        } else {
            $result = $this->dm->get_history_user($nik);
            $data = array();
            $no = 1;
            foreach ($result as $value) {
                $row = array();
                $row[] = $no;
                $row[] = $value->judul_materi;
                $row[] = $value->tanggal_mulai;
                $row[] = $value->tanggal_selesai;
                $row[] = $value->tanggal_test;
                $pre = $value->nilai_pre;
                $post = $value->nilai_post;
                //jika belum pre test
                if ($pre == 0){
                    $row[] = '<a href="'.site_url('quiz/index/pre/'.$value->kode_materi).'" class="btn btn-primary btn-xs">Pre</button>';
                } else if($pre != 0) {
                    $row[] = $pre;
                }
                //jika sudah pre dan belum post
                if ($pre != 0 && $post == 0){
                    $row[] = '<a href="'.site_url('quiz/index/post/'.$value->kode_materi).'" class="btn btn-primary btn-xs">Post</button>';
                //jika belum pre, belum post atau sudah pre sudah post
                } else if($pre == 0 && $post == 0 || $pre != 0 && $post != 0) {
                    $row[] = $post;
                }
                $h = $value->status_hasil;
                if($h == 'Lulus'){
                    $b = 'badge badge-success';
                } else {
                    $b = 'badge badge-danger';
                }
                $row[] = "<span class='".$b."'>".$h."</span>";
                
                // TAMBAHKAN STATUS HASIL
                
                $data[] = $row;
                $no++;
            }
            echo json_encode(['data' => $data]);
        }
    }

    public function data_peserta($id){
        $result = $this->dm->get_data_peserta($id);
        $data = array();
        $no = 1;
        foreach ($result as $value) {
            $row = array();
            $row[] = $no;
            $row[] = $value->nik;
            $row[] = $value->nama;
            $row[] = $value->unit_kerja;
            $row[] = $value->status_tes;
            $row[] = $value->nilai_pre;
            $row[] = $value->nilai_post;
            $h = $value->status_hasil;
            if($h == 'Lulus'){
                $b = 'badge badge-success';
            } else {
                $b = 'badge badge-danger';
            }
            $row[] = "<span class='".$b."'>".$h."</span>";
            $data[] = $row;
            $no++;
        }
        echo json_encode(['data' => $data]);
    }
    
}