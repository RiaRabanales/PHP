<?php

//Tutorial en: https://codeofaninja.com/2013/03/php-login-script.html
// Voy por 8.1; revisado hasta 7.10
// incluyo el core:
include_once "admin/config/core.php";

// pongo el título de la página:
$page_title = "Index";

// incluyo el login checker:
$require_login = true;
include_once "login_checker.php";

//incluyo header y a final footer:
include_once "layout_head.php";

// y aquí pongo el desarrollo de la página:
echo "<div class='col-md-12'>";

// para evitarme que el index me salga undefined:
$action = isset($_GET['action']) ? $_GET['action'] : "";

// si he hecho login bien:
if ($action == 'login_success') {
    echo "<div class='alert alert-info'>";
    echo "<strong>Hola " . $_SESSION['firstname'] . ", bienvenido de vuelta</strong>";
    echo "</div>";
}

// si el usuario ya había hecho log in:
else if ($action == 'already_logged_in') {
    echo "<div class='alert alert-info'>";
    echo "<strong>Ya has hecho log in.</strong>";
    echo "</div>";
}

// aquí el contenido cuando se haya hecho log in:
echo "<div class='alert alert-info'>";
echo "Aquí irá el contenido cuando se haya hecho log in.";
echo "</div>";

echo "</div>";

include_once "layout_foot.php";
?>
