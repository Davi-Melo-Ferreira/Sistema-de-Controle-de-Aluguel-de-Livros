<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Lista de clientes</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <h1>clientes</h1>
  <!-- Formulário para inserir registro na tabela de clientes -->
  <form id="bookForm" method="POST" action="../api/adicionar_clientes.php" novalidate>
    <h3>Adicionar cliente</h3>
      <!-- nome -->
      <div>
          <label for="nome">Nome</label>
          <input id="nome" name="nome" type="text" required />
      </div>

      <!-- email -->
      <div>
          <label for="email">Email</label>
          <input id="email" name="email" type="text" required />
      </div>

      <!-- endereco -->
      <div>
          <label for="endereco">Endereço</label>
          <input id="endereco" name="endereco" type="text" required />
      </div>
      
      <div id="btncliente">
          <button type="submit" name="cadastrar">Adicionar</button>
      </div>
  </form>
  <table border="1" cellpadding="5" cellspacing="0" id="tabela-clientes">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Endereço</th>
        <th>Ação</th>
      </tr>
    </thead>
    <tbody id="corpo-clientes"></tbody>
  </table>
  <button type="button" onclick="window.location.href='../public/index.php'">Voltar</button>

  <script>
    fetch("../api/clientes.php")
      .then(response => response.json())
      .then(data => {
        const corpo = document.getElementById("corpo-clientes");
        corpo.innerHTML = '';
        data.forEach(cliente => {
          const tr = document.createElement("tr");
          tr.innerHTML = `
            <td>${cliente.id_cliente}</td>
            <td>${cliente.nome_cliente}</td>
            <td>${cliente.email_cliente}</td>
            <td>${cliente.endereco_cliente}</td>
            <td></td>
          `;
          // Botão Deletar
          const btnDeletar = document.createElement("button");
          btnDeletar.textContent = "Deletar";
          btnDeletar.onclick = () => {
            if (confirm("Tem certeza que deseja deletar este cliente?")) {
              fetch("../api/deletar_cliente.php", {
                method: "POST",
                headers: {
                  "Content-Type": "application/json"
                },
                body: JSON.stringify({ id: cliente.id_cliente })
              })
              .then(response => response.json())
              .then(result => {
                if (result.success) {
                  tr.remove();
                } else {
                  alert("Erro ao deletar cliente: " + (result.message || "Tente novamente."));
                }
              })
              .catch(() => {
                alert("Erro de conexão ao deletar cliente.");
              });
            }
          };
          tr.querySelector('td:last-child').appendChild(btnDeletar);
          corpo.appendChild(tr);
        });
      })
      .catch(error => console.error("Erro ao buscar clientes:", error));
  </script>
</body>
</html>