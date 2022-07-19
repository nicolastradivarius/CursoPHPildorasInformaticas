<!-- Este archivo se encarga de consultar la tabla de articulos de la BBDD pruebas -->
<!-- Contendra las clases y metodos necesarios para poder extraer la informacion que esta almacenada en la tabla de artículos -->

<?php

    class Productos_model {

        private $db;
        private $productos;

        public function __construct() {
            
            require_once("modelo/conexion.php");

            $this->db = Conexion::conectar();
            $this->productos = array();
        }

        public function get_productos(): array {

            $query = "SELECT * FROM artículos";
            $resultset = $this->db->query($query);

            while($row = $resultset->fetch(PDO::FETCH_ASSOC)){
                //vamos recorriendo los registros del resultset y almacenando cada uno en cada indice del array en cada vuelta de bucle
                $this->productos[] = $row;
            }

            return $this->productos;
        }
    }
?>