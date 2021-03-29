<?php

$host = "localhost";
$user = "root";
$pwd = "";
$db = "alunos";

$conn = new mysqli($host, $user, $pwd, $db);

$error = mysqli_connect_errno();
if($error){
    echo "Erro ao tentar se conectar com o banco de dados $error";
    exit();
}
