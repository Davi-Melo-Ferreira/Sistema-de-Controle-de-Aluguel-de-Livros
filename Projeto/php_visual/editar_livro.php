<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Livro</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include '../php_visual/nav.php'; ?>
    <h1>Editar Livro</h1>
    <main>
        <div id="dadosLivro">
            <h3>Dados atuais do livro:</h3>
            <a id="resultado" name="resultado">
            <?php
            include("../conexao/conexao.php");
            if (isset($_GET['id'])) {
                $id = intval($_GET['id']);
                $sql = "SELECT * FROM livros WHERE id_livro = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($livro = $result->fetch_assoc()) {
                    echo '<table border="1">'
                        . '<tr><th>Campo</th><th>Valor</th></tr>'
                        . '<tr><td>Id</td><td>' . $livro['id_livro'] . '</td></tr>'
                        . '<tr><td>Nome</td><td>' . htmlspecialchars($livro['nome_livro']) . '</td></tr>'
                        . '<tr><td>Valor</td><td>R$' . $livro['valor_livro'] . '</td></tr>'
                        . '<tr><td>Editora</td><td>' . htmlspecialchars($livro['editora_livro']) . '</td></tr>'
                        . '<tr><td>Idioma</td><td>' . htmlspecialchars($livro['idioma_livro']) . '</td></tr>'
                        . '<tr><td>Autor</td><td>' . htmlspecialchars($livro['autor_livro']) . '</td></tr>'
                        . '<tr><td>Alugado</td><td>' . ($livro['alugado_livro'] ? 'Sim' : 'Não') . '</td></tr>'
                        . '</table>';
                } else {
                    echo "Livro não encontrado.";
                }
                $stmt->close();
                $conn->close();
            } else {
                echo "ID do livro não informado.";
            }
            ?>
            </a>
        <!-- Formulário para editar registro na tabela de livros -->
        <form id="bookForm" method="POST" action="../api/editar/editar_livro.php" novalidate>
            <div>
                <label for="campo">Campo:</label>
                <input id="campo" name="campo" type="text" required />
                <select name="nome_opcao" id="nome_opcao">
                    <option value="nome">Nome</option>
                    <option value="valor">Valor</option>
                    <option value="editora">Editora</option>
                    <option value="ano">Ano</option>
                    <option value="idioma">Idioma</option>
                    <option value="autor">Autor</option>
                </select>
            </div>
            <div>
                <button type="submit" name="editar" value="<?php echo isset($id) ? $id : ''; ?>">Editar</button>
            </div>
        </form>
        <button type="button" onclick="window.location.href='../public/index.php'">Voltar</button>
    </main>
    <?php include '../php_visual/footer.php'; ?>
</body>
</html>