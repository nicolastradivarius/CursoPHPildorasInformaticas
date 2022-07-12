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

    require "../datosConexionBBDD.php";

    $db_table = "artículos";
    $conexion = new mysqli($db_host, $db_user, $db_password, $db_name);

    if ($conexion->connect_errno) {
        echo "Fallo al conectar con la BBDD $db_name. Error: " . $conexion->connect_errno;
    }

    $conexion->set_charset("utf8");

    $db_query = "SELECT * FROM $db_table";

    $resultset = $conexion->query($db_query);

    if ($conexion->errno) {

        die($conexion->error);
    }

    echo "<table>";

    while ($row = $resultset->fetch_array((MYSQLI_ASSOC))) {
        echo "<tr><td>";

        echo $row['CÓDIGOARTÍCULO'] . "</td><td>";
        echo $row['NOMBRE'] . "</td><td>";
        echo $row['SECCIÓN'] . "</td><td>";
        echo $row['IMPORTADO'] . "</td><td>";
        echo $row['PRECIO'] . "</td><td>";
        echo $row['PAÍSDEORIGEN'] . "</td></tr>";
    }

    echo "<br>";

    echo "</table>";

    $conexion->close();

    ?>
</body>

</html>