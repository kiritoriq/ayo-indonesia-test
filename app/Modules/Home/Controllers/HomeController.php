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
        $data_aduan = getDataAduan(0);
        // dd($data_aduan);
        return view("Home::index", ['data_aduan' => $data_aduan]);
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

    public function loadDataGrafik() {
        $data = DB::select("SELECT date_trunc('day', created_at) as tanggal, COUNT(id) as jumlah FROM laporan WHERE deleted_at IS NULL GROUP BY date_trunc('day', created_at) ORDER BY date_trunc('day', created_at) ASC");
        foreach($data as $key => $row) {
            $data[$key]->tanggal = date('d/m', strtotime($row->tanggal));
        }

        foreach($data as $item) {
            echo $item->tanggal.", ".$item->jumlah."\r\n";
        }
    }

    public function getPageAduan(Request $request) {
        // dd($request);
        $data = getDataAduan($request->tanggal);
        return view('Home::modal_grafik', ['datas' => $data, 'tanggal' => $request->tanggal]);
    }

    public function loadDataGrafikAduan(Request $request) {
        // $data = DB::select("SELECT jns.id, jns.jenis_aduan, COUNT(lp.id) as jumlah_laporan FROM laporan lp RIGHT JOIN jenis_aduan jns ON jns.id = lp.id_jenis_aduan GROUP BY jns.id, jns.jenis_aduan ORDER BY jns.id ASC");
        $data = getDataAduan($request->tanggal);
        // dd($data);
        foreach($data as $item) {
            echo $item->jenis_aduan.", ".$item->jml_laporan."\r\n";
        }
    }

    public function getDataFaskes() {
        $data_psc = DB::table('data_psc119')->select('*')->get();
        return view('Home::data_faskes', ['data_psc' => $data_psc]);
    }

    public function getDataLain() {
        $data_vaksinasi = DB::table('lokasi_vaksin')->select('*')->where('is_aktif', '=', 1)->orderBy('id', 'desc')->get();
        $data_isolasi = DB::table('lokasi_isolasi')->select('*')->where('is_aktif', '=', 1)->get();
        return view('Home::data_lain', ['data_vaksinasi' => $data_vaksinasi, 'data_isolasi' => $data_isolasi]);
    }
}
