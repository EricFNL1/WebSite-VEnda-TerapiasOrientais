@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">Painel do Administrador</h1>

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
            <td>{{ $appointment->appointment_time }}</td>
            <td>{{ $appointment->status }}</td>
            <td>
                <!-- Botão de Cancelamento com Confirmação -->
                <form method="POST" action="{{ route('appointments.destroy', $appointment->id) }}" onsubmit="return confirm('Tem certeza que deseja cancelar este agendamento?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Cancelar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<h3 class="mt-5">Gerenciar Imagem de Fundo da Página</h3>
<form method="POST" action="{{ route('admin.updateBackgroundImage') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-4">
        <label for="background_image" class="form-label">Escolha uma nova imagem para a página inicial:</label>
        <input type="file" class="form-control" id="background_image" name="background_image" required>
    </div>
    <button type="submit" class="btn btn-primary">Atualizar Imagem</button>
</form>
</div>

<div class="mb-4 container">
        <a href="{{ route('index') }}" class="btn btn-secondary">Voltar</a>
    </div>
@endsection
