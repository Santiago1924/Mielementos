<?php
class Database {
    private $host = "localhost";
    private $db_name = "mi_elementos";  
    private $username = "root";         
    private $password = "";             
    public $con;

    public function conectar() {
        try {
            $this->con = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->con;
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            exit;
        }
    }
}
?>
