<?php

// Usado para se conectar com o banco de dados
$host = "localhost";
$db_name = "php_beginner_crud_level_1";
$username = "root";
$password = "";

try {
    $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
}
// Mostrar erro
catch(PDOException $exception){
    echo "Conexao falhou: " . $exception->getMessage();

}
?>