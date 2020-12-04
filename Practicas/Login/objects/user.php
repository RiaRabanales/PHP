<?php

class User {

    //datos de la BD:
    private $conn;
    private $table_name = "users";
    //atributos de la clase:
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $contact_number;
    public $address;
    public $password;
    public $access_level;
    public $access_code;
    public $status;
    public $created;
    public $modified;

    // constructor:
    public function __construct($db) {
        $this->conn = $db;
    }

    // Método que comprueba si un email dado existe en la base de datos
    function emailExists() {

        // hago las operaciones en la base de datos:
        $query = "SELECT
                id, firstname, lastname, access_level, password, status
                FROM " . $this->table_name . "WHERE email = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $this->email = htmlspecialchars(strip_tags($this->email));
        $stmt->bindParam(1, $this->email);
        $stmt->execute();
        $num = $stmt->rowCount();       //cuento los resultados
        // si el email existe me interesa meter lo que recibo en variables, para acceder más fácilmente
        if ($num > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $row['id'];
            $this->firstname = $row['firstname'];
            $this->lastname = $row['lastname'];
            $this->access_level = $row['access_level'];
            $this->password = $row['password'];
            $this->status = $row['status'];

            // y ya termino devolviendo true
            return true;
        }

        // pero si el email no existe devuelvo false:
        return false;
    }

    // Método para crear un nuevo registro de usuario
    function create() {
        // así saco el timestamp:
        $this->created = date('Y-m-d H:i:s');

        // inserto query:
        $query = "INSERT INTO " . $this->table_name . "
                . SET
                firstname = :firstname,
                lastname = :lastname,
                email = :email,
                contact_number = :contact_number,
                address = :address,
                password = :password,
                access_level = :access_level,
                status = :status,
                created = :created";

        // preparo query y la sanitizo:
        $stmt = $this->conn->prepare($query);
    }

}

?>
