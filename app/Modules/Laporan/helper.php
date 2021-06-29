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

function print_pre($array) {
    echo '<pre>';
    print_r($array);
    echo '</pre>';
    return $array;
}

function getAreaFromKdc($kdc) {
    $data = DB::select("SELECT * FROM area WHERE kdc = $kdc");
    return $data;
}

function getEditPasien($laporan_id) {
    $data = DB::select("SELECT * FROM laporan_pasien WHERE laporan_id = $laporan_id");
    return $data;
}

function getNamaWilayah($id) {
    $data = DB::table('area')->select('name as nama')->where('id', '=', $id)->first();
    return $data->nama;
}

/*helper download*/
function force_download($filename = '', $data = '')
{
    if ($filename == '' OR $data == '')
    {
        return FALSE;
    }

        // Try to determine if the filename includes a file extension.
        // We need it in order to set the MIME type
    if (FALSE === strpos($filename, '.'))
    {
        return FALSE;
    }

        // Grab the file extension
    $x = explode('.', $filename);
    $extension = end($x);

        // Load the mime types
    if (defined('ENVIRONMENT') AND is_file('app/'.ENVIRONMENT.'/mimes.php'))
    {
        include('app/'.ENVIRONMENT.'/mimes.php');
    }
    elseif (is_file('app/mimes.php'))
    {
        include('app/mimes.php');
    }

        // Set a default mime if we can't find it
    if ( ! isset($mimes[$extension]))
    {
        $mime = 'application/octet-stream';
    }
    else
    {
        $mime = (is_array($mimes[$extension])) ? $mimes[$extension][0] : $mimes[$extension];
    }

        // Generate the server headers
    if (strpos($_SERVER['HTTP_USER_AGENT'], "MSIE") !== FALSE)
    {
        header('Content-Type: "'.$mime.'"');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header("Content-Transfer-Encoding: binary");
        header('Pragma: public');
        header("Content-Length: ".strlen($data));
    }
    else
    {
        header('Content-Type: "'.$mime.'"');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        header("Content-Transfer-Encoding: binary");
        header('Expires: 0');
        header('Pragma: no-cache');
        header("Content-Length: ".strlen($data));
    }

    exit($data);
}