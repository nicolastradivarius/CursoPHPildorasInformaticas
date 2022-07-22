<?php

    include_once("entrada_blog.php");
    class ManejoEntradas {

        private $conexion;

        public function __construct(PDO $conexion) {
            $this->conexion = $conexion;
        }

        //retorna un array de objetos de tipo EntradaBlog
        public function getContenidoPorFecha(): array {

            $array_entradas = array();
            $contador = 0;

            $query = "SELECT * FROM contenido_blog ORDER BY FECHA";
            $resultset = $this->conexion->prepare($query);
            $resultset->execute();

            while ($registro = $resultset->fetch(PDO::FETCH_ASSOC)){

                $entrada_blog = new EntradaBlog($registro["TITULO"], $registro["FECHA"], $registro["COMENTARIOS"], $registro["IMAGEN"]);
                $array_entradas[$contador] = $entrada_blog;
                $contador++;
            }

            return $array_entradas;
        }

        public function insertarContenido(EntradaBlog $entrada_blog) {
            $query = "INSERT INTO contenido_blog (TITULO, FECHA, COMENTARIOS, IMAGEN) VALUES (:titulo, :fecha, :comentarios, :imagen);";
            $resultset = $this->conexion->prepare($query);
            $resultset->bindValue(":titulo", $entrada_blog->getTitulo());
            $resultset->bindValue(":fecha", $entrada_blog->getFecha());
            $resultset->bindValue(":comentarios", $entrada_blog->getComentarios());
            $resultset->bindValue(":imagen", $entrada_blog->getImagen());
            $resultset->execute();
        }
    }
