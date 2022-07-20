<?php

echo "<!-- _FILES: ";
print_r($_FILES);
echo " -->\n";


//Recibimos los datos de la archivo y los subimos al servidor

//especifico en la primera dimension de qué botón vino la archivo (con el nombre del attr name),
//y especifico en la segunda dimension el atributo de la archivo al que quiero acceder
$nombre_archivo = $_FILES["archivo"]["name"];
$tipo_archivo = $_FILES["archivo"]["type"];
$size_archivo = $_FILES["archivo"]["size"];

//controlamos el tamaño (en bytes)
if ($size_archivo <= 1000000) {
    $carpeta_destino = $_SERVER["DOCUMENT_ROOT"] . "/intranet/uploads/";
    move_uploaded_file($_FILES["archivo"]['tmp_name'], $carpeta_destino . $nombre_archivo);
    echo "Archivo subido.";
} else {
    echo "No se puede subir el archivo. El tamaño es demasiado grande: ";
    echo $size_archivo;
    echo "&nbspbytes.";
}

require("config.php");

try {

    $conexion = new PDO('mysql:host=' . DB_HOST . '; dbname=' . DB_NAME . '; charset=' . DB_CHARSET, DB_USER, DB_PASSWORD);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //fopen() abre un flujo de datos para poder apuntar a un archivo y despues leerlo
    $archivo_objetivo = fopen($carpeta_destino . $nombre_archivo, 'r');
    $contenido_archivo = fread($archivo_objetivo, $size_archivo);
    $contenido_archivo = addslashes($contenido_archivo);
    fclose($archivo_objetivo);
    unlink($carpeta_destino . $nombre_archivo);

    $query = "INSERT INTO Archivos (NOMBRE, TIPO, CONTENIDO) VALUES ('$nombre_archivo', '$tipo_archivo', '$contenido_archivo')";

    $stmt = $conexion->prepare($query);

    if ($stmt->execute()) {
        echo "Se ha insertado el registro con éxito.";
    } else {
        echo "No se ha podido insertar el registro.";
    }
} catch (Exception $e) {
    die($e->getMessage() . ". Línea: " . $e->getLine());
}
