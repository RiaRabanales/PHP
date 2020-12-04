<?php

// incluyo el core
include_once "admin/config/core.php";

// título de página
$page_title = "Login";

// incluyo el check de login, con default en false
$require_login = false;
include_once "login_checker.php";
$access_denied = false;


// si el usuario envía el formulario login:
if ($_POST) {

    // Aquí compruebo el email:
    // primero incluyo las clases:
    include_once "admin/config/database.php";
    include_once "objects/user.php";

    // instancio la conexión a la base de datos e inicializo objeto User
    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);

    // compruebo contra la BD: si están nombre/usuario y si existe el mail tomo los detalles del usuario
    $user->email = $_POST['email'];
    $email_exists = $user->emailExists();

    // Aquí va la validación de credenciales: si $email_exists es true, la contraseña coincide; user_status = 1 y user = verificado
    if ($email_exists && password_verify($_POST['password'], $user->password) && $user->status == 1) {

        // si se cumple esto pongo session_value en true y ambio los valores de la sesión
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $user->id;
        $_SESSION['access_level'] = $user->access_level;
        $_SESSION['firstname'] = htmlspecialchars($user->firstname, ENT_QUOTES, 'UTF-8');
        $_SESSION['lastname'] = $user->lastname;

        // si el nivel de acceso es Admin debo redireccionar a la sesión de admi
        if ($user->access_level == 'Admin') {
            header("Location: {$home_url}admin/index.php?action=login_success");
            // y si no, sigo con redirección a la sección de customer
        } else {
            header("Location: {$home_url}index.php?action=login_success");
        }

        // pero si no coincide usuario-contraseña o el usuario no existe:
    } else {
        $access_denied = true;
    }
}

// incluyo una vez header y otra footer al final
include_once "layout_head.php";

echo "<div class='col-sm-6 col-md-4 col-md-offset-4'>";

// mensajes de alerta según lo que haga el usuario:
// primero tengo que tomar el valor de 'action' en el url:
$action = isset($_GET['action']) ? $_GET['action'] : "";

//luego le digo al usuario qué pasa: si no esta logueado...
if ($action == 'not_yet_logged_in') {
    echo "<div class = 'alert alert-danger margin-top-40' role = 'alert'>
            Log in, por favor.
            </div>";

    // ...si tiene que hacer log in...
} else if ($action == 'please_login') {
    echo "<div class = 'alert alert-info'>
            <strong>Tienes que hacer log in para acceder a esta página.</strong>
            </div>";

    // ...si he verificado el email:
} else if ($action == 'email_verified') {
    echo "div class = 'alert alert-success'>
            <strong>Se ha validado tu dirección de e-mail.</strong>
            </div>";
}

// Y por último si le deniego el acceso:
if ($access_denied) {
    echo "<div class = 'alert alert-danger margin-top-40' role = 'alert'>
            Acceso Denegado.<br/><br/>
            Usuario o contraseña incorrectos.
            </div>";
}

// formulario HTML
echo "<div class = 'account-wall'>";
echo "<div id = 'my-tab-content' class = 'tab-content'>";
echo "<div class = 'tab-pane active' id = 'login'>";
echo "<img class = 'profile-img' src = 'admin/images/login-icon.jpg' ";
echo "<form class='form-signin' action = '" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method = 'post'>";
echo "<input type = 'text' name = 'email' class = 'form-control' placeholder = 'Email' required autofocus />";
echo "<input type = 'password' name = 'password' class = 'form-control' placeholder = 'Password' required />";
echo "<input type = 'submit' class = 'btn btn-lg btn-primary btn-block' value = 'Log In' />";
echo "</form>";
echo "</div>";
echo "</div>";
echo "</div>";

echo "</div>";

include_once "layout_foot.php";
?>
