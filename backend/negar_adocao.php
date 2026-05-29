<?php
require "conexao.php";

$idSolicitacao = $_GET['sol_id'];

$sql = "UPDATE solicitacoes SET status = 'negado' WHERE sol_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idSolicitacao);

if ($stmt->execute()) {
    echo "<script>alert('Adoção negada com sucesso!'); window.location='../admin/adocoes.php';</script>";
    exit;
} else {
    echo "<script>alert('Erro ao negar adoção!'); window.location='../admin/adocoes.php';</script>";
    exit;
}

?>