<?php

namespace App\Classes;

use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Token\Parser;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use DateTimeImmutable;
use Cache;

class Tokens{

    public function __construct(){
        //
    }
    /*
    *
    */
    public function validateJWT($token){

        $parsedToken = (new Parser(new JoseEncoder()))->parse($token)->claims()->all();
        $now = new DateTimeImmutable();
        if($now < $parsedToken['exp']){
          return true;  //not expired
        } else {
          return false; // expired
        }

    }
  
    /*
    *
    */
    public function getDiastecaIdentifier($machine){

      if( Cache::get('diasteca_identifier') ){
        $identifier = Cache::get('diasteca_identifier');
      } else {
        $url = $machine->options['api_host'].'res1/get/user/'.$machine->options['username'].'/'.$machine->options['password'];
        $response = Http::get($url);
        $data_response = json_decode($response->body(), true);
        Cache::put('diasteca_identifier', $data_response['identifier']);
      }

      return  $identifier;
    }
    /*
    *
    */
    public function getSpringMachineControlToken($machine){

      if( Cache::get('springmachinecontrol_token') ){
        $token = Cache::get('springmachinecontrol_token');
        if( $this->validateJWT($token)){
              return $token;
        }
      }

      $response = Http::asForm()
          ->post($machine->options['api_host'], [
              'getExtraInfo' => true,
              'username' => $machine->options['username'],
              'password' => $machine->options['password'],
      ]);
      $body = json_decode($response->body(), true);
      $token = $body['access_token'];
      Cache::put('springmachinecontrol_token', $token);

      return  $token;
    }
    /*
    *
    */

}
