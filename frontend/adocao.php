<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PataViva</title>
    <link rel="icon" type="image/png" href="logo.png">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
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
    <section class="adocao-hero">
        <div class="adocao-hero-content">
        <h1>Adoção</h1>
        <p>Dê um lar cheio de amor para um animal resgatado.</p>
        </div>
    </section>

    <section class="section">
        <div class="container-animais"> 
            <div class="lista-animais">
                <!-- Lista de animais para adoção -->
                <!-- As informações vem do javascript -->
            </div>
        </div>        
    </section>

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

</body>
<script type="text/javascript" src="js/script.js"></script>
</html>



