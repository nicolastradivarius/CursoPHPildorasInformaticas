<!-- Este archivo se encarga de gestionar las comunicaciones entre los archivos del modelo y la vista. Es decir, es el intermediario -->

<?php

    require_once("modelo/productos_model.php");
    $productos_model = new Productos_model();
    $array_productos = $productos_model->get_productos();

    require_once("vista/productos_view.php");
    ?>