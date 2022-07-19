<?php

echo "<!-- _FILES: ";
print_r($_FILES);
echo " -->\n";


//Recibimos los datos de la imagen y los subimos al servidor

//especifico en la primera dimension de qué botón vino la imagen (con el nombre del attr name),
//y especifico en la segunda dimension el atributo de la imagen al que quiero acceder
$nombre_imagen = $_FILES["imagen"]["name"];

$tipo_imagen = $_FILES["imagen"]["type"];

$size_imagen = $_FILES["imagen"]["size"];

echo $tipo_imagen . "<br>";

//controlamos el tamaño (en bytes)
if ($size_imagen <= 1000000) {
    $pattern = "/image\/jpeg|jpg|png|svg|bmp/";
    if (preg_match($pattern, $tipo_imagen)) {

        //especificamos la carpeta destino donde se almacenara la imagen. 
        //La ruta comienza desde la raiz del servidor
        $carpeta_destino = $_SERVER["DOCUMENT_ROOT"] . "/intranet/uploads/";
        //Movemos la imagen del directorio temporal al directorio escogido ($carpeta_destino)
        move_uploaded_file($_FILES["imagen"]['tmp_name'], $carpeta_destino . $nombre_imagen);
        echo "Archivo subido.";
    } else {
        echo "Solo se pueden subir archivos jpeg, jpg, png, svg, bmp.";
    }
} else {
    echo "No se puede subir el archivo. El tamaño es demasiado grande: ";
    echo $size_imagen;
    echo "&nbspbytes.";
}

require("config.php");

try {

    $conexion = new PDO('mysql:host=' . DB_HOST . '; dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->exec("SET CHARACTER SET " . DB_CHARSET);

    $query = "UPDATE artículos SET FOTO = :nombre_imagen WHERE CÓDIGOARTÍCULO='AR01'";

    $stmt = $conexion->prepare($query);
    $stmt->bindValue(":nombre_imagen", $nombre_imagen);
    $stmt->execute();


} catch (Exception $e) {
    die($e->getMessage() . ". Línea: " . $e->getLine());
}
