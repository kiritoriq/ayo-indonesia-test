<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Organization;
use App\Models\OrgMember;
use App\Models\SportBranch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    public function __construct(Member $member)
    {
        $this->model = $member;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $limit = (isset($request->per_page) ? $request->per_page : (env('APP_PAGE_LIMIT') !== null ? env('APP_PAGE_LIMIT') : 10) ); // SET DEFAULT PAGE LIMIT BY 10
        $members = $this->model->with('org_member.organization')
            ->when(isset($request->search), function($q) use ($request) { // CHECKING WHILE REQUEST CONTAIN SEARCH, THEN SEARCH IT IN ORG_NAME FIELD
                $q->where('name', 'like', '%'.$request->search.'%');
                $q->orWhere('email', 'like', '%'.$request->search.'%');
            })
            ->paginate($limit);

        return view('admin.member.index', [
            'members' => $members
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
        
        return view('admin.member.create', [
            'sports' => $sports_branch
        ]);
    }

    /**
     * Get the Organization data by Sports Id
     * 
     */
    public function getOrgBySportId(Request $request)
    {
        $orgs = Organization::where('sport_branch_id', $request->get('sports_id'))
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($orgs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'height' => 'required',
            'weight' => 'required',
            'email' => 'required',
            'phone_number' => 'required|unique:member'
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

        if(!isset($request->org)) {
            $response['type'] = 'validated';
            $response['msg'] = 'Organization Form must not be empty!';
            return response()->json($response);
        }

        DB::beginTransaction();
        try {
            $member = $this->model->insertGetId([
                'name' => $request->name,
                'height' => intval($request->height),
                'weight' => intval($request->weight),
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'created_by' => Session::get('user_id'),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            if(isset($request->org)) {
                foreach($request->org as $index => $org) {
                    OrgMember::insert([
                        'org_id' => $org['org_id'],
                        'position_id' => $org['position_id'],
                        'member_id' => $member
                    ]);
                }
            }

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
        $member = $this->model->with('org_member')
            ->where('id', $id)
            ->first();
        $sports_branch = SportBranch::where('is_active', '1')
            ->orderBy('id', 'asc')
            ->get();

        return view('admin.member.edit', [
            'member' => $member,
            'sports' => $sports_branch
        ]);
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
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'height' => 'required',
            'weight' => 'required',
            'email' => 'required',
            'phone_number' => 'required|unique:member'
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

        if(!isset($request->org)) {
            $response['type'] = 'validated';
            $response['msg'] = 'Organization Form must not be empty!';
            return response()->json($response);
        }

        DB::beginTransaction();
        try {
            $this->model->where('id', $id)
                ->update([
                    'name' => $request->name,
                    'height' => intval($request->height),
                    'weight' => intval($request->weight),
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                    'updated_by' => Session::get('user_id'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

            if(isset($request->org)) {
                OrgMember::where('member_id', $id)->delete();
                foreach($request->org as $index => $org) {
                    OrgMember::insert([
                        'org_id' => $org['org_id'],
                        'position_id' => $org['position_id'],
                        'member_id' => $id
                    ]);
                }
            }

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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = $this->model->find($id);

        $response = array(
            'status' => 'failed',
            'msg' => 'Terjadi Kesalahan, gagal menghapus data!'
        );

        if($member->delete()) {
            $response['status'] = 'success';
            $response['msg'] = 'Data berhasil dihapus';
        }

        return response()->json($response);
    }
}
