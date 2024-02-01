<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Models\User\Login as UserLogin;
use App\Classes\Users;
use Session;
use Carbon\Carbon;

class LoginSuccessful
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->users = new Users();
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {

        try {
            UserLogin::create([
                'user_id' => $event->user->id,
                'type' => 'login',
                'ip' => request()->getClientIp()
            ]);

            $user = $event->user;
            // user language - save first time
            if(is_null($user->language)){
                $language = session('locale')?session('locale') : app()->getLocale();
                $user->language = $language;
            } else {
                //force to language saved

            }
            session()->put('locale',$user->language);
            //set date format
            session()->put('date_format' , config('languages.lang')[session('locale')]['date_format']);
            // user timezone - save first time
            if(is_null($user->timezone)){
                $user->timezone = geoip()->getLocation()->timezone;
            }
            //update last login
            $user->last_login_at = Carbon::now()->toDateTimeString();
            $user->last_login_ip = request()->getClientIp();

            $user->save();

            if(!$this->users->getRole($user)){
                $this->users->setDefaultRole($user);
            }

        } catch (\Throwable $th) {
            report($th);
        }
        //Session::flash('login-success', 'Hello ' . $event->user->name . ', welcome back!');

    }
}
