<?php

namespace App\Http\Controllers\Auth\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Role\Role;
use App\Classes\Subscriptions;
use App\Helpers\Files;


class SocialController extends Controller
{


    public function __construct(){
        $this->file = new Files();
    }

    /**
    * Redirect the user to the Facebook authentication page.
    *
    * @return \Illuminate\Http\Response
    */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }



    /**
    * Obtain the user information from Facebook.
    *
    * @return \Illuminate\Http\Response
    */

    public function handleProviderCallback($provider)
    {
        try {
            $userSocial = Socialite::driver('facebook')->user();
            $user = User::where('provider_id', $userSocial->id)->where('provider',$provider)->first();

            if(!$user) {
                $role = Role::default()->first();
                $unique_code = checkUniqueCode('App\Models\User' ,'code',8);
                $user = User::create ([
                        'name' => $userSocial->name,
                        'email' => $userSocial->email,
                        'provider' => $provider,
                        'provider_id' => $userSocial->id,
                        'password' => Hash::make('Admin_123'),
                        'email_verified_at' => now(),
                        'code' => $unique_code
                    ])->assignRole($role->name);
                    //--------avatar-------------------
                    $url = $userSocial->avatar;
                    $data = file_get_contents($url);
                    $filename = 'users/'.$user->uuid.'/avatar.jpg';
                    $save_storage = $this->file->createFile($filename, $data);
                    if($save_storage){
                        $user->image = $filename;
                        $user->save();
                    }
                    //trial subscription
                    $trialSubscription= new Subscriptions();
                    $trialSubscription->setTrialSubscription($user);
            }
            //--------------login--------------------
            Auth::login($user);
            return redirect()->route('home');
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }

}
