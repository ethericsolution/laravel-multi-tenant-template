<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TenantWelcomeNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public string $url,
        public string $password,
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
            ->subject('Your website is ready')

            ->greeting('Hello ' . $notifiable->name . ',')

            ->line('Your website has been provisioned successfully and is ready to use.')

            ->line('**Credentials**')

            ->line('**URL:** ' . $this->url)

            ->line('**Email:** ' . $notifiable->email)

            ->line('**Password:** ' . $this->password)

            ->line('Please change your password after your first login.')

            /* ->salutation(
                "Regards,\n" . PHP_EOL .
                    '**' . config('app.name') . ' Team**'
            ) */;
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
