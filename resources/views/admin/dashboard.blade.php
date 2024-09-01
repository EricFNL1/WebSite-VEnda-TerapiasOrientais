@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">Dashboard</h1>
    <p class="lead text-center">Redirecionando para a página inicial...</p>
</div>

<!-- Redirecionamento automático para a página de index -->
<script>
    setTimeout(function() {
        window.location.href = "{{ route('index') }}"; // Use a rota nomeada para garantir que o redirecionamento funcione corretamente
    }, 3000); // Aguarda 3 segundos antes de redirecionar
</script>
@endsection