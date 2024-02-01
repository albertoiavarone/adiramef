<?php

namespace App\Http\Controllers\Maps\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeafletController extends Controller
{
    public function index(){

      //$positions = json_decode(file_get_contents(asset('storage/response.json')), true);
      $positions = json_decode(file_get_contents(asset('storage/response_bsq.json')), true);
      //dump($positions);
      return view('maps.leaflet', compact('positions'));
    }
}
