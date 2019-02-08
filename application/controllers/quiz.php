<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Quiz extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('quiz_model','model');
        $this->load->helper('form','url');
    }

    public function index($st, $km)
    {
        $data['status'] = $st;
        $data['kode_materi'] = $km;
        $this->template->page_title = 'Quiz';
        $this->template->load('template', 'quiz_form', $data);
    }

    public function getDurasiTest($id){
        $data = $this->model->get_durasi_tes($id);
        echo json_encode($data);
    }

    public function ambil_info($id){ //kode_materi
        $result = $this->model->ambil_informasi($id);
        echo json_encode($result);
    }

    public function data_quiz($kode_materi){
        $data['result'] = $this->model->get_data_quiz_pt($kode_materi);
        $this->load->view('quiz_form',$data);
    }

    public function get_soal($no,$km){
        //$no = $no + 1;
        $data = $this->model->get_soal($no,$km);
        echo json_encode($data);
    }

    public function get_jawaban($id){
        $result = $this->model->get_jawaban($id);

        $data = "";
        $no = 1;
        foreach ($result as $value) {
            $data.= '<input type="hidden" id="kp" name="kp" value="'.$value->kode_pertanyaan.'"><label class="jawaban" for="'.$value->kode_jawaban.'"><h4 style="color:black">'.$value->jawaban.'</h4><input type="radio" id="'.$value->kode_jawaban.'" name="jwb" value="'.$value->kode_jawaban.'"><span class="checkmark"></span></label>';
        }
        echo json_encode(['data' => $data]);
    }

    public function save_hasil(){
        $p = $this->input->post('kp');
        $j = $this->input->post('jwb');
        $n = $this->session->userdata('nik');
        $h = "T";
        $data = array (
            'kode_pertanyaan' => $p,
            'kode_jawaban' => $j,
            'nik' => $n,
            'hasil_status' => $h,
            );
        if($this->model->cek_hasil($p, $n) == 1){
            //update ketika sudah ada data dan ingin ubah jawaban
            $this->db->where(array('kode_pertanyaan' => $p, 'nik' => $n));
            $this->db->update('hasil',array('kode_jawaban' => $j));
        } else {
            //insert ketika belum ada data
            $result = $this->db->insert('hasil', $data);
        }
        echo json_encode(array("status" => TRUE));
    }

    public function get_hasil($no,$km){
        $n = $this->session->userdata('nik');
        $data = $this->model->get_hasil($no, $km, $n);
        echo json_encode($data);
    }

    public function review_hasil($km){
        $n = $this->session->userdata('nik');
        $result = $this->model->review_hasil($km, $n);
        $data = array();
        $no = 1;
        foreach ($result as $value) {
            $row = array();
            $row[] = $value->nomor_soal;
            $row[] = $value->jwb;
            $data[] = $row;
        }
        echo json_encode($data);
    }

    public function get_skor($km){
        $n = $this->session->userdata('nik');

        //update status jawaban jadi Finished
        $this->db->where(array('nik' => $n));
        $this->db->update('hasil',array('hasil_status' => 'F'));

        //update status test jadi pre test dan tanggal test
        $this->db->query("UPDATE peserta p inner join jadwal j on p.kode_jadwal = j.kode_jadwal 
            SET status_test = 'ST.0002', tanggal_test = now()
            WHERE nik = '$n' and kode_materi = '$km' ");
        
        //ambil nilai skor
        $data = $this->model->get_skor($km, $n);
        foreach ($data as $value) {
            $nilai = $value->nilai;
            $nilai_min = $value->nilai_min;
        }
        echo json_encode($data);

        //update nilai pre atau post
        $tada = $this->model->cek_test($km, $n);
        foreach ($tada as $value) {
            $pre = $value->nilai_pre;
            $post = $value->nilai_post;
            $kj = $value->kj;
        }
        
        // jika belum test apapun maka update pre test
        if($pre == 0 && $post == 0){
            $this->db->where(array('nik' => $n, 'kode_jadwal' => $kj));
            $this->db->update('peserta',array('nilai_pre' => $nilai, 'status_test' => 'ST.0002'));
        // jika sudah pre test dan belum post test
        } else if($pre != 0 && $post == 0) {
            $this->db->where(array('nik' => $n, 'kode_jadwal' => $kj));
            $this->db->update('peserta',array('nilai_post' => $nilai, 'status_test' => 'ST.0003'));
            // jika nilai lebih besar sama dengan nilai minimal
            if($nilai >= $nilai_min) {
                $this->db->where(array('nik' => $n, 'kode_jadwal' => $kj));
                $this->db->update('peserta',array('status_hasil' => 'ST.0004'));
            // jika nilai lebih kecil dari nilai minimal
            } else if ($nilai < $nilai_min){
                $this->db->where(array('nik' => $n, 'kode_jadwal' => $kj));
                $this->db->update('peserta',array('status_hasil' => 'ST.0005'));
            }
        }
    }
}