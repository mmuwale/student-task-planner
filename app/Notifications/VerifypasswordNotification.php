<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifypasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $token;

    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
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
        $verifyUrl = url('/verify-email?token=' . $this->token . '&email=' . urlencode($notifiable->email));
        return (new MailMessage)
            ->subject('Verify Your Email Address')
            ->greeting('Hello ' . ($notifiable->name ?? 'User') . ',')
            ->line('Thank you for registering! To complete your registration, please verify your email address.')
            ->line('Your verification token is:')
            ->line('<strong>' . $this->token . '</strong>')
            ->action('Verify Email', $verifyUrl)
            ->line('If you did not create an account, no further action is required.')
            ->line('Thank you for using Student Task Planner!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'verify_url' => url('/verify-email?token=' . $this->token . '&email=' . urlencode($notifiable->email)),
            'token' => $this->token,
        ];
    }
}
