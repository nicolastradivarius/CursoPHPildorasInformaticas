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
        $codigo_art = $_GET["c_art"];
        
        $conexion = mysqli_connect($db_host, $db_user, $db_password);

        if (mysqli_connect_errno()) {
            echo "Fallo al conectar con la base de datos '$db_name'.";
            exit();
        }

        mysqli_select_db($conexion, $db_name) or die("No se encuentra la BBDD '$db_name'.");

        mysqli_set_charset($conexion, "utf8");

        $query = "DELETE FROM $db_table WHERE CÓDIGOARTÍCULO ='$codigo_art' ";

        if (!($resultset = mysqli_query($conexion, $query))) {
            echo "Error en la consulta";
        }
        else {
            if (!$affected_rows = mysqli_affected_rows($conexion)) {
                echo "No hay registros que eliminar con codigo $codigo_art";
            }
            else {
                echo "Se han eliminado $affected_rows registros.";
            }
        }

        mysqli_close($conexion);
    ?>
</head>

<body>

</body>

</html>