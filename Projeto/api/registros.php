<?php
    include "../conexao/conexao.php";
    header('Content-Type: application/json');

    $sql = "SELECT a.*, c.nome_cliente, l.nome_livro
            FROM alugueis a
            JOIN clientes c ON a.id_cliente = c.id_cliente
            JOIN livros l ON a.id_livro = l.id_livro";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    $alugueis = [];
    while($row = $result->fetch_assoc()) {
        $alugueis[] = $row;
    }

    echo json_encode($alugueis);

    $stmt->close();
    $conn->close();
?>