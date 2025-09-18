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
    <h1>Bem-Vindo ao Vila-Leste</h1>
    <form method="POST">
            <label for="sair">Sair?</label>
            <input type="submit" name="sair" value="Sair">
    </form>
    <?php
    if (isset($_POST['sair'])){
        session_destroy();
        header("Location: ../api/login.php");
    }
    ?>
</body>
</html>