<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h1>Adicionar Livro</h1>

    <main>
        <<!-- Formulário para inserir registro na tabela de livros -->
        <form id="bookForm" action="/books/create" method="post" novalidate>
        <!-- nome -->
        <div>
            <label for="nome">Nome <span aria-hidden="true">*</span></label>
            <input id="nome" name="nome" type="text" maxlength="100" required />
        </div>

        <!-- editora -->
        <div>
            <label for="editora">Editora <span aria-hidden="true">*</span></label>
            <input id="editora" name="editora" type="text" maxlength="100" required />
        </div>

        <!-- ano (4 dígitos) -->
        <div>
            <label for="ano">Ano (AAAA) <span aria-hidden="true">*</span></label>
            <input id="ano" name="ano" type="text" inputmode="numeric"
                pattern="^\d{4}$" maxlength="4" placeholder="2024" required
                title="Digite um ano com 4 dígitos (ex: 2024)" />
        </div>

        <!-- idioma -->
        <div>
            <label for="idioma">Idioma <span aria-hidden="true">*</span></label>
            <input id="idioma" name="idioma" type="text" maxlength="100" required />
        </div>

        <!-- autor -->
        <div>
            <label for="autor">Autor <span aria-hidden="true">*</span></label>
            <input id="autor" name="autor" type="text" maxlength="100" required />
        </div>

        <!-- nome_alugado (aparece só se alugado = true) -->
        <div id="nomeAlugadoWrapper" style="display:none;">
            <label for="nome_alugado">Nome do locatário</label>
            <input id="nome_alugado" name="nome_alugado" type="text" maxlength="100" />
        </div>

        <!-- alugado_em (timestamp) -->
        <div id="alugadoEmWrapper" style="display:none;">
            <label for="alugado_em">Data/hora do empréstimo</label>
            <!-- datetime-local -> irá gerar "YYYY-MM-DDThh:mm" no cliente.
                No servidor converta para TIMESTAMP conforme timezone desejada. -->
            <input id="alugado_em" name="alugado_em" type="datetime-local" />
        </div>

        <div>
            <button type="submit">Salvar</button>
        </div>
        </form>

        <?php
        session_start();
        include "../conexao/conexao.php";
        header('Content-Type: application/json');

        // le os dados enviados no corpo (JSON)
        $data = json_decode(file_get_contents("php://input"), true);

        // valida se campo recebeu "titulo"
        if (!isset($data["titulo"]) || trim($data["titulo"]) === "") {
            http_response_code(400); // erro de requisição
            echo json_encode(["erro" => "Título inválido"]);
            exit;
        }

        $titulo = trim($data["titulo"]);

        // prepared statement
        $stmt = $conn->prepare("INSERT INTO livro (titulo) VALUES (?)");
        $stmt->bind_param("s", $titulo); // "s" = string; "i" = int

        if ($stmt->execute()) {
            echo json_encode([
                "id" => $stmt->insert_id,
                "titulo" => $titulo,
                "concluida" => 0
            ]);
        } else {
            http_response_code(500); // erro no servidor
            echo json_encode(["erro" => "Falha ao adicionar tarefa"]);
        }

        $stmt->close();
        $conn->close();
        ?>

    </main>
</body>
</html>

<?php
include "../conexao/conexao.php";

?>