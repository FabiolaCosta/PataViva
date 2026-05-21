<?php
require_once "conexao.php";

$sqlAnimais = "SELECT * FROM animais WHERE status = 'para adoção' ORDER BY animal_id DESC";
$resultAnimais = $conn->query($sqlAnimais);

// mandar os resultdos para em json para o front end js
$animaisArray = array();
if ($resultAnimais->num_rows > 0) {
    while($row = $resultAnimais->fetch_assoc()) {
        $animaisArray[] = $row;
    }
}
echo json_encode($animaisArray);

?>