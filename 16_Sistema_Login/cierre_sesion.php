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

    //reanuda la sesion abierta antes para que el navegador sepa cual es la sesion que tiene que destruir
        session_start();

        session_destroy();

        header("location: login.php");
    ?>
</body>
</html>