<?php

namespace App\Modules\Users\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use App\Models\Roles;
use App\Models\UsersRoles;


class UsersController extends Controller
{

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
        $user = User::with(['roles.role'])->get();
        return view("Users::index",['users' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        $role = Roles::orderBy('id', 'asc')->get();
        return view('Users::create', ['roles' => $role]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|confirmed',
            'role' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json(['status' => 'failed', 'errors' => $validator->errors(), 'msg' => 'Gagal register, silahkan coba lagi', 'item' => '']);
        } else {
            $response['status'] = 'failed';
            $response['msg'] = 'Tidak berhasil simpan';
            DB::beginTransaction();
            try {
                $userID = User::insertGetId([
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);

                if($userID) {
                    if(is_array($request->role)) {
                        foreach($request->role as $role) {
                            UsersRoles::create([
                                'user_id' => $userID,
                                'role_id' => $role
                            ]);
                        }
                    } else {
                        UsersRoles::create([
                            'user_id' => $userID,
                            'role_id' => $request->role
                        ]);
                    }
                }

                DB::commit();
                $response['status'] = 'success';
                $response['msg'] = 'Data berhasil disimpan';

            } catch(\Exception $e) {
                DB::rollback();
                $response['msg'] = $e->getMessage();
            }
            return response()->json($response);
        }
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
}
