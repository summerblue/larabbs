<?php

namespace App\Listeners;

use JPush\Client;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\DatabaseNotification;

class PushNotification implements ShouldQueue
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function handle(DatabaseNotification $notification)
    {
		// 本地环境默认不推送
        if (app()->environment('local')) {
            return;
        }

        $user = $notification->notifiable;

        // 没有 registration_id 的不推送
        if (!$user->registration_id) {
            return;
        }

        // 推送消息
        $this->client->push()
            ->setPlatform('all')
            ->addRegistrationId($user->registration_id)
            ->setNotificationAlert(strip_tags($notification->data['reply_content']))
            ->send();

    }
}
