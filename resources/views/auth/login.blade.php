<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;600&family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/estiloagendamento.css') }}"> 
    <link rel="icon" href="{{ asset('img/logoF.png') }}" type="image/x-icon">
</head>
<body>
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="card shadow-lg p-4 rounded" style="max-width: 400px; width: 100%;">
            <!-- Logotipo -->
            <div class="text-center mb-4">
                <img src="{{ asset('img/logoF.png') }}" alt="Logo Terapias Orientais" class="img-fluid" style="width: 60px;">
            </div>

            <!-- Título -->
            <h2 class="text-center mb-4">Bem-vindo de Volta!</h2>

            <!-- Formulário de Login -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Campo de Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required autofocus>
                </div>

                <!-- Campo de Senha -->
                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <!-- Lembrar de Mim -->
                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                    <label class="form-check-label" for="remember_me">Lembrar-me</label>
                </div>

                <!-- Links e Botão de Login -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    @if (Route::has('password.request'))
                        <a class="small text-muted" href="{{ route('password.request') }}">Esqueceu sua senha?</a>
                    @endif
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </div>

                <!-- Links adicionais -->
                <div class="d-flex justify-content-between mt-3">
                    <a href="{{ url('/') }}" class="small text-muted">Voltar à Página Inicial</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="small text-muted">Criar Conta</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
