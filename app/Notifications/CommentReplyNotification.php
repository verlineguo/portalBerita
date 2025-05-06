<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommentReplyNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $comment;
    protected $parentComment;

    /**
     * Create a new notification instance.
     */
    public function __construct(Comment $comment, Comment $parentComment)
    {
        $this->comment = $comment;
        $this->parentComment = $parentComment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $post = $this->comment->post;
        
        return (new MailMessage)
                    ->subject('New Reply to Your Comment')
                    ->greeting('Hello ' . $notifiable->name . '!')
                    ->line('Someone has replied to your comment on article: ' . $post->title)
                    ->line('Reply by: ' . $this->comment->user->name)
                    ->line('Reply: ' . $this->comment->comment)
                    ->action('View Reply', url('/post/' . $post->slug . '#comment-' . $this->comment->id))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'comment_id' => $this->comment->id,
            'user_id' => $this->comment->user_id,
            'user_name' => $this->comment->user->name,
            'post_id' => $this->comment->post_id,
            'post_title' => $this->comment->post->title,
            'comment' => $this->comment->comment,
            'parent_comment_id' => $this->parentComment->id,
            'url' => '/post/' . $this->comment->post->slug . '#comment-' . $this->comment->id
        ];
    }
}