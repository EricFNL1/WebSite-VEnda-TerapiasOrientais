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
    public function updateBackgroundImage(Request $request)
{
    // Verifique se o arquivo de imagem foi enviado
    if ($request->hasFile('background_image')) {
        $file = $request->file('background_image');
        $fileName = 'Background.png'; // Nome fixo para substituir a imagem

        // Salvar a imagem na pasta 'public/img'
        $file->move(public_path('img'), $fileName);

        return redirect()->route('admin_dashboard')->with('success', 'Imagem de fundo atualizada com sucesso!');
    }

    return redirect()->route('admin_dashboard')->with('error', 'Nenhuma imagem foi enviada.');
}

public function updateCarouselImages(Request $request)
{
    $request->validate([
        'carousel_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Valida múltiplas imagens
    ]);

    if ($request->hasFile('carousel_images')) {
        foreach ($request->file('carousel_images') as $image) {
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('carousel'), $imageName);
            // Aqui, você pode salvar o nome da imagem no banco de dados, se necessário.
        }
    }

    return redirect()->back()->with('success', 'Imagens do carrossel atualizadas com sucesso!');
}

public function removeCarouselImage(Request $request)
{
    $imageName = $request->input('image_name');

    // Caminho para a pasta de imagens com separador de diretório apropriado
    $imagePath = public_path('carousel' . DIRECTORY_SEPARATOR . $imageName);

    // Verifique se o arquivo existe antes de tentar deletá-lo
    if (file_exists($imagePath)) {
        // Tenta deletar o arquivo
        if (unlink($imagePath)) {
            return redirect()->back()->with('success', 'Imagem removida com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Erro ao tentar remover a imagem. Por favor, tente novamente.');
        }
    } else {
        return redirect()->back()->with('error', 'Imagem não encontrada.');
    }
}



}
