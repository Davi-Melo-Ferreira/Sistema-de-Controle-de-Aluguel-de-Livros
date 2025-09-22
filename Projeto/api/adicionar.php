<?php
session_start();
include "../conexao/conexao.php";
header('Content-Type: application/json');

// le os dados enviados no corpo (JSON)
$nome = $_POST['nome'] ? $_POST['nome'] : null;
$valor = floatval($_POST['valor']) ? floatval($_POST['valor']) : null;
$editora = $_POST['editora'] ? $_POST['editora'] : null;
$ano = $_POST['ano'] ? intval($_POST['ano']) : null;
$idioma = $_POST['idioma'] ? $_POST['idioma'] : null;
$autor = $_POST['autor'] ? $_POST['autor'] : null;
$alugado = 0;

if (
    empty($nome) || empty($valor) || empty($editora) ||
    empty($ano) || empty($idioma) || empty($autor) ||
    $alugado === null
) {
    http_response_code(400);
    echo json_encode(["erro" => "Todos os campos são obrigatórios"]);
    exit;
}

// prepared statement
$stmt = $conn->prepare("INSERT INTO livros (nome_livro, valor_livro, editora_livro, ano_livro, idioma_livro, autor_livro, alugado_livro) VALUES (?,?,?,?,?,?,?)");
$stmt->bind_param("sdsissi", $nome, $valor, $editora, $ano, $idioma, $autor, $alugado); // "s" = string; "i" = int

if ($stmt->execute()) {
    echo json_encode([
        "id" => $stmt->insert_id,
        "nome_livro" => $nome,
        "valor_livro" => $valor,
        "editora_livro" => $editora,
        "ano_livro" => $ano,
        "idioma_livro" => $idioma,
        "autor_livro" => $autor,
        "alugado_livro" => $alugado
    ]);
} else {
    http_response_code(500); // erro no servidor
    echo json_encode(["erro" => "Falha ao adicionar livro"]);
}

$stmt->close();
$conn->close();
header("Location: ../public/index.php");
?>