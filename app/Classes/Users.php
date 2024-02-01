<?php

namespace App\Classes;

use App\Models\User;
use App\Models\User\UserDetail;
use App\Models\Role\Role;
use App\Models\User\AuthOtp;
use App\Classes\SMS;
use App\Classes\Emails;
use Carbon\Carbon;

class Users{

    public function __construct(){
        $this->SMS = new SMS();
        $this->Emails = new Emails();
    }

    /*
    * get uesr Role
    *
    */
    public function getRole($user){
        $role_name = $user->roles->pluck('name')->first();
        $role = Role::where('name',$role_name)->first();
        return $role;
    }
    /*
    * set default Role
    *
    */
    public function setDefaultRole($user){
        $role = Role::default()->first();
        $user->assignRole($role->name);
        return ;
    }
    /*
    * get lower-ranking roles
    *
    */
    public function getLowerRankRole($user){
        $user_role = $this->getRole($user);
        $roles = Role::where('rank','>=',$user_role->rank)->orderBy('rank','asc')->get();
        return $roles;
    }
    /*
    * che if userRole has specific permission
    *
    */
    public function checkUserPermission($user,$permission){
        $role_name = $user->roles->pluck('name')->first();
        $role = Role::where('name',$role_name)->first();
        $found = $role->permissions->first(function($item) use($permission){
            return $item->name == $permission;
        });
        if($found) {
            return true;
        } else {
            return false;
        }
    }
    /*
    * get uesr Role
    *
    */
    public function isOperator($user){
        $role_name = $user->roles->pluck('name')->first();
        if($role_name == 'operator') {
            return true;
        } else {
            return false;
        }
    }
    /*
    *
    *
    */

    /*
    *check if user have reached send limit
    *
    */
    public function canSendSMSCode($user){
        $sent_codes = AuthOtp::where('user_id',$user->id)->count();
        if(intval($sent_codes) < config('values.SMS_OTP_MAX_SEND')){
            return true;
        } else {
            return false;
        }
    }
    /*
    *get form User Detail for editing
    *
    */
    public function getFormDetail($uuid){
        $user_detail = UserDetail::where('uuid',$uuid)->firstOrFail();
        if($user_detail->is_business){
            if($user_detail->is_pa){
                return 'business-pa';
            } else {
                return 'business';
            }
        } else {
            if($user_detail->is_freelance){
                return 'retail-freelance';
            } else {
                return 'retail';
            }
        }
    }
    /*
    *
    *
    */
    public function sendOTP($user){

        if(!$this->SMS->checkUserPhoneNumber($user)){
            return false;
        }
        $code = rand(111111,999999);
        $text = __('general.brand').' - '.__('messages.sms_otp').$code;
        if( $this->canSendSMSCode($user) ){
            $send_response = $this->SMS->sendSMS($text,$user);
            if(!$send_response['result']){
                return redirect()->route('phone-check')->with('error',$send['description']);
            }
            $otp = AuthOtp::create([
                    'user_id' => $user->id,
                    'action' => 'phoneCheck',
                    'code' => $code,
                    'phone_number' => $user->phone_number,
                ]);
        } else {
            $otp = [];
        }

        if($otp){
            return redirect()->route('phone-check')->with('success',__('messages.code_sent'));
        } else {
            return redirect()->route('phone-check')->with('error',__('general.error'));
        }
    }

}
