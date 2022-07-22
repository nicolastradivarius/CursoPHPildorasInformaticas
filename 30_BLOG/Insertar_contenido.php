<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    require("config.php");

    try {

        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $conexion = new PDO('mysql:host=' . DB_HOST . '; dbname=' . DB_NAME . '; charset=' . DB_CHARSET, DB_USER, DB_PASSWORD);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($_FILES['imagen']['error']) {
            switch ($_FILES['imagen']['error']) {

                case 1: //Error de exceso de tamaño de archivo respecto al especificado en php.ini
                    echo "El tamaño del archivo excede lo permitido por el servidor";
                    break;
                case 2: //Error de exceso de tamaño de archivo respecto al especificado en la directiva MAX_TAM del formulario
                    echo "El tamaño del archivo excede los 2MB";
                    break;
                case 3: //Error de archivo corrupto
                    echo "El envío de archivo se interrumpió";
                    break;
                case 4: //Error de que no hay un archivo subido
                    echo "No se ha enviado archivo alguno";
                    break;
            }
        } else {
            //toda imagen que subamos va a ir a parar al directorio "imagenes/"
            echo "Imagen subida correctamente<br>";

            //si realmente hay un nombre de imagen (porque se ha subido la imagen) y no ha habido error
            if (isset($_FILES['imagen']["name"]) && $_FILES['imagen']["error"] == UPLOAD_ERR_OK) {
                $destino_ruta = "imagenes/";

                //movemos el archivo del directorio temporal (intranet/uploads/) a nuestro directorio
                move_uploaded_file($_FILES["imagen"]["tmp_name"], $destino_ruta . $_FILES["imagen"]["name"]);

                echo "El archivo " . $_FILES["imagen"]["name"] . " se ha copiado en el directorio de imágenes.<br>";
            } else {
                echo "El archivo no se ha podido copiar al directorio de imagenes.<br>";
            }
        }

        $campo_titulo = $_POST["campo_titulo"];
        $area_comentarios = $_POST["area_comentarios"];
        $fecha = date("Y-m-d H:i:s");
        $imagen = $_FILES["imagen"]["name"];

        $query = "INSERT INTO contenido_blog (TITULO, FECHA, COMENTARIOS, IMAGEN) VALUES (:titulo, :fecha, :comentarios, :imagen)";
        $resultset = $conexion->prepare($query);
        $conexion = null;
        $resultset->bindValue(":titulo", $campo_titulo);
        $resultset->bindValue(":fecha", $fecha);
        $resultset->bindValue(":comentarios", $area_comentarios);
        $resultset->bindValue(":imagen", $imagen);

        $resultset->execute();
        $resultset->closeCursor();

        echo "<br>Se ha agregado la entrada con éxito.<br><br><br>";
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    ?>

<a href="formulario.html">Ir al formulario</a>
<a href="blog.php">Ir al blog</a>
</body>

</html>