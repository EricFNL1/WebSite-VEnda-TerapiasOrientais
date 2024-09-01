@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 style="font-family: 'Lora', serif;">Meus Agendamentos</h1>
        <p class="lead">Gerencie seus agendamentos e encontre equilíbrio e bem-estar com nossas terapias orientais.</p>
    </div>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="d-flex justify-content-between mb-4">
        <a href="{{ route('appointments.create') }}" class="btn btn-primary">Novo Agendamento</a>
    </div>
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Serviço</th>
                        <th>Data</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->service }}</td>
                            <td>{{ $appointment->appointment_date }}</td>
                            <td>{{ ucfirst($appointment->status) }}</td>
                            <td>
                                <form method="POST" action="{{ route('appointments.destroy', $appointment) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Cancelar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
</div>
 <!-- Botão Voltar -->
 <div class="mb-4 container">
        <a href="{{ route('index') }}" class="btn btn-secondary">Voltar</a>
    </div>
@endsection
