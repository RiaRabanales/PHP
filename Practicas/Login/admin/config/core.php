<?php
// para mostrar errores:
error_reporting(E_ALL);

// con esto empiezo la sesión php:
session_start();

// situo mi timezone:
date_default_timezone_set('Europe/Paris');

// defino el url de mi homepage:
$home_url="http://localhost/Login/";

// página dada en parámetro URL; la página default is 1
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// limito el número de records por página
$records_per_page = 5;

// cálculo para query LIMIT
$from_record_num = ($records_per_page * $page) - $records_per_page;
?>