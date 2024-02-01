<?php

namespace App\Classes;

use App\Models\Commercial\Order;
use App\Models\Commercial\OrderLog;
use App\Models\Commercial\OrderStatus;
use App\Models\Commercial\OrderMachine;
use Carbon\Carbon;

class Orders{

    public function __construct(){
        //
    }

    /*
    *
    */
    public function defaultStatus(){
      $status = OrderStatus::where('position',1)->first();
      return $status;
    }
    /*
    * create Order
    */
    public function createOrder($ref_code, $name=null, $description=null, $machine=null,$ref_date = null){

      if(!is_null($ref_code)){
        $status = $this->defaultStatus();
        $order = Order::firstOrCreate([
                  'ref_code' => $ref_code
                ],
                [
                  'ref_code' => $ref_code ,
                  'ref_date' => !is_null($ref_date) ? $ref_date : null ,
                  'code' => checkUniqueCode('App\Models\Commercial\Order', 'code', 10),
                  'name' => !is_null($name) ? $name : 'Commessa '.$ref_code ,
                  'description' => !is_null($description) ? $description : 'Descrizione Commessa '.$ref_code ,
                  'order_status_id' => $status->id,
                ]
         );

         if ($order->wasRecentlyCreated) {
            $this->setLog($order);

        }
         return $order;
      }
      return false;
    }
    /*
    *
    */
    public function setLog($order, $status_id = null, $notes = null){
      $log = OrderLog::create([
        'order_id' => $order->id,
        'user_id' => auth()->id(),
        'order_status_id' => $status_id ? $status_id : $order->order_status_id,
        'notes' => $notes ? $notes : null,
      ]);

      if($log->wasRecentlyCreated && $status_id){
        $order->order_status_id  = $status_id;
        $order->save();
      }

      return $log;
    }
    /*
    *
    */
    public function linkOrderMachine($order,$machine){
      $link = OrderMachine::firstOrCreate([
            'order_id' => $order->id,
            'machine_id' => $machine->id,
          ],
          [
            'order_id' => $order->id,
            'machine_id' => $machine->id,
        ]);
      return $link;
    }
    /*
    *
    */

}
