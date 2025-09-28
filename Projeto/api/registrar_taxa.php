
<?php
include "../conexao/conexao.php";
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
if (!$data) {
    $data = $_POST;
}
$id_aluguel = isset($data['id_aluguel']) ? (int)$data['id_aluguel'] : null;

if ($id_aluguel) {
    // Atualiza data_devolucao e taxa_atraso
    $stmt = $conn->prepare("
        UPDATE alugueis
        SET data_devolucao = CURDATE(),
            taxa_atraso = CASE
                WHEN CURDATE() > prazo_devolucao THEN DATEDIFF(CURDATE(), prazo_devolucao) * 5.00
                ELSE 0.00
            END
        WHERE id_aluguel = ? AND data_devolucao IS NULL
    ");
    $stmt->bind_param("i", $id_aluguel);
    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => $stmt->error]);
    }
    $stmt->close();
} else {
    echo json_encode(["success" => false, "error" => "ID não informado"]);
}
$conn->close();
?>

