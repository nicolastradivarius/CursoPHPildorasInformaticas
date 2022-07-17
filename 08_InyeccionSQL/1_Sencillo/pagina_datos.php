<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        table {
            border-collapse: collapse;
            border: 1px solid black;
            margin: auto;
        }

        tr {
            border-collapse: collapse;
            border: 1px solid black;
        }

        td {
            border-collapse: collapse;
            border: 1px solid black;
            padding: 6px;
        }
    </style>
</head>

<body>

    <?php

    require("../datosConexionBBDD.php");

    $db_table = "datospersonales";
    
    $conexion = mysqli_connect($db_host, $db_user, $db_password);
    
    
    if (mysqli_connect_errno()) {
        echo "Fallo al conectar con la base de datos '$db_name'.";
        exit();
    }
    
    mysqli_select_db($conexion, $db_name) or die("No se encuentra la BBDD '$db_name'.");
    
    mysqli_set_charset($conexion, "utf8");

    $usuario = mysqli_real_escape_string($conexion, $_GET["usuario"]);
    $password = mysqli_real_escape_string($conexion, $_GET["password"]);

    $query = "SELECT * FROM $db_table WHERE USUARIO='$usuario' AND PASSWORD='$password'";

    $resultset = mysqli_query($conexion, $query);

    echo $query . "<br>";

    if (!mysqli_affected_rows($conexion)) {
        echo "No se ha encontrado información que mostrar";
    }
    else {

        while ($row = mysqli_fetch_array($resultset, MYSQLI_ASSOC)) {
            echo "<br>";
            echo "Bienvenido $usuario<br>Estos son tus datos:<br>";
            echo $row["dni"] . "<br>";
            echo $row["usuario"] . "<br>";
            echo $row["password"] . "<br>";
        }
    }
    echo "<br>";

    mysqli_close($conexion);


    ?>

</body>

</html>