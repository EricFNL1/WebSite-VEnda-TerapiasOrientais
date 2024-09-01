<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Adicione suas referências de CSS e JavaScript aqui -->
</head>
<body>
    <div class="container">
        <!-- Cabeçalho e barra de navegação -->
        @isset($header)
            <header class="mb-4">
                <div class="container">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Conteúdo da página -->
        <main>
            {{-- Uso correto da diretiva @yield --}}
            @yield('content')
        </main>
    </div>
</body>
</html>
