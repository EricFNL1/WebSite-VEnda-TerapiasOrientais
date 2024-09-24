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
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="Animação.js">
  <link href="https://fonts.googleapis.com/css2?family=Sawarabi+Mincho&display=swap" rel="stylesheet">
  <link rel="icon" href="img/logoF.png" type="image/x-icon" loading="lazy">

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

  <section id="services" class="py-5" data-aos="fade-up">
  <div class="container">
    <h2 class="text-center mb-5">Nossos Serviços</h2>
    <div id="serviceCarousel" class="carousel slide" data-bs-ride="carousel">
      <!-- Indicadores do Carrossel -->
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#serviceCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#serviceCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#serviceCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#serviceCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
      </div>

      <!-- Itens do Carrossel -->
      <div class="carousel-inner">
        <!-- Primeira Slide -->
        <div class="carousel-item active">
          <div class="row text-center justify-content-center">
            <div class="col-md-4">
              <div class="card service-card border-0 shadow-sm mb-4">
                <div class="card-body">
                  <i class="fas fa-spa fa-3x text-primary mb-4"></i>
                  <h5 class="card-title">Auriculoterapia</h5>
                  <p class="card-text">Auriculoterapia: uma abordagem integral que promove o equilíbrio do corpo e da mente, utilizando pontos específicos da orelha para tratar e prevenir desequilíbrios físicos e emocionais.</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card service-card border-0 shadow-sm mb-4">
                <div class="card-body">
                  <i class="fas fa-leaf fa-3x text-success mb-4"></i>
                  <h5 class="card-title">Shiatsu</h5>
                  <p class="card-text">Shiatsu: uma terapia manual japonesa que utiliza pressão com os dedos para harmonizar a energia vital, aliviar tensões musculares, reduzir o estresse e promover o bem-estar físico e emocional.</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card service-card border-0 shadow-sm mb-4">
                <div class="card-body">
                  <i class="fas fa-child fa-3x text-warning mb-4"></i>
                  <h5 class="card-title">Kanrenbuí</h5>
                  <p class="card-text">Kanrenbuí: uma prática terapêutica que utiliza movimentos e posturas específicas para restaurar o fluxo energético, aliviando dores, equilibrando o corpo e promovendo saúde integral e harmonia.</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Segunda Slide -->
        <div class="carousel-item">
          <div class="row text-center justify-content-center">
            <div class="col-md-4">
              <div class="card service-card border-0 shadow-sm mb-4">
                <div class="card-body">
                  <i class="fas fa-seedling fa-3x text-success mb-4"></i>
                  <h5 class="card-title">Aromaterapia</h5>
                  <p class="card-text">Aromaterapia: uma técnica que utiliza óleos essenciais extraídos de plantas para equilibrar corpo e mente, promovendo relaxamento, alívio do estresse, fortalecimento emocional e bem-estar geral.</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card service-card border-0 shadow-sm mb-4">
                <div class="card-body">
                  <i class="fas fa-lightbulb fa-3x text-info mb-4"></i>
                  <h5 class="card-title">Cromoterapia</h5>
                  <p class="card-text">Cromoterapia: uma terapia que utiliza as cores para harmonizar a energia do corpo, promovendo o equilíbrio físico, emocional e mental, ajudando na recuperação da saúde e na melhoria do bem-estar.</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card service-card border-0 shadow-sm mb-4">
                <div class="card-body">
                  <i class="fas fa-band-aid fa-3x text-danger mb-4"></i>
                  <h5 class="card-title">Spiral Taping</h5>
                  <p class="card-text">Spiral Taping: uma técnica terapêutica que utiliza fitas adesivas aplicadas de forma específica na pele para aliviar dores, melhorar a circulação, corrigir a postura e promover o equilíbrio muscular e energético.</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Terceira Slide -->
        <div class="carousel-item">
          <div class="row text-center justify-content-center">
            <div class="col-md-4">
              <div class="card service-card border-0 shadow-sm mb-4">
                <div class="card-body">
                  <i class="fas fa-tree fa-3x text-success mb-4"></i>
                  <h5 class="card-title">Bambuterapia</h5>
                  <p class="card-text">Bambuterapia: uma técnica terapêutica que utiliza bambus de diferentes tamanhos para realizar massagens profundas, promovendo a liberação de tensões musculares, estimulando a circulação sanguínea, drenando toxinas, equilibrando a energia corporal e proporcionando relaxamento e bem-estar integral.</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card service-card border-0 shadow-sm mb-4">
                <div class="card-body">
                  <i class="fas fa-spa fa-3x text-purple mb-4" style="color: #ff91af;"></i>
                  <h5 class="card-title">Massagem Aromática</h5>
                  <p class="card-text">Massagem Aromática: uma técnica que combina o uso de óleos essenciais com movimentos suaves e firmes para promover relaxamento profundo, aliviar tensões musculares, melhorar a circulação sanguínea e proporcionar equilíbrio emocional e físico.</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card service-card border-0 shadow-sm mb-4">
                <div class="card-body">
                  <i class="fas fa-hotjar fa-3x text-red mb-4"></i>
                  <h5 class="card-title">Massagem de Pedras Quentes</h5>
                  <p class="card-text">Massagem de Pedras Quentes: uma técnica terapêutica que utiliza pedras aquecidas aplicadas ao corpo para aliviar dores musculares, melhorar a circulação sanguínea, reduzir o estresse e proporcionar uma sensação profunda de relaxamento e bem-estar.</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Quarta Slide (Novos Cards) -->
        <div class="carousel-item">
          <div class="row text-center justify-content-center">
            <div class="col-md-4">
              <div class="card service-card border-0 shadow-sm mb-4">
                <div class="card-body">
                  <i class="fas fa-leaf fa-3x text-green mb-4" style="color: #006400;"></i>
                  <h5 class="card-title">Massagem de Pindas Chinesas</h5>
                  <p class="card-text">Massagem de Pindas Chinesas: uma técnica terapêutica que utiliza saquinhos de ervas aquecidos aplicados sobre o corpo para proporcionar relaxamento profundo, aliviar dores musculares, melhorar a circulação sanguínea e promover o equilíbrio energético e o bem-estar geral.</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card service-card border-0 shadow-sm mb-4">
                <div class="card-body">
                  <i class="fas fa-hands fa-3x text-indigo mb-4" style="color: #FF9800;"></i>
                  <h5 class="card-title">Reiki</h5>
                  <p class="card-text">Reiki: uma técnica terapêutica que utiliza a imposição das mãos para canalizar a energia vital universal, promovendo a harmonização do corpo, mente e espírito. O Reiki ajuda a reduzir o estresse, aliviar dores, equilibrar emoções e melhorar o bem-estar geral.</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card service-card border-0 shadow-sm mb-4">
                <div class="card-body">
                  <i class="fas fa-band-aid fa-3x text-danger mb-4"></i>
                  <h5 class="card-title">Kinesio Taping</h5>
                  <p class="card-text">Kinesio Taping: uma técnica terapêutica que utiliza fitas elásticas adesivas aplicadas sobre a pele para suportar músculos e articulações sem restringir os movimentos. Ajuda a aliviar dores, reduzir inflamações, melhorar a circulação e proporcionar suporte durante atividades físicas, promovendo uma recuperação mais rápida e eficaz.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Controles do Carrossel -->
      <button class="carousel-control-prev" type="button" data-bs-target="#serviceCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#serviceCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Próximo</span>
      </button>
    </div>

    <!-- Botão para agendamentos -->
    <div class="text-center mt-4">
      <a href="{{ route('appointments.index') }}" class="btn btn-primary">Agende agora!</a>
</div>

</section>

  <div id="carouselExampleIndicators" class="carousel slide container" data-bs-ride="carousel">
  <!-- Indicadores Dinâmicos -->
  <div class="carousel-indicators">
    @php
      $images = glob(public_path('carousel') . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
    @endphp
    @foreach($images as $index => $image)
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : '' }}" aria-label="Slide {{ $index + 1 }}"></button>
    @endforeach
  </div>

  <!-- Itens do Carrossel Dinâmicos -->
  <div class="carousel-inner">
    @foreach($images as $index => $image)
      <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
        <img width="1000px" height="600px" src="{{ asset('carousel/' . basename($image)) }}" class="d-block w-100" alt="Imagem do Carrossel {{ $index + 1 }}">
      </div>
    @endforeach
  </div>

  <!-- Controles de Navegação -->
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Próximo</span>
  </button>
</div>


  <!-- Seção de Depoimentos -->
  <section id="testimonials" class="py-5 bg-light" data-aos="fade-up">
    <div class="container">
      <h2 class="text-center mb-5">O que nossos clientes dizem</h2>
      <div class="row">
        <div class="col-md-6">
          <div class="testimonial p-4 bg-white rounded shadow-sm mb-4">
            <p>"A experiência com o Reiki foi transformadora. Senti uma paz que nunca havia experimentado antes!"</p>
            <p><strong>- Eric Júnior.</strong></p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="testimonial p-4 bg-white rounded shadow-sm mb-4">
            <p>"As sessões de Shiatsu aliviaram minhas dores crônicas e melhoraram meu bem-estar geral. Recomendo!"</p>
            <p><strong>- Edemilso Gomes.</strong></p>
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
  <script></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
      AOS.init();
  </script>

</body>
</html>
