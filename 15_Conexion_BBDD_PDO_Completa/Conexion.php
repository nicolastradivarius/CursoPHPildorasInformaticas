<?php
require("../config.php");

class Conexion
{

    protected $db_connection;

    public function __construct()
    {

        try {
            
            $this->db_connection = new PDO('mysql:host='.DB_HOST.'; dbname='.DB_NAME, 'root', '');
            $this->db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db_connection->exec("SET CHARACTER SET utf8");

            return $this->db_connection;

        } catch (Exception $e) {
            echo "La línea del error es: " . $e->getLine();
        }


        // -------------------------------

        // $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        // if ($this->db_connection->connect_errno) {

        //     echo "Fallo al conectar con la BBDD " . DB_NAME . "<br>Error: " . $this->db_connection->connect_error;
        //     return;
        // }

        // $this->db_connection->set_charset(DB_CHARSET);
    }
}
