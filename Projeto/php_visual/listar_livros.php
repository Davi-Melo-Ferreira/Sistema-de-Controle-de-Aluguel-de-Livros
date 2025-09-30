<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Lista de Livros</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <?php include '../php_visual/nav.php'; ?>
  <h1>Livros</h1>
  <!-- Formulário para inserir registro na tabela de livros -->
  <form id="bookForm" method="POST" action="../api/adicionar/adicionar_livro.php" novalidate>
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
  <table border="1" cellpadding="5" cellspacing="0" id="tabela-livros">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Valor</th>
        <th>Editora</th>
        <th>Ano</th>
        <th>Idioma</th>
        <th>Autor</th>
        <th>Alugado</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody id="corpo-livros"></tbody>
  </table>
  <button type="button" onclick="window.location.href='../public/index.php'">Voltar</button>

  <script>
    fetch("../api/listar/listar_livros.php")
      .then(response => response.json())
      .then(data => {
        const corpo = document.getElementById("corpo-livros");
        corpo.innerHTML = '';
        data.forEach(livro => {
          const tr = document.createElement("tr");
          if (livro.alugado_livro == 1){
              tr.style.textDecoration = 'line-through';
          }
          tr.innerHTML = `
            <td>${livro.id_livro}</td>
            <td>${livro.nome_livro}</td>
            <td>R$${livro.valor_livro}</td>
            <td>${livro.editora_livro}</td>
            <td>${livro.ano_livro}</td>
            <td>${livro.idioma_livro}</td>
            <td>${livro.autor_livro}</td>
            <td>${livro.alugado_livro ? 'Sim' : 'Não'}</td>
            <td></td>
          `;
          // Botão Alugar
          const btnAlugar = document.createElement("button");
          if (livro.alugado_livro == 1){
              btnAlugar.textContent = "Indisponível";
              btnAlugar.setAttribute('class', 'btn-dark white');
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
              fetch("../api/deletar/deletar_livro.php", {
                method: "POST",
                headers: {
                  "Content-Type": "application/json"
                },
                body: JSON.stringify({ id: livro.id_livro })
              })
              .then(response => response.json())
              .then(result => {
                if (result.success) {
                  tr.remove();
                } else {
                  alert("Erro ao deletar livro: " + (result.message || "Tente novamente."));
                }
              })
            }
          };
          tr.querySelector('td:last-child').appendChild(btnAlugar);
          tr.querySelector('td:last-child').appendChild(btnEditar);
          tr.querySelector('td:last-child').appendChild(btnDeletar);
          corpo.appendChild(tr);
        });
      })
      .catch(error => console.error("Erro ao buscar livros:", error));
  </script>
  <?php include '../php_visual/footer.php'; ?>
</body>
</html>