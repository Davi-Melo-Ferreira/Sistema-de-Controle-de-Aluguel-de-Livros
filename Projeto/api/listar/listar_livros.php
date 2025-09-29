<?php
    include "../../conexao/conexao.php";
    header('Content-Type: application/json');

    $stmt = $conn->prepare("SELECT * FROM livros");
    $stmt->execute();
    $result = $stmt->get_result();

    $livros = [];
    while($row = $result->fetch_assoc()) {
        $livros[] = $row;
    }

    echo json_encode($livros);

    $stmt->close();
    $conn->close();
?>