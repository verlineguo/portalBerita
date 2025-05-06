<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPostNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $post;

    /**
     * Create a new notification instance.
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
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
        return (new MailMessage)
            ->subject('Artikel Baru: ' . $this->post->title)
            ->line('Artikel baru telah diterbitkan oleh ' . $this->post->writer->name)
            ->line('Judul: ' . $this->post->title)
            ->line('Kategori: ' . $this->post->category->name)
            ->action('Baca Artikel', url('/post/' . $this->post->slug))
            ->line('Terima kasih telah berlangganan newsletter kami!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'id' => $this->post->id,
            'title' => $this->post->title,
            'writer_id' => $this->post->writer_id,
            'writer_name' => $this->post->writer->name,
            'category' => $this->post->category->name,
            'type' => 'post',
            'icon' => 'bx bx-file',
            'color' => 'success',
            'url' => '/post/' . $this->post->slug
        ];
    }
}