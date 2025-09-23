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
        <form id="bookForm" method="POST" action="../api/adicionar.php" novalidate>
            <label for="campo">Livro:</label>
                <select name="nome_opcao" id="nome_opcao">
                    <option value="nome">Nome</option>
                    <option value="valor">Valor</option>
                    <option value="editora">Editora</option>
                    <option value="ano">Ano</option>
                    <option value="idioma">Idioma</option>
                    <option value="autor">Autor</option>
                </select>
            <script>
                fetch("../api/listar.php")
                .then(response => response.json())
                .then(data => {
                    const lista = document.getElementById("lista-livros");
                    data.forEach(livro => {
                    const li = document.createElement("li");
                    if (livro.alugado_livro == 1){
                        li.style.textDecoration = 'line-through';
                    }
                    li.textContent = `
                    - ID: ${livro.id_livro}
                    - Nome: ${livro.nome_livro}
                    - Valor: R$${livro.valor_livro}
                    - Editora: ${livro.editora_livro}
                    - Ano: ${livro.ano_livro}
                    - Idioma: ${livro.idioma_livro}
                    - Autor: ${livro.autor_livro}
                    - Alugado: ${livro.alugado_livro ? 'Sim' : 'Não'}`;
                    lista.appendChild(li);
                    });
                });
            </script>
            
        </form>
        <button type="button" onclick="window.location.href='../public/index.php'">Voltar</button>

    </main>
</body>
</html>