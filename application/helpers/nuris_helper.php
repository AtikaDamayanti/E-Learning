<?php
function cmb_dinamis($name,$table,$field,$pk,$selected){
    $ci = get_instance();
    $cmb = "<select name='$name' id='$name' class='form-control'>";
    $data = $ci->db->get($table)->result();
    foreach ($data as $d){
        $cmb .="<option value='".$d->$pk."'";
        $cmb .= $selected==$d->$pk?" selected='selected'":'';
        $cmb .=">".  strtoupper($d->$field)."</option>";
    }
    $cmb .="</select>";
    return $cmb;  
}

function cmb_ub($name,$selected){
    $ci = get_instance();
    $load = $ci->load->model('Unit_bisnis_model','ub');
    $cmb = "<select name='$name' id='$name' class='form-control'>";
    $data = $ci->ub->get_all();
    $cmb .= "<option>Pilih</option>";
    foreach ($data as $d){
        $cmb .="<option value='".$d->kode_unit_bisnis."'";
        $cmb .= $selected==$d->kode_unit_bisnis?" selected='selected'":'';
        $cmb .=">".strtoupper($d->nama_unit_bisnis)."</option>";
    }
    $cmb .="</select>";
    return $cmb;
}

function cmb_de($name,$selected){
    $ci = get_instance();
    $load = $ci->load->model('Department_model','de');
    $cmb = "<select name='$name' id='$name' class='form-control'>";
    $data = $ci->de->get_all();
    $cmb .= "<option>Pilih</option>";
    foreach ($data as $d){
        $cmb .="<option value='".$d->kode_department."'";
        $cmb .= $selected==$d->kode_department?" selected='selected'":'';
        $cmb .=">".strtoupper($d->nama_department)."</option>";
    }
    $cmb .="</select>";
    return $cmb;
}

function cmb_jb($name,$selected){
    $ci = get_instance();
    $load = $ci->load->model('Jabatan_model','jb');
    $cmb = "<select name='$name' id='$name' class='form-control'>";
    $data = $ci->jb->get_all();
    $cmb .= "<option>Pilih</option>";
    foreach ($data as $d){
        $cmb .="<option value='".$d->kode_jabatan."'";
        $cmb .= $selected==$d->kode_jabatan?" selected='selected'":'';
        $cmb .=">".strtoupper($d->nama_jabatan)."</option>";
    }
    $cmb .="</select>";
    return $cmb;
}

function cmb_pimpinan($name,$selected){
    $ci = get_instance();
    $load = $ci->load->model('Karyawan_model','ky');
    $cmb = "<select id='$name'>";
    $data = $ci->ky->get_all();
    $cmb .= "<option>Pilih</option>";
    foreach ($data as $d){
        $cmb .="<option value='".$d->kode_karyawan."'";
        $cmb .= $selected==$d->kode_karyawan?" selected='selected'":'';
        $cmb .=">".strtoupper($d->nama_karyawan)."</option>";
    }
    $cmb .="</select>";
    
    return $cmb;
}

function cmb_notulis($name,$selected){
    $ci = get_instance();
    $load = $ci->load->model('Karyawan_model','ky');
    $cmb = "<select id='$name'>";
    $data = $ci->ky->get_all();
    $cmb .= "<option>Pilih</option>";
    foreach ($data as $d){
        $cmb .="<option value='".$d->kode_karyawan."'";
        $cmb .= $selected==$d->kode_karyawan?" selected='selected'":'';
        $cmb .=">".strtoupper($d->nama_karyawan)."</option>";
    }
    $cmb .="</select>";
    
    return $cmb;
}

function cmb_peserta($name,$selected){
    $ci = get_instance();
    $load = $ci->load->model('Karyawan_model','ky');
    $cmb = "<select class='form-control peserta' name='peserta[]'>";
    $data = $ci->ky->get_all();
    $cmb .= "<option>Pilih</option>";
    foreach ($data as $d){
        $cmb .="<option value='".$d->kode_karyawan."'";
        $cmb .= $selected==$d->kode_karyawan?" selected='selected'":'';
        $cmb .=">".strtoupper($d->nama_karyawan)."</option>";
    }
    $cmb .="</select>";
    
    return $cmb;
}


