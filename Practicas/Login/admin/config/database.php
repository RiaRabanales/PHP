<?php

//con esto conecto a mi base de datos


class Database {

    private $host = "localhost";
    private $db_name = "php_login_system";
    private $username = "riarabanales";
    private $password = "alualualu";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->pdo = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
        } catch (PDOException $pdoex) {
            echo "Error de conexión: " . $pdoex->getMessage();
        }
        return $this->pdo;
    }

}

/*
 * Podría convertir esto en un singleton.
 * Singleton: una clase q solo se puede instanciar una vez. 
 * El constructor es privado asi q desde fuera no puedo hacer new.
 * Cuando instancio en vez de hacer new Object, llamo a un método q me instancia si no esta (y lo guarda en variable estatica) o devuelve la variables estatica
 * Cuando una propiedad es estatica su valor es compartido por todos los objetos
 * Si cambia el valor en uno de los objetos se cambia para todos.
 * 
 * Un método estático es uno q no necesitas instanciar para llamarlo.
 */
?>