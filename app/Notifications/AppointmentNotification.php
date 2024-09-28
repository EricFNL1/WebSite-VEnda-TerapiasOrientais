<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentNotification extends Notification
{
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Novo Agendamento')
            ->greeting('Olá!')
            ->line('Um novo agendamento foi criado.')
            ->action('Ver Agendamento', url('/appointments'))
            ->line('Obrigado!');
    }
}