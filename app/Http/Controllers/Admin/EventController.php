<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function __construct(Event $event)
    {
        $this->model = $event; // MODEL INSTANCE
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = (isset($request->per_page) ? $request->per_page : (env('APP_PAGE_LIMIT') !== null ? env('APP_PAGE_LIMIT') : 10) ); // SET DEFAULT PAGE LIMIT BY 10
        $events = $this->model
            ->when(isset($request->search), function($q) use ($request) { // CHECKING WHILE REQUEST CONTAIN SEARCH, THEN SEARCH IT IN EVENT_NAME FIELD
                $q->where('event_name', 'like', '%'.$request->search.'%');
            })
            ->when(isset($request->priority), function($q) use ($request) { // CHECKING WHILE REQUEST CONTAIN PRIORITY, THEN GROUP BY PRIORITY FIELD
                $q->where('priority', $request->priority);
            })
            ->paginate($limit);

        return view('admin.event.index', [
            'events' => $events
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.event.create');
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
            'event_name' => 'required',
            'event_date' => 'required',
            'event_time' => 'required',
            'description' => 'required',
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
            $this->model->insert([
                'event_name' => $request->event_name,
                'event_date' => date('Y-m-d', strtotime($request->event_date)),
                'event_time' => date('H:i:s', strtotime($request->event_time)),
                'description' => $request->description,
                'priority' => $request->priority,
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = $this->model->where('id', $id)->first();

        return view('admin.event.edit', [
            'event' => $event
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
            'event_name' => 'required',
            'event_date' => 'required',
            'event_time' => 'required',
            'description' => 'required',
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
            $this->model->where('id', $id)
            ->update([
                'event_name' => $request->event_name,
                'event_date' => date('Y-m-d', strtotime($request->event_date)),
                'event_time' => date('H:i:s', strtotime($request->event_time)),
                'description' => $request->description,
                'priority' => $request->priority,
                'event_status' => $request->event_status,
                'updated_by' => Session::get('user_id'),
                'updated_at' => date('Y-m-d H:i:s')
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = $this->model->find($id);

        $response = array(
            'status' => 'failed',
            'msg' => 'Terjadi Kesalahan, gagal menghapus data!'
        );

        if($event->delete()) {
            $response['status'] = 'success';
            $response['msg'] = 'Data berhasil dihapus';
        }

        return response()->json($response);
    }
}
