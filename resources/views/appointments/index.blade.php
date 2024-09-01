@extends('layouts.app') <!-- Certifique-se de que o caminho do layout está correto -->

@section('content') <!-- Certifique-se de definir a seção 'content' -->
<div class="container">
    <h1>Meus Agendamentos</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('appointments.create') }}" class="btn btn-primary">Novo Agendamento</a>
    <table class="table mt-4">
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
                        <form method="POST" action="{{ route('appointments.destroy', $appointment) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Cancelar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
