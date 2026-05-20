<?php
require_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $senha = $_POST["senha"];
    $confirmar_senha = $_POST["confirmar_senha"];

    // valida senha
    if ($senha !== $confirmar_senha) {
        die("As senhas não conferem!");
    }

    // criptografa senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // dados opcionais
    $data_nascimento = $_POST["data_nascimento"] ?? null;
    $cep = $_POST["cep"] ?? null;
    $rua = $_POST["rua"] ?? null;
    $numero = $_POST["numero"] ?? null;
    $bairro = $_POST["bairro"] ?? null;
    $cidade = $_POST["cidade"] ?? null;
    $estado = $_POST["estado"] ?? null;

    $tipo_moradia = $_POST["tipo_moradia"] ?? null;
    $situacao_imovel = $_POST["situacao_imovel"] ?? null;

    $possui_quintal = $_POST["possui_quintal"] ?? null;
    $possui_telas = $_POST["possui_telas"] ?? null;
    $possui_outros_animais = $_POST["possui_outros_animais"] ?? null;

    $experiencia_animais = $_POST["experiencia_animais"] ?? null;

    // SQL
    $sql = "INSERT INTO usuarios (
        nome, cpf, email, telefone, senha,
        data_nascimento, cep, rua, numero, bairro, cidade, estado,
        tipo_moradia, situacao_imovel,
        possui_quintal, possui_telas, possui_outros_animais,
        experiencia_animais
    ) VALUES (
        ?, ?, ?, ?, ?,
        ?, ?, ?, ?, ?, ?, ?,
        ?, ?,
        ?, ?, ?,
        ?
    )";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "ssssssssssssssssss",
        $nome,
        $cpf,
        $email,
        $telefone,
        $senha_hash,
        $data_nascimento,
        $cep,
        $rua,
        $numero,
        $bairro,
        $cidade,
        $estado,
        $tipo_moradia,
        $situacao_imovel,
        $possui_quintal,
        $possui_telas,
        $possui_outros_animais,
        $experiencia_animais
    );

    if ($stmt->execute()) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>