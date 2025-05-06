<?php

namespace App\Notifications;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactFormNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $contact;

    /**
     * Create a new notification instance.
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
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
            ->subject('Pesan Kontak Baru: ' . $this->contact->subject)
            ->line('Ada pesan kontak baru dari ' . $this->contact->name)
            ->line('Email: ' . $this->contact->email_address)
            ->line('Subjek: ' . $this->contact->subject)
            ->line('Pesan: ' . $this->contact->message)
            ->action('Lihat Semua Pesan', url('/admin/contacts'))
            ->line('Terima kasih telah menggunakan aplikasi kami!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'id' => $this->contact->id,
            'name' => $this->contact->name,
            'email' => $this->contact->email_address,
            'subject' => $this->contact->subject,
            'message' => $this->contact->message,
            'type' => 'contact',
            'icon' => 'bx bx-envelope',
            'color' => 'primary',
            'url' => '/admin/contacts/' . $this->contact->id
        ];
    }
}