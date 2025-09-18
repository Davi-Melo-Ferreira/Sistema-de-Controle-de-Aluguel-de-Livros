<?php
session_start();
require "usuarios.php";

$usuario = $_SESSION['usuario'];
$senha = $_SESSION['senha'];

print_r($usuario);
foreach($usuarios as $user){
    if ($user['usuario'] === $usuario && $user['senha'] === $senha){
        header("Location: ../public/index.php");
    } else{
        echo "Não deu certo";
    }
}
?>