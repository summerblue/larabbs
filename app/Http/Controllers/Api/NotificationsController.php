<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Resources\NotificationResource;

class NotificationsController extends Controller
{
    /*
     * 消息列表
     */
    public function index(Request $request){
        $data = $request->user()->notifications()->paginate();
        return NotificationResource::collection($data);
    }
}
