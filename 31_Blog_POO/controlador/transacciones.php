<!-- Este archivo se encarga de gestionar las transacciones que van a ocurrir entre el formulario y los otros dos archivos del modelo
Debe recoger la informacion introducida en el formulario e interaccionando con manejo_entradas, debe ser capas de introducir la informacion en la BBDD -->

<?php

require_once("../config.php");
include_once("../modelo/entrada_blog.php");
include_once("../modelo/manejo_entradas.php");

date_default_timezone_set('America/Argentina/Buenos_Aires');

try {

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
        //si realmente hay un nombre de imagen (porque se ha subido la imagen) y no ha habido error
        if (isset($_FILES['imagen']["name"]) && $_FILES['imagen']["error"] == UPLOAD_ERR_OK) {
            $destino_ruta = "../imagenes/";

            //movemos el archivo del directorio temporal (intranet/uploads/) a nuestro directorio
            move_uploaded_file($_FILES["imagen"]["tmp_name"], $destino_ruta . $_FILES["imagen"]["name"]);

            echo "El archivo " . $_FILES["imagen"]["name"] . " se ha copiado en el directorio de imágenes.<br>";
        } else {
            echo "El archivo no se ha podido copiar al directorio de imagenes.<br>";
        }
    }

    $manejo_entradas = new ManejoEntradas($conexion);

    $entrada = new EntradaBlog(
        $_POST["campo_titulo"],
        date("Y-m-d H:i:s"),
        $_POST["area_comentarios"],
        $_FILES["imagen"]["name"]
    );

    $manejo_entradas->insertarContenido($entrada);
    echo "<br>Entrada de blog agregada con exito.";
} catch (Exception $e) {
    die($e->getMessage());
}

?>