<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function cek_user($email,$password)
    {
        $query = $this->db->query("SELECT nik, nama FROM karyawan
                    WHERE email = '$email' AND password = '$password'");
        return $query->result();
    }

    function getUnitKerja($nip){
        // $q = $this->db->query("select substr(nama_unit_kerja, 8, 7) as nama_unit 
        //             from unit_kerja uk 
        //             join pegawai p on p.KODE_UNIT_KERJA = uk.KODE_UNIT_KERJA
        //             where nip = '$nip' ");
        // foreach ($q->result() as $value) {
        //     $v = $value->nama_unit;
        // }
        // return $v;
    }

}