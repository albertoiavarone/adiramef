<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User\Login as UserLogin;
use Session;
use Carbon\Carbon;

class LogoutSuccessful
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        try {
            UserLogin::create([
                'user_id' => $event->user->id,
                'type' => 'logout',
                'ip' => request()->getClientIp()
            ]);

        } catch (\Throwable $th) {
            report($th);
        }
    }
}
