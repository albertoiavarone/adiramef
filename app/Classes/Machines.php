<?php

namespace App\Classes;
use App\Models\Production\Machine;
use App\Models\Production\MachineInfo;
use App\Models\Production\MachineData;
use App\Models\Production\MachineSync;
use App\Models\Production\MachineLog;
use App\Models\Production\Work;
use App\Models\Commercial\Order;
use App\Classes\Sync;
use App\Classes\MachineLogs;
use App\Classes\Orders;
use App\Classes\Programs;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DB;

class Machines{

    public function __construct(){
        $this->sync = new Sync();
        $this->Order = new Orders();
        $this->Program = new Programs();
        $this->syncMachineLogs = new MachineLogs();
        $this->infoRefreshTimeMinutes = config('values.MACHINE_INFO_REFRESH_TIME_MINUTES');
        $this->telemetryRefreshTimeMinutes = config('values.MACHINE_TELEMETRY_REFRESH_TIME_MINUTES');
    }
    /*
    *
    */
    public function saveMachineInfo($machine, $data){
      $updateOrCreate = MachineInfo::updateOrCreate([
                'machine_id' => $machine->id,
              ],
              [
                'info' => $data ,
              ]);
      return $updateOrCreate;
    }
    /*
    *
    */
    public function saveMachineTelemetry($machine, $data){

      $inserted = 0;
      if(!$machine->provider->geo_info){
        $data['latitude'] = $machine->static_latitude;
        $data['longitude'] = $machine->static_longitude;
      }

         $record = MachineData::firstOrcreate([
                    'machine_id' => $machine->id,
                    'timestamp' => $data['timestamp'] ,
                  ],
                  [
                  'machine_id' => $machine->id,
                  'latitude' => isset($data['latitude']) ? $data['latitude'] : null,
                  'longitude' => isset($data['longitude']) ? $data['longitude'] : null,
                  'altitude' => isset($data['altitude']) ? $data['altitude'] : null,
                  'speed' => isset($data['speed']) ? $data['speed'] : null,
                  'direction' => isset($data['direction']) ? $data['direction'] : null,
                  'km' => isset($data['km']) ? $data['km'] : null,
                  'odometer' => isset($data['odometer']) ? $data['odometer'] : null,
                  'time' => isset($data['time']) ? $data['time'] : null,
                  'status' => isset($data['status']) ? $data['status'] : null,
                  'address' => isset($data['address']) ? $data['address'] : null,
                  'parameters' => $data ,
                  'timestamp' => $data['timestamp'] ,
                ]);
          if ($record->wasRecentlyCreated) $inserted++;
          return $inserted;
    }
    /*
    *
    */
    public function saveMachineSync($machine, $data, $type){
          $create = MachineSync::create([
              'type' => $type,
              'machine_id' => $machine->id,
              'status' => $data['request']['http_code'],
              'message' => json_encode($data, true),
              'ref_date' => isset($data['timestamp'] )? $data['timestamp'] : null,
          ]);
          return $create;
    }
    /*
    * GPS machine
    */
    //update machine info (gps device, serial, etc)
    public function infoMachine($machine){
      if(!$machine->gps){
          return;
      }

      $className = 'App\\Classes\\Providers\\' . $machine->provider->class_name;
      $Provider =  new $className($machine->provider);
      //info veicolo
      if( !$machine->infos || data_get($machine, 'infos->updated_at' ) <= Carbon::now()->subMinute($this->infoRefreshTimeMinutes) ) {
        //aggiornamento info macchina almeno ogni 60 minuti
        $data = $Provider->getDevices($machine);
        $update_machine_info = $this->saveMachineInfo($machine, $data);
        $save_sync = $this->saveMachineSync($machine, $data,'info');
      }

      return 200;
    }

    //  sync telemetry data
    public function syncMachine($machine, $date_start=null, $date_end=null){
        //======================impianti senza gps======================
        if(!$machine->gps){
            return $this->syncFixedMachine($machine->uuid);
        }
        //==========================================================
        $className = 'App\\Classes\\Providers\\' . $machine->provider->class_name;
        $Provider =  new $className($machine->provider);



        //telemetria veicolo
        $row = $machine->last_position();
        if( !$row || $row->created_at <= Carbon::now()->subMinute($this->telemetryRefreshTimeMinutes) ) {

            $last_telemetry = $Provider->getLastTelemetry($machine);

            if(!empty($last_telemetry['telemetry'])){
              $inserted_record__telemetry = $this->saveMachineTelemetry($machine, $last_telemetry['telemetry']);
              if($inserted_record__telemetry){
                $save_sync = $this->saveMachineSync($machine, $last_telemetry,'telemetry');
              }
              return $last_telemetry['request']['http_code'];
            }
            return '503';    //custom error empty($last_telemetry['telemetry'])
        }
        //
      return '000';

    }
    /*
    *
    *
    */
    public function syncMachineDiagnostics($uuid, $date_Ymd = ''){

      return;

    }
    /*
    * init sync folder
    */
    public function machineStorage($machine){
      $response = Storage::disk(config('values.FILESYSTEM_DRIVER'))->makeDirectory('machines/'.$machine->serial_number);
      return $response;
    }
    /*
    * sync fixed machine (no gps)
    */
    public function syncFixedMachine($uuid, $date_Ymd = ''){

        //dd('Class Machine syncFixedMachine '.$uuid.'  -- '.$date_Ymd);

        $machine = Machine::where('uuid',$uuid)->first();
        $function = strtolower($machine->options['sync_method_name']);
        if(!$function) return false;
        $response = $this->sync->$function($machine,$date_Ymd) ;
        //dd($response);
        $inserted_rows = 0;
        $msg = '';
        if($response['status']){
            $data = $response['data'];

                if(is_null($data['date_stop'])){
                  return ;
                }
                 //====================================================================
                 if(!is_null($data['order_code'])){
                   $ref_date = null;
                   if(isset($data['ref_date'])){
                     $ref_date = $data['ref_date'];
                   }
                   $order = $this->Order->createOrder($data['order_code'],null, null, $machine, $ref_date);
                   if($order->wasRecentlyCreated){
                     $this->Order->linkOrderMachine($order,$machine);
                   }
                 }

                 //----Program---------------------------
                 $program = $this->Program->createProgram($data['program_name'], $machine, $data['program_id']);
                 //====================================================================
                 $work = Work::firstOrCreate(
                         [
                             'machine_id' => $machine->id,
                             'date_start' => $data['date_start'],
                             'date_stop' => $data['date_stop'],
                         ],
                         [
                            'machine_id' => $machine->id,
                            'order_id' => (isset($order->id) && !is_null($order->id)) ? $order->id : NULL,
                            'date_start' => $data['date_start'],
                            'date_stop' => $data['date_stop'],
                            'total_time' => $data['total_time'] ? $data['total_time'] : NULL,
                            'energy_consumed' => $data['energy_consumed'] ? $data['energy_consumed'] : NULL,
                            'program_id' => $program->id,
                            'program_name' => $program->name,
                            'description' => $data['description'] ? $data['description'] : NULL,
                            'info' => $data['info'],
                            'processes' => $data['processes'],
                    ]);
                if ($work->wasRecentlyCreated) {
                      $msg.= ' - Lavorazione '.$data['order_code'].'<br />';
                      $inserted_rows++;

                }
                //====================================================================

        }
        if($inserted_rows > 0){
            MachineSync::create([
                'type' => 'prod',
                'machine_id' => $machine->id,
                'ref_date' => \Carbon\Carbon::parse($date_Ymd)->format('Y-m-d'),
                'status' => $response['status'],
                'inserted_rows' => $inserted_rows,
                'message' => $response['message'].'<br />'.$msg,
            ]);
        }
        return $response;
    }
    /*
    * get positions
    */
    public function getPosition($machine){

      if(!$machine->last_position()){
        return [];
      }
        $last_position = $machine->last_position();
        $position['latitude'] = $last_position['latitude'];
        $position['longitude'] = $last_position['longitude'];
        $position['status'] = $last_position['status'] == 0 ? 'danger' : ($last_position['status'] == 1 ? 'success' : 'warning');
        $position['text'] =
                              '<h4 class=\"font-weight-bold font-size-sm\"><img class=\"img-fluid mr-1\" src=\"storage/'.$machine->type->logo_path.'\" style=\"height:15px\" />'.$machine->name.'</h4>'.
                              '<hr class=\"m-0 mb-1\"/>'.
                              '<p class=\"font-size-xs\"><i class=\"fas fa-barcode\"></i> Seriale: '.$machine->serial_number.'</p>'.
                              '<p class=\"font-size-xs\"><i class=\"fa fa-map-marker-alt font-size-normal\"></i> '.$last_position->address.'</p>'.
                              '<p class=\"font-size-xs\"><i class=\"fas fa-power-off font-size-normal \"></i> Stato: <span class=\"text-'.$machine->status['class'].'\">'.$machine->status['label'].'</span></p>'.
                              '<p class=\"font-size-xs\"><i class=\"flaticon-dashboard font-size-normal\"></i> Velocità '.intval($last_position['speed']).' Km/h</p>'.
                              '<p class=\"font-size-xs\"><i class=\"far fa-clock font-size-sm\"></i> Ultimo agg. '.($machine->last_position()->timestamp ? convertToLocal($machine->last_position()->timestamp) : 'n.d.').'</p>'.
                              '<hr class=\"m-0 mb-1\"/>'.
                              '<span class=\"float-left\"><img class=\"img-fluid\" src=\"'.(asset( !is_null($machine->provider->logo_path) ? 'storage/'.$machine->provider->logo_path : '')).'\" style=\"height:25px\" alt=\"'.$machine->provider->name.'\" /></span>'.
                              '<span class=\"float-right\"><img class=\"img-fluid\" src=\"'.(asset( !is_null($machine->builder->logo_path) ? 'storage/'.$machine->builder->logo_path : '')).'\" style=\"height:25px\" alt=\"'.$machine->builder->name.'\" /></span>'.
                              '<div class=\"clearfix\"></div>'
                              ;
        return $position;
    }
    /*
    * get positions
    */
    public function getAddress($machine){
      if(!$machine->last_position()){
        return 'n.d.';
      }
        $last_position = $machine->last_position();
        return $last_position->address;
    }
/*
*
*
*/
public function getStatus($machine){

    if(!isset($machine->options['class'])){
        return [
            'status' => false,
            'message' => 'error',
            'data' => [],
        ];
    }
    $className = 'App\\Classes\\Builders\\' . $machine->options['class'];
    $classMachine =  new $className();
    $status = $classMachine->currentState($machine);
    return $status;
  }
/*
*
*
*/

}