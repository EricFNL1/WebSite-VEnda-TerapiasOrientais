@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Resumo Financeiro Mensal</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mês</th>
                <th>Receita Total Prevista</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projections as $projection)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($projection->month)->format('F Y') }}</td>
                    <td>R$ {{ number_format($projection->total_revenue, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Voltar</a>
</div>
@endsection
