<?php

session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../login.php");
    exit;
}

require_once "conexao.php";


$usuario_id = $_SESSION["usuario_id"];
$animal_id = $_GET["animal_id"];

$sqlVerificar = "SELECT * FROM solicitacoes WHERE usuario_id = ? AND animal_id = ?";
$stmtVerificar = $conn->prepare($sqlVerificar);
$stmtVerificar->bind_param("ii", $usuario_id, $animal_id);
$stmtVerificar->execute();
$resultVerificar = $stmtVerificar->get_result();

if ($resultVerificar->num_rows > 0) {
    echo "<script>alert('Você já fez uma solicitação para este animal!'); window.location='../adocao.php';</script>";
    exit;
}

$sql = "INSERT INTO solicitacoes (usuario_id, animal_id) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $usuario_id, $animal_id);


if ($stmt->execute()) {
    echo "<script>alert('Solicitação de adoção enviada com sucesso!'); window.location='../perfil.php';</script>";
    exit;
} else {
    echo "<script>alert('Erro ao enviar solicitação de adoção!'); window.location='../adocao.php';</script>";
    exit;
}