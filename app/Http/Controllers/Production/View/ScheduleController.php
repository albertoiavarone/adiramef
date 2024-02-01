<?php

namespace App\Http\Controllers\Production\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Production\Schedule;
use App\Models\Production\Machine;
use App\Classes\Schedules;

class ScheduleController extends Controller
{
    
    public function __construct(){
        $this->middleware('permission:work_schedule_r')->only('index');
        $this->middleware('permission:work_schedule_c')->only('create');
        $this->middleware('permission:work_schedule_c')->only('store');
        $this->middleware('permission:work_schedule_r')->only('show');
        $this->middleware('permission:work_schedule_u')->only('edit');
        $this->middleware('permission:work_schedule_u')->only('update');
        $this->middleware('permission:work_schedule_d')->only('delete');
        $this->Schedule = new Schedules();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columnConfig = [];
        $columnConfig[] = ['data' => 'created_at', 'orderable'=>true];
        $columnConfig[] = ['data' => 'machine', 'orderable'=>false,'searchable'=>true];
        $columnConfig[] = ['data' => 'name', 'orderable'=>false,'searchable'=>true];
        $columnConfig[] = ['data' => 'date_start', 'orderable'=>true];
        $columnConfig[] = ['data' => 'buttons', 'orderable'=>false];

        $machines = Machine::all();
        return view('production.schedules.index', compact('columnConfig','machines'));
    }
    
    /*
    * list for datatable server side
    */
    public function allSchedules(Request $request)
    {


        $query = Schedule::query();

        //COSTRUZIONE QUERY DI RICERCA
        if($request->has('filterData')){

            $request->validate([
                'machine_uuid' => 'nullable|uuid',
                'date_from' => 'nullable|date_format:d/m/Y',
                'date_to' => 'nullable|date_format:d/m/Y',
            ]);
            if ($request->has('machine_uuid') and $request->machine_uuid) {
                $query->whereHas('machine', function($q) use ($request){
                    return $q->where('uuid',$request->machine_uuid);
                });
            }
            
            if ($request->has('date_from') and $request->date_from) {
                if ($request->has('time_from') and $request->time_from) {
                    $query->where('date_start','>=', LocalToDb($request->date_from).' '.$request->time_from);
                } else {
                    $query->whereDate('date_start','>=', LocalToDb($request->date_from));
                }
            } elseif ($request->has('time_from') and $request->time_from) {
                $query->whereTime('date_start','>=',checkTimeFormat($request->time_from));
            }
            if ($request->has('date_to') and $request->date_to) {
                if ($request->has('time_to') and $request->time_to) {
                    $query->where('date_start','<=', LocalToDb($request->date_to).' '.$request->time_to);
                } else {
                    $query->whereDate('date_start','<=',LocalToDb($request->date_to));
                }
            } elseif ($request->has('time_to') and $request->time_to) {
                $query->whereTime('date_start','<=',checkTimeFormat($request->time_to));
            }
        }
        //FINE COSTRUZIONE QUERY DI RICERCA
        //-------------------------------------------------------------------------
        $columns = array(
                            0 =>'created_at',
                            1 => 'name',
                            2 => 'machine',
                            3 => 'date_start',
                            4 => 'buttons',
                        );

        $totalData = $query->count();
        $totalFiltered = $totalData;
        //-------------------------------------------------------------------------
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        //-------------------------------------------------------------------------
        if(empty($request->input('search.value')))
        {
            $schedules = $query->offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        } else {
            $search = $request->input('search.value');

            $schedules = $query->whereHas('machine', function($q) use ($search){
                                return $q->where('name','LIKE',"%{$search}%");
                            })
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = $query->whereHas('machine', function($q) use ($search){
                                    return $q->where('name','LIKE',"%{$search}%");
                                })

                            ->count();

        }
        //-------------------------------------------------------------------------
        $data = array();
        if(!empty($schedules))
        {
            foreach ($schedules as $schedule)
            {

                $nestedData['created_at'] = convertToLocal($schedule->created_at);
                $nestedData['machine'] = view('production.machines.shared.name',['machine'=>$schedule->machine])->render();
                $nestedData['name'] = $schedule->name;
                $nestedData['date_start'] = formatDateTime($schedule->date_start);
                $nestedData['buttons'] = view('production.schedules.tds.buttons',['schedule'=>$schedule])->render();
                $data[] = $nestedData;

            }
        }
        //-------------------------------------------------------------------------
        $json_data = array(
                    "draw"            => intval($request->input('draw')),
                    "recordsTotal"    => intval($totalData),
                    "recordsFiltered" => intval($totalFiltered),
                    "data"            => $data
                    );
        //-------------------------------------------------------------------------
        echo json_encode($json_data);

    }
    /*
    *
    */
    public function getScheduleDetail(Request $request)
    {
        $request->validate([
            'uuid' => 'required|uuid',
        ]);
        $schedule = Schedule::where('uuid',$request->uuid)->firstOrFail();
        return view('production.schedules.shared.schedule', compact('schedule'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
