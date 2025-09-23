pega o id do livro que deseja alugar,
e depois de ser enviado o post via alugar_livro.php,

<?php
    include "../conexao/conexao.php";
    header('Content-Type: application/json');

    $stmt = $conn->prepare("SELECT * FROM livros WHERE alugado_livro = 0");
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