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
use App\Classes\Builders\PackSolution;


class Sync{

  public function __construct(){
    $this->PackSolution = new PackSolution();

  }

  /*
  *
  *
  */
  public function packsolution($machine){
      //dump('Sync Class PackSolution '.$machine->name.' S/N '.$machine->serial_number) ;
      $data = [];
      $checkHealth = $this->PackSolution->checkHealth($machine);
      //*********Start:errore macchina non raggiungibile********e
      if($checkHealth['status'] < 0){
        return $data = [
              'status'  => false,
              'message'  => 'Macchina non raggiungibile',
            ];
      }
      //*********End:errore macchina non raggiungibile********e

      $currentState = $this->PackSolution->currentState($machine);

      //********Start: errore macchina in produzione********e
      if($currentState['data']['InProduzione'] || !$currentState['data']['FineProduzione'] ) {
        return $data = [
              'status'  => false,
              'message'  => 'Macchina in Produzione',
            ];
      }
      //********End: errore macchina in produzione********e

      $get_data = $this->PackSolution->getProductionData($machine);
      if(!$get_data['data']['ReportPronto']){
        return $data = [
              'status'  => false,
              'message'  => 'Report lavorazione non pronto...',
            ];
      }


      $date_start = Carbon::createFromFormat('YmdHis', $get_data['data']['OraInizio'])->format('Y-m-d H:i:s');
      $date_end = Carbon::createFromFormat('YmdHis', $get_data['data']['OraFine'])->format('Y-m-d H:i:s');
      $total_time = Carbon::createFromFormat('YmdHis', $get_data['data']['OraInizio'])->diff(Carbon::createFromFormat('YmdHis', $get_data['data']['OraFine']))->format('%H:%i:%s');


      $data['data']['order_code'] = null;
      $data['data']['date_start'] = $date_start;
      $data['data']['date_stop'] = $date_end;
      $data['data']['total_time'] = $total_time;
      $data['data']['energy_consumed'] = null;
      $data['data']['program_name'] = $currentState['data']['InfoProg'];
      $data['data']['program_id'] = $get_data['data']['NumProgUsato'];
      $data['data']['description'] = NULL;
      $data['data']['processes'] = $get_data['data']['SacchiProdotti'];;
      //--------------ponte--------------------------------
      $data['data']['info'] = $get_data['data'];

      $data['status'] = true;
      $data['message'] = 'Lettura dati OK';


      return  $data;

  }
  /*
  *
  *
  */
  public function concetti($machine){
      //dump('Sync Class Concetti '.$machine->name.' S/N '.$machine->serial_number) ;
      $data = [];
      $className = 'App\\Classes\\Builders\\' . $machine->options['class'];
      $Builder =  new $className();
      $checkHealth = $Builder->checkHealth($machine);
      //*********Start:errore macchina non raggiungibile********e
      if($checkHealth['status'] < 0){
        return $data = [
              'status'  => false,
              'message'  => 'Macchina non raggiungibile',
            ];
      }
      //*********End:errore macchina non raggiungibile********e
      $currentState = $Builder->currentState($machine);
      dd($currentState);
      //********Start: errore macchina in produzione********e
      if($currentState['data']['InProduzione'] || !$currentState['data']['FineProduzione'] ) {
        return $data = [
              'status'  => false,
              'message'  => 'Macchina in Produzione',
            ];
      }
      //********End: errore macchina in produzione********e
      /*
      $get_data = $this->Concetti->getProductionData($machine);
      if(!$get_data['data']['ReportPronto']){
        return $data = [
              'status'  => false,
              'message'  => 'Report lavorazione non pronto...',
            ];
      }


      $date_start = Carbon::createFromFormat('YmdHis', $get_data['data']['OraInizio'])->format('Y-m-d H:i:s');
      $date_end = Carbon::createFromFormat('YmdHis', $get_data['data']['OraFine'])->format('Y-m-d H:i:s');
      $total_time = Carbon::createFromFormat('YmdHis', $get_data['data']['OraInizio'])->diff(Carbon::createFromFormat('YmdHis', $get_data['data']['OraFine']))->format('%H:%i:%s');


      $data['data']['order_code'] = null;
      $data['data']['date_start'] = $date_start;
      $data['data']['date_stop'] = $date_end;
      $data['data']['total_time'] = $total_time;
      $data['data']['energy_consumed'] = null;
      $data['data']['program_name'] = $currentState['data']['InfoProg'];
      $data['data']['program_id'] = $get_data['data']['NumProgUsato'];
      $data['data']['description'] = NULL;
      $data['data']['processes'] = $get_data['data']['SacchiProdotti'];;
      //--------------ponte--------------------------------
      $data['data']['info'] = $get_data['data'];

      $data['status'] = true;
      $data['message'] = 'Lettura dati OK';

*/
      return  $data;

  }
  /*
  *
  *
  */

}
