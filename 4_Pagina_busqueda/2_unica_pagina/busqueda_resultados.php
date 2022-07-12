<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        table {
            border-collapse: collapse;
            border: 1px solid black;
            margin: auto;
        }

        tr {
            border-collapse: collapse;
            border: 1px solid black;
        }

        td {
            border-collapse: collapse;
            border: 1px solid black;
            padding: 6px;
        }
    </style>

    <?php
    //incluimos el codigo php dentro del <head> para que al cargar la pagina, nos aseguremos que se lea toda la informacion
    //y tambien debemos meter todo el codigo en una funcion dado que este codigo se ejecuta despues de que hagamos submit en el formulario
    function ejecutar_consulta($busqueda)
    {



        // $busqueda = $_GET["buscar"];

        require("../../datosConexionBBDD.php");

        $db_table = "artículos";

        $conexion = mysqli_connect($db_host, $db_user, $db_password);

        if (mysqli_connect_errno()) {
            echo "Fallo al conectar con la base de datos '$db_name'.";
            exit();
        }

        mysqli_select_db($conexion, $db_name) or die("No se encuentra la BBDD '$db_name'.");

        mysqli_set_charset($conexion, "utf8");

        $query = "SELECT * FROM $db_table WHERE NOMBRE LIKE '%$busqueda%'";

        //resultset o recordset --> tabla virtual: creamos una tabla en la memoria donde cargamos toda la informacion que nos devuelve la instruccion SQL $query
        $resultset = mysqli_query($conexion, $query);

        //mysql_fetch_row: va viendo linea a linea la informacion que hay dentro de la tabla virtual y lo almacena en un array

        echo "<table>";

        // while ($row = mysqli_fetch_row($resultset)) {
        while ($row = mysqli_fetch_array($resultset, MYSQLI_ASSOC)) {

            echo "<tr><td>";

            echo $row['CÓDIGOARTÍCULO'] . "</td><td>";
            echo $row['NOMBRE'] . "</td><td>";
            echo $row['SECCIÓN'] . "</td><td>";
            echo $row['IMPORTADO'] . "</td><td>";
            echo $row['PRECIO'] . "</td><td>";
            echo $row['PAÍSDEORIGEN'] . "</td></tr>";
        }
        echo "<br>";

        echo "</table>";

        mysqli_close($conexion);
    }
    ?>
</head>

<body>

    <?php
        @$busqueda_temp = $_GET["buscar"]; //cuando se cargue la pagina, $busqueda_temp será nulo porque aun no hemos hecho ningun submit en el formulario
        //al ser asi, pasa al else y crea el formulario

        $pagina = $_SERVER["PHP_SELF"]; //con esto logramos que la informacion se envíe a la misma pagina

        if ($busqueda_temp != NULL) {
            ejecutar_consulta(($busqueda_temp));
        }
        else {
            echo ("<form action='" . $pagina . "' method='get'> 
            
                <label>Buscar:<input type='text' name='buscar'></label>

                <input type='submit' name='enviando' value='Buscar'>

                </form>");
            
        }
    ?>

    <form action="" method="get"></form>

</body>

</html>