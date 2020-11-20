<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PDO - Leer (CRUD)</title>

        <!-- Latest compiled and minified Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

        <!-- custom css -->
        <style>
            .m-r-1em{ margin-right:1em; }
            .m-b-1em{ margin-bottom:1em; }
            .m-l-1em{ margin-left:1em; }
            .mt0{ margin-top:0; }
        </style>

    </head>
    <body>

        <!-- Esta es la versión avanzada de practicabbdd: añade paginación y cambia código -->
        <div class="container">

            <div class="page-header">
                <h1>Ver productos</h1>
            </div>

            <?php
            include '../config/database_pag.php';

            //Aquí el prompt de confirmación de borrado, redirigido de delete.php
            $action = isset($_GET['action']) ? $_GET['action'] : "";
            if ($action == 'deleted') {
                echo "<div class='alert alert-success'>Producto eliminado.</div>";
            }

            //selecciono todos los datos:
            $query = "SELECT id, name, description, price FROM products ORDER BY id ASC "
                    . "LIMIT :resultado_inicial_en_pag, :resultados_por_pag";
            $statement = $pdo->prepare($query);
            $statement->bindParam(":resultado_inicial_en_pag", $resultado_inicial_en_pag, PDO::PARAM_INT);
            $statement->bindParam(":resultados_por_pag", $resultados_por_pag, PDO::PARAM_INT);
            $statement->execute();

            // calculo el número de filas que retorna
            $num = $statement->rowCount();

            // genero el link para crear nuevos productos
            echo "<a href='create.php' class='btn btn-primary m-b-1em'>Crear nuevo producto</a>";

            //si encuentra al menos un producto, me incluye los datos en la tabla que genero; sino me salta un aviso.
            if ($num > 0) {

                echo "<table class='table table-hover table-responsive table-bordered'>";       //creo la tabla con sus cabeceras
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Nombre</th>";
                echo "<th>Descripción</th>";
                echo "<th>Precio</th>";
                echo "<th>Acción</th>";
                echo "</tr>";

                // esto será el cuerpo de la tabla, con lo que recibo de mi consulta - uso fetch() porque es más rápido que fetchAll()
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    // con 'extract row' convierto '$row['firstname']' en sólo '$firstname
                    extract($row);

                    // creo una nueva fila en la tabla para cada producto
                    echo "<tr>";
                    echo "<td>{$id}</td>";
                    echo "<td>{$name}</td>";
                    echo "<td>{$description}</td>";
                    echo "<td>{$price}</td>";
                    echo "<td>";
                    // y genero los links de las acciones
                    echo "<a href='read_one.php?id={$id}' class='btn btn-info m-r-1em'>ver</a>";
                    echo "<a href='update.php?id={$id}' class='btn btn-primary m-r-1em'>editar</a>";
                    echo "<a href='#' onclick='delete_user({$id});'  class='btn btn-danger'>borrar</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";        //termino la tabla
                
                // aquí hago mis operaciones de paginación:
                $query = "SELECT COUNT(*) as cuenta FROM products";
                $statement = $pdo->prepare($query);
                $statement->execute();
                $fila = $statement->fetch(PDO::FETCH_ASSOC);
                $total_filas = $fila['cuenta'];
                
                $page_url = "index.php?";
                include_once "paging.php";
                
            } else {
                echo "<div class='alert alert-danger'>No se han encontrado productos.</div>";
            }
            ?>

            <!-- javascript para confirmar cuando borro -->
            <script type='text/javascript'>
                function delete_user(id) {

                    var answer = confirm('¿Estás seguro?');
                    if (answer) {
                        // si el usuario cloca ok, entonces llamo a delete.php con la id y ejecuto la query de delete
                        window.location = 'delete.php?id=' + id;
                    }
                }
            </script>

        </div> 

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

        <!-- Latest compiled and minified Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </body>
</html>
