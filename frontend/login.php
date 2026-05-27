<?php

session_start();

require_once "back_end_cli/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $sql = "SELECT usuario_id, nome, senha FROM usuarios WHERE email = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s", $email);

    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {

        $usuario = $resultado->fetch_assoc();

        if (password_verify($senha, $usuario["senha"])) {

            $_SESSION["usuario_id"] = $usuario["id"];
            $_SESSION["usuario"] = $usuario["nome"];

            header("Location: index.php");
            exit;

        } else {

            $erro = "Senha incorreta!";

        }

    } else {

        $erro = "Usuário não encontrado!";

    }

}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - PataViva</title>

  <link rel="stylesheet" href="style.css">

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body class="login-page">

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

  <section>
    <div class="login-container">
    
    <div class="login-card">
      <h2>Entrar</h2>

      <?php if(isset($erro)): ?>
    <p style="color:red;">
        <?php echo $erro; ?>
    </p>
<?php endif; ?>

     <form method="POST">

  <input 
    type="email" 
    name="email"
    placeholder="Email" 
    required
  >

  <input 
    type="password" 
    name="senha"
    placeholder="Senha" 
    required
  >

  <button type="submit">Login</button>

</form>

      <a href="#" class="forgot">Esqueceu sua senha?</a>
      <a>ou</a>
      <a href="cadastro.php" class="forgot">Crie sua conta agora mesmo</a>
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
</html>