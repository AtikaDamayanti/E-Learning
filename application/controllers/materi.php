<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Materi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Materi_model','model');
        $this->load->library('form_validation');
        $this->load->helper('form','url');
    }

    public function index()
    {
        $data = array(
            'button' => 'Create'
        );
        $this->template->load('template','materi_form',$data);
    }

    public function get_download($file){
        $this->load->helper('download');
        //$data = file_get_contents(site_url()'./uploads/'.$file);
        //$name = $this->uri->segment(3);
        $name = $file;
        force_download($name, $data);
    }

    public function data_quiz($kode_materi){
        $data['result'] = $this->model->get_data_quiz_pt($kode_materi);
    
        $this->template->load('template','quiz_list',$data);
    }

    public function data_materi(){
        $result = $this->model->get_data_materi();
        $data = array();
        $no = 1;
        foreach ($result as $value) {
            $row = array();
            $row[] = $no;
            $row[] = $value->judul_materi;
            $row[] = $value->deskripsi_materi;
            $row[] = $value->tanggal_upload;
            $row[] = '<a title="Tambah Quiz" href="pertanyaan/index/'.$value->kode_materi.'"><i class="fa fa-plus-circle fa-2x"></i></a>&emsp;<a title="Lihat Quiz" href="materi/data_quiz/'.$value->kode_materi.'"><i class="fa fa-list fa-2x"></i></a>';
            //$row[] = '<a title="Download File" href="'.base_url('uploads/'.$value->file_materi).'"><i class="fa fa-download fa-2x"></i></a>&emsp;<a title="Edit Quiz" href="javascript:void(0)" onclick=ubah('."'".$value->kode_materi."'".')><i class="fa fa-edit fa-2x"></i></a>';
            $row[] = '<a title="Download File" href="'.base_url('uploads/'.$value->file_materi).'"><i class="fa fa-download fa-2x"></i></a>';
            $data[] = $row;
            $no++;
        }
        echo json_encode(['data' => $data]);
    }

    public function add(){
        $judul = $this->input->post('judul_materi');
        $path = $_FILES['file_materi']['name'];
        $name = $judul.".".pathinfo($path, PATHINFO_EXTENSION);
        $newName = str_replace(' ', '_', $name);

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'pdf|doc|docx|ppt|pptx|jpg|png|jpeg|zip|rar';
        $config['max_filename'] = '255';
        $config['max_size'] = '100000'; //100 MB
        $config['file_name'] = $newName;
        
        $this->load->library('upload', $config);
        $this->upload->initialize($config); 

        //kondisi jika tipe file salah dan ukuran terlalu besar
        if ($this->upload->do_upload('file_materi')) { 
            $this->model->add($newName);
            echo json_encode(array("status" => TRUE));
        } else {
			echo json_encode(array("status" => FALSE));
        } 
    }

    public function edit($id){
        $data = $this->model->read_data_materi($id);
        echo json_encode($data);
    }

    public function update(){
        $judul = $this->input->post('judul_materi');
        $path = $_FILES['file_materi']['name'];
        $name = $judul.".".pathinfo($path, PATHINFO_EXTENSION);
        $newName = str_replace(' ', '_', $name);

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'pdf|doc|docx|ppt|pptx|jpg|png|jpeg';
        $config['max_filename'] = '255';
        $config['max_size'] = '3048'; //3 MB
        $config['file_name'] = $newName;
        $config['overwrite'] = true;

        $this->upload->library('upload',$config);
        $this->upload->initialize($config); 
        $upl_data = $this->upload->data();
        $oldName = $upl_data['file_name'];

        if(file_exists($newName)){
            rename($oldName,$newName);
        }

        $id = $this->input->post('kode_materi');
        $data = array(
            'judul_materi' => $this->input->post('judul_materi'),
            'deskripsi_materi' => $this->input->post('deskripsi_materi'),
            'tanggal_upload' => date("Y-m-d H:i:s"),
            'file_materi' => $newName
        );
        $this->model->update($id,$data);
        echo json_encode(array("status" => TRUE));
    }
}