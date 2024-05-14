<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Forum;
class PostLiked extends Notification
{
    use Queueable;

    protected $forum;
    protected $liker;

    public function __construct(Forum $forum, $liker)
    {
        $this->forum = $forum;
        $this->liker = $liker;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'forum_id' => $this->forum->id,
            'liker_id' => $this->liker->id,
        ];
    }
}
