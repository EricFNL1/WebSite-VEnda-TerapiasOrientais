<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terapias Orientais</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para Ícones -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;600&family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
    <!-- Estilo CSS Personalizado -->
    <link rel="stylesheet" href="{{ asset('estiloagendamentos.css') }}"> <!-- Certifique-se de que o caminho está correto -->
    <link rel="icon" href="{{ asset('img/logoF.png') }}" type="image/x-icon">
    <script type="text/javascript">
        window.$crisp=[];window.CRISP_WEBSITE_ID="a46dc1fb-457d-4aff-80f4-3878dd262dd6";
        (function(){
            d=document;s=d.createElement("script");
            s.src="https://client.crisp.chat/l.js";
            s.async=1;
            d.getElementsByTagName("head")[0].appendChild(s);
        })();
    </script>

</head>
<body>
    <div class="container">
        @isset($header)
            <header class="mb-4">
                <div class="container">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Conteúdo da página -->
        <main>
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>