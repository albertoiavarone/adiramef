<?php

namespace App\Http\Controllers\Production\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Production\Machine;
use App\Models\Production\MachineManteinance;
use App\Models\Production\MachineManteinanceType;
use App\Models\Production\MachineManteinanceStatus;
use App\Models\Production\MachineManteinanceLog;
use App\Helpers\Files;

class MachineManteinanceController extends Controller
{

      public function __construct(){
          $this->middleware('permission:manteinances_r')->only('index');
          $this->middleware('permission:manteinances_c')->only('create');
          $this->middleware('permission:manteinances_c')->only('store');
          $this->middleware('permission:manteinances_r')->only('show');
          $this->middleware('permission:manteinances_u')->only('edit');
          $this->middleware('permission:manteinances_u')->only('update');
          $this->middleware('permission:manteinances_d')->only('delete');
          $this->files = new Files();

      }
      /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\Response
       */
       public function index(Request $request)
       {

               $columnConfig = [];

               $columnConfig[] = ['data' => 'updated_at', 'orderable'=>true,'searchable'=>true];
               $columnConfig[] = ['data' => 'machine', 'orderable'=>false,'searchable'=>true];
               $columnConfig[] = ['data' => 'type', 'orderable'=>false,'searchable'=>true];
               $columnConfig[] = ['data' => 'title', 'orderable'=>false,'searchable'=>true];
               $columnConfig[] = ['data' => 'expire_date', 'orderable'=>true];
               $columnConfig[] = ['data' => 'status', 'orderable'=>true,'searchable'=>true];
               $columnConfig[] = ['data' => 'buttons', 'orderable'=>false];
               $machines = Machine::orderBy('name')->get();
               $types = MachineManteinanceType::where('active',1)->orderBy('name')->get();
               $statuses = MachineManteinanceStatus::where('active',1)->orderBy('position')->get();
               $manteinances = MachineManteinance::all();

               return view('production.manteinance.index', compact('columnConfig','machines','manteinances','types', 'statuses'));

       }

       /*
       * list for datatable server side
       */
       public function allManteinances(Request $request)
       {

           $query = MachineManteinance::query();

           //COSTRUZIONE QUERY DI RICERCA
           if($request->has('filterData')){


               $request->validate([
                   'machine_uuid' => 'nullable|uuid',
                   'date_from' => 'nullable|date_format:d/m/Y',
                   'date_to' => 'nullable|date_format:d/m/Y',
                   'status' => 'nullable|integer|exists:machine_manteinance_statuses,id',
                   'type' => 'nullable|integer|exists:machine_manteinance_types,id',
                   'title' => 'nullable|string',
               ]);

               if ($request->has('machine_uuid') and $request->machine_uuid) {
                   $query->whereHas('machine', function($q) use ($request){
                       return $q->where('uuid',$request->machine_uuid);
                   });
               }
               if ($request->has('date_from') and $request->date_from) {
                   $query->whereDate('expire_date','>=', LocalToDb($request->date_from));
               }
               if ($request->has('date_to') and $request->date_to) {
                   $query->whereDate('expire_date','<=',LocalToDb($request->date_to));
               }
               if ($request->has('type') and $request->type) {
                   $query->whereHas('type', function($q) use ($request){
                       return $q->where('id',$request->type);
                   });
               }
               if ($request->has('status') and $request->status) {
                   $query->whereHas('status', function($q) use ($request){
                       return $q->where('id',$request->status);
                   });
               }

               if ($request->title) {
                   $query->where('title', 'LIKE', "%{$request->title}%");
               }


           }

           //FINE COSTRUZIONE QUERY DI RICERCA
           //-------------------------------------------------------------------------
           $columns = array(

                           0 => 'updated_at',
                           1 => 'machine_id',
                           2 => 'machine_manteinance_type_id',
                           3 => 'title',
                           4 => 'expire_date',
                           5 => 'machine_manteinance_status_id',
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
                   $manteinances = $query->offset($start)
                                ->limit($limit)
                                ->orderBy($order,$dir)
                                ->get();
               } else {
                   //
              }
           //-------------------------------------------------------------------------
           $data = array();

           if(!empty($manteinances))
           {
               foreach ($manteinances as $manteinance)
               {

                   $nestedData['updated_at'] = convertToLocal($manteinance->created_at);
                   $nestedData['machine'] = view('production.machines.shared.name',['machine'=> $manteinance->machine])->render();
                   $nestedData['type'] = $manteinance->type->name;
                   $nestedData['title'] = $manteinance->title;
                   $nestedData['expire_date'] = $manteinance->expire_date ? formatDate($manteinance->expire_date) : null;
                   $nestedData['status'] = view('production.manteinance.tds.status',['manteinance'=>$manteinance])->render();
                   $nestedData['buttons'] = view('production.manteinance.tds.buttons',['manteinance'=>$manteinance])->render();
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
       public function edit($uuid)
       {

           $manteinance = MachineManteinance::where('uuid',$uuid)->firstOrFail();
           $types = MachineManteinanceType::where('active',1)->orderBy('name')->get();
           $statuses = MachineManteinanceStatus::where('active',1)->orderBy('position')->get();
           return view('production.manteinance.edit', compact('manteinance','types','statuses'));
       }
       /*
       *
       */
       public function store(Request $request)
       {

           $request->validate([
               'title' => 'required|string',
               'machine_uuid' => 'required|string|exists:machines,uuid',
               'type' => 'required|integer|exists:machine_manteinance_types,id',
               'status' => 'required|integer|exists:machine_manteinance_statuses,id',
               'expire_date' => 'required|date_format:d/m/Y',
               'notes' => 'nullable|string',
               'uploaded' => 'nullable|max:10000|mimes:doc,docx,pdf,jpeg,jpg,xls,xlsx',
           ]);

           $machine = Machine::where('uuid',$request->machine_uuid)->firstOrFail();

           $manteinance =  MachineManteinance::create([
                       'machine_id' => $machine->id,
                       'title' => $request->title,
                       'machine_manteinance_type_id' => $request->type,
                       'machine_manteinance_status_id' => $request->status,
                       'expire_date' => $request->expire_date ? LocalToDb($request->expire_date) : null,
                       'notes' => $request->notes,
                     ]);
          if($manteinance){

               $log = MachineManteinanceLog::create([
                         'machine_manteinance_id' => $manteinance->id,
                         'user_id' => auth()->id(),
                         'machine_manteinance_status_id' => $request->status,
                         'notes' => $request->notes ? $request->notes : null,
                       ]);
               if ($log && $request->has('uploaded')) {
                   $file = $request->file('uploaded');
                   $path = 'manteinances/' . date('Y', strtotime($manteinance->created_at)) . '/' . $manteinance->uuid;
                   $file_name = $this->files->createFile($path, $file);
                   if ($file_name) {
                       $log->update(
                           [
                               'path_doc' => $file_name
                           ]
                       );
                   }
               }

           return redirect()->route('manteinances.edit', $manteinance->uuid)->with('success',__('general.success'));

         } else {
           return redirect()->route('manteinances.edit', $manteinance->uuid)->with('error',__('general.error'));
         }

       }
       /*
       *
       */
       public function update(Request $request , $uuid)
       {

           $request->validate([
               'title' => 'required|string',
               'notes' => 'nullable|string',
               'type' => 'required|integer|exists:machine_manteinance_types,id',
               'expire_date' => 'required|date_format:d/m/Y',
           ]);
           $manteinance = MachineManteinance::where('uuid',$uuid)->firstOrFail();

           $update =  $manteinance->update([
                       'title' => $request->title,
                       'type' => $request->type,
                       'expire_date' => $request->expire_date ? LocalToDb($request->expire_date) : null,
                       'notes' => $request->notes,
                     ]);

         if($update){
           return redirect()->route('manteinances.edit', $uuid)->with('success',__('general.success'));
         } else {
           return redirect()->route('manteinances.edit', $uuid)->with('error',__('general.error'));
         }

       }
       /*
       * change  status
       *
       */
       public function changeStatus(Request $request, $uuid)
       {

           $request->validate([
               'status' => 'required|numeric|between:1,10',
               'notes' => 'nullable|string',
               'uploaded' => 'nullable|max:10000|mimes:doc,docx,pdf,jpeg,jpg,xls,xlsx',
           ]);

           $manteinance = MachineManteinance::where('uuid', $uuid)->firstOrFail();

           $log = MachineManteinanceLog::create([
               'machine_manteinance_id' => $manteinance->id,
               'user_id' => auth()->id(),
               'machine_manteinance_status_id' => $request->status,
               'notes' => $request->notes,
           ]);

           if ($log) {
               $manteinance->update([
                   'machine_manteinance_status_id' => $request->status,
               ]);
               if ($request->has('uploaded')) {
                   $file = $request->file('uploaded');
                   $path = 'manteinances/' . date('Y', strtotime($manteinance->created_at)) . '/' . $manteinance->uuid;
                   $file_name = $this->files->createFile($path, $file);
                   if ($file_name) {
                       $log->update(
                           [
                               'path_doc' => $file_name
                           ]
                       );
                   }
               }
               return redirect()->route('manteinances.edit', $manteinance->uuid)->with('success', __('general.success'));
           }

           return redirect()->route('manteinances.edit', $manteinance->uuid)->with('error', __('general.error'));
       }
       /*
       *
       */

}
