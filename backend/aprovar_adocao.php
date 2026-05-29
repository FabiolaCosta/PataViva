<?php
require "conexao.php";

$idSolicitacao = $_GET['sol_id'];
$data = date('Y-m-d');

$sql = "UPDATE solicitacoes SET status = 'aprovado' WHERE sol_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idSolicitacao);

if ($stmt->execute()) {

    // Registrar a adoção na tabela adocoes
    $sqlAdocao = "INSERT INTO adocoes (sol_id, dt_adocao) VALUES (?, ?)";
    $stmtAdocao = $conn->prepare($sqlAdocao);
    $stmtAdocao->bind_param("is", $idSolicitacao, $data);

    if (!$stmtAdocao->execute()) {
        echo "<script>alert('Erro ao registrar adoção!'); window.location='../admin/adocoes.php';</script>";
        exit;
    }

    // Atualizar o status do animal para "adotado"
    $sqlAnimal = "UPDATE animais SET status = 'adotado' WHERE animal_id = (SELECT animal_id FROM solicitacoes WHERE sol_id = ?)";
    $stmtAnimal = $conn->prepare($sqlAnimal);
    $stmtAnimal->bind_param("i", $idSolicitacao);
    
    if (!$stmtAnimal->execute()) {
        echo "<script>alert('Erro ao atualizar status do animal!'); window.location='../admin/adocoes.php';</script>";
        exit;
    }

    echo "<script>alert('Adoção aprovada com sucesso!'); window.location='../admin/adocoes.php';</script>";
    exit;
} else {
    echo "<script>alert('Erro ao aprovar adoção!'); window.location='../admin/adocoes.php';</script>";
    exit;
}

?>