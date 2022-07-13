<?php
require("../config.php");

class Conexion
{

    protected $db_connection;

    public function __construct()
    {
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if ($this->db_connection->connect_errno) {

            echo "Fallo al conectar con la BBDD " . DB_NAME . "<br>Error: " . $this->db_connection->connect_error;
            return;
        }

        $this->db_connection->set_charset(DB_CHARSET);
    }
}
