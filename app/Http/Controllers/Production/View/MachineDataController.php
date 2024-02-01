<?php

namespace App\Http\Controllers\Production\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Production\Machine;
use App\Models\Production\MachineData;
use App\Classes\Machines;

class MachineDataController extends Controller
{

  public function __construct(){
      $this->middleware('permission:localizations_r')->only('index');
      $this->middleware('permission:localizations_c')->only('create');
      $this->middleware('permission:localizations_c')->only('store');
      $this->middleware('permission:localizations_r')->only('show');
      $this->middleware('permission:localizations_u')->only('edit');
      $this->middleware('permission:localizations_u')->only('update');
      $this->middleware('permission:localizations_d')->only('delete');
      $this->Machine = new Machines();
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     /*
     *
     */
     public function index(Request $request)
     {

             $columnConfig = [];
             $columnConfig[] = ['data' => 'timestamp', 'orderable'=>true];
             $columnConfig[] = ['data' => 'machine', 'orderable'=>false,'searchable'=>true];
             $columnConfig[] = ['data' => 'address', 'orderable'=>true];
             $columnConfig[] = ['data' => 'buttons', 'orderable'=>false];

             $machines = Machine::orderBy('name')->get();
             return view('production.telemetries.index', compact('columnConfig','machines'));

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
    public function show($uuid)
    {
      $machine_data = MachineData::where('uuid',$uuid)->firstOrFail();
      $positions[0] =  $this->Machine->getPosition($machine_data->machine);
      return view('production.telemetries.show', compact('machine_data','positions'));
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

    /*
    * list for datatable server side
    */
    public function allTelemetries(Request $request)
    {


        $query = MachineData::query();

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
                            0 => 'timestamp',
                            1 => 'machine',
                            2 => 'address',
                            3 => 'buttons',
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
            $telemetries = $query->offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        } else {
            $search = $request->input('search.value');



        }
        //-------------------------------------------------------------------------
        $data = array();
        if(!empty($telemetries))
        {
            foreach ($telemetries as $telemetry)
            {

                $nestedData['timestamp'] = formatDateTime($telemetry->timestamp);
                $nestedData['machine'] = view('production.machines.shared.name',['machine'=>$telemetry->machine])->render();
                $nestedData['address'] = $telemetry->address;
                $nestedData['buttons'] = view('production.telemetries.tds.buttons',['telemetry'=>$telemetry])->render();
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


}
