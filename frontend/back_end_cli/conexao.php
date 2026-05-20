<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "pataviva";

$conn = new mysqli($host, $user, $pass, $db);

// verifica conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// opcional: definir charset (recomendado)
$conn->set_charset("utf8mb4");
?>