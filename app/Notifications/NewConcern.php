<?php

namespace App\Notifications;

use App\Models\Concern;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Str;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewConcern extends Notification
{
    use Queueable;

    protected $loginLink;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Concern $concern, String $loginLink)
    {
        $this->loginLink = $loginLink;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject("New Concern from {$this->concern->user->name}")
                    ->greeting("New Concern from {$this->concern->user->name}")
                    ->line(Str::limit($this->concern->message, 50))
                    ->action('Go to Website', url($this->loginLink))
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
            //
        ];
    }
}
