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

    require("../config.php");

    try {
        
        $db_connection = new PDO('mysql:host='.DB_HOST.'; dbname='.DB_NAME, DB_USER, DB_PASSWORD);
        $db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db_connection->exec("SET CHARACTER SET utf8");

        $db_table = "artículos";

        //con limit 0,3 nos muestra 3 registros a partir del registro 0, o sea, el reg 0, 1 y 2
        $db_query = "SELECT NOMBRE, SECCIÓN, PRECIO, PAÍSDEORIGEN FROM $db_table WHERE SECCIÓN = 'DEPORTES' LIMIT 0,3";

        $resultset = $db_connection->prepare($db_query);

        $resultset->execute(array());

        while($registro = $resultset->fetch(PDO::FETCH_ASSOC)){
            echo "Nombre artículo: " . $registro["NOMBRE"] . " ";
            echo "Sección: " . $registro["SECCIÓN"] . " ";
            echo "Precio: " . $registro["PRECIO"] . " ";
            echo "País de origen: " . $registro["PAÍSDEORIGEN"] . "<br>";
        }

        $resultset->closeCursor();

    } catch (Exception $e) {
        echo $e->getMessage() . ". Línea: " . $e->getLine();
    }
?>
    
</body>
</html>