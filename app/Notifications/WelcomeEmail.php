<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class WelcomeEmail extends Notification
{
    use Queueable;
    private $user;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $user)
    {

        $this->user = $user;
    
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
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->greeting('Hola, ' . $this->user->full_name)
                    ->line('Nos complace darle la bienvenida a nuestra blog, esperamos que disfrute de nuestro contenido.')
                    ->action('Ir al blog', url('/'))   
                    ->line('!Gracias por ser parte de nuestra comunidad!');
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
