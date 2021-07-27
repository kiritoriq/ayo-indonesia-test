<?php

namespace App\Modules\JenisAduan\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class JenisAduanController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis_aduan = DB::select('SELECT * FROM jenis_aduan ORDER BY id ASC');
        // dd($jenis_aduan);
        return view("JenisAduan::index", ['jenis_aduan' => $jenis_aduan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        return view('JenisAduan::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreate(Request $request)
    {
        // dd();
        $isAktif = 0;
        if($request->has('isAktif')) {
            $isAktif = $request->isAktif;
        }
        $validator = Validator::make($request->all(), [
            'jenis_aduan' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json(['status' => 'error', 'msg' => ucwords(implode(', ', str_replace('field is required.', 'Tidak Boleh Kosong', str_replace('The ', '', $validator->errors()->all()))))]);
        } else {
            $insert = DB::table('jenis_aduan')
                        ->insert([
                            'jenis_aduan' => $request->jenis_aduan,
                            'isAktif' => $isAktif,
                            'created_at' => date('Y-m-d H:i:s'),
                            'user_id' => \Auth::user()->id
                        ]);
            if($insert) {
                return response()->json(['status' => 'success', 'msg' => 'Data Berhasil Disimpan!']);
            } else {
                return response()->json(['status' => 'error', 'msg' => $insert]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit(Request $request)
    {
        $data = DB::table('jenis_aduan')->where('id', '=', $request->id)->first();
        return view('JenisAduan::edit', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postEdit(Request $request)
    {
        $isAktif = 0;
        if($request->has('isAktif')) {
            $isAktif = $request->isAktif;
        }
        $validator = Validator::make($request->all(), [
            'jenis_aduan' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json(['status' => 'error', 'msg' => ucwords(implode(', ', str_replace('field is required.', 'Tidak Boleh Kosong', str_replace('The ', '', $validator->errors()->all()))))]);
        } else {
            $insert = DB::table('jenis_aduan')
                        ->where('id', '=', $request->id)
                        ->update([
                            'jenis_aduan' => $request->jenis_aduan,
                            'isAktif' => $isAktif,
                            'updated_at' => date('Y-m-d H:i:s'),
                        ]);
            if($insert) {
                return response()->json(['status' => 'success', 'msg' => 'Data Berhasil Disimpan!']);
            } else {
                return response()->json(['status' => 'error', 'msg' => $insert]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postDelete(Request $request)
    {
        // dd($request);
        $data = DB::table('jenis_aduan')->where('id', '=', $request->id)->delete();
        if($data) {
            return response()->json(['status' => 'success', 'msg' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Data Gagal Dihapus', 'error_msg' => $data]);
        }
    }
}
