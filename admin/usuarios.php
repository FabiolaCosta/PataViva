<?php
// Certifique-se de que a sessão está iniciada.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require '../backend/auth.php';
require '../backend/conexao.php';

/*
CONSULTA:
- nome do usuário
- quantidade de adoções
- cadastro completo?
- pode adotar?
*/

$sql = "
SELECT 
    u.usuario_id,
    u.nome,

    COUNT(a.adocao_id) AS total_adocoes,

    CASE
        WHEN
            u.data_nascimento IS NOT NULL
            AND u.cep IS NOT NULL
            AND u.rua IS NOT NULL
            AND u.numero IS NOT NULL
            AND u.bairro IS NOT NULL
            AND u.cidade IS NOT NULL
            AND u.estado IS NOT NULL
            AND u.tipo_moradia IS NOT NULL
            AND u.situacao_imovel IS NOT NULL
            AND u.possui_outros_animais IS NOT NULL
        THEN 'Completo'
        ELSE 'Incompleto'
    END AS cadastro_status,

    CASE
        WHEN
            u.data_nascimento IS NOT NULL
            AND u.cep IS NOT NULL
            AND u.rua IS NOT NULL
            AND u.numero IS NOT NULL
            AND u.bairro IS NOT NULL
            AND u.cidade IS NOT NULL
            AND u.estado IS NOT NULL
            AND u.tipo_moradia IS NOT NULL
            AND u.situacao_imovel IS NOT NULL
            AND u.possui_outros_animais IS NOT NULL
        THEN 'Sim'
        ELSE 'Não'
    END AS pode_adotar

FROM usuarios u

LEFT JOIN solicitacoes s
ON u.usuario_id = s.usuario_id

LEFT JOIN adocoes a
ON s.sol_id = a.sol_id

GROUP BY u.usuario_id, u.nome

ORDER BY u.nome ASC
";

$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Usuários - Pataviva</title>

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
      <h1>Usuários cadastrados</h1>
      <p>Gerencie os adotantes da plataforma 🐾</p>
    </header>

    <section class="tabela-section">

      <table class="tabela-usuarios">

        <thead>
          <tr>
            <th>Nome</th>
            <th>Adoções</th>
            <th>Cadastro</th>
            <th>Pode adotar?</th>
          </tr>
        </thead>

        <tbody>

        <?php while($usuario = $resultado->fetch_assoc()): ?>

          <tr>

            <td>
              <?php echo $usuario["nome"]; ?>
            </td>

            <td>
              <?php echo $usuario["total_adocoes"]; ?>
            </td>

            <td>
              <?php echo $usuario["cadastro_status"]; ?>
            </td>

            <td>

              <?php if($usuario["pode_adotar"] == "Sim"): ?>

                <span class="status-aprovado">
                  ✔ Sim
                </span>

              <?php else: ?>

                <span class="status-negado">
                  ✖ Não
                </span>

              <?php endif; ?>

            </td>

          </tr>

        <?php endwhile; ?>

        </tbody>

      </table>

    </section>

  </main>

</div>

</body>
</html>
```
