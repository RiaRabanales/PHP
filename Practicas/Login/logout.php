<?php

// configuración de core:
include_once "admin/config/core.php";

// destruyo la sesión (y elimino todos los settings de sesión
session_destroy();

// redirecciono a la página login:
header("Location: ($home_url)login.php");
?>