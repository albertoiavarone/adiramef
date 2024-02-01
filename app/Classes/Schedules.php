<?php

namespace App\Classes;
use App\Models\Production\Machine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Models\Production\Schedule;
use App\Models\Commercial\Order;
use Carbon\Carbon;
use DB;
use Storage;
use File;

class Schedules{
    /*
    * schedule Device
    */
    public function schedule($machine, $request){
      $className = 'App\\Classes\\Builders\\' . $machine->options['sync_method_name'];
      $Builder =  new $className($machine->builder);
      //$Builder->testClass($machine);
      $data = $Builder->schedule($machine, $request);
    }
    /*
    * create schedule
    */
    public function saveSchedule($machine, $data){

      $schedule = Schedule::create([
          'machine_id' => $machine->id,
          'machine_program_id' => $data['data']['program_id'],
          'name' => $data['data']['name'],
          'date_start' => \Carbon\Carbon::now(),
          'sent' => $data['data']['prog_sent'],
          'code' => implode(' - ',$data['data']['barcodes']),
          'info' => [
              'content' => $data['data']['info'],
          ],
      ]);
      return $schedule;
    }
  /*
  *
  *
  */
    public function packsolution($machine, $request){
        $className = 'App\\Classes\\Builders\\' . $machine->options['class'];
        $Builder =  new $className();
        $resp = $Builder->setMachine($machine, $request);
        if($resp['status']){
          $data = [];
          $data['machine_program_id'] = '';
          $schedule = $this->saveSchedule($machine,$resp);
        }
        return;
    }
  /*
  *
  *
  */

}
