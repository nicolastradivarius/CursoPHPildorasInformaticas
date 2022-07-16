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

        include("conexion.php");

        $id = $_GET["id"];
        $db_table = 'datos_usuarios';

        $db_query = "DELETE FROM $db_table WHERE ID='$id'";

        $db_connection->query($db_query);

        header("location: index.php");
    ?>
    
</body>
</html>