<?php

namespace App\Notifications;

use App\Models\Chirp;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Str;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewChirp extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Chirp $chirp)
    {
        //
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
            ->subject("¡Nuevo Chirp de {$this->chirp->user->name}!")
            ->greeting("Hola {$notifiable->name},")
            ->line("Hay un nuevo Chirp de {$this->chirp->user->name}. Aquí tienes un adelanto:")
            ->line(Str::limit($this->chirp->message, 50))
            ->action('Ver Chirps', url("/chirps"))
            ->line('Recuerda, puedes interactuar con este Chirp directamente desde la plataforma.')
            ->line('Gracias por ser parte de nuestra comunidad.')
            ->salutation('Saludos, El equipo de Chirper');
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
