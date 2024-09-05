@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">Painel do Administrador</h1>

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
            <th>Status</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($appointments as $appointment)
        <tr>
            <td>{{ $appointment->user->name }}</td>
            <td>{{ $appointment->service }}</td>
            <td>{{ $appointment->appointment_date }}</td>
            <td>
                <!-- Formulário para alterar a hora -->
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
    <!-- Paginação -->
</table>

<div class="d-flex justify-content-center mt-4">
    {{ $appointments->links('pagination::bootstrap-4') }}
</div>

<h3 class="mt-5">Gerenciar Imagem de Fundo da Página</h3>
<form method="POST" action="{{ route('admin.updateBackgroundImage') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-4">
        <label for="background_image" class="form-label">Escolha uma nova imagem para a página inicial:</label>
        <input type="file" class="form-control" id="background_image" name="background_image" required>
    </div>
    <button type="submit" class="btn btn-primary">Atualizar Imagem</button>
</form>

<h3 class="mt-5">Gerenciar Imagens do Carrossel</h3>
<form method="POST" action="{{ route('admin.updateCarouselImage') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-4">
        <label for="carousel_image" class="form-label">Escolha uma nova imagem para o carousel:</label>
        <input type="file" class="form-control" id="carousel_image" name="carousel_image" required>
    </div>
    <button type="submit" class="btn btn-primary">Atualizar Imagem</button>
</form>


<h3 class="mt-5">Gerenciar Imagens do Carrossel</h3>
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

<div class="mb-4 container">
        <a href="{{ route('index') }}" class="btn btn-secondary">Voltar</a>
</div>
@endsection
