<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doações - PataViva</title>

  <link rel="icon" type="image/png" href="logo.png">
  <link rel="stylesheet" href="style.css">

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body class="doacao-page">

<header>
  <img src="logo.png" alt="PataViva Logo" class="logo">

  <nav>
    <a href="index.php">Início</a>
    <a href="adocao.php">Adoção</a>
    <a href="como.php">Como Ajudar</a>
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
<section class="doacao-hero">
  <div class="doacao-overlay">
    <h1>Ajude a salvar vidas</h1>
    <p>Sua contribuição ajuda animais em situação de abandono.</p>
  </div>
</section>

<!-- CONTEÚDO -->
<section class="doacao-section">
  <div class="doacao-container">

    <div class="doacao-info">
      <h2>Para onde vai sua doação?</h2>

      <p>Usamos o dinheiro para alimentação, resgate, veterinário e castração.</p>

      <div class="doacao-dados">
        <div class="dado"><h3>850+</h3><span>Resgatados</span></div>
        <div class="dado"><h3>620+</h3><span>Adotados</span></div>
        <div class="dado"><h3>120</h3><span>Em tratamento</span></div>
      </div>
    </div>

    <div class="doacao-card">
      <h2>Faça uma doação</h2>

      <img 
        src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=PataVivaPix"
        class="qr-code"
      >

      <p>Chave PIX: contato@pataviva.org.br</p>

      <!-- BOTÃO CERTO -->
      <button class="btn-doar" onclick="abrirDoacao()">
        Quero ajudar
      </button>
    </div>

  </div>
</section>

<!-- MODAL -->
<div id="modalDoacao" class="modal">
  <div class="modal-content">

    <h2>Fazer Doação</h2>

    <form action="back_end_cli/salvar_doacao.php" method="POST">

      <label>Você já fez o PIX?</label>
      <select name="pix_feito" required>
        <option value="sim">Sim</option>
        <option value="nao">Não</option>
      </select>

      <label>Valor da doação</label>
      <input type="number" name="valor" step="0.01" required>

      <button type="submit" class="btn">Confirmar</button>
      <button type="button" class="btn-cancel" onclick="fecharDoacao()">Cancelar</button>

    </form>

  </div>
</div>

<!-- SCRIPT (CERTO) -->
<script>
function abrirDoacao() {
  document.getElementById("modalDoacao").style.display = "flex";
}

function fecharDoacao() {
  document.getElementById("modalDoacao").style.display = "none";
}

// clicar fora fecha
window.onclick = function(event) {
  let modal = document.getElementById("modalDoacao");
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

</body>
</html>
