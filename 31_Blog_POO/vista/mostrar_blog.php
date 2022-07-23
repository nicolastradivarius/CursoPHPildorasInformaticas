<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
</head>

<body>
    <?php
    require_once("../config.php");
    include_once("../modelo/manejo_entradas.php");

    //debemos conectar con la BBDD, establecer los attr y llamar al metodo insertarcontenido
    try {

        $conexion = new PDO('mysql:host=' . DB_HOST . '; dbname=' . DB_NAME . '; charset=' . DB_CHARSET, DB_USER, DB_PASSWORD);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $manejo_entradas = new ManejoEntradas($conexion);

        $array_entradas_blog = $manejo_entradas->getContenidoPorFecha();

        if (empty($array_entradas_blog)) {
            echo "No hay entradas de blog aún.";
        } else {

            foreach ($array_entradas_blog as $entrada) {
                echo "<h3>" . $entrada->getTitulo() . "</h3>";
                echo "<h4>" . $entrada->getFecha() . "</h4>";
                echo "<div style='max-width: 400px; border: 1px solid black; word-wrap: break-word;'>" . $entrada->getComentarios() . "</div><br>";

                if ($entrada->getImagen() && file_exists("../imagenes/" . $entrada->getImagen())) {
                    echo "<img src='../imagenes/" . $entrada->getImagen() . "' width='300px'/>";
                }

                echo "<hr>";
            }
        }
    } catch (Exception $e) {
        die($e->getMessage());
    }
    ?>

    <br>
    <a href="../vista/formulario.html">Volver a la pagina de insercion</a>
</body>
</html>