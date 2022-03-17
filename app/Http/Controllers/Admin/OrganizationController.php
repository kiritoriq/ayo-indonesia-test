<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\SportBranch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OrganizationController extends Controller
{
    public function __construct(Organization $org)
    {
        $this->model = $org; // MODEL INSTANCE
    }

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $limit = (isset($request->per_page) ? $request->per_page : (env('APP_PAGE_LIMIT') !== null ? env('APP_PAGE_LIMIT') : 10) ); // SET DEFAULT PAGE LIMIT BY 10
        $orgs = $this->model->with('sports')
            ->when(isset($request->search), function($q) use ($request) { // CHECKING WHILE REQUEST CONTAIN SEARCH, THEN SEARCH IT IN ORG_NAME FIELD
                $q->where('org_name', 'like', '%'.$request->search.'%');
            })
            ->when(isset($request->sports), function($q) use ($request) { // CHECKING WHILE REQUEST CONTAIN SPORTS, THEN GROUP BY SPORT BRANCH FIELD
                $q->where('sport_branch_id', $request->sports);
            })
            ->paginate($limit);

        $sports_branch = SportBranch::where('is_active', '1')->orderBy('id', 'asc')->get();

        return view('admin.organization.index', [
            'orgs' => $orgs,
            'sports' => $sports_branch
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $sports_branch = SportBranch::where('is_active', '1')
            ->orderBy('id', 'asc')
            ->get();

        return view('admin.organization.create', [
            'sports' => $sports_branch
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'org_name' => 'required',
            'since' => 'required',
            'address' => 'required',
            'sport_branch' => 'required',
            'logo' => 'image|max:1048'
        ]);

        $response = array(
            'status' => 'failed',
            'msg' => 'Terjadi Kesalahan, gagal menyimpan data!'
        );

        if($validation->fails()) {
            $response['type'] = 'validated';
            $response['msg'] = ucwords(implode(', ', str_replace('The ', '', $validation->errors()->all())));
            return response()->json($response);
        }

        DB::beginTransaction();
        try {
            $destinationPath = base_path() . '/public/media/upload/logo/';
            if($request->has('logo')) {
                $image = $request->file('logo');
                $tipeFile = $image->getClientOriginalExtension();
                $fileName = Str::random(7).'_'.date('Ymd').'.'.$tipeFile;
                $upload = $image->move($destinationPath, $fileName);
            } else {
                $fileName = "";
            }
            $this->model->insert([
                'org_name' => $request->org_name,
                'logo' => $fileName,
                'since' => $request->since,
                'address' => $request->address,
                'sport_branch_id' => $request->sport_branch,
                'created_by' => Session::get('user_id'),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            DB::commit();
            $response['status'] = 'success';
            $response['msg'] = 'Data berhasil disimpan';
        } catch(\Exception $e) {
            DB::rollBack();
            $response['msg'] = $e->getMessage();
        }

        return response()->json($response);
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
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $org = $this->model->where('id', $id)->first();
        $sports_branch = SportBranch::where('is_active', '1')
            ->orderBy('id', 'asc')
            ->get();

        return view('admin.organization.edit', [
            'org' => $org,
            'sports' => $sports_branch
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'org_name' => 'required',
            'since' => 'required',
            'address' => 'required',
            'sport_branch' => 'required',
            'logo' => 'image|max:1048'
        ]);

        $response = array(
            'status' => 'failed',
            'msg' => 'Terjadi Kesalahan, gagal menyimpan data!'
        );

        if($validation->fails()) {
            $response['type'] = 'validated';
            $response['msg'] = ucwords(implode(', ', str_replace('The ', '', $validation->errors()->all())));
            return response()->json($response);
        }

        DB::beginTransaction();
        try {
            $destinationPath = base_path() . '/public/media/upload/logo/';
            if($request->has('logo')) {
                $image = $request->file('logo');
                $tipeFile = $image->getClientOriginalExtension();
                $fileName = Str::random(7).'_'.date('Ymd').'.'.$tipeFile;
                $upload = $image->move($destinationPath, $fileName);
                @unlink($destinationPath . $request->old_logo);
            } else {
                if(isset($request->old_logo)) {
                    $fileName = $request->old_logo;
                } else {
                    $fileName = "";
                }
            }
            $this->model->where('id', $id)->update([
                'org_name' => $request->org_name,
                'logo' => $fileName,
                'since' => $request->since,
                'address' => $request->address,
                'sport_branch_id' => $request->sport_branch,
                'updated_by' => Session::get('user_id'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            DB::commit();
            $response['status'] = 'success';
            $response['msg'] = 'Data berhasil diupdate';
        } catch(\Exception $e) {
            DB::rollBack();
            $response['msg'] = $e->getMessage();
        }

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $org = $this->model->find($id);

        $response = array(
            'status' => 'failed',
            'msg' => 'Terjadi Kesalahan, gagal menghapus data!'
        );

        if($org->delete()) {
            $response['status'] = 'success';
            $response['msg'] = 'Data berhasil dihapus';
        }

        return response()->json($response);
    }
}
