<?php
include "../conexao/conexao.php";

$input = json_decode(file_get_contents("php://input"), true);
if (!isset($input["id"]) || !is_numeric($input["id"])) {
    http_response_code(400);
    echo json_encode(["erro" => "ID inválido"]);
    exit;
}

$id = (int)$input["id"];

$stmt = $conn->prepare("DELETE FROM tarefas WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(["sucesso" => true]);
} else {
    http_response_code(500);
    echo json_encode(["erro" => "Falha ao excluir"]);
}

$stmt->close();
$conn->close();
?>