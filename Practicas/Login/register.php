<?php
//Core, título de página, login-checker y clases:
include_once "admin/config/core.php";
$page_title = "Register";
include_once "login_checker.php";
include_once 'admin/config/database.php';
include_once 'objects/user.php';
include_once "libs/php/utils.php";

// incluyo header aquí y footer al final:
include_once "layout_head.php";

echo "<div class='col-md-12'>";

//Si he enviado el formulario:
if ($_POST) {

    // tomo la conexiónn de la base de datos:
    $database = new Database();
    $db = $database->getConnection();

    // inicializo los objetos:
    $user = new User($db);
    $utils = new Utils();

    // trabajo con el email: lo seteo y compruebo si existe; si no existe creo usuario
    $user->email = $_POST['email'];
    if ($user->emailExists()) {
        echo "<div class='alert alert-danger'>";
        echo "Este email ya está registrado. Prueba de nuevo o haz <a href='{$home_url}login'>login.</a>";
        echo "</div>";
    } else {
        // creo el nuevo usuario:
        // 1º. setelo los valores como propiedades del objeto
        $user->firstname = $_POST['firstname'];
        $user->lastname = $_POST['lastname'];
        $user->contact_number = $_POST['contact_number'];
        $user->address = $_POST['address'];
        $user->password = $_POST['password'];
        $user->access_level = 'Customer';
        $user->status = 1;

        // 2º. creo el usuario
        if ($user->create()) {
            echo "<div class='alert alert-info'>";
            echo "Registro con éxito. <a href='{$home_url}login'>Haz login</a>.";
            echo "</div>";

            // y vacío los valores posteados.
            $_POST = array();
        } else {
            echo "<div class='alert alert-danger' role='alert'>Registro imposible. Prueba de nuevo.</div>";
        }
    }
}
?>
<form action='register.php' method='post' id='register'>

    <table class='table table-responsive'>

        <tr>
            <td class='width-30-percent'>Nombre</td>
            <td><input type='text' name='firstname' class='form-control' required value="<?php echo isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname'], ENT_QUOTES) : ""; ?>" /></td>
        </tr>

        <tr>
            <td>Apellido</td>
            <td><input type='text' name='lastname' class='form-control' required value="<?php echo isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname'], ENT_QUOTES) : ""; ?>" /></td>
        </tr>

        <tr>
            <td>Teléfono de contacto</td>
            <td><input type='text' name='contact_number' class='form-control' required value="<?php echo isset($_POST['contact_number']) ? htmlspecialchars($_POST['contact_number'], ENT_QUOTES) : ""; ?>" /></td>
        </tr>

        <tr>
            <td>Dirección</td>
            <td><textarea name='address' class='form-control' required><?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address'], ENT_QUOTES) : ""; ?></textarea></td>
        </tr>

        <tr>
            <td>Email</td>
            <td><input type='email' name='email' class='form-control' required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES) : ""; ?>" /></td>
        </tr>

        <tr>
            <td>Contraseña</td>
            <td><input type='password' name='password' class='form-control' required id='passwordInput'></td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-plus"></span> Registrar
                </button>
            </td>
        </tr>

    </table>
</form>
<?php
echo "</div>";

include_once "layout_foot.php";
?>