<?php
include "../../conexao/conexao.php";

header('Content-Type: application/json');

// Recebe dados do POST
$data = json_decode(file_get_contents('php://input'), true);
if (!$data) {
	$data = $_POST;
}
$id_cliente = isset($data['id_cliente']) ? (int)$data['id_cliente'] : null;
$id_livro = isset($data['id_livro']) ? (int)$data['id_livro'] : null;

if ($id_cliente && $id_livro) {
	// prazo_devolucao = data atual + 2 semanas (14 dias)
	$stmt = $conn->prepare("INSERT INTO alugueis (id_cliente, id_livro, prazo_devolucao) VALUES (?, ?, DATE_ADD(CURDATE(), INTERVAL 14 DAY))");
	$stmt->bind_param("ii", $id_cliente, $id_livro);
	if ($stmt->execute()) {
		echo json_encode(["success" => true, "id_aluguel" => $conn->insert_id]);
        header("Location: ../../php_visual/alugar_livro.php");
	} else {
		echo json_encode(["success" => false, "error" => $stmt->error]);
	}
	$stmt->close();
} else {
	echo json_encode(["success" => false, "error" => "Dados incompletos"]);
}
$conn->close();
?>