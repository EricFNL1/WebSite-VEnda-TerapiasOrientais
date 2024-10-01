<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AppointmentCreatedNotification extends Notification
{
    use Queueable;

    protected $appointment;

    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    // Defina o canal de notificação como e-mail
    public function via($notifiable)
    {
        return ['mail'];
    }

    // Conteúdo do e-mail
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Novo Agendamento Criado')
                    ->greeting('Olá, Admin!')
                    ->line('Um novo agendamento foi criado.')
                    ->line('Usuário: ' . $this->appointment->user->name)
                    ->line('Serviço: ' . $this->appointment->service)
                    ->line('Data: ' . $this->appointment->appointment_date)
                    ->line('Horário: ' . $this->appointment->appointment_time)
                    ->line('Valor: R$ ' . number_format($this->appointment->valor, 2, ',', '.'))
                    ->action('Ver Agendamentos', url('/admin/appointments'))
                    ->line('Obrigado por usar nosso sistema!');
    }
}
