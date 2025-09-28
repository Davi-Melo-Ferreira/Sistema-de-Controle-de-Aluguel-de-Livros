<?php
include "../conexao/conexao.php";

$input = json_decode(file_get_contents("php://input"), true);
if (!isset($input["id"]) || !is_numeric($input["id"])) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "ID inválido"]);
    exit;
}

$id = (int)$input["id"];

$stmt = $conn->prepare("DELETE FROM clientes WHERE id_cliente = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Falha ao excluir"]);
}

$stmt->close();
$conn->close();
?>