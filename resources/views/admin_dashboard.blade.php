@extends('layouts.app')

@section('content')

<div class="container py-5">
    <h1 class="text-center mb-4">Painel do Administrador</h1>

    <div class="mb-4 container">
        <a href="{{ route('index') }}" class="btn btn-secondary">Voltar</a>
        <a href="{{ route('financial.index') }}" class="btn btn-secondary" style="color: #00FF00">Financeiro</a>
    </div>
    
    <!-- Filtro por data -->
    <form method="GET" action="{{ route('admin_dashboard') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <input type="date" name="date" class="form-control" value="{{ request('date') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>

    <!-- Seção de Agendamentos -->
    <h2 class="mb-4">Todos os Agendamentos</h2>
    <table class="table">
    <thead>
        <tr>
            <th>Usuário</th>
            <th>Serviço</th>
            <th>Data</th>
            <th>Hora</th>
            <th>Valor</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($appointments as $appointment)
        <tr>
            <td>{{ $appointment->user ? $appointment->user->name : 'Usuário não encontrado' }}</td>
            <td>{{ $appointment->service ? $appointment->service : 'Serviço não encontrado' }}</td> <!-- Usando o campo 'service' diretamente -->
            <td>{{ $appointment->appointment_date }}</td>
            <td>
                <form method="POST" action="{{ route('appointments.updateTime', $appointment->id) }}">
                    @csrf
                    @method('PATCH')
                    <select name="appointment_time" class="form-select mb-2" required>
                        <option selected disabled>Selecione um horário</option>
                        @foreach (['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00'] as $time)
                            <option value="{{ $time }}" {{ $appointment->appointment_time == $time ? 'selected' : '' }}>
                                {{ $time }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-warning">Alterar Hora</button>
                </form>
            </td>
            <td>R$ {{ number_format($appointment->valor, 2, ',', '.') }}</td>
            <td>{{ $appointment->status }}</td>
            <td>
                <!-- Botão de Cancelamento com Confirmação -->
                <form method="POST" action="{{ route('appointments.destroy', $appointment->id) }}" onsubmit="return confirm('Tem certeza que deseja cancelar este agendamento?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Cancelar</button>
                </form>
                <form method="POST" action="{{ route('appointments.finalize', $appointment->id) }}" onsubmit="return confirm('Tem certeza que deseja finalizar este agendamento?');" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success">Finalizar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

    <!-- Paginação -->
    <div class="d-flex justify-content-center mt-4">
        {{ $appointments->links('pagination::bootstrap-4') }}
    </div>

    <h3 class="mt-5">Adicionar Novo Serviço</h3>
    <form method="POST" action="{{ route('admin.addService') }}">
        @csrf
        <div class="row mb-4">
            <div class="col-md-4">
                <input type="text" name="name" class="form-control" placeholder="Nome do Serviço" required>
            </div>
            <div class="col-md-2">
                <input type="number" step="0.01" name="valor" class="form-control" placeholder="Valor" required>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Adicionar Serviço</button>
            </div>
        </div>
    </form>

    <!-- Gerenciar Valores dos Serviços -->
    <h3 class="mt-5">Gerenciar Valores dos Serviços</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Serviço</th>
                <th>Valor</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $service)
            <tr>
                <td>{{ $service->name }}</td>
                <td>R$ {{ number_format($service->valor, 2, ',', '.') }}</td>
                <td>
                    <!-- Formulário para alterar o valor -->
                    <form method="POST" action="{{ route('admin.service.updateValue', $service->id) }}" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <div class="input-group">
                            <input type="number" step="0.01" name="valor" class="form-control" value="{{ $service->valor }}" required>
                            <button type="submit" class="btn btn-success">Atualizar</button>
                        </div>
                    </form>
                    <!-- Formulário para remover o serviço -->
                    <form method="POST" action="{{ route('admin.removeService', $service->id) }}" class="d-inline" onsubmit="return confirm('Tem certeza que deseja remover este serviço?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Remover</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
        {{ $services->links('pagination::bootstrap-4') }}
    </div>

    <!-- Gerenciar Imagem de Fundo da Página -->
    <h3 class="mt-5">Gerenciar Imagem de Fundo da Página</h3>
    <form method="POST" action="{{ route('admin.updateBackgroundImage') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="background_image" class="form-label">Escolha uma nova imagem para a página inicial:</label>
            <input type="file" class="form-control" id="background_image" name="background_image" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar Imagem</button>
    </form>

    <!-- Gerenciar Imagens do Carrossel -->
    <h3 class="mt-5">Gerenciar Imagens do Carrossel</h3>
    <form method="POST" action="{{ route('admin.updateCarouselImage') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="carousel_image" class="form-label">Escolha uma nova imagem para o carousel:</label>
            <input type="file" class="form-control" id="carousel_image" name="carousel_image" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar Imagem</button>
    </form>

    <!-- Lista de Imagens do Carrossel -->
    <br>
    <br>
    <div class="mb-4">
        @foreach (App\Models\CarouselImage::all() as $image)
            <div class="d-flex align-items-center mb-3">
                <img src="{{ asset('carousel/' . $image->image_name) }}" alt="Imagem Carrossel" width="100" class="me-3">
                <form method="POST" action="{{ route('admin.removeCarouselImage') }}">
                    @csrf
                    <input type="hidden" name="image_id" value="{{ $image->id }}">
                    <button type="submit" class="btn btn-danger">Remover Imagem</button>
                </form>
            </div>
        @endforeach
    </div>
</div>

@endsection
