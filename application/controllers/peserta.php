<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Peserta extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Peserta_model','pm');
        $this->load->library('form_validation');
        $this->load->helper('form','url');
    }

    public function index($id)
    {   
        $data['hasil'] = $this->pm->get_materi($id);
        
        $this->template->load('template','peserta_list',$data);
    }

    public function peserta_list($id){
        $data = $this->pm->get_data_peserta($id);
        
        $b = array();
        $no = 1;
        foreach ($data as $k) {
            $a = array();
            $a[] = $no;
            $a[] = $k->nik;
            $a[] = $k->nama;
            $a[] = $k->jabatan;
            $a[] = $k->unit_kerja;
            $b[] = $a;
            $no++;
        }
        echo json_encode(['data' => $b]);
        //var_dump($b);
    }

    public function add(){
        $kj = $this->input->post('kode_jadwal');
        $p = $this->input->post('peserta');

        $dataj = array();
        $a = array();
        $b = array();
        $receiver = array();

        $cn = count($p);
        for ($i = 0; $i < $cn; $i++) {
            $dataj[] = array(
                'kode_jadwal' => $kj,
                'nik' => $p[$i],
                'nilai_pre' => 0,
                'nilai_post' => 0,
                'status_test' => 'ST.0001',
                'status_hasil' => 'ST.0005',
                'waktu_undang' => date('Y-m-d H:i:s')
            );
        }
        $result = $this->db->insert_batch('peserta', $dataj);

        $lastPeserta = $this->pm->get_last_data_peserta($kj);
        foreach ($lastPeserta as $j) {
            $a['nik'] = $j->nik;
            $a['nama'] = $j->nama;
            $a['email'] = $j->email;
            $a['mtr'] = $j->judul_materi;
            $a['tm'] = date("d-m-Y",strtotime($j->tanggal_mulai));
            $a['ts'] = date("d-m-Y",strtotime($j->tanggal_selesai));
            $b[] = $a;
        }
        $c = count($b);
        for ($i=0; $i < $c; $i++) { 
            $receiver[] = $b[$i]['email'];
        }
        echo json_encode($receiver);
        //DIBUAT ARRAY BIAR BISA NGIRIM BANYAK EMAIL
        
        //send email
        //$this->load->library('email');

        $sender = 'atikarizkyy@gmail.com';
        $pasw = '@t1k4r1zky';

        $config['protocol']     = 'smtp';
        $config['smtp_host']    = 'smtp.googlemail.com';
        $config['smtp_crypto']  = 'ssl';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '5';
        $config['smtp_user']    = 'atikarizkyy@gmail.com';
        $config['smtp_pass']    = '@t1k4r1zky';
        $config['charset']      = 'utf-8';
        $config['wordwrap']     = TRUE;
        $config['mailpath']     = '/usr/sbin/sendmail';
        $config['charset']      = 'iso-8859-1';
        $config['newline']      = "\r\n";
        $config['crlf']         = "\r\n";
        $config['mailtype']     = 'html'; // or html
        $config['validation']   = TRUE;
        
        $this->load->library('email', $config); 
        $this->email->initialize($config); 
        $this->email->from($sender, 'Divisi Human Capital Dev. & Learning Center');
        $this->email->to($receiver);
        $this->email->subject('Undangan Quiz');
        for ($i=0; $i < $c; $i++) { 
            $this->email->message($this->load->view('undangan_peserta',$b[$i],true));
        }
        $this->email->set_mailtype("html");

        if($this->email->send())
        {   
            echo $this->email->print_debugger(); echo 'mail send';
            echo json_encode(array("status" => TRUE));
        }
        else 
        {
            echo $this->email->print_debugger(); echo 'mail failed sent';
            echo json_encode(array("status" => FALSE));
        }
    }
}