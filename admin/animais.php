<?php
// Certifique-se de que a sessão está iniciada, se necessário para a autenticação.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require '../backend/auth.php';
require '../backend/conexao.php';

$sqlAnimais = "SELECT * FROM animais ORDER BY animal_id DESC";
$resultAnimais = $conn->query($sqlAnimais);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Painel - Pataviva</title>
  <link rel="stylesheet" href="dashboard.css">
  <link rel="stylesheet" href="style.css<?php echo "?v=" . time(); ?>">
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
        <h1>Gerenciamento de Animais</h1>
      </header>

      <!-- ABAS -->
      <div class="tabs">
        <button class="tab-btn active" onclick="openTab('cadastro')">Cadastrar</button>
        <button class="tab-btn" onclick="openTab('lista')">Consultar</button>
      </div>

      <!-- ABA CADASTRO -->
      <div id="cadastro" class="tab-content active">
        <div class="card">
          <h2>Cadastrar Animal</h2>

          <form action="../backend/cadastrar_animal.php" method="POST" enctype="multipart/form-data" class="form-cadastro">
            
            <label>Nome:</label>
            <input type="text" name="nome" required>

            <label>Espécie:</label>
            <select name="especie" required>
                <option value="Cachorro">Cachorro</option>
                <option value="Gato">Gato</option>
                <option value="Coelho">Coelho</option>
            </select>            

            <label>Sexo:</label>
            <select name="sexo" required>
                <option value="M">Macho</option>
                <option value="F">Fêmea</option>
            </select>

            <label>Porte:</label>
            <select name="porte" required>
                <option value="pequeno">Pequeno</option>
                <option value="medio">Médio</option>
                <option value="grande">Grande</option>
            </select>

            <label>Idade:</label>
            <input type="number" name="idade">

            <label>Descrição:</label>
            <textarea name="descricao"></textarea>

            <label>Foto:</label>
            <input type="file" name="foto" id="inputFoto" accept="image/*">

            <img id="preview" style="display:none; width:200px; margin-top:10px;">

            <button type="submit">Cadastrar</button>
          </form>
        </div>
      </div>

      <!-- ABA LISTA -->
      <div id="lista" class="tab-content">
        <div class="card">
          <h2>Animais cadastrados</h2>          

          <div class="lista-animais">
            <?php if ($resultAnimais->num_rows > 0): ?>
              <?php while($animal = $resultAnimais->fetch_assoc()): ?>
          
                <div class="animal-card">
                    <img src="<?php echo $animal['foto']; ?>" width="120">

                    <h3><?php echo $animal['nome']; ?></h3>

                    <p><strong>Espécie:</strong> <?php echo $animal['especie']; ?></p>
                    <p><strong>Porte:</strong> <?php echo $animal['porte']; ?></p>
                    <p><strong>Idade:</strong> <?php echo $animal['idade']; ?> anos</p>
                    <p><strong>Sexo:</strong> <?php echo $animal['sexo']; ?></p>
                    <p><strong>Status:</strong> <?php echo $animal['status']; ?></p>
                    <p><strong>Descrição:</strong> <?php echo $animal['descricao']; ?></p>

                </div>

              <?php endwhile; ?>
            <?php else: ?>
                <p>Nenhum animal cadastrado.</p>
            <?php endif; ?>
           
          </div>
        </div>
      </div>
    </main>
   
    <script>
      function openTab(tabId) {
          // remove active de tudo
          document.querySelectorAll(".tab-content").forEach(tab => {
              tab.classList.remove("active");
          });

          document.querySelectorAll(".tab-btn").forEach(btn => {
              btn.classList.remove("active");
          });

          // ativa a aba clicada
          document.getElementById(tabId).classList.add("active");
          event.target.classList.add("active");
      }

      // preview imagem
      document.getElementById("inputFoto").addEventListener("change", function(event) {
          const file = event.target.files[0];

          if (file) {
              const preview = document.getElementById("preview");
              preview.src = URL.createObjectURL(file);
              preview.style.display = "block";
          }
      });
    </script>
</body>