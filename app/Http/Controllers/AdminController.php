<?php

// AdminController.php

namespace App\Http\Controllers;

use App\Models\CarouselImage;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;

class AdminController extends Controller
{
    // Método para exibir o painel de administração
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Acesso negado. Apenas administradores podem acessar esta página.');
        }

        $appointments = Appointment::all();

        return view('admin_dashboard', compact('appointments'));
    }

    // Método para atualizar a imagem de fundo
    public function updateBackgroundImage(Request $request)
    {
        if ($request->hasFile('background_image')) {
            $file = $request->file('background_image');
            $fileName = 'Background.png';

            $file->move(public_path('img'), $fileName);

            return redirect()->route('admin.dashboard')->with('success', 'Imagem de fundo atualizada com sucesso!');
        }

        return redirect()->route('admin.dashboard')->with('error', 'Nenhuma imagem foi enviada.');
    }

    // Método para atualizar imagens do carrossel
    public function updateCarouselImage(Request $request)
    {
        if ($request->hasFile('carousel_image')) {
            $file = $request->file('carousel_image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('carousel'), $imageName);

            // Lógica para salvar a imagem no banco de dados
            CarouselImage::create(['image_name' => $imageName]);

            return redirect()->back()->with('success', 'Imagem adicionada ao carousel com sucesso!');
        }

        return redirect()->back()->with('error', 'Nenhuma imagem foi selecionada.');
    }

    // Método para remover imagens do carousel
    public function removeCarouselImage(Request $request)
    {
        $imageId = $request->input('image_id'); // Alterado para usar image_id
        $image = CarouselImage::find($imageId);

        if ($image) {
            $imagePath = public_path('carousel/' . $image->image_name);

            // Verifique se o arquivo existe e o remova
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }

            // Remova o registro do banco de dados
            $image->delete();

            return redirect()->back()->with('success', 'Imagem removida do carousel com sucesso!');
        }

        return redirect()->back()->with('error', 'Imagem não encontrada.');
    }
}
