<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Título de página + SEO -->
        <title><?php echo isset($page_title) ? strip_tags($page_title) : "Tienda"; ?></title>

        <!-- Bootstrap CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen" />

        <!-- admin custom CSS -->
        <link href="libs/css/customer.css" rel="stylesheet" />

    </head>
    <body>

        <!-- incluyo la navbar -->
        <?php include_once 'navigation.php'; ?>

        <!-- container -->
        <div class="container">

            <?php
            // si el título de la página es login no lo quiero mostrar
            if ($page_title != "Login") {
                ?>
                <div class='col-md-12'>
                    <div class="page-header">
                        <h1><?php echo isset($page_title) ? $page_title : "Tutorial de Login por MRG"; ?></h1>
                    </div>
                </div>
                <?php
            }
            ?>