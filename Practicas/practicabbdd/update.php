<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PDO - Update (CRUD)</title>
        <!-- Latest compiled and minified Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    </head>
    <body>
        <div class="container">

            <div class="page-header">
                <h1>Actualizar producto</h1>
            </div>

            <!-- Necesitaré pasarme por parámetro el ID del producto, como en read_one -->
            <?php
            $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

            include '../config/database.php';

            // y leo el record del id, lo guardo en la variable $row, y muestro
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

            //Luego aquí actualizo el record en la tabla, pero sólo si tengo el formulario;
            if ($_POST) {
                try {
                    $query = "UPDATE products 
					SET name=:name, description=:description, price=:price 
					WHERE id = :id";
                    $statement = $pdo->prepare($query);
                    $name = htmlspecialchars(strip_tags($_POST['name']));
                    $description = htmlspecialchars(strip_tags($_POST['description']));
                    $price = htmlspecialchars(strip_tags($_POST['price']));
                    // bindeo los parámetros y ejecuto la query
                    $statement->bindParam(':name', $name);
                    $statement->bindParam(':description', $description);
                    $statement->bindParam(':price', $price);
                    $statement->bindParam(':id', $id);
                    if ($statement->execute()) {
                        echo "<div class='alert alert-success'>Actualizado.</div>";
                    } else {
                        echo "<div class='alert alert-danger'>No actualizado.</div>";
                    }
                }
                catch (PDOException $ex) {
                    die('ERROR: ' . $ex->getMessage());
                }
            }
            ?>

            <!-- Aquí me incluyo estos datos en la página: -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}"); ?>" method="post">
                <table class='table table-hover table-responsive table-bordered'>
                    <tr>
                        <td>Nombre</td>
                        <td><input type='text' name='name' value="<?php echo htmlspecialchars($name, ENT_QUOTES); ?>" class='form-control' /></td>
                    </tr>
                    <tr>
                        <td>Descripción</td>
                        <td><textarea name='description' class='form-control'><?php echo htmlspecialchars($description, ENT_QUOTES); ?></textarea></td>
                    </tr>
                    <tr>
                        <td>Precio</td>
                        <td><input type='text' name='price' value="<?php echo htmlspecialchars($price, ENT_QUOTES); ?>" class='form-control' /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type='submit' value='Guardar cambios' class='btn btn-primary' />
                            <a href='index.php' class='btn btn-danger'>Volver a todos los productos</a>
                        </td>
                    </tr>
                </table>
            </form>

        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

        <!-- Latest compiled and minified Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </body>
</html>
