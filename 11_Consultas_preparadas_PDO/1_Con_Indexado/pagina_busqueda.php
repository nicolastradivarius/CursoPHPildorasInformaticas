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

    require "../datosConexionBBDD.php";

    try {
        $conexion = new PDO('mysql:host=' . $db_host . '; dbname=' . $db_name, $db_user, $db_password);
        $conexion->exec("SET CHARACTER SET utf8");

        $db_table = "artículos";
        $db_query = "SELECT NOMBRE, SECCIÓN, PRECIO, PAÍSDEORIGEN FROM $db_table WHERE NOMBRE = ?";

        $busqueda = $_GET["buscar"];

        //resultset es un objeto de tipo PDOStatement
        $resultset = $conexion->prepare($db_query);

        //ponemos un 1 porque es el PRIMER "?" que debemos bindear en la consulta sql
        //si hubiese dos "?", tendriamos que poner tambien otra instruccion así pero poniendo 2
        $resultset->bindParam(1, $busqueda, PDO::PARAM_STR_CHAR);
        $resultset->execute();

        while($row = $resultset->fetch(PDO::FETCH_ASSOC)) {
            echo "Nombre artículo: " .$row['NOMBRE'] . " ";
            echo "Sección: " .$row['SECCIÓN'] . " ";
            echo "Precio: " .$row['PRECIO'] . " ";
            echo "País de origen: " .$row['PAÍSDEORIGEN'] . "<br><br>";
        }

        $resultset->closeCursor();

    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    } finally {
    }



    ?>

</body>

</html>