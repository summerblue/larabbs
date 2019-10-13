<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Resources\NotificationResource;

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

    public function read(Request $request)
    {
        $request->user()->markAsRead();

        return response(null, 204);
    }
}
