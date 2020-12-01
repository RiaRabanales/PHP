<?php
//Este es el archivo de conexión pre-paginación; lo guardo e incluyo para aclararme.

//con esto conecto a mi base de datos
$host = "localhost";
$db_name = "php_beginner_crud_level_1";
$username = "riarabanales";
$password = "alualualu";

//siempre pongo la conexión dentro de un try-catch por controlar errores
try {
    $pdo = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
} catch (PDOException $pdoex) {
    echo "Error de conexión: " . $pdoex->getMessage();
}

