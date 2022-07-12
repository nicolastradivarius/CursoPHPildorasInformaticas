<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>

        table {
            border-collapse:collapse;
            border: 1px solid black;
            margin: auto;
        }

        tr {
            border-collapse:collapse;
            border: 1px solid black;
        }

        td {
            border-collapse:collapse;
            border: 1px solid black;
            padding: 6px;
        }
    </style>
</head>
<body>
    
    <?php

        $busqueda = $_GET["buscar"];

        require("../datosConexionBBDD.php");

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

        echo "<form action='actualizar.php' method='get'>"; 

        // while ($row = mysqli_fetch_row($resultset)) {
        while ($row = mysqli_fetch_array($resultset, MYSQLI_ASSOC)) {

            echo "<input type='text' name='codigo_art' value='" . $row['CÓDIGOARTÍCULO'] . "' readonly><br>";
            echo "<input type='text' name='nombre_articulo' value='" . $row['NOMBRE'] . "'><br>";
            echo "<input type='text' name='seccion' value='" . $row['SECCIÓN'] . "'><br>";
            echo "<input type='text' name='importado' value='" . $row['IMPORTADO'] . "'><br>";
            echo "<input type='text' name='fecha' value='" . $row['FECHA'] . "'><br>";
            echo "<input type='text' name='precio' value='" . $row['PRECIO'] . "'><br>";
            echo "<input type='text' name='p_orig' value='" . $row['PAÍSDEORIGEN'] . "'><br>";
            echo "<br>";

        }
        echo "<input type='submit' name='enviando' value='Actualizar'>";
        echo "</form>";

        mysqli_close($conexion);

        //caracteres comodin: % (sustituye cadena de caracteres) y _ (sustituye un unico caracter)

    ?>

</body>
</html>