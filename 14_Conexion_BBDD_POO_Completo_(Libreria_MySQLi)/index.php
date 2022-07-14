<?php

    require ("Devuelve_Productos.php");

    $busqueda_pais = $_GET["buscar"];

    $conexion_productos = new Devuelve_Productos();

    $array_productos = $conexion_productos->getProductos($busqueda_pais);
?>

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
        echo "<table>";
        foreach($array_productos as $elemento) {
            echo "<tr><td>";
            echo $elemento['CÓDIGOARTÍCULO'] . "</td><td>";
            echo $elemento['NOMBRE'] . "</td><td>";
            echo $elemento['SECCIÓN'] . "</td><td>";
            echo $elemento['PRECIO'] . "</td><td>";
            echo $elemento['FECHA'] . "</td><td>";
            echo $elemento['IMPORTADO'] . "</td><td>";
            echo $elemento['PAÍSDEORIGEN'] . "</td></tr>";
        }
        echo "</table>";
    ?>
</body>
</html>