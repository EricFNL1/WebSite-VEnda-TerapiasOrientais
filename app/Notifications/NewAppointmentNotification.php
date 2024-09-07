<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewAppointmentNotification extends Notification
{
    use Queueable;

    protected $appointment;

    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    public function via($notifiable)
    {
        // Aqui você define o canal de notificação. Pode ser 'mail', 'database', 'broadcast', etc.
        return ['mail']; // Exemplo para enviar um e-mail
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Novo Agendamento Criado')
                    ->greeting('Olá, Admin!')
                    ->line('Um novo agendamento foi criado.')
                    ->line('Detalhes do agendamento:')
                    ->line('Usuário: ' . $this->appointment->user->name)
                    ->line('Serviço: ' . $this->appointment->service)
                    ->line('Data: ' . $this->appointment->appointment_date)
                    ->line('Horário: ' . $this->appointment->appointment_time)
                    ->line('Valor: R$ ' . number_format($this->appointment->valor, 2, ',', '.'))
                    ->action('Ver Agendamentos', url('/admin/appointments'))
                    ->line('Obrigado por usar nosso sistema!');
    }

    public function toArray($notifiable)
    {
        return [
            'appointment_id' => $this->appointment->id,
            'user_name' => $this->appointment->user->name,
            'service' => $this->appointment->service,
            'date' => $this->appointment->appointment_date,
            'time' => $this->appointment->appointment_time,
        ];
    }
}