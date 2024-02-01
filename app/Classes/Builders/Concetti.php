<?php

namespace App\Classes\Builders;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use DB;

class Concetti{

  public function __construct(){
      $this->host = config('values.OPC_HOST');
      $this->simulate = 1;
      $this->debug = 0;
      $this->machine_ready = true;
  }
  /*
  *
  */
  public function getStatuses(){
      $statuses = [];
      return   $statuses;

  }
  /*
  *
  */
  public function formatLabel($text){
      $string = str_replace(' ','_', __('packSolution.'.$text));
      return   $string;

  }
  /*
  *
  */
  public function checkHealth($machine){
      if($this->debug) dump('Class Concetti - checkHealth',$machine->name.' S/N '.$machine->serial_number);
      $data =[];

      if($this->simulate){
        //--------------------------------------------------------------------
        $data = [
          'status' => 0,
          'message' => 'Device on',
        ];
        //--------------------------------------------------------------------
      } else {
        //--------------------------------------------------------------------
        $url = $this->host.'/concetti/checkStatusDevice';
        $params = array(
               "ip" => $machine->host,
            );
        $response = Http::withBody(json_encode($params), 'application/json')->get($url);
        $data = json_decode($response->body(), true);
        //--------------------------------------------------------------------
      }

      return $data;
  }
  /*
  *
  */
  public function currentState($machine){
      if($this->debug) dump('Class Concetti - currentState',$machine->name.' S/N '.$machine->serial_number);
      $data =[];

      if($this->simulate){
        //--------------------------------------------------------------------
        $data = [
          'status' => 0,
          'data' => [
            "Life_bit" => true,
            "Emergency" => true,
            "Main_power" => true,
            "Manual" => true,
            "Auto" => false,
            "In_production" => true,
            "Alarm" => true,
            "Wait_product" => true,
            "Wait_operator" => true,
            "Wait_machine" => true,
            "Remote" => true,
            "N_bag_no_reset" => 144,
            "N_bag_with_reset" => 12,
            "Hours_no_reset" => 15,
            "Hours_with_reset" => 15,
            "Production" => 15,
            "Program" => 15,
            "Peso_Sacco" => 15,
            "Lunghezza_Sacco" => 15,
            "Larghezza_Sacco" => 15,
            "Str_Product_Type" => 'Tipo AAAAAAAAAAAAAAA',
            "Str_Recipe_Name" => 'Tipo AAAAAAAAAAAAAAA',
            "DT_Date_Time" => '20230929101233',
          ],
        ];
        //--------------------------------------------------------------------
      } else {
        //--------------------------------------------------------------------
        $url = $this->host.'/concetti/getDataMacchinaScada';
        $params = array(
               "db" => 500,
               "ip" => $machine->host,
            );
        $response = Http::withBody(json_encode($params), 'application/json')->get($url);
        $data = json_decode($response->body(), true);
        //--------------------------------------------------------------------
      }

      return $data;
  }

  /*
  *
  */
  public function getProductionData($machine){

    //dump('Class Concetti - getDataScada',$machine->name.' S/N '.$machine->serial_number);
    $data =[];
    $url = $this->host.'/concetti/getDataScada';
    if($this->simulate){
      //--------------------------------------------------------------------
      $data = [
        'status' => 0,
        'data' => [
          "ProntoRicevereProg" => $this->machine_ready,
          "ReportPronto" => true,
          "NumProgUsato" => 18,
          "OraInizio" => '20230929101233',
          "OraFine" => '20230929101951',
          "SacchiProdotti" => 144,
          "SacchiContaminati" => 12,
          "ProduzioneOraria" => 15,
        ],
      ];
      //--------------------------------------------------------------------
    } else {
      //--------------------------------------------------------------------
      $params = array(
             "ip" => $machine->host,
          );
      $response = Http::withBody(json_encode($params), 'application/json')->get($url);
      $data = json_decode($response->body(), true);
      //--------------------------------------------------------------------
    }
      return $data;
  }
  /*
  *
  */
  public function setMachine($machine, $request){
      //dump('Class Concetti - postDataScada',$machine->name.' S/N '.$machine->serial_number);
      $request->validate([
        'program' => 'nullable|numeric',
        'order_number' => 'required|integer',
        'item_to_produce' => 'required|integer',
        'barcodes.*' => 'required|string',
        'uuid' => 'required|uuid|exists:machines,uuid',

      ]);
      // per settare la macchina devo verificare sia pronta a ricevere il programma dallo scada
      $resp = $this->getProductionData($machine);
      if(!$resp['data']['ProntoRicevereProg']){
          return [
            'status' => false,
            'message' => 'Macchina non pronta a ricevere il programma dallo SCADA',
          ];
      }

      $params = [
          'prog_sent' => true,
          'report_read' => true,
          'order_number' => $request->order_number,
          'item_to_produce' => $request->item_to_produce,
          'barcodes' => $request->barcodes,
          "ip" => $machine->host,
      ];


      $url = $this->host.'/postMachineSettings';
      $params = array(
           "prog_sent" => $params['prog_sent'],
           "report_read" => $params['report_read'],
           "order_number" => $params['order_number'],
           "item_to_produce" => $params['item_to_produce'],
           "barcodes_to_produce" => $params['barcodes_to_produce'],
        );
        $response = Http::withBody(json_encode($params), 'application/json')->post($url);

        return $response->body();
  }
  /*
  *
  */

}
