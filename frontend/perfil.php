<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

require 'back_end_cli/conexao.php';

// Busca as solicitações de adoção do usuário
$sqlSolicitacao = "SELECT animais.nome, animais.especie, animais.sexo, animais.porte, animais.idade, animais.descricao, animais.foto, solicitacoes.status
                    FROM solicitacoes 
                    JOIN animais ON solicitacoes.animal_id = animais.animal_id
                    WHERE solicitacoes.usuario_id = ? AND solicitacoes.status in('pendente', 'negado')";

$stmtSolicitacao = $conn->prepare($sqlSolicitacao);
$stmtSolicitacao->bind_param("i", $_SESSION["usuario_id"]);
$stmtSolicitacao->execute();
$resultSolicitacoes = $stmtSolicitacao->get_result();

// Busca os animais adotados pelo usuário
$sqlAdotados = "SELECT animais.nome, animais.especie, animais.sexo, animais.porte, animais.idade, animais.descricao, animais.foto 
                FROM adocoes 
                JOIN solicitacoes ON adocoes.sol_id = solicitacoes.sol_id
                JOIN animais ON solicitacoes.animal_id = animais.animal_id
                WHERE solicitacoes.usuario_id = ? AND solicitacoes.status = 'aprovado'";

$stmtAdotados = $conn->prepare($sqlAdotados);
$stmtAdotados->bind_param("i", $_SESSION["usuario_id"]);
$stmtAdotados->execute();
$resultAdotados = $stmtAdotados->get_result();  


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil - PataViva</title>

  <link rel="stylesheet" href="style.css">

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body class="perfil-page">

  <!-- HEADER -->
  <header>

    <img src="logo.png" alt="PataViva Logo" class="logo">

    <nav>
      <a href="index.php">Início</a>
      <a href="adocao.php">Adoção</a>
            <a href="como.php">Como Ajudar</a>
            <a href="sobre.php">Sobre</a>
            <a href="#contato">Contato</a>

      <a href="perfil.php" class="login-btn">
        <?php echo $_SESSION["usuario"]; ?>
      </a>
    </nav>

  </header>

  <!-- PERFIL -->
  <section class="perfil-section">

    <div class="perfil-container">

      <!-- CARD USUÁRIO -->
      <div class="perfil-card">

        <h2>Meu Perfil</h2>

        <div class="perfil-info">

          <div class="info-item">
            <span>Nome:</span>
            <strong>
              <?php echo $_SESSION["usuario"]; ?>
            </strong>
          </div>

          <div class="info-item">
            <span>Status:</span>
            <strong>Adotante PataViva</strong>
          </div>

        </div>

      </div>

      <!-- ALTERAR SENHA -->
      <div class="perfil-card">

        <h2>Alterar Senha</h2>

         <form action="back_end_cli/alterar_senha.php" method="POST" class="senha-form">
          <input 
            type="password" 
            name="senha_atual"
            placeholder="Senha atual"
            required
          >

          <input 
            type="password" 
            name="nova_senha"
            placeholder="Nova senha"
            required
          >

          <input 
            type="password" 
            name="confirmar_senha"
            placeholder="Confirmar nova senha"
            required
          >

          <button type="submit">
            Alterar senha
          </button>

        </form>

      </div>

      <!-- ANIMAIS ADOTADOS -->
      <div class="perfil-card">

        <h2>Animais Adotados</h2>

        <div class="animais-adotados">
          <?php if ($resultAdotados->num_rows === 0): ?>
            <p>Você não tem animais adotados.</p>
          <?php endif; ?>
          
          <?php while ($animal = $resultAdotados->fetch_assoc()): ?>
            <div class="animal-item animal-card">
              <div class="animal-card-image">
                <img src="<?= htmlspecialchars($animal['foto']) ?>" alt="<?= htmlspecialchars($animal['nome']) ?>">
              </div>
              <div class="animal-card-content">
                <strong><?= htmlspecialchars($animal['nome']) ?></strong>
                <p><strong>Espécie:</strong> <?= htmlspecialchars($animal['especie']) ?></p>
                <p><strong>Porte:</strong> <?= htmlspecialchars($animal['porte']) ?></p>
                <p><strong>Idade:</strong> <?= htmlspecialchars($animal['idade']) ?> anos</p>                
              </div>
            </div>
          <?php endwhile; ?>   
        </div>
      </div>

      <!-- SOLICITAÇÃO DE ADOÇÃO -->
      <div class="perfil-card">

        <h2>Solicitações de Adoção</h2>

        <div class="animais-adotados">
          <?php if ($resultSolicitacoes->num_rows === 0): ?>
            <p>Você não tem solicitações de adoção pendentes.</p>
          <?php endif; ?>
          
          <?php while ($solicitacao = $resultSolicitacoes->fetch_assoc()): ?>
            <div class="animal-item animal-card">
              <div class="animal-card-image">
                <img src="<?= htmlspecialchars($solicitacao['foto']) ?>" alt="<?= htmlspecialchars($solicitacao['nome']) ?>">
              </div>
              <div class="animal-card-content">
                <strong><?= htmlspecialchars($solicitacao['nome']) ?></strong>
                <p><strong>Espécie:</strong> <?= htmlspecialchars($solicitacao['especie']) ?></p>
                <p><strong>Porte:</strong> <?= htmlspecialchars($solicitacao['porte']) ?></p>
                <p><strong>Idade:</strong> <?= htmlspecialchars($solicitacao['idade']) ?> anos</p>      
                <p><strong>Status:</strong> <?= htmlspecialchars($solicitacao['status']) ?></p>          
              </div>
            </div>
          <?php endwhile; ?>          
        </div>
      </div>

      <!-- LOGOUT -->
      <div class="perfil-card logout-card">

        <h2>Sair da Conta</h2>

        <p>
          Clique abaixo para encerrar sua sessão com segurança.
        </p>

        <a href="logout.php" class="logout-btn">
          Logout
        </a>

      </div>

    </div>

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

  </footer>

  <footer>
    <p>© 2026 PataViva - Todos os direitos reservados</p>
  </footer>

</body>
</html>
