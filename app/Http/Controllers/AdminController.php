<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment; // Certifique-se de importar o modelo Appointment

class AdminController extends Controller
{
    // Método para exibir o painel de administração
    public function index()
    {
        // Verifica se o usuário logado é administrador
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Acesso negado. Apenas administradores podem acessar esta página.');
        }

        // Busca todos os agendamentos
        $appointments = Appointment::all();

        // Exibe a página do painel do administrador com os agendamentos
        return view('admin_dashboard', compact('appointments'));
    }

    // Método para atualizar imagens
    public function updateImages(Request $request)
    {
        // Verifica se o usuário logado é administrador
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Acesso negado. Apenas administradores podem acessar esta página.');
        }

        // Lógica para atualizar as imagens
        // Código para realizar o upload e salvar a imagem

        return redirect()->route('admin_dashboard')->with('success', 'Imagem atualizada com sucesso.');
    }
}
