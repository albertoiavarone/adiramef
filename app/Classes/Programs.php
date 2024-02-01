<?php

namespace App\Classes;

use App\Models\Production\Program;
use Carbon\Carbon;

class Programs{

    public function __construct(){
        //
    }


    /*
    * create Program
    */
    public function createProgram($name, $machine, $ref_id=null){

        $program = Program::updateOrCreate([
                  'name' => $name,
                  'machine_id' => $machine->id,
                  'ref_id' => $ref_id,
                ],
                [
                  'name' => $name,
                  'machine_id' => $machine->id,
                  'ref_id' => $ref_id,
                ]
         );


         return $program;

    }

}
