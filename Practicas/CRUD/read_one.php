<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PDO - Leer uno (CRUD)</title>

        <!-- Latest compiled and minified Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    </head>
    <body>

        <div class="container">

            <div class="page-header">
                <h1>Ver producto</h1>
            </div>

            <?php
            // Tengo que recibir un parámetro (el ID), y compruebo si lo tengo con isset()
            // If if isset tomo id, else doy error y mato el script.
            $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: ID no encontrado.');

            include '../config/database_pag.php';

            // leo los datos del id, bindeo el parámetro, ejecuto la query, la guardo en una variable y la paso a mi formulario.
            try {
                $query = "SELECT id, name, description, price FROM products WHERE id = ? LIMIT 0,1";
                $statement = $pdo->prepare($query);
                $statement->bindParam(1, $id);
                $statement->execute();
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                $name = $row['name'];
                $description = $row['description'];
                $price = $row['price'];
            } catch (PDOException $ex) {
                die('ERROR: ' . $ex->getMessage());
            }
            ?>

            <!-- Y aquí genero mi tabla para mostrar lo anterior -->
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Nombre</td>
                    <td><?php echo htmlspecialchars($name, ENT_QUOTES); ?></td>
                </tr>
                <tr>
                    <td>Descripción</td>
                    <td><?php echo htmlspecialchars($description, ENT_QUOTES); ?></td>
                </tr>
                <tr>
                    <td>Precio</td>
                    <td><?php echo htmlspecialchars($price, ENT_QUOTES); ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <a href='index.php' class='btn btn-danger'>Volver a todos los productos</a>
                    </td>
                </tr>
            </table>

        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

        <!-- Latest compiled and minified Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </body>
</html>
