<?php
session_start();
include "../conexao/conexao.php";
header('Content-Type: application/json');

$usuario = $_SESSION['usuario'] ?? '';
$senha = $_SESSION['senha'] ?? '';

$stmt = $conn->prepare("SELECT * FROM funcionarios WHERE nome_funcionario = ? AND senha_funcionario = ?");
$stmt->bind_param("ss", $usuario, $senha);
$stmt->execute();
$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    $_SESSION['usuario'] = $user['nome_funcionario'];
    header("Location: ../public/index.php");
    exit;
    // Ou use header("Location: ../public/index.php"); exit; se não for AJAX
} else {
    echo "<p>Usuário ou senha inválidos. Tente novamente.</p>";
    echo "<a href='login.php'>Voltar para a página de login</a>";
    session_destroy();
}