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
use App\Modules\Laporan\DataTables\LaporanWargaDataTable;
use App\Modules\Laporan\Dto\LaporanDto;

class LaporanController extends Controller
{
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
        // dd($this->loadDataTables());

        // $laporans = $this->model->with(['petugas'])->where('deleted_at', '=', null)->orderBy('created_at', 'desc')->get();
        // return view('Laporan::index', ['laporans' => $laporans]);
        $jenis_aduan = DB::table('jenis_aduan')->select('*')->whereRaw('"isAktif" != 0')->orderBy('id', 'asc')->get();

        return view('Laporan::index', ['jenis_aduans' => $jenis_aduan]);
    }

    public function loadDataTables()
    {
        $draw = $_REQUEST['draw'];
        $limit_data = $_REQUEST['length'];
        $offset_data = $_REQUEST['start'];
        $jenis_aduan = (($_POST['columns'][5]['search']['value'] != '')?$_POST['columns'][5]['search']['value']:'');
        $cari_data =  $_POST['search']['value'];
        // dd($jenis_aduan);
        $order_data = "desc";
        $data = DB::select("SELECT * FROM call_center_cari_laporan_warga('".$cari_data."', '".$order_data."', '".$limit_data."', '".$offset_data."', '".$jenis_aduan."' )");
        
        $output_table = array();
        $output_table['aaData'] = array();
        $total_row = 0;
        
        if ($data != null || $data[0]->level != 1) {
            foreach ($data as $row) {
                if ($row->level == 1) {
                    $list = [];
                    $list["no"] = $row->row_data;
                    $list["nama_pelapor"] = ucwords($row->nama_pelapor);
                    $list["no_telp_pelapor"] = $row->no_telp_pelapor;
                    $list["alamat_pelapor"] = $row->alamat_pelapor;

                    if (strlen($row->isi_laporan) > 30) {
                        $isi_laporan = substr_replace($row->isi_laporan, ' ...', 30);
                    } else {
                        $isi_laporan = $row->isi_laporan;
                    }

                    $list["isi_laporan"] = $isi_laporan;
                    $list["jenis_aduan"] = (($row->jenis_aduan!=null)?'<span class="label label-lg font-weight-bold label-light-primary label-inline mr-3">'.$row->jenis_aduan.'</span>':'<i>Tidak diketahui</i>');
                    $list["petugas_input"] = $row->username;
                    $list["tanggal_input"] = formatTanggalPanjang(date(('Y-m-d'), strtotime($row->created_at))) . ' Pukul ' . date('H:i', strtotime($row->created_at));
                    $list["aksi"] =
                    $button = '
                    <button type="button" id="detail" data-fancybox='.$row->id.' data-type="ajax"
                    data-src='.route("laporan.details", $row->id).'
                    data-theme="dark"
                    class="btn btn-sm btn-default btn-text-warning btn-hover-warning btn-icon detail"
                    title="Detail">
                    <span class="svg-icon svg-icon-warning svg-icon-2x">
                        <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-04-19-122603/theme/html/demo1/dist/../src/media/svg/icons/Text/Menu.svg--><svg
                            xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                            viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <rect fill="#000000" x="4" y="5" width="16" height="3" rx="1.5" />
                                <path
                                    d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L18.5,10 C19.3284271,10 20,10.6715729 20,11.5 C20,12.3284271 19.3284271,13 18.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z"
                                    fill="#000000" opacity="0.3" />
                            </g>
                        </svg>
                        <!--end::Svg Icon--></span>
                </button>

                <a class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon"
                    data-toggle="tooltip" data-theme="dark" title="Edit Laporan"
                    href='.route("laporan.edit", $row->id).'>
                    <span class="svg-icon svg-icon-primary"><svg xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                            viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <path
                                    d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                    fill="#000000" fill-rule="nonzero"
                                    transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) " />
                                <rect fill="#000000" opacity="0.3" x="5" y="20" width="15"
                                    height="2" rx="1" />
                            </g>
                        </svg></span>
                </a>
                ';
                    if (array_intersect(Session::get('role_id'), [1])) {
                        $button .=
                                '
                                    <button type="button" id="btnDelete" data-id='.$row->id .' data-href='.route("laporan.delete", $row->id).' class="btn btn-delete btn-sm btn-default btn-text-danger btn-hover-primary btn-icon" data-toggle="tooltip" data-theme="dark" title="Hapus Laporan">
                                        <span class="svg-icon svg-icon-danger"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>
                                                <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>
                                            </g>
                                        </svg></span>
                                    </button>
                                ';
                    }
                    $list["aksi"] = $button;
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

    public function getCetakExcel()
    {
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

    public function getCreate()
    {
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
            'prov_id' => 'required',
            'kab_id' => 'required',
            'kec_id' => 'required',
            'kel_id' => 'required',
            'isi_laporan' => 'required',
            'instansi' => 'required',
            'id_jenis_aduan' => 'required'
        ]);

        if ($validator->fails()) {
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
            $create->id_jenis_aduan = $request->id_jenis_aduan;
            $create->user_id = Auth::user()->id;
            $create->role_id = Session::get('role_id')[0];
            $create->created_at = date('Y-m-d H:i:s');
            $create->save();

            if ($create) {
                return response()->json(['status' => 'success', 'msg' => 'Laporan telah berhasil disimpan!']);
            } else {
                return response()->json(['status' => 'failed', 'msg' => 'Laporan gagal disimpan!', 'error' => $create]);
            }
        }
    }

    public function getEdit($id)
    {
        $laporan = $this->model->where('id', '=', $id)->first();
        return view('Laporan::edit', ['laporan' => $laporan]);
    }
    
    public function add_pasien()
    {
        return view('Laporan::add_pasien');
    }
    
    public function add_nik()
    {
        return view('Laporan::add_nik');
    }

    public function postEdit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_pelapor' => 'required',
            'alamat_pelapor' => 'required',
            'no_telp_pelapor' => 'required',
            'prov_id' => 'required',
            'kab_id' => 'required',
            'kec_id' => 'required',
            'kel_id' => 'required',
            'isi_laporan' => 'required',
            'instansi' => 'required',
            'id_jenis_aduan' => 'required'
        ]);

        if ($validator->fails()) {
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
            $update->id_jenis_aduan = $request->id_jenis_aduan;
            $update->role_id = Session::get('role_id')[0];
            $update->updated_at = date('Y-m-d H:i:s');
            $update->save();

            if ($update) {
                return response()->json(['status' => 'success', 'msg' => 'Laporan telah berhasil disimpan!']);
            } else {
                return response()->json(['status' => 'failed', 'msg' => 'Laporan gagal disimpan!', 'error' => $update]);
            }
        }
    }

    public function getDetails($id)
    {
        $laporan = $this->model->with(['petugas', 'jenisAduan'])->where('id', '=', $id)->first();
        // dd($laporan);
        return view('Laporan::details', ['laporan' => $laporan]);
    }

    public function postDelete($id)
    {
        $data = $this->model->find($id);
        $insert_log = DB::table('delete_log')->insert([
            'laporan_id' => $id,
            'user_id' => Auth::user()->id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        if ($insert_log) {
            $update = $this->model->where('id', '=', $id)->update(['deleted_at' => date('Y-m-d H:i:s')]);
            if ($update) {
                return response()->json(['status' => 'success', 'msg' => 'Data Laporan berhasil dihapus']);
            }
        } else {
            return response()->json(['status' => 'failed', 'msg' => 'Data tidak berhasil dihapus']);
        }
    }

    public function getKota(Request $request)
    {
        return getKota($request->id, $request->parent_id, $request->selected);
    }

    public function getKecamatan(Request $request)
    {
        return getKecamatan($request->id, $request->parent_id, $request->selected);
    }

    public function getKelurahan(Request $request)
    {
        return getKelurahan($request->id, $request->parent_id, $request->selected);
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
            if ($output == false or $output != 0) {
                $result = json_encode($output);
            }

            curl_close($ch);
            if ($output == false) {
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
