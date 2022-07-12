<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?php

    // $busqueda = $_GET["buscar"];


    require("../datosConexionBBDD.php");

    $db_table = "artículos";
    $codigo_art = $_GET["codigo_art"];
    $seccion = $_GET["seccion"];
    $nombre_articulo = $_GET["nombre_articulo"];
    $precio = $_GET["precio"];
    $fecha = $_GET["fecha"];
    $importado = $_GET["importado"];
    $pais_origen = $_GET["p_orig"];

    $conexion = mysqli_connect($db_host, $db_user, $db_password);

    if (mysqli_connect_errno()) {
        echo "Fallo al conectar con la base de datos '$db_name'.";
        exit();
    }

    mysqli_select_db($conexion, $db_name) or die("No se encuentra la BBDD '$db_name'.");

    mysqli_set_charset($conexion, "utf8");

    $query = "UPDATE $db_table SET SECCIÓN='$seccion', NOMBRE='$nombre_articulo', PRECIO='$precio', FECHA='$fecha', IMPORTADO='$importado', PAÍSDEORIGEN='$pais_origen' WHERE CÓDIGOARTÍCULO='$codigo_art'";

    if (!($resultset = mysqli_query($conexion, $query))) {
        echo "Error en la consulta";
    } else {
        echo "Registro guardado<br><br>";

        echo "<table><tr><td>$codigo_art</td></tr>";
        echo "<tr><td>$seccion</td></tr>";
        echo "<tr><td>$nombre_articulo</td></tr>";
        echo "<tr><td>$precio</td></tr>";
        echo "<tr><td>$fecha</td></tr>";
        echo "<tr><td>$importado</td></tr>";
        echo "<tr><td>$pais_origen</td></tr></table>";
    }

    mysqli_close($conexion);
    ?>
</head>

<body>

</body>

</html>