<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Transformers\NotificationTransformer;

class NotificationsController extends Controller
{
    public function index()
    {
        $notifications = $this->user->notifications()->paginate(20);

        return $this->response->paginator($notifications, new NotificationTransformer());
    }
}
