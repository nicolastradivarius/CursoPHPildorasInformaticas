<?php

    require_once("modelo/personas_model.php");
    $personas_model = new Personas_model();
    $array_personas = $personas_model->get_personas();

    require_once("vista/personas_view.php");
    ?>