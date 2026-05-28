<?php

session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../index.php");
    exit;
}

require_once "conexao.php";

/*
AJUSTE O CAMINHO ACIMA SE NECESSÁRIO

Exemplo:
require_once "conexao.php";
ou
require_once "../conexao.php";
*/

$usuario_id = $_SESSION["usuario_id"];

$senha_atual = $_POST["senha_atual"];
$nova_senha = $_POST["nova_senha"];
$confirmar_senha = $_POST["confirmar_senha"];

/* verifica se as senhas novas conferem */
if ($nova_senha !== $confirmar_senha) {
    die("As novas senhas não conferem.");
}

/* busca senha atual no banco */
$sql = "SELECT senha FROM usuarios WHERE usuario_id = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $usuario_id);

$stmt->execute();

$resultado = $stmt->get_result();

$usuario = $resultado->fetch_assoc();

/* verifica senha atual */
if (!$usuario || !password_verify($senha_atual, $usuario["senha"])) {
    die("Senha atual incorreta.");
}

/* gera hash da nova senha */
$nova_senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);

/* atualiza senha */
$sql_update = "UPDATE usuarios SET senha = ? WHERE usuario_id = ?";

$stmt_update = $conn->prepare($sql_update);

$stmt_update->bind_param(
    "si",
    $nova_senha_hash,
    $usuario_id
);

if ($stmt_update->execute()) {

    echo "
    <script>
        alert('Senha alterada com sucesso!');
        window.location.href = 'perfil.php';
    </script>
    ";

} else {

    echo "
    <script>
        alert('Erro ao alterar senha.');
        window.location.href = 'perfil.php';
    </script>
    ";
}

$stmt->close();
$stmt_update->close();
$conn->close();

?>
