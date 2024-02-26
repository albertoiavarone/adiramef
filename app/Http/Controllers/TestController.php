<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\User;

use App\Models\Production\Machine;
use App\Models\Production\MachineType;
use App\Models\Production\MachineInfo;
use App\Models\Production\Builder;
use App\Models\Production\Provider;
use App\Models\Production\Work;
use App\Models\Commercial\Order;
use App\Models\Commercial\Customer;

use App\Classes\SMS;
use App\Classes\Users;
use Image;
use \Carbon\Carbon;
use Illuminate\Support\Str;
use App\Classes\Machines;
use App\Classes\Sync;
use App\Classes\MachineLogs;
use App\Classes\Tokens;
use Cache;


class TestController extends Controller
{

    public function __construct(){
        $this->SMS = new SMS();
        $this->users = new Users();
        $this->machine = new Machines();
        $this->MachineLogs = new MachineLogs();
        $this->sync = new Sync();
        $this->Token = new Tokens();
    }

    public function test(){

      $machines = Machine::all();
      foreach($machines as $machine){
        dump($machine->name);
        $this->machine->init_sync($machine);
      }
    }

    public function test_post(Request $request){
        dd('stooop');
    }

}
