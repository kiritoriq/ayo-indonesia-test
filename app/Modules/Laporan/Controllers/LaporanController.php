<?php

namespace App\Modules\Laporan\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Laporan\Models\Laporan;
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
        $laporans = $this->model->with(['petugas'])->orderBy('created_at', 'desc')->get();
        // dd($laporans);
        return view('Laporan::index', ['laporans' => $laporans]);
    }

    public function getCreate() {
        return view('Laporan::create');
    }

    public function postCreate(Request $request) {
        // dd($request);
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
            $create = Laporan::create([
                'nama_pelapor' => $request->nama_pelapor,
                'alamat_pelapor' => $request->alamat_pelapor,
                'no_telp_pelapor' => $request->no_telp_pelapor,
                'isi_laporan' => $request->isi_laporan,
                'instansi' => $request->instansi,
                'user_id' => Auth::user()->id,
                'role_id' => Session::get('role_id')[0],
                'created_at' => date('Y-m-d H:i:s'),
            ]);
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
            $update = Laporan::where('id', '=', $request->id)->update([
                'nama_pelapor' => $request->nama_pelapor,
                'alamat_pelapor' => $request->alamat_pelapor,
                'no_telp_pelapor' => $request->no_telp_pelapor,
                'isi_laporan' => $request->isi_laporan,
                'instansi' => $request->instansi,
                'user_id' => Auth::user()->id,
                'role_id' => Session::get('role_id')[0],
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
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
}