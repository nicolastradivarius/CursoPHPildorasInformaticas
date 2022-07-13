<?php

    require("conexion.php");

    //Devuelve_Productos ES una Conexion a una tabla de una BBDD MySQL que se encarga de devolvernos todos los productos de la tabla
    class Devuelve_Productos extends Conexion {

        private $db_query;
        private $db_table;

        public function __construct() {
            parent::__construct();
            $this->db_table = "artículos";
            $this->db_query = "SELECT * FROM $this->db_table";
        }

        public function getProductos() {
            $resultset = $this->db_connection->query($this->db_query);

            //$productos es un array asociativo
            $productos = $resultset->fetch_all(MYSQLI_ASSOC);

            return $productos;
        }
    }
?>