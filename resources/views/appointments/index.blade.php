@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 style="font-family: 'Lora', serif;">Meus Agendamentos</h1>
        <p class="lead">Gerencie seus agendamentos e encontre equilíbrio e bem-estar com nossas terapias orientais.</p>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="mb-4">
        <a href="{{ route('appointments.create') }}" class="btn btn-primary">Novo Agendamento</a>
    </div>

    <table class="table">
    <thead>
        <tr>
            <th>Nome</th>
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
    <td>{{ $appointment->service ? $appointment->service : 'Serviço não encontrado' }}</td> <!-- Exibe o nome do serviço salvo -->
    <td>{{ $appointment->appointment_date }}</td>
    <td>{{ $appointment->appointment_time }}</td>
    <td>R$ {{ number_format($appointment->valor, 2, ',', '.') }}</td>
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

    <!-- Botão Voltar -->
    <div class="mb-4 container text-center">
        <a href="{{ route('index') }}" class="btn btn-secondary">Voltar</a>
    </div>
</div>
@endsection
