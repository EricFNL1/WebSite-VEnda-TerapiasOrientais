<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    // Exibir agendamentos
    public function index()
    {
        $appointments = Appointment::where('user_id', Auth::id())->get();
        return view('appointments.index', compact('appointments'));
    }

    // Exibir o formulário de criação
    public function create()
    {
        return view('appointments.create');
    }

    // Salvar um novo agendamento
    public function store(Request $request)
    {
        $request->validate([
            'service' => 'required|string|max:255',
            'appointment_date' => 'required|date|after:today', // Validação apenas de data
            'appointment_time' => 'required|string',
        ]);

        // Verifique se o horário já está reservado
        $exists = Appointment::where('appointment_date', $request->appointment_date)
                    ->where('appointment_time', $request->appointment_time)
                    ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Este horário já está reservado. Por favor, escolha outro horário.');
        }

        // Cria o novo agendamento
        Appointment::create([
            'user_id' => Auth::id(),
            'service' => $request->service,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'status' => 'pending',
        ]);

        return redirect()->route('appointments.index')->with('success', 'Agendamento criado com sucesso!');
    }

    // Cancelar um agendamento
    public function destroy(Appointment $appointment)
    {
        // Verifique se o usuário autenticado é o proprietário do agendamento ou um administrador
        if ($appointment->user_id != Auth::id() && Auth::user()->role !== 'admin') {
            abort(403); // Acesso negado
        }
    
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Agendamento cancelado com sucesso!');
    }
}
