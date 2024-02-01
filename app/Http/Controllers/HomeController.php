<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Models\User\AuthOtp;
use App\Models\Production\Machine;
use App\Models\Production\MachineManteinance;
use App\Models\Commercial\Order;
use App\Classes\Users;
use App\Classes\SMS;
use App\Classes\Machines;

use Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['auth','verified']);
        $this->users = new Users();
        $this->SMS = new SMS();
        $this->Machine = new Machines();
        $this->manteinance_expiring_days = 30;
    }
    /*
    * Home
    *
    */
    public function index(){
        //return redirect()->back();
        $user = auth()->user();
        $orders_statuses = DB::table('orders')
                    ->join('order_statuses', 'orders.order_status_id', '=', 'order_statuses.id')
                    ->select(DB::raw('order_statuses.name,count(*) as cont'))
                    ->whereYear('ref_date', \Carbon\Carbon::now()->year)
                    ->whereNull('deleted_at')
                    ->groupBy('order_status_id')->get();
        $works_by_month = DB::table('works')
                    ->select(DB::raw('MONTH(date_start) month,count(*) as cont'))
                    ->whereYear('date_start', \Carbon\Carbon::now()->year)
                    ->groupBy('month')->get();
        $months = getMonths();
        $machines = Machine::orderBy('id')->get();

        $gps = $machines->sum('gps');

        $positions = [];
        foreach($machines as $key => $machine){
            if(!$machine->gps) continue;
            $positions[$key] =  $this->Machine->getPosition($machine);
        }
        //dd($positions);

        $manteinances = MachineManteinance::whereDate('expire_date','>=',\Carbon\Carbon::now())
                      ->whereDate('expire_date', '<=', \Carbon\Carbon::now()->addDay($this->manteinance_expiring_days))
                      ->whereHas('status', function($q){
                        return $q->where('position',1);
                      })
                      ->orderBy('expire_date', 'ASC')->get();

        return view('home', compact('user','machines', 'positions','orders_statuses','works_by_month','months','manteinances','gps'));


    }
    /*
    * redirect for users with no user details
    *
    */
    public function Start(){
        $user = auth()->user();
        if(count($user->details)>0){
            return redirect()->back();
        }
        return view('handshake.start');
    }


}
