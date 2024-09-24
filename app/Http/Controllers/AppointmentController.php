<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\FinancialProjection;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewAppointmentNotification;
use App\Models\User; // Importa o modelo User

class AppointmentController extends Controller
{
    public function index()
{
    $appointments = Appointment::with('user') // Apenas carrega o usuário relacionado
                               ->where('user_id', Auth::id())
                               ->get();
    return view('appointments.index', compact('appointments'));
}

    public function create()
    {
        // Horários disponíveis para agendamento
        $allTimes = [
            '08:00', '09:00', '10:00', '11:00', '12:00',
            '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00'
        ];

        // Busca horários já reservados para uma data específica
        $reservedTimes = Appointment::where('appointment_date', request('appointment_date'))
            ->pluck('appointment_time')
            ->toArray();

        // Calcula os horários disponíveis
        $availableTimes = array_diff($allTimes, $reservedTimes);
        $services = Service::all(); // Busca todos os serviços do banco de dados

        return view('appointments.create', compact('availableTimes', 'services'));
    }

    public function store(Request $request)
{
    // Validação dos dados
    $request->validate([
        'service_id' => 'required|exists:services,id',
        'service' => 'required|string|max:255', // Validando o nome do serviço
        'appointment_date' => 'required|date|after:today',
        'appointment_time' => 'required|string',
        'valor' => 'required|numeric',
    ]);

    // Verifique se o horário já está reservado
    $exists = Appointment::where('appointment_date', $request->appointment_date)
                ->where('appointment_time', $request->appointment_time)
                ->exists();

    if ($exists) {
        // Redireciona de volta com uma mensagem de erro
        return redirect()->back()->withInput()->withErrors([
            'appointment_time' => 'Este horário já está reservado. Por favor, escolha outro horário.'
        ]);
    }

    // Cria o novo agendamento e armazena na variável $appointment
    $appointment = Appointment::create([
        'user_id' => Auth::id(),
        'service_id' => $request->service_id,
        'service' => $request->service, // Salva o nome do serviço
        'appointment_date' => $request->appointment_date,
        'appointment_time' => $request->appointment_time,
        'status' => 'pending',
        'valor' => $request->valor,
    ]);
    
    FinancialProjection::create([
        'appointment_id' => $appointment->id,
        'projected_revenue' => $appointment->valor,
        'projection_date' => $appointment->appointment_date,
    ]);

    // Notifica o administrador
    $admin = User::where('role', 'admin')->first(); // Assume que o admin tem uma role 'admin'
    if ($admin) {
        $admin->notify(new NewAppointmentNotification($appointment));
    }

    return redirect()->route('appointments.index')->with('success', 'Agendamento criado com sucesso!');
}
    public function destroy(Appointment $appointment)
    {
        // Verifica se o usuário tem permissão para deletar o agendamento
        if ($appointment->user_id != Auth::id() && Auth::user()->role !== 'admin') {
            abort(403);
        }

        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Agendamento cancelado com sucesso!');
    }

    public function finalize($id)
    {
        // Verifica se o usuário é um administrador
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Acesso negado. Apenas administradores podem finalizar agendamentos.');
        }

        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'Finalizado';
        $appointment->save();

        return redirect()->route('admin_dashboard')->with('success', 'Agendamento finalizado com sucesso.');
    }

    public function updateTime(Request $request, Appointment $appointment)
    {
        // Verifica se o usuário é um administrador
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        // Validação do horário
        $request->validate([
            'appointment_time' => 'required|string'
        ]);

        $appointment->appointment_time = $request->appointment_time;
        $appointment->save();

        return redirect()->route('admin_dashboard')->with('success', 'Horário do agendamento atualizado com sucesso!');
    }

}
