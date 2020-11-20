<?php

namespace App\Http\Controllers\Api;

<<<<<<< HEAD
use App\Http\Resources\NotificationResource;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
=======
use Illuminate\Http\Request;
use App\Http\Resources\NotificationResource;
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531

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

<<<<<<< HEAD
    public function read(Request $request,DatabaseNotification $notification=null)
    {
        if($notification){
            $request->user()->decrement('notification_count');
            $notification->markAsRead();
        }else{
            $request->user()->markAsRead();
        }
        return response(null,204);
=======
    public function read(Request $request)
    {
        $request->user()->markAsRead();

        return response(null, 204);
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
    }
}
