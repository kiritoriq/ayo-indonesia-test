<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventLog;
use Illuminate\Http\Request;

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
        $events = $this->model
            ->when(isset($request->search), function($q) use ($request) { // CHECKING WHILE REQUEST CONTAIN SEARCH, THEN SEARCH IT IN ORG_NAME FIELD
                $q->where('event_resume', 'like', '%'.$request->search.'%');
            })
            ->paginate($limit);

        return view('admin.event_report.index', [
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
        $events = Event::orderBy('created_at', 'asc')->get();

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
        //
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
        //
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
