<?php

namespace App\Listeners;

use App\Events\UserFollowed;
use App\Models\Notification;

class SendUserFollowedNotification
{
    public function handle(UserFollowed $event)
    {
        $data = [
            'user_id' => $event->followed->id,
            'type' => 'user_followed',
            'data' => json_encode([
                'message' => "You have a new follower: {$event->follower->name}",
                'follower_name' => $event->follower->name
            ]),
            'read' => false
        ];

        Notification::create($data);
    }
}
