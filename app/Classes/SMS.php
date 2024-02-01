<?php

namespace App\Classes;
use App\Models\User;
use App\Models\User\UserDetail;
use App\Models\User\AuthOtp;
use App\Classes\Users;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class SMS{

        public function __construct(){

        }
        /*
        *
        *
        */
        public function checkUserPhoneNumber($user){

            if(!$user->phone_number){
                $user_detail = UserDetail::where('user_id',$user->id)
                            ->where('is_default',1)
                            ->first();
                $phone_number = $user_detail->phone_number;
                $data['phone_number'] = $phone_number;
                $validator = Validator::make($data, [
                    'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                ]);
                if ($validator->fails()){
                    return false;
                } else {
                    $user->phone_number = $phone_number;
                    $save = $user->save();
                    return $save;
                }
            } else {
                $data['phone_number'] = $user->phone_number;
                $validator = Validator::make($data, [
                    'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                ]);
                if ($validator->fails()){
                    return false;
                } else {
                    return true;
                }
            }
        }


        /*
        *
        *
        */
        public function sendSMS($text,$user){


            return;
        }
    //--------------------------------------------------------
}
