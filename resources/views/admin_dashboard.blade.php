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
    <!-- Seção de Gerenciamento de Imagens -->
    <h2 class="mt-5 mb-4">Gerenciar Imagens da Página Inicial</h2>
    <form action="{{ route('admin.updateImages') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="newImage" class="form-label">Escolha uma nova imagem para a página inicial:</label>
            <input type="file" class="form-control" id="newImage" name="newImage">
        </div>
        <button type="submit" class="btn btn-primary">Atualizar Imagem</button>
    </form>

</div>

<div class="mb-4 container">
        <a href="{{ route('index') }}" class="btn btn-secondary">Voltar</a>
    </div>
@endsection
