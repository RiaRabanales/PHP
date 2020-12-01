<!-- Esto es la barra de navegación -->

<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container-fluid">

        <div class="navbar-header">
            <!-- esto para móvil -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- 'Yo' es mi site name -->
            <a class="navbar-brand" href="<?php echo $home_url; ?>">Yo</a>
        </div>

        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <!-- link a la página "Cart", highlight si la página actual es cart.php -->
                <li <?php echo $page_title == "Index" ? "class='active'" : ""; ?>>
                    <a href="<?php echo $home_url; ?>">Home</a>
                </li>
            </ul>

            <?php
            // veo si el usuario estaba logeado; si sí, enseño opciones de editar perfil, pedidos y logout
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true && $_SESSION['nivel_acceso'] == 'Customer') {
                ?>
                <ul class="nav navbar-nav navbar-right">
                    <li <?php echo $page_title == "Edit Profile" ? "class='active'" : ""; ?>>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            <?php echo $_SESSION['firstname']; ?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo $home_url; ?>logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
                <?php
            } else {
                // si no lo estaba, muestro lo que lo permite
                ?>
                <ul class="nav navbar-nav navbar-right">
                    <li <?php echo $page_title == "Login" ? "class='active'" : ""; ?>>
                        <a href="<?php echo $home_url; ?>login">
                            <span class="glyphicon glyphicon-log-in"></span> Log In
                        </a>
                    </li>

                    <li <?php echo $page_title == "Register" ? "class='active'" : ""; ?>>
                        <a href="<?php echo $home_url; ?>register">
                            <span class="glyphicon glyphicon-check"></span> Registro
                        </a>
                    </li>
                </ul>
                <?php
            }
            ?>

        </div><!--/.nav-collapse -->

    </div>
</div>

