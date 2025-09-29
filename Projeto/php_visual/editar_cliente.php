<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar cliente</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Editar cliente</h1>
    <main>
        <div id="dadoscliente">
            <h3>Dados atuais do cliente:</h3>
            <a id="resultado" name="resultado">
            <?php
            include("../conexao/conexao.php");
            if (isset($_GET['id'])) {
                $id = intval($_GET['id']);
                $sql = "SELECT * FROM clientes WHERE id_cliente = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($cliente = $result->fetch_assoc()) {
                    echo '<table border="1">'
                        . '<tr><th>Campo</th><th>Valor</th></tr>'
                        . '<tr><td>Id</td><td>' . $cliente['id_cliente'] . '</td></tr>'
                        . '<tr><td>Nome</td><td>' . htmlspecialchars($cliente['nome_cliente']) . '</td></tr>'
                        . '<tr><td>Email</td><td>' . $cliente['email_cliente'] . '</td></tr>'
                        . '<tr><td>Endereço</td><td>' . htmlspecialchars($cliente['endereco_cliente']) . '</td></tr>'
                        . '</table>';
                } else {
                    echo "cliente não encontrado.";
                }
                $stmt->close();
                $conn->close();
            } else {
                echo "ID do cliente não informado.";
            }
            ?>
            </a>
        <!-- Formulário para editar registro na tabela de clientes -->
        <form id="bookForm" method="POST" action="../api/editar/editar_cliente.php" novalidate>
            <div>
                <label for="campo">Campo:</label>
                <input id="campo" name="campo" type="text" required />
                <select name="nome_opcao" id="nome_opcao">
                    <option value="nome">Nome</option>
                    <option value="email">Email</option>
                    <option value="endereco">Endereço</option>
                </select>
            </div>
            <div>
                <button type="submit" name="editar" value="<?php echo isset($id) ? $id : ''; ?>">Editar</button>
            </div>
        </form>
        <button type="button" onclick="window.location.href='../public/index.php'">Voltar</button>
    </main>
</body>
</html>