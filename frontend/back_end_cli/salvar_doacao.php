<?php
session_start();
require "conexao.php";

if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../index.php");
    exit;
}

$usuario_id = $_SESSION["usuario_id"];
$pix_feito = $_POST["pix_feito"];
$valor = $_POST["valor"];

$sql = "INSERT INTO doacoes (usuario_id, pix_feito, valor)
        VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("isd", $usuario_id, $pix_feito, $valor);

if ($stmt->execute()) {
    header("Location: ../doacoes.php?sucesso=1");
    exit;
} else {
    echo "Erro ao salvar doação: " . $stmt->error;
}
