<?php

    class Personas_model {

        private $db;
        private $personas;
        private $table;

        public function __construct() {
            
            require_once("modelo/conexion.php");

            $this->db = Conexion::conectar();
            $this->personas = array();
            $this->table = "datos_usuarios";
        }

        public function close(){
            $this->db = null;
        }

        public function get_personas(): array {

            require_once("modelo/paginacion.php");

            $query = "SELECT * FROM $this->table LIMIT $start_from, $page_size";
            $resultset = $this->db->query($query);

            while($row = $resultset->fetch(PDO::FETCH_ASSOC)){
                //vamos recorriendo los registros del resultset y almacenando cada uno en cada indice del array en cada vuelta de bucle
                $this->personas[] = $row;
            }

            $resultset->closeCursor();

            return $this->personas;
        }
    }
?>