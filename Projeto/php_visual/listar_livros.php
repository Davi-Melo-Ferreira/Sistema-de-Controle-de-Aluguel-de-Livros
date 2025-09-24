<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Lista de Livros</title>
</head>
<body>
  <h1>Livros</h1>
  <!-- Formulário para inserir registro na tabela de livros -->
  <form id="bookForm" method="POST" action="../api/adicionar.php" novalidate>
    <h3>Adicionar Livro</h3>
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
      
      <div id="botao">
          <button type="submit" name="cadastrar">Adicionar</button>
      </div>
  </form>
  <ul id="lista-livros"></ul>
  <button type="button" onclick="window.location.href='../public/index.php'">Voltar</button>

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


          // Botão Alugar
          const btnAlugar = document.createElement("button");
          if (livro.alugado_livro == 1){
              btnAlugar.textContent = "Indisponível";
              btnAlugar.setAttribute('type', 'button');
          } else{
              btnAlugar.textContent = "Alugar";
              btnAlugar.onclick = () => {
                if (confirm("Tem certeza que deseja alugar este livro?")) {
                  window.location.href = `alugar_livro.php?id=${livro.id_livro}`;
                }
              };
          }
          

          // Botão Editar
          const btnEditar = document.createElement("button");
          btnEditar.textContent = "Editar";
          btnEditar.onclick = () => {
            if (confirm("Tem certeza que deseja editar este livro?")) {
              window.location.href = `editar_livro.php?id=${livro.id_livro}`;
            }
          };

          // Botão Deletar
          const btnDeletar = document.createElement("button");
          btnDeletar.textContent = "Deletar";
          btnDeletar.onclick = () => {
            if (confirm("Tem certeza que deseja deletar este livro?")) {
              fetch("../api/deletar.php", {
                method: "POST",
                headers: {
                  "Content-Type": "application/json"
                },
                body: JSON.stringify({ id: livro.id_livro })
              })
              .then(response => response.json())
              .then(result => {
                if (result.success) {
                  li.remove();
                } else {
                  alert("Erro ao deletar livro: " + (result.message || "Tente novamente."));
                }
              })
              .catch(() => {
                alert("Erro de conexão ao deletar livro.");
              });
            }
          };

          li.appendChild(btnAlugar);
          li.appendChild(btnEditar);
          li.appendChild(btnDeletar);
          lista.appendChild(li);
        });
      })
      .catch(error => console.error("Erro ao buscar livros:", error));
  </script>
</body>
</html>