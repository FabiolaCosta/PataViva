<?php
// Certifique-se de que a sessão está iniciada, se necessário para a autenticação.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require '../backend/auth.php';
require '../backend/conexao.php';

$sql_animais = "SELECT COUNT(*) AS total FROM animais";

$result_animais = $conn->query($sql_animais);

$total_animais = 0;

if ($result_animais && $result_animais->num_rows > 0) {

    $dados_animais = $result_animais->fetch_assoc();

    $total_animais = $dados_animais["total"];
}

$sql_adocoes = "SELECT COUNT(*) AS total FROM adocoes";

$result_adocoes = $conn->query($sql_adocoes);

$total_adocoes = 0;

if ($result_adocoes && $result_adocoes->num_rows > 0) {

    $dados_adocoes = $result_adocoes->fetch_assoc();

    $total_adocoes = $dados_adocoes["total"];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Painel - Pataviva</title>
    <link rel="icon" type="image/png" href="logo.png">
  <link rel="stylesheet" href="dashboard.css">
</head>
<body>

  <div class="container">

    <!-- SIDEBAR -->
    <aside class="sidebar">
      <h2 class="logo">
        <img src="logo.png" alt="Logo Pataviva">
        Pataviva
      </h2>

      <nav>
        <ul>
          <li><a href="index.php">🏠 Início</a></li>
          <li><a href="animais.php">🐶 Animais</a></li>
          <li><a href="adocoes.php">📋 Adoções</a></li>
          <li><a href="doacoes.php">💰 Doações</a></li>
          <li><a href="usuarios.php">👤 Usuários</a></li>
          <li><a href="perfil.php">⚙️ Perfil</a></li>
          <li><a href="../backend/logout.php">🚪 Sair</a></li>
        </ul>
      </nav>
    </aside>

    <main class="content">
      <header>
        <h1>Painel Administrativo</h1>
        <p>Bem-vindo ao sistema Pataviva 🐾</p>
      </header>

      <section class="cards">
        <div class="card">
          <h3>Animais cadastrados</h3>
          <p><?php echo $total_animais; ?></p>
        </div>

        <div class="card">
          <h3>Adoções realizadas</h3>
          <p><?php echo $total_adocoes; ?></p>
        </div>

        <div class="card">
          <h3>Doações recebidas</h3>
          <p>R$ 2.300</p>
        </div>
      </section>
    </main>

  </div>

</body>
</html>
