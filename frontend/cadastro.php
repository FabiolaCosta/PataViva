<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro para Adoção - PataViva</title>

  <link rel="stylesheet" href="style.css">

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body class="cadastro-page">

  <header>
    <img src="logo.png" class="logo">

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
  <section class="cadastro-container">

    <div class="cadastro-card">
      <h2>Cadastro para Adoção</h2>

      <form action="back_end_cli/cadastro.php" method="POST">

        <h3>Dados Pessoais</h3>

        <input type="text" name="nome" placeholder="Nome completo" required>

        <input type="text" name="cpf" placeholder="CPF" required maxlength="14">

        <input type="email" name="email" placeholder="Email" autocomplete="email" required>

        <input type="tel" name="telefone" placeholder="Telefone" required>

        <input type="date" name="data_nascimento">

        <h3>Endereço</h3>

        <input type="text" name="cep" placeholder="CEP">

        <input type="text" name="rua" placeholder="Rua">

        <input type="text" name="numero" placeholder="Número">

        <input type="text" name="bairro" placeholder="Bairro">

        <input type="text" name="cidade" placeholder="Cidade">

        <input type="text" name="estado" placeholder="Estado">

        <h3>Moradia</h3>

        <select name="tipo_moradia">
          <option value="">Tipo de moradia</option>
          <option value="casa">Casa</option>
          <option value="apartamento">Apartamento</option>
        </select>

        <select name="situacao_imovel">
          <option value="">Situação do imóvel</option>
          <option value="proprio">Próprio</option>
          <option value="alugado">Alugado</option>
        </select>

        <select name="possui_quintal">
          <option value="">Possui quintal?</option>
          <option value="1">Sim</option>
          <option value="0">Não</option>
        </select>

        <select name="possui_telas">
          <option value="">Possui telas de proteção?</option>
          <option value="1">Sim</option>
          <option value="0">Não</option>
        </select>

        <h3>Experiência com Animais</h3>

        <select name="possui_outros_animais">
          <option value="">Possui outros animais?</option>
          <option value="1">Sim</option>
          <option value="0">Não</option>
        </select>

        <textarea
          name="experiencia_animais"
          placeholder="Conte um pouco sobre sua experiência com animais"
          rows="5"
        ></textarea>

        <h3>Segurança da Conta</h3>

        <input type="password" name="senha" placeholder="Senha" required minlength="6" autocomplete="new-password">

        <input type="password" name="confirmar_senha" placeholder="Confirmar senha" required autocomplete="new-password">

        <label class="checkbox">
          <input type="checkbox" name="termo" required>
          Estou ciente da responsabilidade de cuidar do animal
        </label>

        <button type="submit">Cadastrar</button>

      </form>
    </div>

  </section>
  <footer class="rodape-pata-viva" id="contato">
    <div class="container-footer">

      <div class="bloco-logo">
        <img src="logo.png" class="logo-rodape">
        <p>Organização de Amparo Animal</p>
      </div>

      <div class="bloco-info">
        <p><strong>Dúvidas e contato:</strong></p>
        <p>contato@pataviva.org.br</p>
        <p>São Paulo - SP</p>
      </div>

    </div>
  </footer>

</body>
</html>
