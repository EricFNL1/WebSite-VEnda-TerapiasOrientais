@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Todos os Agendamentos</h1>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Serviço</th>
                <th>Data</th>
                <th>Status</th>
                <th>Usuário</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->service }}</td>
                    <td>{{ $appointment->appointment_date }}</td>
                    <td>{{ ucfirst($appointment->status) }}</td>
                    <td>{{ $appointment->user->name }}</td>
                    <td>
                        <!-- Ações administrativas, como edição e exclusão -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mb-4 container">
        <a href="{{ route('index') }}" class="btn btn-secondary">Voltar</a>
    </div>
@endsection
