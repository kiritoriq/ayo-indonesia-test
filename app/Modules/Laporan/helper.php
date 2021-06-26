<?php

use Illuminate\Support\Facades\DB;

function formatTanggalPanjang($tanggal) {
    if(substr($tanggal, 0,9) != '00-00-000' || substr($tanggal, 0,9) != ''){
        $aBulan = array(1=> "Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agt", "Sep", "Okt", "Nov", "Des");
        list($thn,$bln,$tgl)=explode("-",$tanggal);
        $bln = (($bln >0 ) && ($bln < 10))? substr($bln,1,1): $bln ;
        return $tgl." ".$aBulan[$bln]." ".$thn;
    }else{
        return '';
    }
}

function getProvinsi($isSel="") {
    $datas = DB::select('SELECT id, name FROM area WHERE parent_id = 0 AND id != 9999999');
    $html = "<select name='prov_id' id='prov_id' class='form-control h-auto py-5 px-6 rounded-lg prov'>";
    $html.= "<option value=''>Pilih Provinsi</option>";
    foreach($datas as $data) {
        $selected = ($data->id==$isSel)?'selected':'';
        $html.= "<option value='".$data->id."' ".$selected.">".$data->name."</option>";
    }
    $html.= "</select>";
    return $html;
}

function getKota($parent_id="", $isSel="") {
    $datas = DB::select('SELECT id, name FROM area WHERE parent_id = '.$parent_id.'::int8 ');
    $html = "<select name='kab_id' id='kab_id' class='form-control h-auto py-5 px-6 rounded-lg kabkota'>";
    $html.= "<option value=''>Pilih Kab/Kota</option>";
    foreach($datas as $data) {
        $selected = ($data->id==$isSel)?'selected':'';
        $html.= "<option value='".$data->id."' ".$selected.">".$data->name."</option>";
    }
    $html.= "</select>";
    return $html;
}

function getKecamatan($parent_id="", $isSel="") {
    $datas = DB::select("SELECT id, name FROM area WHERE parent_id = ".$parent_id." ::int8 ");
    $html = "<select name='kec_id' id='kec_id' class='form-control h-auto py-5 px-6 rounded-lg kec'>";
    $html.= "<option value=''>Pilih Kecamatan</option>";
    foreach($datas as $data) {
        $selected = ($data->id==$isSel)?'selected':'';
        $html.= "<option value='".$data->id."' ".$selected.">".$data->name."</option>";
    }
    $html.= "</select>";
    return $html;
}

function getKelurahan($parent_id="", $isSel="") {
    $datas = DB::select("SELECT id, name FROM area WHERE parent_id = ".$parent_id." ::int8 ");
    $html = "<select name='kel_id' id='kel_id' class='form-control h-auto py-5 px-6 rounded-lg kel'>";
    $html.= "<option value=''>Pilih Kelurahan</option>";
    foreach($datas as $data) {
        $selected = ($data->id==$isSel)?'selected':'';
        $html.= "<option value='".$data->id."' ".$selected.">".$data->name."</option>";
    }
    $html.= "</select>";
    return $html;
}