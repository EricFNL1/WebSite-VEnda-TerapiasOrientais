@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1>Resumo Financeiro Mensal</h1>
  <!-- Botão Voltar -->
  <div class="mb-4 container text-center">
        <a href="{{ route('admin_dashboard') }}" class="btn btn-secondary">Voltar</a>
    </div>
    <!-- Formulário para Filtro de Mês e Ano -->
    <form method="GET" action="{{ route('financial.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <label for="month">Mês:</label>
                <select name="month" class="form-control">
                    <option value="">Todos</option>
                    @php
                        $meses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
                    @endphp
                    @foreach ($meses as $key => $mes)
                        <option value="{{ str_pad($key + 1, 2, '0', STR_PAD_LEFT) }}" {{ request('month') == str_pad($key + 1, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
                            {{ $mes }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="year">Ano:</label>
                <select name="year" class="form-control">
                    <option value="">Todos</option>
                    @for ($y = date('Y'); $y >= 2000; $y--)
                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>

    <!-- Gráfico de Receita Financeira -->
    <canvas id="financeChart" width="400" height="200"></canvas>

    <!-- Tabela de Resumo Financeiro -->
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Mês</th>
                <th>Receita Total Prevista</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projections as $projection)
                <tr>
                    <td>{{ $meses[date('n', strtotime($projection->month)) - 1] }} {{ date('Y', strtotime($projection->month)) }}</td>
                    <td>R$ {{ number_format($projection->total_revenue, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

  
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('financeChart').getContext('2d');
        var financeChart = new Chart(ctx, {
            type: 'bar', // Tipo de gráfico
            data: {
                labels: {!! json_encode($months) !!}, // Passa os meses como labels do gráfico
                datasets: [{
                    label: 'Receita Total Prevista',
                    data: {!! json_encode($revenues) !!}, // Passa os dados das receitas
                    backgroundColor: 'rgba(0, 255, 0, 0.2)',
                    borderColor: 'rgba(0, 255, 0, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endsection
