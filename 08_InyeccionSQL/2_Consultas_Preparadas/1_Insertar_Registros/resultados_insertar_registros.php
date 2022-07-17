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
        require("../../../datosConexionBBDD.php");

        
        $conexion = mysqli_connect($db_host, $db_user, $db_password);
        
        if (mysqli_connect_errno()) {
            echo "Fallo al conectar con la base de datos '$db_name'.";
            exit();
        }

        $db_table = "artículos";

        $c_art = $_GET["c_art"];
        $seccion = $_GET["seccion"];
        $n_art = $_GET["n_art"];
        $precio = $_GET["precio"];
        $fecha = $_GET["fecha"];
        $importado = $_GET["importado"];
        $pais_origen = $_GET["pais_origen"];

        mysqli_select_db($conexion, $db_name) or die("No se encuentra la BBDD '$db_name'.");
    
        mysqli_set_charset($conexion, "utf8");

        $query = "INSERT INTO $db_table (CÓDIGOARTÍCULO, SECCIÓN, NOMBRE, PRECIO, FECHA, IMPORTADO, PAÍSDEORIGEN) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt_object = mysqli_prepare($conexion, $query);

        $state = mysqli_stmt_bind_param($stmt_object, "sssssss", $c_art, $seccion, $n_art, $precio, $fecha, $importado, $pais_origen);

        $state = mysqli_stmt_execute($stmt_object);

        if (!$state) {
            echo "Error al ejecutar la consulta";
        }
        else {
            // $state = mysqli_stmt_bind_result($stmt_object, $codigo_articulo, $seccion, $precio, $pais_origen);

            echo "Agregado nuevo registro <br>";

           
        }

        mysqli_stmt_close($stmt_object);

    ?>

    
</body>

</html>