<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h1 {
            text-align: center;
        }

        body {
            background-color: yellowgreen;
        }

        td {
            border: 1px solid #ff0000;
        }
    </style>
</head>
<body>
    <h1>Modelo Vista Controlador</h1>

    <?php
    //hay que tener en cuenta que las rutas especificadas en productos_controller.php deben estar especificadas pensando que
    //al incluir/requerir un archivo, es como si su codigo estuviese en el lugar donde es incluido
    //(en este caso, el codigo de productos_controller.php estuviera en index.php)
    //con lo cual las rutas especificadas en productos_controller.php deben ser escritas pensando que se está
    //accediendo desde index.php, y no desde ese mismo archivo
        require_once("controlador/productos_controller.php");
    ?>
</body>
</html>