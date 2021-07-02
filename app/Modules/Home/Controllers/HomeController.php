<?php

namespace App\Modules\Home\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_psc = DB::table('data_psc119')->select('*')->get();
        return view("Home::index", ['data_psc' => $data_psc]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function loadDataTablesRS() {
        $draw = $_REQUEST['draw'];
        $limit_data = $_REQUEST['length'];
        $offset_data = $_REQUEST['start'];
        $cari_data =  $_POST['search']['value'];
        $order_data = "desc";
        $data = DB::select("SELECT * FROM data_rs_jateng('".$cari_data."', '".$order_data."', '".$limit_data."', '".$offset_data."' )");
        
        $output_table = array();
        $output_table['aaData'] = array();
        $total_row = 0;

        if ($data != null || $data[0]->level != 1) {
            foreach ($data as $row) {
                if ($row->level == 1) {
                    $list = [];
                    $list["no"] = $row->row_data;
                    $list["nama_rs"] = ucwords($row->nama_rs);
                    $list["alamat_rs"] = ucwords($row->alamat_rs);
                    $list["website_rs"] = ucwords($row->website_rs);
                    $list["no_telp"] = $row->no_telp;
                    $list["kabkot"] = $row->kab_kota;
                    $list["kec"] = $row->kec;
                    $list["kel"] = $row->kel;
                    $output_table['aaData'][] = $list;
                } elseif ($row->level == 99) {
                    $total_row = ($row->row_data != null) ? $row->row_data : 0;
                }
            }
        }

        $output_table['sEcho'] = $draw;
        $output_table['iTotalRecords'] = $output_table['iTotalDisplayRecords'] = $total_row;
      
        return response()->json($output_table);
    }

    public function loadDataTablesDirRS() {
        $draw = $_REQUEST['draw'];
        $limit_data = $_REQUEST['length'];
        $offset_data = $_REQUEST['start'];
        $cari_data =  $_POST['search']['value'];
        $order_data = "desc";
        $data = DB::select("SELECT * FROM data_direktur_rs_jateng('".$cari_data."', '".$order_data."', '".$limit_data."', '".$offset_data."' )");
        
        $output_table = array();
        $output_table['aaData'] = array();
        $total_row = 0;

        if ($data != null || $data[0]->level != 1) {
            foreach ($data as $row) {
                if ($row->level == 1) {
                    $list = [];
                    $list["no"] = $row->row_data;
                    $list["nama_rs"] = ucwords($row->nama_rs);
                    $list["kls_rs"] = ucwords($row->kls_rs);
                    $list["nama_direktur"] = ucwords($row->nama_direktur);
                    $list["no_telp"] = $row->no_telp;
                    $output_table['aaData'][] = $list;
                } elseif ($row->level == 99) {
                    $total_row = ($row->row_data != null) ? $row->row_data : 0;
                }
            }
        }

        $output_table['sEcho'] = $draw;
        $output_table['iTotalRecords'] = $output_table['iTotalDisplayRecords'] = $total_row;
      
        return response()->json($output_table);
    }

    public function loadDataTablesPuskesmas() {
        $draw = $_REQUEST['draw'];
        $limit_data = $_REQUEST['length'];
        $offset_data = $_REQUEST['start'];
        $cari_data =  $_POST['search']['value'];
        $order_data = "desc";
        $data = DB::select("SELECT * FROM data_puskesmas_jateng('".$cari_data."', '".$order_data."', '".$limit_data."', '".$offset_data."' )");
        
        $output_table = array();
        $output_table['aaData'] = array();
        $total_row = 0;

        if ($data != null || $data[0]->level != 1) {
            foreach ($data as $row) {
                if ($row->level == 1) {
                    $list = [];
                    $list["no"] = $row->row_data;
                    $list["nama_wilayah"] = ucwords($row->nama_wilayah);
                    $list["nama_puskesmas"] = ucwords($row->nama_puskesmas);
                    $list["kepala_puskesmas"] = ucwords($row->kepala_puskesmas);
                    $list["no_telp"] = $row->no_telp;
                    $output_table['aaData'][] = $list;
                } elseif ($row->level == 99) {
                    $total_row = ($row->row_data != null) ? $row->row_data : 0;
                }
            }
        }

        $output_table['sEcho'] = $draw;
        $output_table['iTotalRecords'] = $output_table['iTotalDisplayRecords'] = $total_row;
      
        return response()->json($output_table);
    }

    public function loadDataGrafik() {
        $data = DB::select("SELECT date_trunc('day', created_at) as tanggal, COUNT(id) as jumlah FROM laporan WHERE deleted_at IS NULL GROUP BY date_trunc('day', created_at) ORDER BY date_trunc('day', created_at) ASC");
        foreach($data as $key => $row) {
            $data[$key]->tanggal = date('d/m', strtotime($row->tanggal));
        }

        foreach($data as $item) {
            echo $item->tanggal.", ".$item->jumlah."\r\n";
        }
    }
}
