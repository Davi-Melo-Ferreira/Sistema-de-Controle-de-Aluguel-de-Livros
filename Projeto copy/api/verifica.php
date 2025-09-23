<?php
session_start();
require "usuarios.php";

$usuario = $_SESSION['usuario'];
$senha = $_SESSION['senha'];

foreach($usuarios as $user){
    if ($user['usuario'] === $usuario && $user['senha'] === $senha){
        header("Location: ../public/index.php");
    } else{
        echo "<p>Usuário ou senha inválidos. Tente novamente.</p>";
        echo "<a href='login.php'>Voltar para a página de login</a>";
        session_destroy();
    }
}
?>