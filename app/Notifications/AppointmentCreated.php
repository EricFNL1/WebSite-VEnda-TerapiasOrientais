<?php
namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
class AppointmentCreated extends Notification
{
    use Queueable;
    protected $appointment;

    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
      
    
        $service = is_object($this->appointment->service) ? $this->appointment->service->name : $this->appointment->service;
    
        $mailMessage = (new MailMessage)
            ->subject('Novo Agendamento Criado')
            ->greeting('Olá!')
            ->line('Um novo agendamento foi criado.')
            ->line('Detalhes do agendamento:')
            ->line('Usuário: ' . $this->appointment->user->name)
            ->line('Serviço: ' . $service)
            ->line('Data: ' . $this->appointment->appointment_date)
            ->line('Horário: ' . $this->appointment->appointment_time);
    
        if ($notifiable->role === 'admin') {
            $mailMessage->action('Ver Agendamentos', url('/admin/appointments'))
                        ->line('Obrigado por gerenciar nosso sistema!');
        } else {
            $mailMessage->line('Obrigado por usar nosso sistema!');
        }
    
        return $mailMessage;
    }
}

