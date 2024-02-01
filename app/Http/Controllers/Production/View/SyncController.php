<?php

namespace App\Http\Controllers\Production\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Production\MachineSync;
use App\Models\Production\Machine;

class SyncController extends Controller
{
    public function __construct(){
        $this->middleware('permission:syncs_r')->only('index');
        $this->middleware('permission:syncs_c')->only('create');
        $this->middleware('permission:syncs_c')->only('store');
        $this->middleware('permission:syncs_r')->only('show');
        $this->middleware('permission:syncs_u')->only('edit');
        $this->middleware('permission:syncs_u')->only('update');
        $this->middleware('permission:syncs_d')->only('delete');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {

             $columnConfig = [];

             $columnConfig[] = ['data' => 'created_at', 'orderable'=>true,'searchable'=>true];
             $columnConfig[] = ['data' => 'type', 'orderable'=>false,'searchable'=>true];
             $columnConfig[] = ['data' => 'machine', 'orderable'=>false,'searchable'=>true];
             $columnConfig[] = ['data' => 'status', 'orderable'=>true,'searchable'=>true];
             $columnConfig[] = ['data' => 'inserted_rows', 'orderable'=>false,'searchable'=>true];
             $columnConfig[] = ['data' => 'ref_date', 'orderable'=>true];
             $columnConfig[] = ['data' => 'buttons', 'orderable'=>false];
             $machines = Machine::all();
             return view('production.syncs.index', compact('columnConfig','machines'));

     }

     /*
     * list for datatable server side
     */
     public function allSyncs(Request $request)
     {
         $query = MachineSync::query();

         //COSTRUZIONE QUERY DI RICERCA
         if($request->has('filterData')){

             $request->validate([
                 'machine_uuid' => 'nullable|uuid',
                 'date_from' => 'nullable|date_format:d/m/Y',
                 'date_to' => 'nullable|date_format:d/m/Y',
                 'status' => 'nullable|integer|between:0,1',
                 'type' => 'nullable|string|in:prod,dia'
             ]);

             if ($request->has('machine_uuid') and $request->machine_uuid) {
                 $query->whereHas('machine', function($q) use ($request){
                     return $q->where('uuid',$request->machine_uuid);
                 });
             }
             if ($request->has('date_from') and $request->date_from) {
                 $query->whereDate('ref_date','>=', LocalToDb($request->date_from));
             }
             if ($request->has('date_to') and $request->date_to) {
                 $query->whereDate('ref_date','<=',LocalToDb($request->date_to));
             }
             if ($request->has('status') and $request->status) {
                 $query->where('status',$request->status);
             }
             if ($request->has('type') and $request->type) {
                 $query->where('type',$request->type);
             }

         }

         //FINE COSTRUZIONE QUERY DI RICERCA
         //-------------------------------------------------------------------------
         $columns = array(

                         0 => 'created_at',
                         1 => 'type',
                         2 => 'machine',
                         3 => 'status',
                         4 => 'inserted_rows',
                         5 => 'ref_date',
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
                 $syncs = $query->offset($start)
                              ->limit($limit)
                              ->orderBy($order,$dir)
                              ->get();
             } else {
                 $search = $request->input('search.value');

                 $syncs =  $query->where('type','LIKE',"%{$search}%")
                            ->orWhere('status','LIKE',"%{$search}%")
                            ->orWhere('ref_date','LIKE',"%{$search}%")
                            ->orWhereHas('machine', function($q) use ($search){
                                 return $q->where('name','LIKE',"%{$search}%");
                             })
                             ->offset($start)
                             ->limit($limit)
                             ->orderBy($order,$dir)
                             ->get();

             $totalFiltered = $query->where('type','LIKE',"%{$search}%")
                                    ->orWhere('status','LIKE',"%{$search}%")
                                    ->orWhere('ref_date','LIKE',"%{$search}%")
                                    ->orWhereHas('machine', function($q) use ($search){
                                         return $q->where('name','LIKE',"%{$search}%");
                                     })
                                     ->count();
         }
         //-------------------------------------------------------------------------
         $data = array();
         if(!empty($syncs))
         {
             foreach ($syncs as $sync)
             {

                 $nestedData['created_at'] = convertToLocal($sync->created_at);
                 $nestedData['ref_date'] = $sync->ref_date ? formatDate($sync->ref_date) : null;
                 $nestedData['type'] = view('production.syncs.tds.type',['sync'=> $sync])->render();;
                 $nestedData['machine'] = view('production.machines.shared.name',['machine'=> $sync->machine])->render();
                 $nestedData['status'] = view('production.syncs.tds.status',['sync'=>$sync])->render();
                 $nestedData['inserted_rows'] = $sync->inserted_rows;
                 $nestedData['buttons'] = view('production.syncs.tds.buttons',['sync'=>$sync])->render();
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
     public function getSyncDetail(Request $request)
     {
         $request->validate([
             'uuid' => 'required|uuid',
         ]);
         $sync = MachineSync::where('uuid',$request->uuid)->firstOrFail();
         return view('production.syncs.shared.sync', compact('sync'));
     }
     /*
     *
     */
     public function cronJob()
     {
        // \Artisan::call('syncMachine:cron');
         \Artisan::call('schedule:run');
     }
     /*
     *
     */
}
