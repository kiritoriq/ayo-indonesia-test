<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class EventLogController extends Controller
{
    public function __construct(EventLog $event)
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
        $event_logs = $this->model->with('event')
            ->when(isset($request->search), function($q) use ($request) { // CHECKING WHILE REQUEST CONTAIN SEARCH, THEN SEARCH IT IN EVENT RESUME FIELD
                $q->where('event_resume', 'like', '%'.$request->search.'%');
                $q->whereHas('event', function($o) use ($request) {
                   $o->orWhere('event_name', 'like', '%'. $request->search .'%');
                });
            })
            ->paginate($limit);

        return view('admin.event_report.index', [
            'event_logs' => $event_logs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $events = Event::where('event_status', '1')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('admin.event_report.create', [
            'events' => $events
        ]);
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
            'event_id' => 'required',
            'event_resume' => 'required',
            'member_attend' => 'required',
            'event_result' => 'required',
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
                    'event_id' => $request->event_id,
                    'event_resume' => $request->event_resume,
                    'member_attend' => $request->member_attend,
                    'member_contribution' => $request->member_contribution,
                    'event_result' => $request->event_result,
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
        $eventlog = $this->model->where('id', $id)->first();
        $events = Event::where('event_status', '1')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('admin.event_report.edit', [
            'eventlog' => $eventlog,
            'events' => $events
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
            'event_id' => 'required',
            'event_resume' => 'required',
            'member_attend' => 'required',
            'event_result' => 'required',
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
                'event_id' => $request->event_id,
                'event_resume' => $request->event_resume,
                'member_attend' => $request->member_attend,
                'member_contribution' => $request->member_contribution,
                'event_result' => $request->event_result,
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eventlog = $this->model->find($id);

        $response = array(
            'status' => 'failed',
            'msg' => 'Terjadi Kesalahan, gagal menghapus data!'
        );

        if($eventlog->delete()) {
            $response['status'] = 'success';
            $response['msg'] = 'Data berhasil dihapus';
        }

        return response()->json($response);
    }
}
