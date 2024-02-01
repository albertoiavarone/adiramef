<?php

namespace App\Http\Controllers\Production\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Production\MachineLog;
use App\Models\Production\Machine;


class MachineLogController extends Controller
{
    public function __construct(){
        $this->middleware('permission:diagnostics_r')->only('index');
        $this->middleware('permission:diagnostics_c')->only('create');
        $this->middleware('permission:diagnostics_c')->only('store');
        $this->middleware('permission:diagnostics_r')->only('show');
        $this->middleware('permission:diagnostics_u')->only('edit');
        $this->middleware('permission:diagnostics_u')->only('update');
        $this->middleware('permission:diagnostics_d')->only('delete');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columnConfig = [];
        $columnConfig[] = ['data' => 'date', 'orderable'=>true];
        $columnConfig[] = ['data' => 'machine', 'orderable'=>true,'searchable'=>true];
        $columnConfig[] = ['data' => 'type', 'orderable'=>false,'searchable'=>true];
        $columnConfig[] = ['data' => 'action', 'orderable'=>false,'searchable'=>true];
        $columnConfig[] = ['data' => 'duration', 'orderable'=>false,'searchable'=>true];
        $columnConfig[] = ['data' => 'message', 'orderable'=>false,'searchable'=>true];
        $columnConfig[] = ['data' => 'buttons', 'orderable'=>true];

        $machines = Machine::all();

        return view('production.diagnostics.index', compact('columnConfig','machines'));
    }

    /*
    * list for datatable server side
    */
    public function allDiagnostics(Request $request)
    {
        $query = MachineLog::query();

        //COSTRUZIONE QUERY DI RICERCA
        if($request->has('filterData')){

            $request->validate([
                'machine_uuid' => 'nullable|uuid',
                'date_from' => 'nullable|date_format:d/m/Y',
                'date_to' => 'nullable|date_format:d/m/Y',
                'time_from' => 'nullable|string',
                'time_to' => 'nullable|string',
                'action' => 'nullable|string|in:START,STOP',
                'type' => 'nullable|string|in:PROD,ALRM',
                'message' => 'nullable|string',
            ]);
            
            if ($request->has('machine_uuid') and $request->machine_uuid) {
                $query->whereHas('machine', function($q) use ($request){
                    return $q->where('uuid',$request->machine_uuid);
                });
            }
            if ($request->has('date_from') and $request->date_from) {
                if ($request->has('time_from') and $request->time_from) {
                    $query->where('date','>=', LocalToDb($request->date_from).' '.$request->time_from);
                } else {
                    $query->whereDate('date','>=', LocalToDb($request->date_from));
                }
            } elseif ($request->has('time_from') and $request->time_from) {
                $query->whereTime('date','>=',checkTimeFormat($request->time_from));
            }
            if ($request->has('date_to') and $request->date_to) {
                if ($request->has('time_to') and $request->time_to) {
                    $query->where('date','<=', LocalToDb($request->date_to).' '.$request->time_to);
                } else {
                    $query->whereDate('date','<=',LocalToDb($request->date_to));
                }
            } elseif ($request->has('time_to') and $request->time_to) {
                $query->whereTime('date','<=',checkTimeFormat($request->time_to));
            }
            
            if ($request->has('action') and $request->action) {
                $query->where('action',$request->action);
            }
            if ($request->has('type') and $request->type) {
                $query->where('type',$request->type);
            }
            if ($request->has('message') and $request->message) {
                $query->where('message','LIKE', "%{$request->message}%");
            }
        }
        //FINE COSTRUZIONE QUERY DI RICERCA
        //-------------------------------------------------------------------------
        $columns = array(
                            0 => 'date',
                            1 => 'machine',
                            2 => 'type',
                            3 => 'action',
                            4 => 'duration',
                            5 => 'message',
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
            $diagnostics = $query->offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        } else {
            $search = $request->input('search.value');

            $diagnostics =  $query->where('type','LIKE',"%{$search}%")
                           ->orWhere('action','LIKE',"%{$search}%")
                           ->orWhere('date','LIKE',"%{$search}%")
                           ->orWhereHas('machine', function($q) use ($search){
                                return $q->where('name','LIKE',"%{$search}%");
                            })
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = $query->where('type','LIKE',"%{$search}%")
                           ->orWhere('action','LIKE',"%{$search}%")
                           ->orWhere('date','LIKE',"%{$search}%")
                           ->orWhereHas('machine', function($q) use ($search){
                                return $q->where('name','LIKE',"%{$search}%");
                            })
                            ->count();
        }

        $data = array();
        if(!empty($diagnostics))
        {
            foreach ($diagnostics as $diagnostic)
            {

                $nestedData['date'] = formatDateTime($diagnostic->date);
                $nestedData['machine'] = view('production.machines.shared.name',['machine'=> $diagnostic->machine])->render();
                $nestedData['type'] = view('production.diagnostics.tds.type',['diagnostic'=>$diagnostic])->render();
                $nestedData['action'] = $diagnostic->action;
                $nestedData['message'] = $diagnostic->message;
                $nestedData['duration'] = $diagnostic->duration > 0 ? date("H:i:s", $diagnostic->duration) : '';
                $nestedData['buttons'] = view('production.diagnostics.tds.buttons',['diagnostic'=>$diagnostic])->render();
                $data[] = $nestedData;

            }
        }

        $json_data = array(
                    "draw"            => intval($request->input('draw')),
                    "recordsTotal"    => intval($totalData),
                    "recordsFiltered" => intval($totalFiltered),
                    "data"            => $data
                    );

        echo json_encode($json_data);

    }
    /*
    *
    */
    public function getDiagnosticDetail(Request $request)
    {
        $request->validate([
            'uuid' => 'required|uuid',
        ]);
        $diagnostic = MachineLog::where('uuid',$request->uuid)->firstOrFail();
        return view('production.diagnostics.shared.diagnostic', compact('diagnostic'));
    }
    /*
    *
    */


}
