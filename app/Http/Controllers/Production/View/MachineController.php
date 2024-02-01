<?php

namespace App\Http\Controllers\Production\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Production\Builder;
use App\Models\Production\Provider;
use App\Models\Production\MachineType;
use App\Models\Production\Machine;
use App\Models\Production\MachineInfo;
use App\Models\Production\Work;
use App\Models\Production\MachineSync;
use App\Models\Production\MachineLog;
use App\Models\Production\MachineData;
use App\Models\Production\MachineManteinance;
use App\Models\Production\MachineManteinanceType;
use App\Models\Production\MachineManteinanceStatus;
use App\Models\Production\MachineAttachment;
use App\Models\Commercial\OrderMachine;
use App\Models\Commercial\Order;
use App\Classes\Machines;
use App\Classes\Schedules;
use \Carbon\Carbon;
use App\Helpers\Files;

class MachineController extends Controller
{

    public function __construct(){
        $this->middleware('permission:machines_r')->only('index');
        $this->middleware('permission:machines_c')->only('create');
        $this->middleware('permission:machines_c')->only('store');
        $this->middleware('permission:machines_r')->only('show');
        $this->middleware('permission:machines_u')->only('edit');
        $this->middleware('permission:machines_u')->only('update');
        $this->middleware('permission:machines_d')->only('delete');
        $this->machine = new Machines();
        $this->schedule = new Schedules();
        $this->files = new Files();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $machines = Machine::orderBy('name')->get();
        return view('production.machines.index', compact('machines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $builders = Builder::orderBy('name')->get();
        $providers = Provider::orderBy('name')->get();
        $machine_types = MachineType::orderBy('name')->get();
        return view('production.machines.create', compact('builders','machine_types','providers'));
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
            'name' => 'required|string',
            'serial_number' => 'required|string',
            'purchase_date' => 'nullable|string',
            'builder_uuid' => 'required|uuid',
            'provider_uuid' => 'nullable|uuid',
            'machine_type_uuid' => 'required|uuid',
            'option_keys.*' => 'nullable|string',
            'option_values.*' => 'nullable|string',
            'sync_production' => 'nullable|boolean',
            'sync_diagnostics' => 'nullable|boolean',
            'host' => 'nullable|string',
            'gps' => 'nullable|boolean',
            'static_latitude' => 'nullable|numeric',
            'static_longitude' => 'nullable|numeric',
        ]);


        $sync_production = 0;
        if($request->sync_production){
            $sync_production = 1;
        }
        $sync_diagnostics = 0;
        if($request->sync_diagnostics){
            $sync_diagnostics = 1;
        }
        $gps = 0;
        if($request->gps){
            $gps = 1;
        }

        $builder = Builder::where('uuid',$request->builder_uuid)->firstOrFail();
        if($request->provider_uuid){
          $provider = Provider::where('uuid',$request->provider_uuid)->firstOrFail();
        }
        $machine_type = MachineType::where('uuid',$request->machine_type_uuid)->firstOrFail();

        $options = [];
        if(!empty($request->option_keys) && !empty($request->option_values)){
            foreach($request->option_keys as $i => $value){
                if($value == '') continue;
                $options[$value] = $request->option_values[$i];
            }

        }

        $machine = Machine::create([
                        'name' => $request->name,
                        'builder_id' => $builder->id,
                        'provider_id' => $request->provider_uuid ? $provider->id : null,
                        'machine_type_id' => $machine_type->id,
                        'serial_number' => $request->serial_number,
                        'purchase_date' => $request->purchase_date ? LocalToDb($request->purchase_date) : NULL,
                        'options' => $options,
                        'sync_production' => $sync_production,
                        'sync_diagnostics' => $sync_diagnostics,
                        'host' => $request->host,
                        'gps' => $gps,
                        'static_latitude' => $request->static_latitude,
                        'static_longitude' => $request->static_longitude,
                    ]);

        if($machine){
          MachineInfo::create([
            'machine_id' => $machine->id,
          ]);
            $this->machine->machineStorage($machine);
            return redirect()->route('machines.edit',$machine->uuid)->with('success',__('general.success'));
        } else {
            return redirect()->route('machines.edit',$machine->uuid)->with('error',__('general.error'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $machine = Machine::where('uuid',$uuid)->firstOrFail();
        $last_work = [];
        $positions = [];
        if(!$machine->gps){
          $last_work = $machine->last_work();
          $status_machine = $this->machine->getStatus($machine);
        }else if($machine->gps){
            $positions[0] =  $this->machine->getPosition($machine);
            $status_machine = null;
        }
        return view('production.machines.show', compact('machine','last_work','positions','status_machine'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $builders = Builder::orderBy('name')->get();
        $providers = Provider::where('status',1)->orderBy('name')->get();
        $machine_types = MachineType::orderBy('name')->get();
        $machine = Machine::where('uuid',$uuid)->firstOrFail();
        return view('production.machines.edit', compact('builders','machine_types','machine','providers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {

        $request->validate([
            'name' => 'required|string',
            'serial_number' => 'required|string',
            'purchase_date' => 'nullable|string',
            'builder_uuid' => 'required|uuid',
            'provider_uuid' => 'nullable|uuid',
            'machine_type_uuid' => 'required|uuid',
            'option_keys.*' => 'nullable|string',
            'option_values.*' => 'nullable|string',
            'sync_production' => 'nullable|boolean',
            'sync_diagnostics' => 'nullable|boolean',
            'host' => 'nullable|string',
            'gps' => 'nullable|boolean',
            'static_latitude' => 'nullable|numeric',
            'static_longitude' => 'nullable|numeric',
        ]);

        $sync_production = 0;
        if($request->sync_production){
            $sync_production = 1;
        }
        $sync_diagnostics = 0;
        if($request->sync_diagnostics){
            $sync_diagnostics = 1;
        }
        $gps = 0;
        if($request->gps){
            $gps = 1;
        }

        $machine = Machine::where('uuid',$uuid)->firstOrFail();
        $builder = Builder::where('uuid',$request->builder_uuid)->firstOrFail();
        if($request->provider_uuid){
          $provider = Provider::where('uuid',$request->provider_uuid)->firstOrFail();
        }
        $machine_type = MachineType::where('uuid',$request->machine_type_uuid)->firstOrFail();
        $options = [];
        if(!empty($request->option_keys) && !empty($request->option_values)){
            foreach($request->option_keys as $i => $value){
                if($value == '') continue;
                $options[$value] = $request->option_values[$i];
            }

        }

        $host = $request->host;
        if($request->host == ''){
          $host = null;
        }
        $update = $machine->update([
                        'name' => $request->name,
                        'builder_id' => $builder->id,
                        'provider_id' => $request->provider_uuid ? $provider->id : null,
                        'machine_type_id' => $machine_type->id,
                        'serial_number' => $request->serial_number,
                        'purchase_date' => $request->purchase_date ? LocalToDb($request->purchase_date) : NULL,
                        'options' => $options,
                        'sync_production' => $sync_production,
                        'sync_diagnostics' => $sync_diagnostics,
                        'host' => $host,
                        'gps' => $gps,
                        'static_latitude' => $request->static_latitude,
                        'static_longitude' => $request->static_longitude,
                    ]);



        if($update){
            $this->machine->machineStorage($machine);
              MachineInfo::firstOrCreate([
                  'machine_id' => $machine->id,
                ],
                [
                  'machine_id' => $machine->id,
                ]);
            return redirect()->route('machines.edit',$machine->uuid)->with('success',__('general.success'));
        } else {
            return redirect()->route('machines.edit',$machine->uuid)->with('error',__('general.error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $delete = Machine::where('uuid',$uuid)->delete();
        if( $delete) {
            return redirect()->route('machines.index')->with('success',__('general.success'));
        } else {
            return redirect()->route('machines.index')->with('error',__('general.error'));
        }
    }

    /**
     * machineSync
     *
     */
    public function syncMachine(Request $request)
    {
        //force sync from machine info panel
        $machine = Machine::where('uuid',$request->uuid)->firstOrFail();
        $response = $this->machine->syncMachine($machine);
        if($response['status']){
            return redirect()->route('machines.show',$machine->uuid)->with('success',__('general.success'));
        } else {
            return redirect()->route('machines.show',$machine->uuid)->with('error',$response['message']);
        }
        return;
    }
    /**
     * machineSync Diagnostics
     *
     */
    public function syncMachineDiagnostics(Request $request)
    {
        $machine = Machine::where('uuid',$request->uuid)->firstOrFail();
        $response = $this->machine->syncMachineDiagnostics($request->uuid);
        //dd($response);
        if($response['status']){
            return redirect()->route('machines.show',$machine->uuid)->with('success',__('general.success'));
        } else {
            return redirect()->route('machines.show',$machine->uuid)->with('error',__('general.error'));
        }
        return;
    }
    /**
     * get production data of machine
     *
     */
    public function getMachineData(Request $request)
    {


        $request->validate([
            'uuid' => 'required|uuid',
            'months' => 'nullable|integer|between: 1,12',
        ]);
        $months = 12;
        if($request->months){
            $months = $request->months;
        }
        $machine = Machine::where('uuid',$request->uuid)->firstOrFail();
        $works = $machine->works->where('date_start', '>', \Carbon\Carbon::now()->subMonth($months) );
        $data = [];

        foreach($works as $work){
            $month = $work->date_start->format('m');
            if(!isset($data['works'][$month])){
                $data['works'][$month]['value'] = 0;
            }
            $data['works'][$month]['value']++;
            $data['works'][$month]['label'] = __('months.'.$month.'_sm');
        }

        $json = json_encode($data,true);
        return $json;
    }

    /**
     * machine Datatable Server
     *
    */
    public function getMachineWorks(Request $request)
    {
        $request->validate([
            'uuid' => 'required|uuid'
        ]);
        $machine = Machine::where('uuid',$request->uuid)->firstOrFail();

        $columnConfig = [];
        $columnConfig[] = ['data' => 'date_start', 'orderable'=>true];
        $columnConfig[] = ['data' => 'order', 'orderable'=>false,'searchable'=>true];
        $columnConfig[] = ['data' => 'lot', 'orderable'=>false,'searchable'=>true];
        $columnConfig[] = ['data' => 'program', 'orderable'=>false,'searchable'=>true];
        $columnConfig[] = ['data' => 'total_time', 'orderable'=>true];
        $columnConfig[] = ['data' => 'buttons', 'orderable'=>false];
        return view('production.machines.show.works', compact('machine','columnConfig'));
    }
    //-----------------------------------------------------------------------
    public function allMachineWorks(Request $request)
    {

        $columns = array(
                            0 => 'date_start',
                            1 => 'order_id',
                            2 => 'order_lot_id',
                            3 => 'program_id',
                            4 => 'total_time',
                            5 => 'buttons',
                        );


        $totalData = Work::whereHas('machine', function($q) use ($request){
                    return $q->where('uuid',$request->uuid);
                })->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $works = Work::whereHas('machine', function($q) use ($request){
                                return $q->where('uuid',$request->uuid);
                            })->offset($start)
                             ->limit($limit)
                             ->orderBy($order,$dir)
                             ->get();
        } else {
            $search = $request->input('search.value');

            $works =  Work::whereHas('machine', function($q) use ($request){
                                return $q->where('uuid',$request->uuid);
                                })
                                ->whereHas('order', function($q) use ($search){
                                    return $q->where('code','LIKE',"%{$search}%");
                                })
                                ->offset($start)
                                ->limit($limit)
                                ->orderBy($order,$dir)
                                ->get();

            $totalFiltered = Work::whereHas('machine', function($q) use ($request){
                                return $q->where('uuid',$request->uuid);
                            })
                            ->whereHas('order', function($q) use ($search){
                                return $q->where('code','LIKE',"%{$search}%");
                            })
                             ->count();
        }

        $data = array();
        if(!empty($works))
        {
            foreach ($works as $work)
            {

                $nestedData['date_start'] = formatDatetime($work->date_start);
                $nestedData['order'] = data_get($work, 'order.ref_code');
                $nestedData['lot'] = data_get($work, 'lot.code');
                $nestedData['program'] = data_get($work, 'program.name');
                $nestedData['total_time'] = $work->total_time;
                $nestedData['buttons'] = view('production.machines.show.tds.works_buttons',['work'=>$work])->render();
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

    /**
     * machine Datatable Server
     *
    */
    public function getMachineSyncs(Request $request)
    {
        $request->validate([
            'uuid' => 'required|uuid'
        ]);
        $machine = Machine::where('uuid',$request->uuid)->firstOrFail();

        $columnConfig = [];
        $columnConfig[] = ['data' => 'created_at', 'orderable'=>true];
        $columnConfig[] = ['data' => 'ref_date', 'orderable'=>true,'searchable'=>true];
        $columnConfig[] = ['data' => 'type', 'orderable'=>true,'searchable'=>true];
        $columnConfig[] = ['data' => 'status', 'orderable'=>true,'searchable'=>true];
        $columnConfig[] = ['data' => 'inserted_rows', 'orderable'=>true,'searchable'=>true];
        $columnConfig[] = ['data' => 'buttons', 'orderable'=>false];
        return view('production.machines.show.syncs', compact('machine','columnConfig'));
    }
    //-----------------------------------------------------------------------
    public function allMachineSyncs(Request $request)
    {
        $columns = array(
                        0 => 'created_at',
                        1 => 'ref_date',
                        2 => 'type',
                        3 => 'status',
                        4 => 'inserted_rows',
                        5 => 'buttons',
                        );


        $totalData = MachineSync::whereHas('machine', function($q) use ($request){
                            return $q->where('uuid',$request->uuid);
                        })->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $syncs = MachineSync::whereHas('machine', function($q) use ($request){
                                return $q->where('uuid',$request->uuid);
                            })->offset($start)
                             ->limit($limit)
                             ->orderBy($order,$dir)
                             ->get();
        } else {
            $search = $request->input('search.value');

            $syncs =  MachineSync::whereHas('machine', function($q) use ($request){
                                return $q->where('uuid',$request->uuid);
                                })
                                ->where('type','LIKE',"%{$search}%")
                                ->orWhere('inserted_rows','LIKE',"%{$search}%")
                                ->offset($start)
                                ->limit($limit)
                                ->orderBy($order,$dir)
                                ->get();

            $totalFiltered = MachineSync::whereHas('machine', function($q) use ($request){
                                return $q->where('uuid',$request->uuid);
                            })
                            ->where('type','LIKE',"%{$search}%")
                            ->orWhere('inserted_rows','LIKE',"%{$search}%")
                            ->count();
        }

        $data = array();
        if(!empty($syncs))
        {
            foreach ($syncs as $sync)
            {

                $nestedData['created_at'] = convertToLocal($sync->created_at);
                $nestedData['ref_date'] = $sync->ref_date ? formatDate($sync->ref_date) : null;
                $nestedData['type'] = $sync->type;
                $nestedData['status'] = view('production.syncs.tds.status',['sync'=>$sync])->render();
                $nestedData['inserted_rows'] = $sync->inserted_rows;
                $nestedData['buttons'] = view('production.machines.show.tds.syncs_buttons',['sync'=>$sync])->render();
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
    /**
     * machine Datatable Server
     *
    */
    public function getMachineDiagnostics(Request $request)
    {
        $request->validate([
            'uuid' => 'required|uuid'
        ]);
        $machine = Machine::where('uuid',$request->uuid)->firstOrFail();

        $columnConfig = [];
        $columnConfig[] = ['data' => 'date', 'orderable'=>true];
        $columnConfig[] = ['data' => 'type', 'orderable'=>true,'searchable'=>true];
        $columnConfig[] = ['data' => 'action', 'orderable'=>true,'searchable'=>true];
        $columnConfig[] = ['data' => 'message', 'orderable'=>true,'searchable'=>true];
        $columnConfig[] = ['data' => 'duration', 'orderable'=>true,'searchable'=>true];
        $columnConfig[] = ['data' => 'buttons', 'orderable'=>false];
        return view('production.machines.show.diagnostic', compact('machine','columnConfig'));
    }
    //-----------------------------------------------------------------------
    public function allMachineDiagnostics(Request $request)
    {

        $columns = array(
                        0 => 'date',
                        1 => 'type',
                        2 => 'action',
                        3 => 'message',
                        4 => 'duration',
                        5 => 'buttons',
                        );

        $totalData = MachineLog::whereHas('machine', function($q) use ($request){
                            return $q->where('uuid',$request->uuid);
                        })->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $diagnostics = MachineLog::whereHas('machine', function($q) use ($request){
                                return $q->where('uuid',$request->uuid);
                            })->offset($start)
                             ->limit($limit)
                             ->orderBy($order,$dir)
                             ->get();
        } else {
            $search = $request->input('search.value');

            $diagnostics =  MachineLog::whereHas('machine', function($q) use ($request){
                                return $q->where('uuid',$request->uuid);
                                })
                                ->where('type','LIKE',"%{$search}%")
                                ->orWhere('message','LIKE',"%{$search}%")
                                ->offset($start)
                                ->limit($limit)
                                ->orderBy($order,$dir)
                                ->get();

            $totalFiltered = MachineLog::whereHas('machine', function($q) use ($request){
                                return $q->where('uuid',$request->uuid);
                            })
                            ->where('type','LIKE',"%{$search}%")
                            ->orWhere('message','LIKE',"%{$search}%")
                            ->count();
        }

        $data = array();
        if(!empty($diagnostics))
        {
            foreach ($diagnostics as $diagnostic)
            {

                $nestedData['date'] = formatDatetime($diagnostic->date);
                $nestedData['type'] = $diagnostic->type;
                $nestedData['action'] = $diagnostic->action;
                $nestedData['message'] = $diagnostic->message;
                $nestedData['duration'] = date('H:i:s', $diagnostic->duration);
                $nestedData['buttons'] = view('production.machines.show.tds.diagnostics_buttons',['diagnostic'=>$diagnostic])->render();
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
    /**
     * set machine Schedule
     *
    */
    public function viewMachineSchedule(Request $request)
    {
        $request->validate([
            'uuid' => 'required|uuid'
        ]);
        $machine = Machine::where('uuid',$request->uuid)->firstOrFail();
        return view('production.machines.show.schedule', compact('machine'));
    }
    /**
     * set machine Schedule
     *
    */
    public function setMachineSchedule(Request $request)
    {


        $request->validate([
            'uuid' => 'required|uuid',
        ]);

        $machine = Machine::where('uuid',$request->uuid)->firstOrFail();
        $function = strtolower($machine->options['sync_method_name']);
        $response = $this->schedule->$function($machine, $request) ;

        return $response;
    }
    //-----------------------------------------------------------------------
    /*
    *
    */
    public function pingMachine(Request $request)
    {
        $request->validate([
            'uuid' => 'required|uuid'
        ]);
        $machine = Machine::where('uuid',$request->uuid)->firstOrFail();
        if(!$machine->host){
          $response['uuid'] = $request->uuid;
          $response['status'] = false;
          $response['code'] = 400;
          $response['msg'] = 'Host non specificato';
          $response['host'] = $machine->host;
          return $response;
        }
        $ip = $machine->host;
        /*
        exec("ping -c 4 " . $host, $output, $result);
        // -c for linux, -n for windows
        // 4 is number of requests
        */
        $ping = exec("ping  ".$ip,$out,$check);

    		$response = [];

    		$response['out'] = $out;

        if( !strpos($out[2],$machine->host) ){
    			$check = true;  //errore
    		} else {
    			$check = false;
    		}

        if($machine->last_log()){
            $response['last_log']['date'] = convertToLocal($machine->last_log()->date);
            $response['last_log']['type'] = $machine->last_log()->type.' '.$machine->last_log()->action;
            $response['last_log']['message'] = $machine->last_log()->message;
        }

        if($machine->last_work()) {
            $response['last_work']['date'] = convertToLocal($machine->last_work()->date_start);
            $response['last_work']['type'] = $machine->last_work()->order->code;
            $response['last_work']['message'] = $machine->last_work()->total_time;
        }
        $response['error_ping'] = $check;
        if($check == 0){
          // Do stuff for the server being online
          $response['uuid'] = $machine->uuid;
          $response['status'] = true;
          $response['code'] = 200;
          $response['msg'] = 'On line';
          $response['host'] = $machine->host;

        } else {
          // Do stuff for the server being offline
          $response['uuid'] = $request->uuid;
          $response['status'] = false;
          $response['code'] = 400;
          $response['msg'] = 'Off line';
          $response['host'] = $machine->host;
        }
        sleep(1);
        return $response;

    }

    /**
     * machine Datatable Server
     *
    */
    public function getMachineTelemetry(Request $request)
    {
        $request->validate([
            'uuid' => 'required|uuid'
        ]);
        $machine = Machine::where('uuid',$request->uuid)->firstOrFail();

        $columnConfig = [];
        $columnConfig[] = ['data' => 'date', 'orderable'=>true];
        $columnConfig[] = ['data' => 'latitude', 'orderable'=>false,'searchable'=>true];
        $columnConfig[] = ['data' => 'longitude', 'orderable'=>false,'searchable'=>true];
        $columnConfig[] = ['data' => 'address', 'orderable'=>false,'searchable'=>true];
        $columnConfig[] = ['data' => 'buttons', 'orderable'=>false];
        return view('production.machines.show.telemetry', compact('machine','columnConfig'));
    }
    //-----------------------------------------------------------------------
    //-----------------------------------------------------------------------
    public function allMachineTelemetry(Request $request)
    {

        $columns = array(
                        0 => 'timestamp',
                        1 => 'latitude',
                        2 => 'longitude',
                        3 => 'address',
                        4 => 'buttons',
                        );

        $totalData = MachineData::whereHas('machine', function($q) use ($request){
                            return $q->where('uuid',$request->uuid);
                        })->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $telemetries = MachineData::whereHas('machine', function($q) use ($request){
                                return $q->where('uuid',$request->uuid);
                            })->offset($start)
                             ->limit($limit)
                             ->orderBy($order,$dir)
                             ->get();
        } else {
            $search = $request->input('search.value');

            $telemetries =  MachineData::whereHas('machine', function($q) use ($request){
                                return $q->where('uuid',$request->uuid);
                                })
                                ->offset($start)
                                ->limit($limit)
                                ->orderBy($order,$dir)
                                ->get();

            $totalFiltered = MachineData::whereHas('machine', function($q) use ($request){
                                return $q->where('uuid',$request->uuid);
                            })
                            ->count();
        }

        $data = array();

        if(!empty($telemetries))
        {
            foreach ($telemetries as $telemetry)
            {

                $nestedData['date'] = convertToLocal($telemetry->timestamp);
                $nestedData['latitude'] = $telemetry->latitude;
                $nestedData['longitude'] = $telemetry->longitude;
                $nestedData['address'] = $telemetry->address;
                $nestedData['buttons'] = view('production.telemetries.tds.buttons',['telemetry'=>$telemetry])->render();
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
    /**
     * machine Datatable Server
     *
    */
    public function getMachineOrders(Request $request)
    {
        $request->validate([
            'uuid' => 'required|uuid'
        ]);
        $machine = Machine::where('uuid',$request->uuid)->firstOrFail();

        $columnConfig = [];
        $columnConfig[] = ['data' => 'ref_date', 'orderable'=>true];
        $columnConfig[] = ['data' => 'name', 'orderable'=>false,'searchable'=>true];
        $columnConfig[] = ['data' => 'status', 'orderable'=>false,'searchable'=>true];
        $columnConfig[] = ['data' => 'buttons', 'orderable'=>false];
        return view('production.machines.show.orders', compact('machine','columnConfig'));
    }
    //-----------------------------------------------------------------------
    //-----------------------------------------------------------------------
    public function allMachineOrders(Request $request)
    {

        $columns = array(
                        0 => 'ref_date',
                        1 => 'name',
                        2 => 'status',
                        3 => 'buttons',
                        );

        $totalData = Order::whereHas('order_machines', function($q) use ($request){
                              return $q->whereHas('machine', function ($t) use ($request) {
                                return $t->where('uuid', $request->uuid);
                              });
                        })->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $Orders = Order::whereHas('order_machines', function($q) use ($request){
                                  return $q->whereHas('machine', function ($t) use ($request) {
                                    return $t->where('uuid', $request->uuid);
                                  });
                                })
                                ->offset($start)
                               ->limit($limit)
                               ->orderBy($order,$dir)
                               ->get();
        } else {
            $search = $request->input('search.value');

            $Orders =  Order::whereHas('order_machines', function($q) use ($request){
                                    return $q->whereHas('machine', function ($t) use ($request) {
                                      return $t->where('uuid', $request->uuid);
                                        });
                                  })
                                ->offset($start)
                                ->limit($limit)
                                ->orderBy($order,$dir)
                                ->get();

            $totalFiltered = Order::whereHas('order_machines', function($q) use ($request){
                                    return $q->whereHas('machine', function ($t) use ($request) {
                                      return $t->where('uuid', $request->uuid);
                                        });
                                  })
                            ->count();
        }

        $data = array();

        if(!empty($Orders))
        {
            foreach ($Orders as $Order)
            {

                $nestedData['ref_date'] = formatDate($Order->ref_date);
                $nestedData['name'] = $Order->name;
                $nestedData['status'] = view('commercial.orders.tds.status',['order'=> $Order])->render();
                $nestedData['buttons'] = view('commercial.orders.tds.buttons',['order'=> $Order])->render();
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
    public function forceMachinesSyncs(){

      $minutes = 5;

      $last_sync = MachineSync::orderBy('created_at','DESC')->first();
      if($last_sync && $last_sync->created_at >= Carbon::now()->subMinute($minutes)){
        return str_replace('#minutes#',$minutes, __('production.wait_for_sync_msg'));
      }
      //----------sync---------------
      \Artisan::call('syncMachine:cron');
      return ;
    }
    /*
    *
    */
    public function getMachineMap(Request $request){

      $machine = Machine::where('uuid',$request->uuid)->firstOrFail();
      $positions = [];
      if($machine->gps){
          $positions[0] =  $this->machine->getPosition($machine);
      }
      return view('home.shared.map_single', compact('positions','machine'));

    }

    /**
     * machine Datatable Server
     *
    */
    public function getMachineManteinances(Request $request)
    {
        $request->validate([
            'uuid' => 'required|uuid'
        ]);
        $machine = Machine::where('uuid',$request->uuid)->firstOrFail();
        $manteinance_types = MachineManteinanceType::where('active',1)->orderBy('name')->get();
        $manteinance_statuses = MachineManteinanceStatus::where('active',1)->orderBy('position')->get();

        $columnConfig = [];
        $columnConfig[] = ['data' => 'expire_date', 'orderable'=>true];
        $columnConfig[] = ['data' => 'type', 'orderable'=>false,'searchable'=>true];
        $columnConfig[] = ['data' => 'title', 'orderable'=>false,'searchable'=>true];
        $columnConfig[] = ['data' => 'status', 'orderable'=>false,'searchable'=>true];
        $columnConfig[] = ['data' => 'buttons', 'orderable'=>false];
        return view('production.machines.show.manteinances', compact('machine','columnConfig','manteinance_types','manteinance_statuses'));
    }
    //-----------------------------------------------------------------------
    public function allMachineManteinances(Request $request)
    {

        $columns = array(
                        0 => 'expire_date',
                        1 => 'type',
                        2 => 'title',
                        3 => 'status',
                        4 => 'buttons',
                        );


        $totalData = MachineManteinance::whereHas('machine', function($q) use ($request){
                            return $q->where('uuid',$request->uuid);
                        })->count();


        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $manteinances = MachineManteinance::whereHas('machine', function ($t) use ($request) {
                                    return $t->where('uuid', $request->uuid);
                                })
                                ->offset($start)
                               ->limit($limit)
                               ->orderBy($order,$dir)
                               ->get();
        } else {
            $search = $request->input('search.value');

            $manteinances =  MachineManteinance::hereHas('machine', function ($t) use ($request) {
                                      return $t->where('uuid', $request->uuid);
                                  })
                                ->offset($start)
                                ->limit($limit)
                                ->orderBy($order,$dir)
                                ->get();

            $totalFiltered = MachineManteinance::whereHas('machine', function ($t) use ($request) {
                                      return $t->where('uuid', $request->uuid);
                                  })
                            ->count();
        }

        $data = array();

        if(!empty($manteinances))
        {
            foreach ($manteinances as $manteinance)
            {

                $nestedData['expire_date'] = formatDate($manteinance->expire_date);
                $nestedData['type'] = $manteinance->type->name;
                $nestedData['title'] = $manteinance->title;
                $nestedData['status'] = view('production.manteinance.tds.status',['manteinance'=> $manteinance])->render();
                $nestedData['buttons'] = view('production.manteinance.tds.buttons',['manteinance'=> $manteinance])->render();
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
    public function getMachineAttachments(Request $request){

      $machine = Machine::where('uuid',$request->uuid)->firstOrFail();

      return view('production.machines.show.attachments.index', compact('machine'));

    }
    /*
    *
    */
    public function saveMachineAttachment(Request $request){


        $request->validate([
            'machine_uuid' => 'required|uuid',
            'attachment' => 'required|max:10000|mimes:doc,docx,pdf,jpeg',
            'label' => 'required|string',
            'description' => 'nullable|string',
        ]);


        $machine = Machine::where('uuid', $request->machine_uuid)->firstOrFail();

        $file = $request->file('attachment');
        //$path = 'CV/'.date('Y').'/'.date('m');
        $path = 'machines/'.$machine->serial_number.'/';
        $file_name = $this->files->createFile($path, $file);

        $result = MachineAttachment::create([
            'machine_id' => $machine->id,
            'label' => $request->label,
            'path' =>  $file_name,
            'original_name' => $file->getClientOriginalName(),
            'size' => $file->getSize(),
            'description' => $request->description ? $request->description : NULL,
        ]);



        return $result;

    }
    /*
    *
    */
}
