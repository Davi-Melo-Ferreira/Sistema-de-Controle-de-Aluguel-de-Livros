<?php
session_start();
if (!isset($_SESSION['usuario'])){
    Header("Location: ../api/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Vila-Leste</h1>
    <form method="POST">
        <input type="submit" name="adicionar" value="Adicionar">

        <input type="submit" name="listar" value="Livros">

        <input type="submit" name="alugar" value="Alugueis">

        <input type="submit" name="sair" value="Sair">
    </form>
    <?php
    if (isset($_POST['sair'])){
        session_destroy();
        header("Location: ../api/login.php");
    }
    if (isset($_POST['adicionar'])){
        header("Location: ../php_visual/cadastrar_livro.php");
    }
    if (isset($_POST['listar'])){
        header("Location: ../php_visual/listar_livros.php");
    }
    if (isset($_POST['alugar'])){
        header("Location: ../php_visual/alugar_livro.php");
    }
    ?>
</body>
</html>