<?php

// AdminController.php

namespace App\Http\Controllers;

use App\Models\CarouselImage;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\Service;

class AdminController extends Controller
{
    // Método para exibir o painel de administração
    public function index(Request $request)
    {
        // Verifica se o usuário é administrador
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Acesso negado. Apenas administradores podem acessar esta página.');
        }
    
        // Recupera a data da requisição
        $date = $request->input('date');
    
        // Cria uma query para recuperar os agendamentos
        $appointmentsQuery = Appointment::query();
        
    
        // Aplica o filtro por data se uma data for fornecida
        if ($date) {
            $appointmentsQuery->whereDate('appointment_date', $date);
        }
    
        // Aplica a paginação com 5 agendamentos por página
        $appointments = $appointmentsQuery->paginate(5);
    
        $services = Service::paginate(5);

        // Retorna a visão com os agendamentos filtrados e paginados
         return view('admin_dashboard', compact('appointments', 'services'));
        
    }

    public function adminDashboard()
    {
        // Carrega os agendamentos com os serviços e usuários associados
        $appointments = Appointment::with('service', 'user')->get(); 
    
        // Verifique se todos os serviços necessários estão sendo carregados corretamente
        $services = Service::all()->pluck('name', 'id'); // Cria um array de serviços com o ID como chave e o nome como valor
    
        return view('admin_dashboard', compact('appointments', 'services'));
    }

    public function addService(Request $request)
    {
        // Valida os dados do formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
        ]);

        // Cria um novo serviço
        Service::create([
            'name' => $request->name,
            'valor' => $request->valor,
        ]);

        return redirect()->route('admin_dashboard')->with('success', 'Serviço adicionado com sucesso!');
    }

    public function removeService($id)
    {
        // Remove o serviço
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('admin_dashboard')->with('success', 'Serviço removido com sucesso!');
    }

    public function updateServiceValue(Request $request, $id)
    {
         // Valida os dados do formulário
    $request->validate([
        'valor' => 'required|numeric|min:0',
    ]);

    // Atualiza o valor do serviço
    $service = Service::find($id);
    if ($service) {
        $service->valor = $request->valor;
        $service->save();
        return redirect()->route('admin_dashboard')->with('success', 'Valor do serviço atualizado com sucesso!');
    }

    return redirect()->route('admin_dashboard')->with('error', 'Serviço não encontrado.');
    }
    // Método para atualizar a imagem de fundo
    public function updateBackgroundImage(Request $request)
    {
        if ($request->hasFile('background_image')) {
            $file = $request->file('background_image');
            $fileName = 'Background.png';

            $file->move(public_path('img'), $fileName);

            return redirect()->route('admin_dashboard')->with('success', 'Imagem de fundo atualizada com sucesso!');

        }

        return redirect()->route('admin_dashboard')->with('error', 'Nenhuma imagem foi enviada.');
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
