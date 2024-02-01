<?php

namespace App\Classes;
use Illuminate\Support\Facades\Validator;
use App\Models\OpenBanking\Account;
use App\Models\Social\Group;
use App\Models\Report\Report;
use Carbon\Carbon;

class Notifications{

    public $actions = ['summary'];

    public function __construct(){
        $this->action_times = explode(',',config('values.ACTION_TIMES'));
    }


    /*
    *
    *get data for call api of the passed model uuid
    */
    public function getReportUserModelData($model,$model_uuid){

        $data = [];

        switch($model){

            case "account":
                $account = Account::where('uuid', $model_uuid)->first();
                $data['user_uuids'][] = $account->user->uuid;
                $data['account_uuids'][] = $account->uuid;
                $data['group'] = '';
            break;

            case "group":
                $group = Group::where('uuid', $model_uuid)->first();
                $data['group'] = $group->name;
                if($group->accounts){
                    foreach($group->accounts as $key=>$group_account){
                        $data['account_uuids'][$key] = $group_account->account->uuid;
                        $data['user_uuids'][$key] = $group_account->account->user->uuid;
                    }
                }
            break;
        }

        return $data;
    }
    /*
    *
    *
    */
    public function checkSending($report_id,$rule,$data){

        $report = Report::find($report_id);
        $send = false;
        switch($rule){
            case "send_anyway":
                $send = true;
            break;
            case "send_if_negative":
                if($data['amount']<=0) $send = true;
            break;
            case "send_if_changed":
                if($data['delta_previous']!=0) $send = true;
            break;

        }

        return $send;
    }
    /*
    *
    *
    */
}
