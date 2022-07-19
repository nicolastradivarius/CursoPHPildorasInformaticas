<?php

    require "config.php";

    class Conexion {

        public static function conectar(): PDO {
            try {

                $conexion = new PDO('mysql:host='.DB_HOST.'; dbname='.DB_NAME, DB_USER, DB_PASSWORD);
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conexion->exec("SET CHARACTER SET ".DB_CHARSET);
                
            } catch(Exception $e) {
                die($e->getMessage() . ". Línea: " . $e->getLine());
            }
            
            return $conexion;
        }
    }
?>