<?php

/*
 * Esto me comprueba si un usuario está logeado; si no, me lleva al login.
 */

// aquí compruebo que no tenga nivel de acceso 'Admin' y redirecciono:
if (isset($_SESSION['access_level']) && $_SESSION['access_level'] == "Admin") {
    header("Location: {$home_url}admin/index.php?action=logged_in_as_admin");
} else if (isset($require_login) && $require_login == true) {
    // si hay $require_login y el valor es true
    // pero si el user no esta logueado le redirecciono a la pagina de login
    if (!isset($_SESSION['access_level'])) {
        header("Location: {$home_url}login.php?action=please_login");
    }
} else if (isset($page_title) && ($page_title == "Login" || $page_title == "Sign Up")) {
    // si ha entrado en la página de login o registrar pero ya estaba logueado:
    if (isset($_SESSION['access_level']) && $_SESSION['access_level'] == "Customer") {
        header("Location: {$home_url}index.php?action=already_logged_in");
    }
} else {
    // no hago nada, me quedo en esta página
}

?>
