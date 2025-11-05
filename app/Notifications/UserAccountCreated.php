<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserAccountCreated extends Notification
{
    /**
     * Create a new notification instance.
     */
    public function __construct(
        private string $password
    ) {}

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
            ->subject(__('Your account for').' '.config('app.name').' '.__('has been created'))
            ->greeting(__('Hello!').' '.$notifiable->name.'!')
            ->line(__('We have created your account for').' '.config('app.name'))
            ->line(__('You can log in with the following credentials').':')
            ->line('**'.__('Email').':** '.$notifiable->email)
            ->line('**'.__('Password').':** '.$this->password)
            ->action(__('Log in'), url('/'))
            ->line(__('Thank you for watching our stream.'));
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
