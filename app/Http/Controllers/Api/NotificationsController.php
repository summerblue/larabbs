<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\NotificationResource;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationsController extends Controller
{
    public function index(Request $request)
    {
        $notifications = $request->user()->notifications()->paginate();

        return NotificationResource::collection($notifications);
    }

    public function stats(Request $request)
    {
        return response()->json([
            'unread_count' => $request->user()->notification_count,
        ]);
    }

    public function read(Request $request,DatabaseNotification $notification=null)
    {
        if($notification){
            $request->user()->decrement('notification_count');
            $notification->markAsRead();
        }else{
            $request->user()->markAsRead();
        }
        return response(null,204);
    }
}
