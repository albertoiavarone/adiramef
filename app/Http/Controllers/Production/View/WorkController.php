<?php

namespace App\Http\Controllers\Production\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Production\Work;
use App\Models\Production\Machine;
use App\Models\Production\MachineOperator;
use App\Models\Commercial\Order;
use App\Classes\Orders;

class WorkController extends Controller
{
    public function __construct(){
        $this->middleware('permission:works_r')->only('index');
        $this->middleware('permission:works_c')->only('create');
        $this->middleware('permission:works_c')->only('store');
        $this->middleware('permission:works_r')->only('show');
        $this->middleware('permission:works_u')->only('edit');
        $this->middleware('permission:works_u')->only('update');
        $this->middleware('permission:works_d')->only('delete');
        $this->Order = new Orders();
    }
    /*
    *
    */
    public function index(Request $request)
    {

            $columnConfig = [];
            $columnConfig[] = ['data' => 'created_at', 'orderable'=>true];
            $columnConfig[] = ['data' => 'machine', 'orderable'=>false,'searchable'=>true];
            $columnConfig[] = ['data' => 'type', 'orderable'=>false,'searchable'=>true];
            $columnConfig[] = ['data' => 'order', 'orderable'=>false,'searchable'=>true];
            $columnConfig[] = ['data' => 'processes', 'orderable'=>true];
            $columnConfig[] = ['data' => 'bales', 'orderable'=>false];
            $columnConfig[] = ['data' => 'buttons', 'orderable'=>false];

            $machines = Machine::orderBy('name')->get();
            return view('production.works.index', compact('columnConfig','machines'));

    }
    /*
    *
    */
    public function create()
    {
        $machines = Machine::orderBy('name')->get();
        return view('production.works.create', compact('machines'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'machine' => 'required|uuid',
            'order' => 'required|exists:orders,id',
            'name' => 'required|string',
            'date_from' => 'required|string',
            'date_to' => 'required|string',
            'description' => 'nullable|string',
            'cost' => 'nullable|numeric',
            'energy_consumed' => 'nullable|numeric',
            'fuel' => 'nullable|numeric',
        ]);

        $machine = Machine::where('uuid',$request->machine)->firstOrFail();
        $order = Order::find($request->order);

        $work = Work::create([
            'machine_id' => $machine->id,
            'order_id' => $request->order,
            'code' => checkUniqueCode('App\Models\Production\Work', 'code', 10),
            'name' => $request->name,
            'date_start' => LocalDatetimeToDb($request->date_from) ,
            'date_stop' => LocalDatetimeToDb($request->date_to) ,
            'total_time' => timeTwoDates($request->date_from, $request->date_to),
            'description' => $request->description,
            'cost' => round($request->cost,2),
            'energy_consumed' => round($request->energy_consumed,2),
            'fuel' => round($request->fuel,2),
            'processes' => 1,
        ]);
        if($work) {

          $this->Order->linkOrderMachine($order,$machine);

            return redirect()->route('works.index')->with('success', __('general.success'));
        } else {
            return redirect()->route('works.index')->with('error',__('general.error'));
        }
    }
    /*
    * list for datatable server side
    */
    public function allWorks(Request $request)
    {


        $query = Work::query();

        //COSTRUZIONE QUERY DI RICERCA
        if($request->has('filterData')){

            $request->validate([
                'machine_uuid' => 'nullable|uuid',
                'date_from' => 'nullable|date_format:d/m/Y',
                'date_to' => 'nullable|date_format:d/m/Y',
				'code' => 'nullable|string',

            ]);
            if ($request->has('machine_uuid') and $request->machine_uuid) {
                $query->whereHas('machine', function($q) use ($request){
                    return $q->where('uuid',$request->machine_uuid);
                });
            }

			if ($request->has('code') and $request->code) {
                $query->whereHas('order', function($q) use ($request){
                    return $q->where('ref_code', 'LIKE', '%'.$request->code.'%');
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
                            0 => 'created_at',
                            1 => 'machine',
                            2 => 'type',
                            3 => 'order',
                            4 => 'processes',
                            5 => 'bales',
                            6 => 'buttons',
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
            $works = $query->offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        } else {
            $search = $request->input('search.value');

            /*
            $works = $query->whereHas('program', function($q) use ($search){
                                return $q->where('name','LIKE',"%{$search}%");
                            })

                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = $query->whereHas('program', function($q) use ($search){
                                    return $q->where('name','LIKE',"%{$search}%");
                                })

                            ->count();
            */

        }
        //-------------------------------------------------------------------------
        $data = array();
        if(!empty($works))
        {
            foreach ($works as $work)
            {

                $nestedData['created_at'] = convertToLocal($work->updated_at);
                $nestedData['machine'] = view('production.machines.shared.name',['machine'=>$work->machine])->render();
                $nestedData['type'] = $work->machine->type->name;
                $nestedData['order'] = data_get($work, 'order.ref_code').' '.data_get($work, 'order.name');
                $nestedData['processes'] = $work->processes;
                $nestedData['bales'] =  view('production.erp.status',['work'=>$work])->render();
                $nestedData['buttons'] = view('production.works.tds.buttons',['work'=>$work])->render();
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
    public function getWorkDetail(Request $request)
    {
        $request->validate([
            'uuid' => 'required|uuid',
        ]);
        $work = Work::where('uuid',$request->uuid)->firstOrFail();
        return view('production.works.shared.work', compact('work'));
    }

	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($uuid)
     {
		 $delete = Work::where('uuid',$uuid)->delete();
         if($delete) {
             return redirect()->route('works.index')->with('success',__('general.success'));
         } else {
             return redirect()->route('works.index')->with('error',__('general.error'));
         }
     }
	 /*
    *
    */
}
