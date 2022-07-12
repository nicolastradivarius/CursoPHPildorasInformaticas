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
        $conexion = new PDO('mysql:host='.$db_host.'; dbname='.$db_name, $db_user, $db_password);
        echo "Conexión establecida con la BBDD $db_name";
    } catch (Exception $e) {
        die('Error: '.$e->getMessage());
    } finally {
    }



?>
    
</body>
</html>