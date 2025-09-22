<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Lista de Livros</title>
</head>
<body>
  <h1>Livros cadastrados</h1>
  <ul id="lista-livros"></ul>
  <form method="POST">
        <input type="submit" name="adicionar" value="Adicionar">

        <input type="submit" name="editar" value="Editar">

        <input type="submit" name="deletar" value="Deletar">

        <input type="submit" name="voltar" value="Voltar">
        <?php
            if (isset($_POST['voltar'])){
                session_destroy();
                header("Location: ../public/index.php");
            }
            if (isset($_POST['adicionar'])){
                header("Location: ../api/adicionar.php");
            }
            if (isset($_POST['editar'])){
                header("Location: ../api/editar.php");
            }
            if (isset($_POST['deletar'])){
                header("Location: ../api/deletar.php");
            }
        ?>
    </form>

  <script>
    fetch("api/listar_livros.php")
      .then(response => response.json())
      .then(data => {
        const lista = document.getElementById("lista-livros");

        data.forEach(livro => {
          const li = document.createElement("li");
          li.textContent = `${livro.nome_livro} - R$${livro.valor_livro}`;
          lista.appendChild(li);
        });
      })
      .catch(error => console.error("Erro ao buscar livros:", error));
  </script>
</body>
</html>