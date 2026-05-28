<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require '../backend/auth.php';
require '../backend/conexao.php';

/*
USUÁRIO → SOLICITAÇÃO → ADOÇÃO → ANIMAL
*/

$sql = "
SELECT 
    u.nome AS usuario_nome,
    an.nome AS animal_nome,
    a.dt_adocao

FROM adocoes a

INNER JOIN solicitacoes s
    ON s.sol_id = a.sol_id

INNER JOIN usuarios u
    ON u.usuario_id = s.usuario_id

INNER JOIN animais an
    ON an.animal_id = s.animal_id

ORDER BY a.dt_adocao DESC
";

$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Adoções - Pataviva</title>

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

  <!-- CONTEÚDO -->
  <main class="content">

    <header>
      <h1>Adoções realizadas</h1>
      <p>Histórico de usuários e animais adotados 🐾</p>
    </header>

    <section class="tabela-section">

      <table class="tabela-usuarios">

        <thead>
          <tr>
            <th>Usuário</th>
            <th>Animal</th>
            <th>Data da adoção</th>
          </tr>
        </thead>

        <tbody>

          <?php if ($resultado && $resultado->num_rows > 0): ?>

            <?php while($row = $resultado->fetch_assoc()): ?>

              <tr>
                <td><?php echo $row["usuario_nome"]; ?></td>
                <td><?php echo $row["animal_nome"]; ?></td>
                <td><?php echo $row["dt_adocao"]; ?></td>
              </tr>

            <?php endwhile; ?>

          <?php else: ?>

            <tr>
              <td colspan="3" style="text-align:center; padding:20px;">
                Nenhuma adoção registrada ainda.
              </td>
            </tr>

          <?php endif; ?>

        </tbody>

      </table>

    </section>

  </main>

</div>

</body>
</html>
