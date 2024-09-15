<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class CrispController extends Controller
{
    public function handleWebhook(Request $request)
    {
        // Obtém o conteúdo da mensagem enviada pelo usuário
        $message = $request->input('content');
        $response = '';

        // Verifica se a mensagem é sobre verificar agendamentos
        if (str_contains(strtolower($message), 'verificar agendamento')) {
            $userEmail = $this->extractEmail($message); // Suponha que você tenha um método para extrair o email do usuário
            $appointments = Appointment::where('email', $userEmail)->get();

            if ($appointments->isEmpty()) {
                $response = 'Nenhum agendamento encontrado para este email.';
            } else {
                $response = "Agendamentos encontrados:\n";
                foreach ($appointments as $appointment) {
                    $response .= "Serviço: {$appointment->service}, Data: {$appointment->appointment_date}, Hora: {$appointment->appointment_time}\n";
                }
            }
        } elseif (str_contains(strtolower($message), 'criar agendamento')) {
            // Exemplo: Pede detalhes do usuário para criar um agendamento
            $response = 'Por favor, forneça o serviço, data e hora desejados.';
        } else {
            $response = 'Desculpe, não entendi sua mensagem. Você pode perguntar sobre "verificar agendamento" ou "criar agendamento".';
        }

        // Responde ao Crisp com uma mensagem personalizada
        return response()->json(['content' => $response]);
    }

    // Método de exemplo para extrair um email de uma mensagem
    private function extractEmail($message)
    {
        // Aqui você pode usar regex ou outra lógica para extrair o email do texto da mensagem
        preg_match('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', $message, $matches);
        return $matches[0] ?? null;
    }
}
