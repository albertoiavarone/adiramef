<?php

namespace App\Http\Controllers\Notifications\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Models\Report\Report;
use App\Classes\Users;
use App\Classes\Notifications;

class NotificationController extends Controller
{

    public function __construct(){
        $this->users = new Users;
        $this->notifications = new Notifications;
    }

    public function markAsRead( Request $request)
    {
        $request->validate([
            'uuid' => 'required|uuid'
        ]);
        $notification = auth()->user()->Notifications()->where('id', $request->uuid)->first();

        if ($notification) {
            $notification->markAsRead();
            return response()->json([
                        'msg' => __('general.success'),
                    ], 201);
        } else {
            return response()->json([
                        'msg' => __('general.data_not_found'),
                    ], 404);
        }
    }
    /*
    *
    *
    */
    public function myNotifications()
    {
        return view('notifications.mynotifications');
    }
    /*
    *
    *
    */
    public function notificationCenter()
    {
        $user = auth()->user();
        $reports = Report::all();
        $array_reports = collectionToArray($reports,'id','name');
        $accounts =  $this->users->getUserAccounts($user,'');
        $groups = $user->groups;
        $action_times = $this->notifications->action_times;
        return view('notifications.center', compact('reports','array_reports','accounts','groups','action_times'));
    }

}
