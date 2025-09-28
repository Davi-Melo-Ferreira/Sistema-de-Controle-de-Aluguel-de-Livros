<?php
include "../conexao/conexao.php";

// pega lista de clientes
$clientes = $conn->query("SELECT id_cliente, nome_cliente FROM clientes ORDER BY nome_cliente");

// pega lista de livros
$livros = $conn->query("SELECT id_livro, nome_livro FROM livros ORDER BY nome_livro");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/style.css">
  <title>Cadastrar Aluguel</title>
</head>
<body>
  <h1>Novo Aluguel</h1>
  <form action="../api/registrar_aluguel.php" method="POST">
    <label for="id_cliente">Cliente:</label>
    <select name="id_cliente" id="id_cliente" required>
      <option value="">Selecione um cliente</option>
      <?php while($c = $clientes->fetch_assoc()): ?>
        <option value="<?= $c['id_cliente'] ?>"><?= htmlspecialchars($c['nome_cliente']) ?></option>
      <?php endwhile; ?>
    </select>
    <br><br>

    <label for="id_livro">Livro:</label>
    <select name="id_livro" id="id_livro" required>
      <option value="">Selecione um livro</option>
      <?php while($l = $livros->fetch_assoc()): ?>
        <option value="<?= $l['id_livro'] ?>"><?= htmlspecialchars($l['nome_livro']) ?></option>
      <?php endwhile; ?>
    </select>
    <br><br>

    <button type="submit">Registrar Aluguel</button>
    </form>
    <h2>Registros</h2>

    <table border="1" cellpadding="5" cellspacing="0" id="tabela-registros">
      <thead>
        <tr>
          <th>ID</th>
          <th>Cliente</th>
          <th>Livro</th>
          <th>Data Aluguel</th>
          <th>Prazo Devolução</th>
          <th>Data Devolução</th>
          <th>Taxa Atraso</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody id="corpo-tabela"></tbody>
    </table>
    <button type="button" onclick="window.location.href='../public/index.php'">Voltar</button>

    <script>
    // Busca todos os registros de alugueis
    async function carregarRegistros() {
      const res = await fetch('../api/registros.php');
      const registros = await res.json();
      const corpo = document.getElementById('corpo-tabela');
      corpo.innerHTML = '';
      registros.forEach(registro => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${registro.id_aluguel}</td>
          <td>${registro.nome_cliente}</td>
          <td>${registro.nome_livro}</td>
          <td>${registro.data_aluguel}</td>
          <td>${registro.prazo_devolucao}</td>
          <td>${registro.data_devolucao || '---'}</td>
          <td>R$ ${registro.taxa_atraso}</td>
          <td></td>
        `;
        if (!registro.data_devolucao) {
          const btnRegistrar = document.createElement('button');
          btnRegistrar.textContent = 'Registrar Devolução';
          btnRegistrar.onclick = async () => {
            await fetch('../api/registrar_taxa.php', {
              method: 'POST',
              headers: { 'Content-Type': 'application/json' },
              body: JSON.stringify({ id_aluguel: registro.id_aluguel })
            });
            carregarRegistros();
          };
          tr.querySelector('td:last-child').appendChild(btnRegistrar);
        }
        corpo.appendChild(tr);
      });
    }
    carregarRegistros();
    </script>
  </main>
</body>
</html>