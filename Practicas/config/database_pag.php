<?php
// con esto conecto a mi base de datos
$host = "localhost";
$db_name = "php_beginner_crud_level_1";
$username = "riarabanales";
$password = "alualualu";

// siempre pongo la conexión dentro de un try-catch por controlar errores
try {
    $pdo = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
} catch (PDOException $pdoex) {
    echo "Error de conexión: " . $pdoex->getMessage();
}

//con esto cambio mis variables de paginación:
if (isset($_GET['page'])){
    $pagina = $_GET['page'];
} else {
    $pagina = 1;
}
// esto es lo mismo que:
// $page = isset($_GET['page']) ? $_GET['page'] : 1;

$resultados_por_pag = 5;
$resultado_inicial_en_pag = ($resultados_por_pag * $pagina) - $resultados_por_pag;