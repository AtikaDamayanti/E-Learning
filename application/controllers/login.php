<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('login_model','lm');
        $this->load->library('form_validation');
        $this->load->helper('form','url');
    }

    public function index()
    {
        $session = $this->session->userdata('isLogin');
        if($session == FALSE)
        {
            $this->load->view('login_form');
        }
    }

    function do_login()
    {
        $email = $this->input->post("email");
        $password = $this->input->post("password");
        
        $cek = $this->lm->cek_user($email,$password);
        if(count($cek) == 1)
        {
            foreach ($cek as $c) 
            {
                $nik = $c->nik;
                $nama = $c->nama;
            }

            $this->session->set_userdata(array(
                'isLogin' => TRUE,
                'nik'     => $nik,
                'nama'    => $nama
            ));
            
            redirect('dashboard');            
            // $get = $this->login->getUnitKerja($nip);
           
            // if($get == "Pelayan"){
            //     redirect('penerimaan');
            // } else {
            //     redirect('pengiriman');
            // } 
        } else {
            redirect('login');
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect('login','refresh');
    }
}