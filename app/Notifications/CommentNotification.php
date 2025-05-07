<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $comment;

    /**
     * Create a new notification instance.
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
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
            ->subject('Komentar Baru pada Artikel: ' . $post->title)
            ->line('Ada komentar baru dari ' . $this->comment->user->name)
            ->line('Pada artikel: ' . $post->title)
            ->line('Komentar: ' . $this->comment->comment)
            ->action('Lihat Komentar', url('/post/' . $post->slug . '#comment-' . $this->comment->id))
            ->line('Terima kasih telah menggunakan aplikasi kami!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $post = $this->comment->post;
        
        return [
            'comment_id' => $this->comment->id,
            'user_id' => $this->comment->user_id,
            'user_name' => $this->comment->user->name,
            'post_id' => $post->id,
            'post_title' => $post->title,
            'comment' => $this->comment->comment,
            'type' => 'comment',
            'icon' => 'bx bx-message-detail',
            'color' => 'danger',
            'url' => '/post/' . $post->slug . '#comment-' . $this->comment->id
        ];
    }
}