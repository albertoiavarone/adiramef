<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        //
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        /*  ------- start: Two Factor Auth Email notification------------- */
        $new_two_factor_secret = $user->two_factor_secret;
        $old_two_factor_secret = $user->getOriginal('two_factor_secret');
        if($new_two_factor_secret!=$old_two_factor_secret){
            $recipient = $user->email;
            $sender = config('values.MAIL_FROM_ADDRESS');

            if(!is_null($new_two_factor_secret)){
                $recovery_codes = '';
                foreach (json_decode(decrypt($user->two_factor_recovery_codes)) as $code){
                    $recovery_codes.= $code.'<br>';
                }
                $data = [
                            'address' => $recipient,
                            'subject' => __('auth.mf_enabled'),
                            'sender' => $sender,
                            'body' =>  __('auth.mf_enabled')."<br><br>".__('auth.mf_codes').
                                            "<br><br>".$recovery_codes,
                        ];
            } else {
                $data = [
                            'address' => $recipient,
                            'subject' => __('auth.mf_disabled'),
                            'sender' => $sender,
                            'body' =>  __('auth.mf_disabled'),
                        ];
            }
            dispatch(new \App\Jobs\SendEmailJob($data));
            /*  ------- end: Two Factor Auth Email notification------------- */
        }


    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
