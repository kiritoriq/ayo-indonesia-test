<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    private User $model;
    function __construct(
        User $user
    )
    {
        $this->model = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $limit = (isset($request->per_page) ? $request->per_page : (env('APP_PAGE_LIMIT') !== null ? env('APP_PAGE_LIMIT') : 10) );
        $user = $this->model->with('roles')
            ->when(isset($request->search), function($q) use ($request) {
                $q->where('email', 'like', '%'.$request->search.'%');
                $q->orWhere('name', 'like', '%'.$request->search.'%');
            })
            ->when(isset($request->role), function($q) use ($request) {
                $q->where('role_id', $request->role);
            })
            ->whereNull('deleted_at')
            ->paginate($limit);

        $roles = Roles::where('is_active', 1)->orderBy('id', 'asc')->get();

        return view('admin.users.index', [
            'users' => $user,
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $roles = Roles::where('is_active', 1)->orderBy('id', 'asc')->get();

        return view('admin.users.create', [
            'roles' => $roles
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
            'role' => 'required',
            'email' => 'required|unique',
            'name' => 'required',
            'password' => 'required|confirmed'
        ]);

        $response = array(
            'status' => 'failed',
            'msg' => 'Error occured while creating User'
        );

        if($validation->fails()) {
            $response['type'] = 'validate';
            $response['msg'] = $validation->errors();
            return response()->json($response);
        }

        try {
            $this->model->insert([
                'role_id' => $request->role,
                'email' => $request->email,
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'is_active' => 1,
                'created_by' => Session::get('user_id'),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $response['status'] = 'success';
            $response['msg'] = 'Data saved successfully';
        } catch (\Exception $e) {
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
        $user = $this->model->where('id', $id)->first();

        return view('admin.users.edit', [
            'user' => $user
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $user = $this->model->where('id', $id)->first();

        $response = array(
            'status' => 'failed',
            'msg' => 'Error occured while deleting data'
        );

        if($user->delete()) {
            $response['status'] = 'success';
            $response['msg'] = 'Data deleted!';

            return response()->json($response);
        }

        return response()->json($response);
    }
}
