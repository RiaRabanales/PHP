<?php

include '../config/database.php';

try {

    // recibo el ID
    $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: falta ID.');

    $query = "DELETE FROM products WHERE id = ?";
    $statement = $pdo->prepare($query);
    $statement->bindParam(1, $id);

    if ($statement->execute()) {
        // redirecciono e informo TODO revisar; llevo hasta apartado 10
        header('Location: index.php?action=deleted');
    } else {
        die('No se ha podido borrar.');
    }
} catch (PDOException $ex) {
    die('ERROR: ' . $ex->getMessage());
}
?>
