<?php

namespace App\Helpers;

use App\Models\Organization;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;

class Helper
{

    public static function tgl($timestamp = '', $date_format = 'l, j F Y | H:i', $suffix = 'WIB')
    {
        if (trim($timestamp) == '') {
            $timestamp = time();
        } elseif (!ctype_digit($timestamp)) {
            $timestamp = strtotime($timestamp);
        }
        # remove S (st,nd,rd,th) there are no such things in indonesia :p
        $date_format = preg_replace("/S/", "", $date_format);
        $pattern = array(
            '/Mon[^day]/', '/Tue[^sday]/', '/Wed[^nesday]/', '/Thu[^rsday]/',
            '/Fri[^day]/', '/Sat[^urday]/', '/Sun[^day]/', '/Monday/', '/Tuesday/',
            '/Wednesday/', '/Thursday/', '/Friday/', '/Saturday/', '/Sunday/',
            '/Jan[^uary]/', '/Feb[^ruary]/', '/Mar[^ch]/', '/Apr[^il]/', '/May/',
            '/Jun[^e]/', '/Jul[^y]/', '/Aug[^ust]/', '/Sep[^tember]/', '/Oct[^ober]/',
            '/Nov[^ember]/', '/Dec[^ember]/', '/January/', '/February/', '/March/',
            '/April/', '/June/', '/July/', '/August/', '/September/', '/October/',
            '/November/', '/December/',
        );
        $replace = array(
            'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min',
            'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu',
            'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des',
            'Januari', 'Februari', 'Maret', 'April', 'Juni', 'Juli', 'Agustus', 'September',
            'Oktober', 'November', 'Desember',
        );
        $date = date($date_format, $timestamp);
        $date = preg_replace($pattern, $replace, $date);
        $date = "{$date} {$suffix}";
        return $date;
    }

    public static function getBrowser()
    {

        $agent = $_SERVER['HTTP_USER_AGENT'];
        $name = 'NA';


        if (preg_match('/MSIE/i', $agent) && !preg_match('/Opera/i', $agent)) {
            $name = 'Internet Explorer';
        } elseif (preg_match('/Firefox/i', $agent)) {
            $name = 'Mozilla Firefox';
        } elseif (preg_match('/Chrome/i', $agent)) {
            $name = 'Google Chrome';
        } elseif (preg_match('/Safari/i', $agent)) {
            $name = 'Apple Safari';
        } elseif (preg_match('/Opera/i', $agent)) {
            $name = 'Opera';
        } elseif (preg_match('/Netscape/i', $agent)) {
            $name = 'Netscape';
        }

        return $name;
    }

    public static function getUserIP()
    {
        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') > 0) {
                $addr = explode(",", $_SERVER['HTTP_X_FORWARDED_FOR']);
                return trim($addr[0]);
            } else {
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    public static function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE)
    {
        $output = NULL;
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
        $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
        $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
        $continents = array(
            "AF" => "Africa",
            "AN" => "Antarctica",
            "AS" => "Asia",
            "EU" => "Europe",
            "OC" => "Australia (Oceania)",
            "NA" => "North America",
            "SA" => "South America"
        );
        if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
            $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
            if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                switch ($purpose) {
                    case "location":
                        $output = array(
                            "city"           => @$ipdat->geoplugin_city,
                            "state"          => @$ipdat->geoplugin_regionName,
                            "country"        => @$ipdat->geoplugin_countryName,
                            "country_code"   => @$ipdat->geoplugin_countryCode,
                            "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                            "continent_code" => @$ipdat->geoplugin_continentCode
                        );
                        break;
                    case "address":
                        $address = array($ipdat->geoplugin_countryName);
                        if (@strlen($ipdat->geoplugin_regionName) >= 1)
                            $address[] = $ipdat->geoplugin_regionName;
                        if (@strlen($ipdat->geoplugin_city) >= 1)
                            $address[] = $ipdat->geoplugin_city;
                        $output = implode(", ", array_reverse($address));
                        break;
                    case "city":
                        $output = @$ipdat->geoplugin_city;
                        break;
                    case "state":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "region":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "country":
                        $output = @$ipdat->geoplugin_countryName;
                        break;
                    case "countrycode":
                        $output = @$ipdat->geoplugin_countryCode;
                        break;
                }
            }
        }
        return $output;
    }

    public static function friendlyFilename($string)
    {
        $string = str_replace(array('[\', \']'), '', $string);
        $string = preg_replace('/\[.*\]/U', '', $string);
        $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '_', $string);
        $string = htmlentities($string, ENT_COMPAT, 'utf-8');
        $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string);
        $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/'), '_', $string);
        $string = str_replace('__', '_', $string);
        return strtolower(trim($string, '_'));
    }

    public static function limit_text($text, $limit)
    {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
    }

    public static function formatTanggalPanjang($tanggal) {
        if(substr($tanggal, 0,9) != '00-00-000' || substr($tanggal, 0,9) != ''){
            $aBulan = array(1=> "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
            list($thn,$bln,$tgl)=explode("-",$tanggal);
            $bln = (($bln >0 ) && ($bln < 10))? substr($bln,1,1): $bln ;
            return $tgl." ".$aBulan[$bln]." ".$thn;
        }else{
            return '';
        }
    }

    public static function getOrgById($id)
    {
        $orgs = Organization::where('id', $id)
            ->orderBy('created_at', 'asc')
            ->first();
        
        return $orgs;
    }

}
