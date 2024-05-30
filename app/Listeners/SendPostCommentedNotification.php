<?php

namespace App\Listeners;

use App\Events\PostCommented;
use App\Models\Notification;

class SendPostCommentedNotification
{
    public function handle(PostCommented $event)
    {
        Notification::create([
            'user_id' => $event->post->user_id,
            'type' => 'post_commented',
            'data' => json_encode(['message' => "{$event->user->name} commented on your post"]),
            'read' => false
        ]);
    }
}
