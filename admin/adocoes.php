<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require '../backend/auth.php';
require '../backend/conexao.php';

// busca todas as solicitações de adoção
$sql = "SELECT solicitacoes.sol_id, u.nome as usuario_nome, u.usuario_id, a.nome as animal_nome, solicitacoes.dt_sol, solicitacoes.status
        FROM solicitacoes 
        JOIN usuarios u ON solicitacoes.usuario_id = u.usuario_id
        JOIN animais a ON solicitacoes.animal_id = a.animal_id
        ORDER BY solicitacoes.dt_sol DESC";

$resultado = $conn->query($sql);

// contagem de status
$countSql = "SELECT
            SUM(CASE WHEN status = 'pendente' THEN 1 ELSE 0 END) AS pendentes,
            SUM(CASE WHEN status = 'aprovado' THEN 1 ELSE 0 END) AS aprovados,
            SUM(CASE WHEN status = 'negado' THEN 1 ELSE 0 END) AS negados
            FROM solicitacoes";
$countResultado = $conn->query($countSql);
$statusCounts = $countResultado ? $countResultado->fetch_assoc() : ['pendentes' => 0, 'aprovados' => 0, 'negados' => 0];


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Adoções - Pataviva</title>

  <!-- BIBLIOTECA JS CONFIRM -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>
  <!-- SCRIPTS LOCAIS -->
  <link rel="stylesheet" href="dashboard.css">
  <link rel="stylesheet" href="style.css">
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
      <h1>Solicitações de Adoção</h1>
      <p>Gerencie as solicitações de adoção da ONG 🐾</p>
    </header>

    <section class="cards">
      <div class="card">
        <h3>Pendentes</h3>
        <p><?php echo isset($statusCounts['pendentes']) ? $statusCounts['pendentes'] : 0; ?></p>
      </div>

      <div class="card">
        <h3>Aprovados</h3>
        <p><?php echo isset($statusCounts['aprovados']) ? $statusCounts['aprovados'] : 0; ?></p>
      </div>

      <div class="card">
        <h3>Negados</h3>
        <p><?php echo isset($statusCounts['negados']) ? $statusCounts['negados'] : 0; ?></p>
      </div>
    </section>

    <!-- TABELA -->
    <section class="tabela-container">

      <table>
        <thead>
            <tr>
                <th>Usuário</th>
                <th>Animal</th>
                <th>Data da Solicitação</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>

          <?php if ($resultado && $resultado->num_rows > 0): ?>
            <?php while($row = $resultado->fetch_assoc()): ?>
              <tr>
                <td><?php echo $row["usuario_nome"]; ?></td>
                <td><?php echo $row["animal_nome"]; ?></td>
                <td><?php echo date("d/m/Y", strtotime($row["dt_sol"])); ?></td>
              
                <td>
                    <?php if ($row["status"] == "pendente"): ?>
                      <span class="badge pendente">
                        Pendente  
                      </span>
                    <?php endif; ?>
                    <?php if ($row["status"] == "aprovado"): ?>
                      <span class="badge aprovado">
                        Aprovado  
                      </span>
                    <?php endif; ?>
                    <?php if ($row["status"] == "negado"): ?>
                      <span class="badge negado">
                        Negado  
                      </span>
                    <?php endif; ?>
                </td>
                <td class="acoes">
                  <button class="btn-detalhes" onclick="abrirModalUsuario(<?= $row['usuario_id'] ?>)">
                    Info. Usuario
                  </button>

                  <?php if ($row["status"] == "pendente"): ?>                      
                    <button class="btn-aprovar" onclick="aprovarAdocao(<?= $row['sol_id'] ?>)">
                      Aprovar
                    </button>

                    <button class="btn-negar" onclick="negarAdocao(<?= $row['sol_id'] ?>)">
                      Negar
                    </button>
                  <?php endif; ?>
                  <?php if ($row["status"] == "negado"): ?>                      
                    <button class="btn-aprovar" onclick="aprovarAdocao(<?= $row['sol_id'] ?>)">
                      Aprovar
                    </button>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr>
              <td colspan="5" style="text-align:center; padding:20px;">
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
<script type="text/javascript" src="js/script.js?V=<?php echo time(); ?>"></script>
</html>
