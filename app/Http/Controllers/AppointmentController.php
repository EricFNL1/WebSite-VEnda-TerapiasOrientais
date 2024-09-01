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
            'appointment_date' => 'required|date|after:now',
        ]);

        Appointment::create([
            'user_id' => Auth::id(),
            'service' => $request->service,
            'appointment_date' => $request->appointment_date,
            'status' => 'pending',
        ]);

        return redirect()->route('appointments.index')->with('success', 'Agendamento criado com sucesso!');
    }

    // Cancelar um agendamento
    public function destroy(Appointment $appointment)
    {
        if ($appointment->user_id != Auth::id()) {
            abort(403);
        }

        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Agendamento cancelado com sucesso!');
    }
}

