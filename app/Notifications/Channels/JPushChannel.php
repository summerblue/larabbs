<?php

namespace App\Notifications\Channels;

use JPush\Client;
use Illuminate\Notifications\Notification;

class JPushChannel
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     */
    public function send($notifiable, Notification $notification)
    {
        $notification->toJPush($notifiable)->send();
    }
}

