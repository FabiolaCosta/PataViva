<?php

require_once "conexao.php";

header('Content-Type: application/json');

$usuario_id = $_GET["usuario_id"];

$sql = "SELECT * FROM usuarios WHERE usuario_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();

$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();

echo json_encode($usuario);

?>