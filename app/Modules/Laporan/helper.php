<?php

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