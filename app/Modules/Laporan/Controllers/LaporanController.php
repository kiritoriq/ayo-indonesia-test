<?php

namespace App\Modules\Laporan\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Modules\Laporan\Models\Laporan;
use App\Modules\Laporan\Models\LaporanPasien;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LaporanController extends Controller {

    private $model;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Laporan $laporan)
    {
        $this->model = $laporan;
        $this->middleware('auth');
    }

    public function index()
    {
        $laporans = $this->model->with(['petugas'])->where('deleted_at', '=', null)->orderBy('created_at', 'desc')->get();
        // dd($laporans);
        return view('Laporan::index', ['laporans' => $laporans]);
    }

    public function loadDataTables() {
        // DIGARAP MAS ULIL
    }

    public function getCetakExcel() {
        return view('Laporan::filter_cetak');
    }
    
    public function postCetakExcel(Request $request) {
        $tanggal1 = date('Y-m-d H:i:s', strtotime($request->tanggal1));
        $tanggal2 = date('Y-m-d H:i:s', strtotime($request->tanggal2));
        $data = $this->model->with(['petugas'])->where('deleted_at','=',null)->whereRaw("created_at BETWEEN '".$tanggal1."' AND '".$tanggal2."'")->orderBy('created_at', 'desc')->get();
        
        // dd($data);
        $pada_1 = strtoupper(formatTanggalPanjang(date('Y-m-d', strtotime($request->tanggal1))));
        $pada_2 = strtoupper(formatTanggalPanjang(date('Y-m-d', strtotime($request->tanggal2))));
        return view('Laporan::cetak_excel', ['datas' => $data, 'pada_1' => $pada_1, 'pada_2' => $pada_2, 'tanggal_1' => $tanggal1, 'tanggal_2' => $tanggal2]);
    }

    public function getCreate() {
        return view('Laporan::create');
    }

    public function postCreate(Request $request) 
    {

        // print_pre($request->all());
        // exit;
        $validator = Validator::make($request->all(), [
            'nama_pelapor' => 'required',
            'alamat_pelapor' => 'required',
            'no_telp_pelapor' => 'required',
            'isi_laporan' => 'required',
            'instansi' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json(['status' => 'validate', 'error' => ucwords(implode(', ', str_replace('field is required.', 'Tidak Boleh Kosong', str_replace('The ', '', $validator->errors()->all()))))]);
        } else {

            $create = new Laporan;
            $create->nama_pelapor = $request->nama_pelapor;
            $create->alamat_pelapor = $request->alamat_pelapor;
            $create->no_telp_pelapor = $request->no_telp_pelapor;
            $create->isi_laporan = $request->isi_laporan;
            $create->instansi = $request->instansi;
            $create->asal_instansi = ($request->asal_instansi != '')?$request->asal_instansi:'';
            $create->prov_id = $request->prov_id;
            $create->kab_id = $request->kab_id;
            $create->kec_id = $request->kec_id;
            $create->kel_id = $request->kel_id;
            $create->solusi = $request->solusi;
            $create->user_id = Auth::user()->id;
            $create->role_id = Session::get('role_id')[0];
            $create->created_at = date('Y-m-d H:i:s');
            $create->save();

            if (isset($request->nik_pasien)) {
                $_pasien = [];
                foreach($request->nik_pasien as $key => $item) {
                    $_pasien[] = (object)[
                        'nik_pasien' => $item,
                        'nama_lengkap_pasien' => ($request->nama_lengkap_pasien[$key] ? $request->nama_lengkap_pasien[$key] : 0),
                        'prov_id_pasien' => ($request->prov_id_pasien[$key] ? $request->prov_id_pasien[$key] : 0),
                        'kab_id_pasien' => ($request->kab_id_pasien[$key] ? $request->kab_id_pasien[$key] : 0),
                        'kec_id_pasien' => ($request->kec_id_pasien[$key] ? $request->kec_id_pasien[$key] : 0),
                        'kel_id_pasien' => ($request->kel_id_pasien[$key] ? $request->kel_id_pasien[$key] : 0),
                        'alamat_pasien' => ($request->alamat_pasien[$key] ? $request->alamat_pasien[$key] : 0),
                        'tgl_lahir_pasien' => ($request->tgl_lahir_pasien[$key] ? $request->tgl_lahir_pasien[$key] : 0),
                        'golongan_darah_pasien' => ($request->golongan_darah_pasien[$key] ? $request->golongan_darah_pasien[$key] : 0),
                        'f' => ($request->f[$key] ? $request->f[$key] : 0),
                    ];
                }
                
                foreach($_pasien as $items) {
                    $laporan_pasien = new LaporanPasien;
                    $laporan_pasien->laporan_id = $create->id;
                    $laporan_pasien->nama_lengkap = $items->nama_lengkap_pasien;
                    if ($items->f=='f-api') {
                        $laporan_pasien->prov_id = getAreaFromKdc($items->prov_id_pasien)[0]->id;
                        $laporan_pasien->kab_id = getAreaFromKdc($items->kab_id_pasien)[0]->id;
                        $laporan_pasien->kec_id = getAreaFromKdc($items->kec_id_pasien)[0]->id;
                        $laporan_pasien->kel_id = getAreaFromKdc($items->kel_id_pasien)[0]->id;
                    } else {
                        $laporan_pasien->prov_id = $items->prov_id_pasien;
                        $laporan_pasien->kab_id = $items->kab_id_pasien;
                        $laporan_pasien->kec_id = $items->kec_id_pasien;
                        $laporan_pasien->kel_id = $items->kel_id_pasien;
                    }
                    $laporan_pasien->alamat = $items->alamat_pasien;
                    $laporan_pasien->tgl_lahir = (isset(explode(', ',$items->tgl_lahir_pasien)[1]) ? explode(', ',$items->tgl_lahir_pasien)[1] : $items->tgl_lahir_pasien);
                    $laporan_pasien->golongan_darah = $items->golongan_darah_pasien;
                    $laporan_pasien->nik = $items->nik_pasien;
                    $laporan_pasien->save();
                }

            }
            // exit;

            if($create) {
                return response()->json(['status' => 'success', 'msg' => 'Laporan telah berhasil disimpan!']);
            } else {
                return response()->json(['status' => 'failed', 'msg' => 'Laporan gagal disimpan!', 'error' => $create]);
            }
        }
    }

    public function getEdit($id) {
        $laporan = $this->model->where('id', '=', $id)->first();
        return view('Laporan::edit', ['laporan' => $laporan]);
    }
    
    public function add_pasien() {
        return view('Laporan::add_pasien');
    }
    
    public function add_nik() {
        return view('Laporan::add_nik');
    }

    public function postEdit(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama_pelapor' => 'required',
            'alamat_pelapor' => 'required',
            'no_telp_pelapor' => 'required',
            'isi_laporan' => 'required',
            'instansi' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json(['status' => 'validate', 'error' => ucwords(implode(', ', str_replace('field is required.', 'Tidak Boleh Kosong', str_replace('The ', '', $validator->errors()->all()))))]);
        } else {

            $update = Laporan::find($request->id);
            $update->nama_pelapor = $request->nama_pelapor;
            $update->alamat_pelapor = $request->alamat_pelapor;
            $update->no_telp_pelapor = $request->no_telp_pelapor;
            $update->isi_laporan = $request->isi_laporan;
            $update->instansi = $request->instansi;
            $update->asal_instansi = ($request->asal_instansi != '')?$request->asal_instansi:'';
            $update->prov_id = $request->prov_id;
            $update->kab_id = $request->kab_id;
            $update->kec_id = $request->kec_id;
            $update->kel_id = $request->kel_id;
            $update->user_id = Auth::user()->id;
            $update->solusi = $request->solusi;
            $update->role_id = Session::get('role_id')[0];
            $update->updated_at = date('Y-m-d H:i:s');
            $update->save();

            if (isset($request->nik_pasien)) {
                $_pasien = [];
                foreach($request->nik_pasien as $key => $item) {
                    $_pasien[] = (object)[
                        'nik_pasien' => $item,
                        'nama_lengkap_pasien' => ($request->nama_lengkap_pasien[$key] ? $request->nama_lengkap_pasien[$key] : 0),
                        'prov_id_pasien' => ($request->prov_id_pasien[$key] ? $request->prov_id_pasien[$key] : 0),
                        'kab_id_pasien' => ($request->kab_id_pasien[$key] ? $request->kab_id_pasien[$key] : 0),
                        'kec_id_pasien' => ($request->kec_id_pasien[$key] ? $request->kec_id_pasien[$key] : 0),
                        'kel_id_pasien' => ($request->kel_id_pasien[$key] ? $request->kel_id_pasien[$key] : 0),
                        'alamat_pasien' => ($request->alamat_pasien[$key] ? $request->alamat_pasien[$key] : 0),
                        'tgl_lahir_pasien' => ($request->tgl_lahir_pasien[$key] ? $request->tgl_lahir_pasien[$key] : 0),
                        'golongan_darah_pasien' => ($request->golongan_darah_pasien[$key] ? $request->golongan_darah_pasien[$key] : 0),
                        'f' => ($request->f[$key] ? $request->f[$key] : 0),
                    ];
                }
                
                foreach($_pasien as $items) {
                    $chk = DB::select("SELECT * FROM laporan_pasien WHERE nik = '$items->nik_pasien' AND laporan_id = $request->id");
                    if (!$chk) {
                        $laporan_pasien = new LaporanPasien;
                        $laporan_pasien->laporan_id = $request->id;
                        $laporan_pasien->nama_lengkap = $items->nama_lengkap_pasien;
                        if ($items->f=='f-api') {
                            $laporan_pasien->prov_id = getAreaFromKdc($items->prov_id_pasien)[0]->id;
                            $laporan_pasien->kab_id = getAreaFromKdc($items->kab_id_pasien)[0]->id;
                            $laporan_pasien->kec_id = getAreaFromKdc($items->kec_id_pasien)[0]->id;
                            $laporan_pasien->kel_id = getAreaFromKdc($items->kel_id_pasien)[0]->id;
                        } else {
                            $laporan_pasien->prov_id = $items->prov_id_pasien;
                            $laporan_pasien->kab_id = $items->kab_id_pasien;
                            $laporan_pasien->kec_id = $items->kec_id_pasien;
                            $laporan_pasien->kel_id = $items->kel_id_pasien;
                        }
                        $laporan_pasien->alamat = $items->alamat_pasien;
                        $laporan_pasien->tgl_lahir = (isset(explode(', ',$items->tgl_lahir_pasien)[1]) ? explode(', ',$items->tgl_lahir_pasien)[1] : $items->tgl_lahir_pasien);
                        $laporan_pasien->golongan_darah = $items->golongan_darah_pasien;
                        $laporan_pasien->nik = $items->nik_pasien;
                        $laporan_pasien->save();
                    }
                }
            }

            if($update) {
                return response()->json(['status' => 'success', 'msg' => 'Laporan telah berhasil disimpan!']);
            } else {
                return response()->json(['status' => 'failed', 'msg' => 'Laporan gagal disimpan!', 'error' => $update]);
            }
        }
    }

    public function getDetails($id) {
        $laporan = $this->model->where('id', '=', $id)->first();
        return view('Laporan::details', ['laporan' => $laporan]);
    }

    public function postDelete($id) {
        $data = $this->model->find($id);
        $insert_log = DB::table('delete_log')->insert([
            'laporan_id' => $id,
            'user_id' => Auth::user()->id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        if($insert_log) {
            $update = $this->model->where('id', '=', $id)->update(['deleted_at' => date('Y-m-d H:i:s')]);
            if($update) {
                return response()->json(['status' => 'success', 'msg' => 'Data Laporan berhasil dihapus']);
            }
        } else {
            return response()->json(['status' => 'failed', 'msg' => 'Data tidak berhasil dihapus']);
        }
    }

    public function getKota(Request $request) {
        return getKota($request->parent_id, $request->selected);
    }

    public function getKecamatan(Request $request) {
        return getKecamatan($request->parent_id, $request->selected);
    }

    public function getKelurahan(Request $request) {
        return getKelurahan($request->parent_id, $request->selected);
    }

    public function add_pasien_action(Request $request)
    {
        $nik = $request->nik;
        $url = 'http://172.16.160.43:8080/dukcapil/get_json/33/diskominfo_33/call_nik';
        $ip = '10.33.0.30';
        $userId = '202002066kominfo';
        $password = 'kominfo2020';

        $data = array(
            'nik'       => $nik,
            'user_id'   => $userId,
            'password'  => $password,
            'ip_user'   => $ip
        );

        // CHECK APAKAH ADA DI DB ATAU BELUM
        $check = DB::select("SELECT * FROM laporan_pasien WHERE nik = '$nik'");
        if (!$check) {
            $data_string = json_encode($data);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-type: application/json',
                'accept: application/json'
            ));
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT, 15); //timeout in seconds

            $output = curl_exec($ch);
            $result = $output;
            if($output == false or $output != 0){
                $result = json_encode($output);
            }

            curl_close($ch);
            if($output == false) {
                return 'Api Capil Sedang Bermasalah Mohon dicoba kembali 5-10 menit lagi !';
            }
            return ($output);
        } else {
            return (json_encode($check));
        }
    }

    public function hapus_pasien(Request $request)
    {
        $data = LaporanPasien::find($request->id);
        $data->delete();
        return response()->json(['status' => 'success', 'msg' => 'Data Pasien berhasil dihapus']);
    }

}