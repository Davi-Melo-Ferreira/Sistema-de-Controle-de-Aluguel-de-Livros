<?php
header("Content-Type: application/json");
include("../conexao/conexao.php");

$sql = "SELECT * FROM livros ORDER BY id DESC";

$result = $conn->query($sql);

$livros = [];

while($row = $result->fetch_assoc()) {
    $livros[] = $row;
}

echo json_encode($livros);
?>