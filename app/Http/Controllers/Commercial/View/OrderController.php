<?php

namespace App\Http\Controllers\Commercial\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commercial\Order;
use App\Models\Commercial\OrderStatus;
use App\Models\Commercial\OrderDocument;
use App\Classes\Orders;
use App\Helpers\Files;

class OrderController extends Controller
{
  public function __construct(){
      $this->middleware('permission:orders_r')->only('index');
      $this->middleware('permission:orders_c')->only('create');
      $this->middleware('permission:orders_c')->only('store');
      $this->middleware('permission:orders_r')->only('show');
      $this->middleware('permission:orders_u')->only('edit');
      $this->middleware('permission:orders_u')->only('update');
      $this->middleware('permission:orders_d')->only('delete');
      $this->Order = new Orders();
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

             $columnConfig[] = ['data' => 'created_at', 'orderable'=>true];
             $columnConfig[] = ['data' => 'ref_code', 'orderable'=>true,'searchable'=>true];
             $columnConfig[] = ['data' => 'ref_date', 'orderable'=>true,'searchable'=>true];
             $columnConfig[] = ['data' => 'name', 'orderable'=>true,'searchable'=>true];
             $columnConfig[] = ['data' => 'status', 'orderable'=>false,'searchable'=>true];
             $columnConfig[] = ['data' => 'updated_at', 'orderable'=>true];
             $columnConfig[] = ['data' => 'buttons', 'orderable'=>false];
             $orders = Order::all();
             $order_statuses = OrderStatus::orderBy('position')->get();
             return view('commercial.orders.index', compact('columnConfig','orders','order_statuses'));

     }

     /*
     * list for datatable server side
     */
     public function allOrders(Request $request)
     {
         $query = Order::query();
         //COSTRUZIONE QUERY DI RICERCA
         if($request->has('filterData')){

             $request->validate([
                 'code' => 'nullable|string',
                 'ref_code' => 'nullable|string',
                 'name' => 'nullable|string',
                 'date_from' => 'nullable|date_format:d/m/Y',
                 'date_to' => 'nullable|date_format:d/m/Y',
                 'status' => 'nullable|exists:order_statuses,id',
             ]);


             if ($request->has('date_from') and $request->date_from) {
                 $query->whereDate('ref_date','>=', LocalToDb($request->date_from));
             }
             if ($request->has('date_to') and $request->date_to) {
                 $query->whereDate('ref_date','<=',LocalToDb($request->date_to));
             }
             if ($request->has('code') and $request->code) {
                 $query->where('code','LIKE',"%{$request->code}%" );
             }
             if ($request->has('ref_code') and $request->ref_code) {
                 $query->where('ref_code','LIKE',"%{$request->ref_code}%" );
             }
             if ($request->has('name') and $request->name) {
                 $query->where('name','LIKE',"%{$request->name}%" );
             }
             if ($request->has('status') and $request->status) {
                 $query->where('order_status_id', $request->status );
             }


         }


         //-------------------------------------------------------------------------
         $columns = array(

                         0 => 'created_at',
                         1 => 'ref_code',
                         2 => 'ref_date',
                         3 => 'name',
                         4 => 'status',
                         5 => 'updated_at',
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
                 $Orders = $query->offset($start)
                              ->limit($limit)
                              ->orderBy($order,$dir)
                              ->get();
             } else {
                 //
         }
         //-------------------------------------------------------------------------
         $data = array();
         if(!empty($Orders))
         {
             foreach ($Orders as $Order)
             {

                 $nestedData['created_at'] = convertToLocal($Order->created_at);
                 $nestedData['ref_code'] = $Order->ref_code;
                 $nestedData['ref_date'] = formatDate($Order->ref_date,'d/m/Y');
                 $nestedData['name'] = $Order->name;
                 $nestedData['status'] = view('commercial.orders.tds.status',['order'=>$Order])->render();
                 $nestedData['updated_at'] = convertToLocal($Order->updated_at);
                 $nestedData['buttons'] = view('commercial.orders.tds.buttons',['order'=>$Order])->render();
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('commercial.orders.create');
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
          'ref_code' => 'required|string',
          'ref_date' => 'required|date_format:d/m/Y',
          'name' => 'required|string',
          'description' => 'nullable|string',
          'date_from' => 'nullable|string',
          'date_to' => 'nullable|string',
      ]);

      $status = $this->Order->defaultStatus();

      $order =   Order::create([
            'code' => checkUniqueCode('App\Models\Commercial\Order', 'code', 10),
            'ref_code' => $request->ref_code,
            'ref_date' => LocalToDb($request->ref_date),
            'order_status_id' => $status->id,
            'name' => $request->name,
            'description' => $request->description ? $request->description : null,
            'date_start' => $request->date_from ? LocalDatetimeToDb($request->date_from) : null ,
            'date_end' => $request->date_to ? LocalDatetimeToDb($request->date_to) : null,

        ]);

      if($order){
          $this->Order->setLog($order,$status->id,'Creazione record');
          return redirect()->route('orders.edit', $order->uuid )->with('success',__('general.success'));
      } else {
          return redirect()->route('orders.edit', $order->uuid)->with('error',__('general.error'));
      }
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
    public function edit($uuid)
    {
        $order = Order::where('uuid',$uuid)->firstORFail();
        $statuses = OrderStatus::orderBy('position')->get();
        return view('commercial.orders.edit', compact('order','statuses'));
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
          'ref_code' => 'required|string',
          'ref_date' => 'required|date_format:d/m/Y',
          'name' => 'required|string',
          'description' => 'nullable|string',
          'date_from' => 'nullable|string',
          'date_to' => 'nullable|string',

      ]);

      $order = Order::where('uuid',$uuid)->firstOrFail();


      $update =   $order->update([
            'ref_code' => $request->ref_code,
            'ref_date' => LocalToDb($request->ref_date),
            'name' => $request->name,
            'description' => $request->description ? $request->description : null,
            'date_start' => $request->date_from ? LocalDatetimeToDb($request->date_from) : null ,
            'date_end' => $request->date_to ? LocalDatetimeToDb($request->date_to) : null,

      ]);
      selectTabView('info');
      if($update){
          return redirect()->route('orders.edit', $order->uuid )->with('success',__('general.success'));
      } else {
          return redirect()->route('orders.edit', $order->uuid)->with('error',__('general.error'));
      }
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
    *
    *
    */
    public function addLog($uuid, Request $request)
    {
        $request->validate([
            'status_id' => 'required|exists:order_statuses,id',
            'notes' => 'nullable|string',
        ]);

        $order = Order::where('uuid',$uuid)->firstORFail();
        $log = $this->Order->setLog($order, $request->status_id, $request->notes);
        selectTabView('logs');
        if($log){
            return redirect()->route('orders.edit', $order->uuid )->with('success',__('general.success'));
        } else {
            return redirect()->route('orders.edit', $order->uuid)->with('error',__('general.error'));
        }
    }


    /* ------------------------------------- */
    public function saveAttachment($uuid, Request $request)
    {
        $request->validate([
            'attachment' => 'required|max:10000|mimes:doc,docx,pdf,xls,xlsx,txt',
            'label' => 'required|string',
        ]);

        $order = Order::where('uuid',$uuid)->firstOrFail();

        $file = $request->file('attachment');
        $path = 'Order/' . date('Y') . '/' . $order->uuid;
        $file_name = $this->files->createFile($path, $file);


        $created = OrderDocument::create([
            'order_id' => $order->id,
            'label' => $request->label,
            'path' => $file_name,
            'original_name' => $file->getClientOriginalName(),
            'size' => $file->getSize(),
        ]);
        selectTabView('documents');
        if ($created) {
            return redirect()->route('orders.edit', $order->uuid)->with('success', __('general.success'));
        } else {
            return redirect()->route('orders.edit', $order->uuid)->with('error', __('general.error'));
        }
    }

    /*
      *
      *
    */
    public function deleteAttachment($uuid)
    {
        $document = OrderDocument::where('uuid', $uuid)->firstOrFail();
        selectTabView('documents');
        if ($document->delete()) {
            return redirect()->route('orders.edit', $document->order->uuid)->with('success', __('general.success'));
        }

        return redirect()->route('orders.edit', $document->order->uuid)->with('error', __('general.error'));
    }
    /*
      *
      *
    */
    public function getOrderByCode(Request $request)
    {
      $orders = Order::where('ref_code','LIKE', "%{$request->term}%")->orWhere('name','LIKE', "%{$request->term}%")->get();
      $results = [];

      foreach ($orders as $order) {
          $results[] = [
            'id' => $order->id,
            'text' => $order->ref_code . ' ' . $order->name,
          ];
      }

      return json_encode($results);
    }


}
