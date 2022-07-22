<?php

require("config.php");

try {

    $conexion = new PDO('mysql:host=' . DB_HOST . '; dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->exec("SET CHARACTER SET " . DB_CHARSET);

    $query = "SELECT FOTO FROM artículos WHERE CÓDIGOARTÍCULO = 'AR01'";

    $stmt = $conexion->prepare($query);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $ruta_img = $row["FOTO"];
    }

    $conexion = null;
} catch (Exception $e) {
    die($e->getMessage() . ". Línea: " . $e->getLine());
}

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
    <div>
        <img src="/intranet/uploads/<?php echo $ruta_img ?>" width="25%" alt="">
    </div>
</body>
</html>