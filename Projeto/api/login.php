<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Login</h1>
    <main>
        <form method="POST">
            <label for="usuario">Usuário:</label><br>
            <input type="text" id="usuario" name="usuario" required><br>

            <label for="senha">Senha:</label><br>
            <input type="password" id="senha" name="senha" required><br>

            <p id="verificacao" name="verificacao"></p>
            <script>
                const response = await fetch("verifica.php");
                const data = await response.json();
                if (data.sucesso) {
                    window.location.href = 'index.php';
                } else {
                    document.getElementById('verificacao');
                }
            </script>

            <input type="submit" name="enviar" value="Entrar"><br>
        </form>
        <?php
        session_start();
        if (isset($_SESSION['usuario'])){
            header("Location: ../public/index.php");
        }
        if (isset($_POST['enviar'])){
            $_SESSION['usuario'] = $_POST['usuario'];
            $_SESSION['senha'] = $_POST['senha'];
            header("Location: verifica.php");
        }
        ?>
    </main>
</body>
</html>