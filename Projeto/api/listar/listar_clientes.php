<?php

include "../../conexao/conexao.php";
header('Content-Type: application/json');

$stmt = $conn->prepare("SELECT * FROM clientes");
$stmt->execute();
$result = $stmt->get_result();

$clientes = [];
while($row = $result->fetch_assoc()) {
    $clientes[] = $row;
}

echo json_encode($clientes);

$stmt->close();
$conn->close();

?>