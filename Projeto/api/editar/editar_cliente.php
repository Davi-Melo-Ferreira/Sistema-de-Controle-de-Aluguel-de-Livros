<?php
include "../../conexao/conexao.php";
require "../../php_visual/editar_cliente.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['editar'])) {
        $id = intval($_POST['editar']);
        $campo = $_POST['campo'];
        $nome_opcao = $_POST['nome_opcao'];

        // Validação básica
        $campos_validos = ['nome', 'email', 'endereco'];
        if (in_array($nome_opcao, $campos_validos)) {
            $sql = "UPDATE clientes SET {$nome_opcao}_cliente = ? WHERE id_cliente = ?";
            $stmt = $conn->prepare($sql);
            if ($nome_opcao == 'valor' || $nome_opcao == 'ano') {
                $stmt->bind_param("di", $campo, $id); // valor é decimal, ano é inteiro
            } else {
                $stmt->bind_param("si", $campo, $id); // outros são strings
            }
            if ($stmt->execute()) {
                echo "<p>cliente atualizado com sucesso!</p>";
            } else {
                echo "<p>Erro ao atualizar cliente: " . $stmt->error . "</p>";
            }
            $stmt->close();
        } else {
            echo "<p>Campo inválido selecionado.</p>";
        }
        $conn->close();
        header("Location: ../../php_visual/editar_cliente.php?id=" . $id);
        exit;
    } else {
        echo "<p>ID do cliente não informado ou formulário não submetido corretamente.</p>";
    }
}
?>