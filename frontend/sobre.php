<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sobre Nós - PataViva</title>

  <link rel="stylesheet" href="style.css">

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>

  <!-- HEADER -->
  <header>
    <img src="logo.png" alt="PataViva Logo" class="logo">

    <nav>
     <a href="index.php">Início</a>
            <a href="adocao.php">Adoção</a>
            <a href="#">Como Ajudar</a>
            <a href="sobre.php">Sobre</a>
            <a href="#contato">Contato</a>

            <?php if(isset($_SESSION['usuario'])): ?>

  <a href="perfil.php" class="login-btn">
    <?php echo $_SESSION['usuario']; ?>
  </a>

<?php else: ?>

  <a href="login.php" class="login-btn">Login</a>

<?php endif; ?>
    </nav>
  </header>

  <!-- HERO -->
  <section class="sobre-hero">
    <div class="sobre-hero-content">
      <h1>Sobre a PataViva</h1>
      <p>Amor, cuidado e compromisso com a vida animal</p>
    </div>
  </section>

  <!-- HISTÓRIA -->
  <section class="sobre-section">
    <div class="sobre-container">
      
      <div class="sobre-texto">
        <h2>Nossa História</h2>
        <p>
          A PataViva nasceu com o propósito de dar voz aos animais abandonados e
          oferecer a eles uma nova chance de viver com dignidade. Desde a sua criação,
          a ONG atua no resgate, cuidado e reabilitação de cães e gatos em situação de risco.
        </p>

        <p>
          Ao longo dos anos, construímos uma rede de apoio com voluntários, parceiros e
          adotantes, transformando histórias de abandono em histórias de amor.
        </p>
      </div>

      <div class="sobre-imagem">
        <img src="" alt="Animais resgatados">
      </div>

    </div>
  </section>

  <!-- MISSÃO / VISÃO / VALORES -->
  <section class="sobre-mvv">
    <div class="mvv-container">

      <div class="mvv-card">
        <h3>Missão</h3>
        <p>Proteger, cuidar e encontrar lares responsáveis para animais resgatados.</p>
      </div>

      <div class="mvv-card">
        <h3>Visão</h3>
        <p>Ser referência nacional na proteção e bem-estar animal.</p>
      </div>

      <div class="mvv-card">
        <h3>Valores</h3>
        <p>Amor, responsabilidade, respeito à vida e compromisso com a sociedade.</p>
      </div>

    </div>
  </section>

  <!-- EQUIPE -->
  <section class="equipe">
    <h2>Nossa Equipe</h2>

    <div class="equipe-cards">

      <div class="membro">
        <img src="">
        <h3>Carla Souza</h3>
        <span>Fundadora</span>
      </div>

      <div class="membro">
        <img src="">
        <h3>Rafael Lima</h3>
        <span>Veterinário</span>
      </div>

      <div class="membro">
        <img src="">
        <h3>Juliana Alves</h3>
        <span>Voluntária</span>
      </div>

    </div>
  </section>

  <!-- CTA -->
  <section class="cta">
    <h2>Faça parte dessa causa</h2>
    <p>Ajude a transformar a vida de animais que precisam de você.</p>
    <a href="#" class="btn">Quero ajudar</a>
  </section>

  <!-- FOOTER -->
  <footer class="rodape-pata-viva" id="contato">
    <div class="container-footer">

      <div class="bloco-logo">
        <img src="logo.png" alt="Logo Pata Viva" class="logo-rodape">
        <p>Organização de Amparo Animal</p>
      </div>

      <div class="bloco-info">
        <p><strong>Dúvidas e contato:</strong></p>
        <p>contato@pataviva.org.br</p>
        <p>São Paulo - SP</p>
      </div>

    </div>

    <footer>
      <p>© 2026 PataViva - Todos os direitos reservados</p>
    </footer>
  </footer>

</body>
</html>