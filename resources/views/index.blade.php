<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Terapias Orientais</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome para Ícones -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="Estilo.css">
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <img id="logo" src="img/logo.png" alt="">
      <a class="navbar-brand" href="#">Terapias Orientais</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
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
            <a class="nav-link" href="{{ route('agendamentos') }}">Agendamentos</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Header com Imagem de Fundo -->
  <header class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <h1 class="display-4">Descubra o Equilíbrio e a Harmonia</h1>
      <p class="lead">Terapias orientais para restaurar sua saúde e bem-estar</p>
      <a href="#services" class="btn btn-primary btn-lg">Nossos Serviços</a>
    </div>
  </header>

  <!-- Seção de Serviços -->
  <section id="services" class="py-5">
    <div class="container">
      <h2 class="text-center mb-5">Nossos Serviços</h2>
      <div class="row text-center">
        <div class="col-md-4">
          <div class="card service-card border-0">
            <div class="card-body">
              <i class="fas fa-spa fa-3x text-primary mb-4"></i>
              <h5 class="card-title">Acupuntura</h5>
              <p class="card-text">Utilize técnicas milenares de acupuntura para equilibrar o fluxo de energia no corpo.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card service-card border-0">
            <div class="card-body">
              <i class="fas fa-leaf fa-3x text-success mb-4"></i>
              <h5 class="card-title">Shiatsu</h5>
              <p class="card-text">Massagem terapêutica baseada em técnicas japonesas para aliviar tensões.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card service-card border-0">
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
  <section id="testimonials" class="py-5">
    <div class="container">
      <h2 class="text-center mb-5">O que nossos clientes dizem</h2>
      <div class="row">
        <div class="col-md-6">
          <div class="testimonial">
            <p>"A experiência com o Reiki foi transformadora. Senti uma paz que nunca havia experimentado antes!"</p>
            <p><strong>- Maria A.</strong></p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="testimonial">
            <p>"As sessões de Shiatsu aliviaram minhas dores crônicas e melhoraram meu bem-estar geral. Recomendo!"</p>
            <p><strong>- João B.</strong></p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Seção de Contato -->
  <section id="contact" class="py-5 bg-dark text-white">
    <div class="container">
      <h2 class="text-center mb-5">Fale Conosco</h2>
      <div class="row">
      <div id="contact" class=" col-md-6 d-flex justify-content-center align-items-center flex-wrap gap-3">
        <a href="https://wa.me/19983830035"><img src="img/whatsapp icon.png" alt="Icone WhatsApp" class="tamanhologo"></a>
         <a href="https://www.instagram.com/terapias_orientaais/"><img src="img/instagram-icon.png" alt="Icone Instagram" class="tamanhologo"></a>
     </div>
        <div class="col-md-6">
          <h5>Endereço</h5>
          <p>Rua das Terapias, 123, Centro, Cidade XYZ</p>
          <h5>Telefone</h5>
          <p><i class="fas fa-phone"></i> (19) 98383-0035</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Rodapé -->
  <footer>
    <div class="container text-center">
      <p>&copy; 2024 Terapias Orientais. Todos os direitos reservados.</p>
    </div>
  </footer>

  <!-- Bootstrap JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>