<!DOCTYPE HTML>
<html>
    <head>
        <title>PDO - Crear (CRUD)</title>

        <!-- Latest compiled and minified Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <!-- Latest compiled and minified Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>
    <body>

        <!-- container -->
        <div class="container">

            <div class="page-header">
                <h1>Crear producto</h1>
            </div>

            <?php
            //incluyo el archivo de configuracion de la bbdd:
            include '../config/database.php';

            //hago query: inserto, la preparo para ejecutar, veo valores de post, los bindeo, añado fecha, y ejecuto query

            try {
                $query = "INSERT INTO products SET name = :name, description=:description, price=:price, created=:created";
                $statement = $pdo->prepare($query);
                //con htmlsp y strip_tags hago el control de lo que recibo
                if (isset($name)) {
                    $name = htmlspecialchars(strip_tags($_POST['name']));
                }
                if (isset($description)) {
                    $description = htmlspecialchars(strip_tags($_POST['description']));
                }
                if (isset($price)) {
                    $price = htmlspecialchars(strip_tags($_POST['price']));
                }
                //y los bindeo:
                $statement->bindParam(':name', $name);
                $statement->bindParam(':description', $description);
                $statement->bindParam(':price', $price);
                //genero la fecha de creación:
                $created = date('Y-m-d H:i:s');
                $statement->bindParam(':created', $created);
                //ejecuto la query:
                if ($statement->execute()) {
                    echo "<div class='alert alert-success'>Creado.</div>";
                } else {
                    echo "<div class='alert alert-danger'>No creado.</div>";            //OJO esto me sale tb al principio porq no hay nada
                }
            } catch (Exception $ex) {
                //con die mato la ejecución del script
                die('ERROR: ' . $ex->getMessage());
            }
            ?>

            <!-- formulario html para introducir la info del producto -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <table class='table table-hover table-responsive table-bordered'>
                    <tr>
                        <td>Nombre</td>
                        <td><input type='text' name='name' class='form-control' /></td>
                    </tr>
                    <tr>
                        <td>Descripción</td>
                        <td><textarea name='description' class='form-control'></textarea></td>
                    </tr>
                    <tr>
                        <td>Precio</td>
                        <td><input type='text' name='price' class='form-control' /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type='submit' value='guardar' class='btn btn-primary' />
                            <a href='index.php' class='btn btn-danger'>volver a ver productos</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>

    </body>
</html>
