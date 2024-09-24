<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Pusher\PushNotifications\PushNotifications;

class NewAppointmentNotification extends Notification
{
    use Queueable;

    protected $appointment;

    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Define os canais de entrega da notificação.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // Aqui você define os canais para a notificação: e-mail e notificações push via Pusher Beams
        return ['mail', 'pusher-beams'];
    }

    /**
     * Envia a notificação por e-mail.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
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

    /**
     * Envia a notificação push via Pusher Beams.
     *
     * @param mixed $notifiable
     * @return void
     */
    public function toPusherBeams($notifiable)
    {
        $pushNotifications = new PushNotifications([
            "instanceId" => env('PUSHER_BEAMS_INSTANCE_ID'),
            "secretKey" => env('PUSHER_BEAMS_SECRET_KEY'),
        ]);

        $publishResponse = $pushNotifications->publishToInterests(
            ['admins'], // Canal de interesse para os administradores
            [
                "web" => [
                    "notification" => [
                        "title" => "Novo Agendamento Criado!",
                        "body" => "O usuário " . $this->appointment->user->name . " fez um novo agendamento.",
                        "deep_link" => url('/admin/appointments')
                    ]
                ]
            ]
        );

        return $publishResponse;
    }

    /**
     * Envia a notificação para o banco de dados (opcional).
     *
     * @param mixed $notifiable
     * @return array
     */
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
