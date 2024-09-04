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
        // Definindo os horários de 8h às 19h, de hora em hora
        $allTimes = [
            '08:00', '09:00', '10:00', '11:00', '12:00',
            '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00'
        ];
    
        // Buscando os horários já reservados no banco de dados para uma data específica
        $reservedTimes = Appointment::where('appointment_date', request('appointment_date'))
                            ->pluck('appointment_time')
                            ->toArray();
    
        // Calculando os horários disponíveis
        $availableTimes = array_diff($allTimes, $reservedTimes);
    
        return view('appointments.create', compact('availableTimes', 'reservedTimes'));
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

    public function finalize($id)
{
    // Verifica se o usuário é um administrador
    if (Auth::user()->role !== 'admin') {
        return redirect()->route('dashboard')->with('error', 'Acesso negado. Apenas administradores podem finalizar agendamentos.');
    }

    // Encontre o agendamento pelo ID
    $appointment = Appointment::findOrFail($id);

    // Marque o agendamento como finalizado
    $appointment->status = 'Finalizado';
    $appointment->save();

    // Redireciona de volta com uma mensagem de sucesso
    return redirect()->route('admin.dashboard')->with('success', 'Agendamento finalizado com sucesso.');
}

    public function updateBackgroundImage(Request $request)
{
    $request->validate([
        'background_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Valida o upload da imagem
    ]);

    if ($request->hasFile('background_image')) {
        $image = $request->file('background_image');
        $imageName = 'background.' . $image->getClientOriginalExtension();
        $path = public_path('images');

        // Mover a imagem para a pasta public/images
        $image->move($path, $imageName);

        // Se estiver armazenando no banco de dados, atualizar o caminho da imagem
        // Por exemplo:
        // Config::where('key', 'background_image')->update(['value' => 'images/' . $imageName]);

        return redirect()->back()->with('success', 'Imagem de fundo atualizada com sucesso!');
    }

    return redirect()->back()->with('error', 'Falha ao atualizar a imagem de fundo.');
}

public function updateTime(Request $request, Appointment $appointment)
{
    // Verifique se o usuário é um administrador
    if (Auth::user()->role !== 'admin') {
        abort(403); // Acesso negado
    }

    // Valide o novo horário
    $request->validate([
        'appointment_time' => 'required|string'
    ]);

    // Atualize a hora do agendamento
    $appointment->appointment_time = $request->appointment_time;
    $appointment->save();

    return redirect()->route('admin_dashboard')->with('success', 'Horário do agendamento atualizado com sucesso!');
}
}
