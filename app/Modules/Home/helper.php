<?php

use Illuminate\Support\Facades\DB;
/**
 *	Home Helper
 */

 function getDataAduan($tanggal) {
     $data = DB::select("WITH _param as (
        SELECT
            '".$tanggal."' ::text as _vtanggal
        )
        , _laporan_dasar as (
            SELECT
            -- 	jns.id,
            -- 	jns.jenis_aduan,
            -- 	COUNT(lp.id) as jumlah_laporan
                lp.*
            FROM
                laporan lp
            -- LEFT JOIN
            -- 	jenis_aduan jns ON jns.id = lp.id_jenis_aduan
            WHERE
            lp.deleted_at is null
            AND
            CASE WHEN
                (select _vtanggal from _param) = '0'
            THEN
                true
            ELSE
                CONCAT_WS('/', lpad(EXTRACT(day from lp.created_at) ::text, 2, '0'), lpad(EXTRACT(month from lp.created_at) ::text, 2, '0')) = (select _vtanggal from _param)
            END
            -- ORDER BY
            -- 	jns.id ASC
        )
        , _aduan as (
            SELECT
                jns.jenis_aduan,
                COUNT(lp.id) as jml_laporan
            FROM
                _laporan_dasar lp
            RIGHT JOIN
                jenis_aduan jns ON jns.id = lp.id_jenis_aduan
            GROUP BY
                jns.jenis_aduan
        )
        , _total as (
            SELECT
                'Total' ::text as jenis_aduan,
                SUM(jml_laporan) as jml_laporan
            FROM
                _aduan
        )
        , _pre_show as (
            SELECT
                *,
                CASE WHEN
                    jml_laporan != 0
                THEN
                    ((jml_laporan / (select jml_laporan from _total)) * 100) ::NUMERIC (30, 2)
                ELSE
                    0
                END as prosentase_show,
                CASE WHEN
                    jml_laporan != 0
                THEN
                    ((jml_laporan / (select jml_laporan from _total)) * 100)
                ELSE
                    0
                END as prosentase_asli
            FROM _aduan
        )
        , _total_persen as (
            SELECT
                'Total' ::text as jenis_aduan,
                SUM(jml_laporan) as jml_laporan,
                SUM(prosentase_show) :: NUMERIC(30,2) as prosentase_show,
                SUM(prosentase_asli) :: NUMERIC(30,2) as prosentase_asli
            FROM
                _pre_show
        )
        , _show as (
            SELECT
                *
            FROM
                _pre_show
            UNION ALL
            SELECT
                *
            FROM _total_persen
        )
        SELECT * FROM _show");
    return $data;
 }
