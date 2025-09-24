<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h1>Alugar Livro</h1>

    <main>
        <!-- Formulário para inserir registro na tabela de livros -->
        <form id="bookForm" method="POST" action="../api/alugar.php" novalidate>
            <label for="campo">Cliente:</label>
                <select name="cliente_opcao" id="cliente_opcao"></select>
                <script>
                    fetch("../api/usuarios.php")
                    .then(response => response.json())
                    .then(data => {
                        const selecao = document.getElementById("cliente_opcao");
                        data.forEach(cliente => {
                        const opcao = document.createElement("option");
                            opcao.textContent = `Nome: ${cliente.nome_cliente}`;
                            selecao.appendChild(opcao);
                        });
                    });
                </script>

            <label for="campo">Livro:</label>
                <select name="livro_opcao" id="livro_opcao"></select>
            <script>
                fetch("../api/listar.php")
                .then(response => response.json())
                .then(data => {
                    const selecao = document.getElementById("livro_opcao");
                    data.forEach(livro => {
                    const opcao = document.createElement("option");
                    if (livro.alugado_livro == 0){
                        opcao.textContent = `Nome: ${livro.nome_livro}`;
                        selecao.appendChild(opcao);
                    }
                    
                    });
                });
            </script>
            <input type="submit" value="Alugar Livro" name="alugar_livro">
            
        </form>
        <button type="button" onclick="window.location.href='../public/index.php'">Voltar</button>

        <h2>Registros</h2>
        
    </main>
</body>
</html>