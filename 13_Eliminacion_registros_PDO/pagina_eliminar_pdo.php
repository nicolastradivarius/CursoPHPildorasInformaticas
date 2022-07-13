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
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conexion->exec("SET CHARACTER SET utf8");

        $db_table = "artículos";

        $c_art = $_POST["c_art"];
        
        $db_query = "DELETE FROM $db_table WHERE CÓDIGOARTÍCULO = :c_art";
        $resultset = $conexion->prepare($db_query);
        // $resultset->bindValue(":secc", $seccion, PDO::PARAM_STR_CHAR);
        // $resultset->bindValue(":pais_orig", $pais_origen, PDO::PARAM_STR_CHAR);
        // $resultset->execute();
        // $resultset->execute(array(":secc"=>$seccion, ":pais_orig"=>$pais_origen));
        // $resultset->execute(array(":c_art"=>$c_art, ":seccion"=>$seccion, ":n_art"=>$n_art, ":precio"=>$precio, ":fecha"=>$fecha, ":importado"=>$importado, ":p_orig"=>$p_orig));

        $resultset->bindValue(":c_art", $c_art, PDO::PARAM_STR);
        $resultset->execute();
        
        // while($row = $resultset->fetch(PDO::FETCH_ASSOC)) {
        //     echo "Nombre artículo: " .$row['NOMBRE'] . " ";
        //     echo "Sección: " .$row['SECCIÓN'] . " ";
        //     echo "Precio: " .$row['PRECIO'] . " ";
        //     echo "País de origen: " .$row['PAÍSDEORIGEN'] . "<br><br>";
        // }

        echo "Registro " .$c_art. " eliminado";

        $resultset->closeCursor();

    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    } finally {
        //empty
    }



    ?>

</body>

</html>