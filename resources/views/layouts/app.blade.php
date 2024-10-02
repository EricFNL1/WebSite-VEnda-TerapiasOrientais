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
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/66fd3704e5982d6c7bb79a5c/1i96htqn7';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
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

    <script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    const beamsClient = new PusherPushNotifications.Client({
        instanceId: '7bb9324d-5e6d-4318-9cb1-69ee2d66fc24',
    });

    beamsClient.start()
        .then(() => beamsClient.addDeviceInterest('hello'))
        .then(() => console.log('Successfully registered and subscribed!'))
        .catch(console.error);
</script>



</body>
</html>