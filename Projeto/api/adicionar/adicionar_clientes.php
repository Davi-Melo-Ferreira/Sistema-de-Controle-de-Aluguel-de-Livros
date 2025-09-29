<?php
session_start();
include "../../conexao/conexao.php";
header('Content-Type: application/json');

// le os dados enviados no corpo (JSON)
$nome = $_POST['nome'] ? $_POST['nome'] : null;
$email = $_POST['email'] ? ($_POST['email']) : null;
$endereco = $_POST['endereco'] ? $_POST['endereco'] : null;

if (
    empty($nome) || empty($email) || empty($endereco)
) {
    http_response_code(400);
    echo json_encode(["erro" => "Todos os campos são obrigatórios"]);
    exit;
}

// prepared statement
$stmt = $conn->prepare("INSERT INTO clientes (nome_cliente, email_cliente, endereco_cliente) VALUES (?,?,?)");
$stmt->bind_param("sss", $nome, $email, $endereco);

if ($stmt->execute()) {
    echo json_encode([
        "id" => $stmt->insert_id,
        "nome_cliente" => $nome,
        "email_cliente" => $email,
        "endereco_cliente" => $endereco
    ]);
} else {
    http_response_code(500); // erro no servidor
    echo json_encode(["erro" => "Falha ao adicionar cliente"]);
}

$stmt->close();
$conn->close();
header("Location: ../php_visual/clientes.php");
?>