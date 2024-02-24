<?php

namespace App\Classes;
use App\Models\Production\Machine;
use App\Models\Commercial\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use DB;
use Storage;
use Cache;


class Sync{

  public function __construct(){
    //
  }
  //-------------------------------------------------------------------------------------------------------------------------
  public function importData($machine, $date_Ymd=null){

    $className = 'App\\Classes\\Builders\\' . $machine->options['sync_method_name'];

    $Builder =  new $className($machine->builder);

    //$Builder->testClass($machine);

    $data = $Builder->importData($machine, $date_Ymd);

    return $data;
  }
  //-------------------------------------------------------------------------------------------------------------------------


}
