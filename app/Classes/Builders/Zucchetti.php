<?php

namespace App\Classes\Builders;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use DB;
use Storage;

class Zucchetti{

  public function __construct(){
      $this->debug = 0;
  }
  /*
  *
  */
  public function testClass($machine)
  {
    //dump('Zucchetti testClass machine '.$machine->serial_number);
  }
  /*
  *
  */
  public function importData($machine, $date_Ymd)
  {
    //dump('Sync zucchetti '.$machine->name.' S/N '.$machine->serial_number) ;
    /*
      0 => "LNK_DOC"
      1 => "ID"
      2 => "Descrizione 1"
      3 => "Descrizione 2"
      4 => "Matricola"
      5 => "Inventario Adiramef"
      6 => "Inventario Ente"
      7 => "Tipo Macchinario"
      8 => "Costruttore"
      9 => "Famiglia"
      10 => "Ubicazione"
      11 => "Liv.1"
      12 => "Liv.2"
      13 => "Liv.3"
      14 => "Stato"
      15 => "Oggetto Sottoposto a Manutenzione"
    */

    if($date_Ymd==''){
        $date = date('Ymd');
    } else {
        $date = \Carbon\Carbon::parse($date_Ymd)->format('Ymd');
    }

    $data = [];
    $data['message'] = '';

    $directory = 'zucchetti/'.date('Y').'/';
    $files = Storage::files($directory);

    $files = array_filter($files, function ($value) use ($date) {
       //return strpos(basename($value), $date);
       return str_starts_with(basename($value), $date);
    });



    if( empty($files)){
        $data['status'] = false;
        $data['message'] = 'File not found!';
        $data['date'] = $date;
        return $data;
    }

    $i = 0;
    foreach($files as $key => $file){
      $line = 0;

      $path = Storage::disk(config('values.FILESYSTEM_DRIVER'))->path($file);
      if (($handle = fopen($path, "r")) !== FALSE) {

          $separator =  ",";

          while (($row = fgetcsv($handle, 1000, $separator)) !== FALSE) {

              $line++;
              if($row[4] != $machine->serial_number) {
                continue;
              }

                  $duration = rand(50, 180);
                  $date_start = date('Y-m-d H:i:s', strtotime( pathinfo($file, PATHINFO_FILENAME)) - $duration);
                  $date_stop = date('Y-m-d H:i:s', strtotime( pathinfo($file, PATHINFO_FILENAME)));
                  $total_time = Carbon::parse($date_stop)->diff(Carbon::parse($date_start))->format('%H:%i:%s');

                  $data['data'][$i]['line'] = $line;
                  $data['data'][$i]['order_code'] = NULL;
                  $data['data'][$i]['date_start'] = $date_start;
                  $data['data'][$i]['program_name'] = $row[14];
                  $data['data'][$i]['program_ref_code'] = NULL;
                  $data['data'][$i]['processes'] = 1;
                  $data['data'][$i]['energy_consumed'] = NULL;
                  $data['data'][$i]['info']['Dispositivo']['Categoria'] = $row[12];
                  $data['data'][$i]['info']['Dispositivo']['Famiglia'] = $row[9];
                  $data['data'][$i]['info']['Dispositivo']['Ubicazione'] = $row[10];
                  $data['data'][$i]['info']['Dispositivo']['In manutenzione'] = $row[15];
                  $data['data'][$i]['info']['Programma'] = $row[14];
                  $data['data'][$i]['date_stop'] = $date_stop;
                  $data['data'][$i]['total_time'] = $total_time;
                  $i++;
          }
          fclose($handle);
      }
      $data['message'].= 'File '.basename($file).' - '.$machine->serial_number.': readed'."\n";
    }

    $data['status'] = true;
    $data['date'] =  \Carbon\Carbon::parse($date)->format('Y-m-d');
    return $data;
  }
  /*
  *
  */
  public function currentState($machine)
  {

        if(!$machine->host){
          $response['uuid'] = $machine->uuid;
          $response['status'] = false;
          $response['code'] = 400;
          $response['msg'] = 'Host non specificato';
          $response['host'] = $machine->host;
          return $response;
        }
        $ip = $machine->host;
        /*
        exec("ping -c 4 " . $host, $output, $result);
        // -c for linux, -n for windows
        // 4 is number of requests
        */
        $ping = exec("ping  ".$ip,$out,$check);

    		$response = [];

    		$response['out'] = $out;

        if( !strpos($out[2],$machine->host) ){
    			$check = true;  //errore
    		} else {
    			$check = false;
    		}

        $response['error_ping'] = $check;
        $response['uuid'] = $machine->uuid;
        $response['host'] = $machine->host;
        if($check == 0){
          // Do stuff for the server being online
          $response['status'] = true;
          $response['code'] = 200;
          $response['msg'] = 'On line';

        } else {
          // Do stuff for the server being offline
          $response['status'] = false;
          $response['code'] = 400;
          $response['msg'] = 'Off line';
        }

        $response['data']['ping'] = $response['msg'];
        $response['class'] = 'general';


        return $response;


  }
  /*
  *
  */


}
