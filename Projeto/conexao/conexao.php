<?php
$host = "localhost";
$user = "root";
$pass = "1234";
$db = "davi_livraria_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_errno){
    die("Erro na conexão" . mysqli_connect_error());
} else{
    echo "Banco de dados carregado com sucesso";
}
?>