<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Editar Livro</h1>
    <main>
        <!-- Formulário para inserir registro na tabela de livros -->
        <form id="bookForm" method="POST" action="../api/editar.php" novalidate>
            <!-- nome -->
            <div>
                <label for="nome">Nome</label>
                <input id="nome" name="nome" type="text" required />
            </div>

            <!-- valor -->
            <div>
                <label for="valor">Valor</label>
                <input id="valor" name="valor" type="number" step="0.01" required />

            </div>

            <!-- editora -->
            <div>
                <label for="editora">Editora</label>
                <input id="editora" name="editora" type="text" required />
            </div>

            <!-- ano -->
            <div>
                <label for="ano">Ano</label>
                <input id="ano" name="ano" type="number" maxlength="4" required />
            </div>

            <!-- idioma -->
            <div>
                <label for="idioma">Idioma</label>
                <input id="idioma" name="idioma" type="text" required />
            </div>

            <!-- autor -->
            <div>
                <label for="autor">Autor</label>
                <input id="autor" name="autor" type="text" required />
            </div>
            
            <div>
                <button type="submit" name="cadastrar">Salvar</button>
            </div>
        </form>
        <button type="button" onclick="window.location.href='../public/index.php'">Voltar</button>

    </main>
</body>
</html>