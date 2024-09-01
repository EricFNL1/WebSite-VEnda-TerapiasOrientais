<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Exibe o painel do usuário.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard'); // Certifique-se de que você tenha um arquivo dashboard.blade.php em resources/views
    }
}
