<?php

namespace App\Notifications;

use App\Models\Newsletter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewsletterSubscriptionNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $newsletter;

    /**
     * Create a new notification instance.
     */
    public function __construct(Newsletter $newsletter)
    {
        $this->newsletter = $newsletter;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'newsletter_id' => $this->newsletter->id,
            'email' => $this->newsletter->email,
            'type' => 'newsletter',
            'icon' => 'bx bx-send',
            'color' => 'warning',
            'url' => '/admin/newsletter/manage',
            'message' => 'New subscriber: ' . $this->newsletter->email
        ];
    }
}