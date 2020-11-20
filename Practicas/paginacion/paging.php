<?php

// aquí genero una lista con las opciones de paginación
echo "<ul class='pagination pull-left margin-zero mt0'>";

// botón de la primera página
if ($pagina > 1) {
    $prev_pag = $pagina - 1;
    echo "<li>";
    echo "<a href='{$page_url}page={$prev_pag}'>";
    echo "<span style='margin:0 .5em;'>«</span>";
    echo "</a>";
    echo "</li>";
}

// números de página que puedo clicar
$total_pags = ceil($total_filas / $resultados_por_pag);
$rango = 1;           // rango de links que quiero mostrar
$num_inicial = $pagina - $rango;
$num_limite_for = ($pagina + $rango) + 1;

for ($i = $num_inicial; $i < $num_limite_for; $i++) {
    // sólo lo quiero imprimir si tiene sentido hacerlo: pág > 0 o < máx
    if (($i > 0) && ($i <= $total_pags)) {
        // con esto imprimo las páginas de alrededor:
        if ($i != $pagina) {
            echo "<li>";
            echo " <a href='{$page_url}page={$i}'>{$i}</a> ";
            echo "</li>";
        } else {        //y con esto la página activa:
            echo "<li class='active'>";
            echo "<a href='javascript::void();'>{$i}</a>";      // no quiero que me siga link a otro punto
            echo "</li>";
        }
    }
}

// botón de la última página
if ($pagina < $total_pags) {
    $sig_pag = $pagina + 1;
    echo "<li>";
    echo "<a href='{$page_url}page={$sig_pag}'>";
    echo "<span style='margin:0 .5em;'>»</span>";
    echo "</a>";
    echo "</li>";
}

echo "</ul>";
?>