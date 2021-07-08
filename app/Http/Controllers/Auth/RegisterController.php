<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request) {
        $validator = $this->validator($request->all());
        if($validator->fails()) {
            return response()->json(['status' => 'failed', 'msg' => 'Harap cek kembali inputan Anda!', 'errors' => $validator->errors()]);
        } else {
            User::create([
                'username' => $request->username,
                'password' => Hash::make($request->password)
            ]);
            
            return response()->json(['status' => 'success', 'msg' => 'Data Berhasil disimpan']);
        }
    }

    public function cetakDataVaksinasi() {
        $data = DB::select("select * from get_vaksinasi()");
        $tgl_skrg = Helper::formatTanggalPanjang(date('Y-m-d', strtotime($data[0]->tanggal_scraping)));
        
        return view('auth.cetak_excel_vaksinasi', ['datas' => $data, 'tgl_skrg' => $tgl_skrg]);
    }

    public function getDataVaksin() {
        $datas = DB::table('lokasi_vaksin')->select('*')->where('is_aktif', '=', 1)->get();
        foreach($datas as $key => $data) {
            $datas[$key]->kab_id = ($data->kab_id!=null)?getNamaWilayah($data->kab_id):Null;
            $datas[$key]->kec_id = ($data->kec_id!=null)?getNamaWilayah($data->kec_id):Null;
            $datas[$key]->kel_id = ($data->kel_id!=null)?getNamaWilayah($data->kel_id):Null;
        }

        return response()->json($datas, 200);
    }
}
