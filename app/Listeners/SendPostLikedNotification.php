<?php

namespace App\Listeners;

use App\Events\PostLiked;
use App\Models\Notification;

class SendPostLikedNotification
{
    public function handle(PostLiked $event)
    {
        Notification::create([
            'user_id' => $event->post->user_id,
            'type' => 'post_liked',
            'data' => json_encode(['message' => "{$event->user->name} liked your post"]),
            'read' => false
        ]);
    }
}
