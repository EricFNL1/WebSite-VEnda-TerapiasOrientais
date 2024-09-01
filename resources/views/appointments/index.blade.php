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

    <table class="table table-bordered">
        <thead>
            <tr>
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
                    <td>{{ $appointment->service }}</td>
                    <td>{{ $appointment->appointment_date }}</td>
                    <td>{{ $appointment->appointment_time }}</td> <!-- Exibir a hora do agendamento -->
                    <td>{{ ucfirst($appointment->status) }}</td>
                    <td>
                        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja cancelar este agendamento?')">Cancelar</button>
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
