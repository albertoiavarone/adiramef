<?php

namespace App\Classes\Builders;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use DB;

class PackSolution{

  public function __construct(){
      $this->host = config('values.OPC_HOST');
      $this->simulate = 1;
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
      //dump('Class PackSolution - checkHealth',$machine->name.' S/N '.$machine->serial_number);
      $data =[];
      $url = $this->host.'/packsolution/getDataMacchinaScada';
      if($this->simulate){
        //--------------------------------------------------------------------
        $data = [
          'status' => 0,
          'message' => 'Device on',
        ];
        //--------------------------------------------------------------------
      } else {
        //--------------------------------------------------------------------
        $url = $this->host.'/packsolution/checkStatusDevice';
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
      //dump('Class PackSolution - getDataMacchinaScada',$machine->name.' S/N '.$machine->serial_number);
      $data =[];
      $url = $this->host.'/packsolution/getDataMacchinaScada';
      if($this->simulate){
        //--------------------------------------------------------------------
        $data = [
          'status' => 0,
          'data' => [
            "NumProgInUso" => 18,
            "InfoProg" => "Nome del Programma",
            "EmInserite" => true,
            "Automatico" => true,
            "InProduzione" => false,
            "FineProduzione" => true,
            "InAttesaProdotto" => true,
            "StivaSacchiVuota" => true,
            "NoConsValle" => true,
            "AbMetalDetector" => true,
            "ImpSacchiDaProdurre" => 45,
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
  public function getProductionData($machine){

    //dump('Class PackSolution - getDataScada',$machine->name.' S/N '.$machine->serial_number);
    $data =[];
    $url = $this->host.'/packsolution/getDataScada';
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
      //dump('Class PackSolution - postDataScada',$machine->name.' S/N '.$machine->serial_number);
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



      if($this->simulate){
        //--------------------------------------------------------------------
        $data = [
            'prog_sent' => true,
            'report_read' => true,
            'order_number' => $request->order_number,
            'item_to_produce' => $request->item_to_produce,
            'barcodes' => $request->barcodes,
            "ip" => $machine->host,
            "program_id" => $request->program,
            'name' => trans_choice('general.order',1).' '.$request->order_number,
            'info' => [
              'order_number' => $request->order_number,
              'item_to_produce' => $request->item_to_produce,
              'barcodes' => implode('-',$request->barcodes),
              "ip" => $machine->host,
              "program_id" => $request->program,
              'name' => trans_choice('general.order',1).' '.$request->order_number,
            ],
        ];
        $resp = [
          'status' => true,
          'data' => $data,
          'message' => 'OK',
        ];

        return $resp;
        //--------------------------------------------------------------------
      } else {
        $url = $this->host.'/packsolution/postDataScada';
        $params = array(
             "prog_sent" => $values['prog_sent'],
             "report_read" => $values['report_read'],
             "order_number" => $values['order_number'],
             "item_to_produce" => $values['item_to_produce'],
             "barcodes_to_produce" => $values['barcodes_to_produce'],
          );
          $response = Http::withBody(json_encode($params), 'application/json')->post($url);

          return $response->body();
      }



  }
  /*
  *
  */

}
