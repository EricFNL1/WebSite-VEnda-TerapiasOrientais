<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Site sobre Terapias Orientais, incluindo Acupuntura, Shiatsu, e Reiki para restaurar saúde e bem-estar.">
  <meta name="keywords" content="terapias orientais, acupuntura, shiatsu, reiki, saúde, bem-estar">
  <title>Terapias Orientais</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome para Ícones -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="Estilo.css">
  <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;600&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="icon" href="img/logoF.png" type="image/x-icon" loading="lazy">
</head>
<body>

<style>
.hero {
    background: url('{{ asset('img/Background.png') }}') no-repeat center center;
    background-size: cover;
    background-position: center;
    height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-shadow: 4px 4px 8px rgb(0, 0, 0);
    position: relative;
}
</style>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark navcor fixed-top">
  <div class="container">
    <img id="logo" src="img/logoF.png" alt="Logo Terapias Orientais" class="me-2" loading="lazy">
    <p class="text-white mb-0" id="textoprimer">Terapias Orientais</p>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="#services">Serviços</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#testimonials">Depoimentos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contact">Contato</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('appointments.index') }}">Agendamentos</a>
        </li>

        <!-- Verificação de Autenticação -->
        @guest
          <li class="nav-item">
            <a class="btn btn-link" href="{{ route('login') }}">Entrar</a>
          </li>
        @else
          <!-- Verificação se o usuário é admin -->
          @if (Auth::user() && Auth::user()->role === 'admin')
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin_dashboard') }}">Painel Admin</a>
            </li>
          @endif

          <!-- Botão de Logout -->
          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="btn btn-link">Sair</button>
            </form>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>

  <!-- Header com Imagem de Fundo -->
  <header class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content text-center text-white py-5">
      <h1 class="display-4 cor">Descubra o Equilíbrio e a Harmonia</h1>
      <p class="lead textolegenda cor">Terapias orientais para restaurar sua saúde e bem-estar</p>
    </div>
  </header>

  <!-- Seção de Serviços -->
  <section id="services" class="py-5" data-aos="fade-up">
    <div class="container">
      <h2 class="text-center mb-5">Nossos Serviços</h2>
      <div class="row text-center">
        <div class="col-md-4">
          <div class="card service-card border-0 shadow-sm mb-4">
            <div class="card-body">
              <i class="fas fa-spa fa-3x text-primary mb-4"></i>
              <h5 class="card-title">Acupuntura</h5>
              <p class="card-text">Utilize técnicas milenares de acupuntura para equilibrar o fluxo de energia no corpo.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card service-card border-0 shadow-sm mb-4">
            <div class="card-body">
              <i class="fas fa-leaf fa-3x text-success mb-4"></i>
              <h5 class="card-title">Shiatsu</h5>
              <p class="card-text">Massagem terapêutica baseada em técnicas japonesas para aliviar tensões.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card service-card border-0 shadow-sm mb-4">
            <div class="card-body">
              <i class="fas fa-hand-holding-heart fa-3x text-danger mb-4"></i>
              <h5 class="card-title">Reiki</h5>
              <p class="card-text">Canalização de energia para promover o equilíbrio emocional e espiritual.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Seção de Depoimentos -->
  <section id="testimonials" class="py-5 bg-light" data-aos="fade-up">
    <div class="container">
      <h2 class="text-center mb-5">O que nossos clientes dizem</h2>
      <div class="row">
        <div class="col-md-6">
          <div class="testimonial p-4 bg-white rounded shadow-sm mb-4">
            <p>"A experiência com o Reiki foi transformadora. Senti uma paz que nunca havia experimentado antes!"</p>
            <p><strong>- Maria A.</strong></p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="testimonial p-4 bg-white rounded shadow-sm mb-4">
            <p>"As sessões de Shiatsu aliviaram minhas dores crônicas e melhoraram meu bem-estar geral. Recomendo!"</p>
            <p><strong>- João B.</strong></p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Seção de Contato -->
  <section id="contact" class="py-5 bg-dark text-white" data-aos="fade-up">
    <div class="container">
      <h2 class="text-center mb-5">Fale Conosco</h2>
      <div class="d-flex justify-content-center align-items-center flex-wrap gap-3 mb-4">
        <a href="https://wa.me/19983830035"><img src="img/whatsapp icon.png" alt="Icone WhatsApp" class="tamanhologo" loading="lazy"></a>
        <a href="https://www.instagram.com/terapias_orientaais/"><img src="img/instagram-icon.png" alt="Icone Instagram" class="tamanhologo" loading="lazy"></a>
      </div>
      <div class="row">
        <div class="col-md-6 p-4">
          <h5>Endereço</h5>
          <p>Rua Padre José, 396, Centro, Mogi Mirim</p>
          <h5>Telefone</h5>
          <p><i class="fas fa-phone"></i> (19) 98383-0035</p>
        </div>
        <div class="col-md-6 p-4">
          <!-- Mapa incorporado do Google Maps -->
          <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3664.4770597417244!2d-46.9614175!3d-22.4372627!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c8f9b4e5afbe45%3A0x1ea9d4c2bddeca36!2sR.%20Padre%20Jos%C3%A9%2C%20396%20-%20Centro%2C%20Mogi%20Mirim%20-%20SP%2C%2013800-170!5e0!3m2!1spt-BR!2sbr!4v1693571222068!5m2!1spt-BR!2sbr" 
            width="100%" 
            height="300" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
      </div>
    </div>
  </section>

  <!-- Rodapé -->
  <footer class="bg-dark text-white py-3">
    <div class="container text-center">
      <p>&copy; 2024 Terapias Orientais. Todos os direitos reservados.</p>
    </div>
  </footer>

  <!-- Bootstrap JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
      AOS.init();
  </script>

</body>
</html>
