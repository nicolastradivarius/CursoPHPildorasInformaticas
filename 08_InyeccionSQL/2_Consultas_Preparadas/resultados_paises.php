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
        require("../../datosConexionBBDD.php");

        
        $conexion = mysqli_connect($db_host, $db_user, $db_password);
        
        if (mysqli_connect_errno()) {
            echo "Fallo al conectar con la base de datos '$db_name'.";
            exit();
        }

        $db_table = "artículos";
        $pais = $_GET["buscar"];

        mysqli_select_db($conexion, $db_name) or die("No se encuentra la BBDD '$db_name'.");
    
        mysqli_set_charset($conexion, "utf8");

        //Consultas preparadas:

        //primer paso: creamos la sentencia SQL sustituyendo los valores de criterio por el simbolo "?"
        $query = "SELECT CÓDIGOARTÍCULO, SECCIÓN, PRECIO, PAÍSDEORIGEN FROM $db_table WHERE PAÍSDEORIGEN=?";

        //segundo paso: preparamos la consulta sql con la función mysqli_prepare(). Esta funcion requiere dos parámetros: $conexion y $query
        $stmt_object = mysqli_prepare($conexion, $query);

        //tercer paso: unimos los parametros a la sentencia sql. De esto se encarga la funcion mysqli_stmt_bind_param(). Devuelve true o false.
        // Esta funcion requiere tres parametros: el objeto mysqli_stmt (devuelto por mysqli_prepare y que guardamos en $stmt_object), el tipo de dato que se utilizara como criterio en la query, y la variable con criterio
        $state = mysqli_stmt_bind_param($stmt_object, "s", $pais);

        //cuarto paso: ejecutar la consulta con mysqli_stmt_execute(), y devuelve true o false. Esta funcion requiere como parametro stmt_object
        $state = mysqli_stmt_execute($stmt_object);

        if (!$state) {
            echo "Error al ejecutar la consulta";
        }
        else {
            //quinto paso: asociar variables al resultado de la consulta sql. 
            //Lo conseguimos con la funcion mysqli_stmt_bind_result(). Devuelve true o false. 
            //Necesita como parametros el stmt_object y tantas variables como campos en la consulta sql.
            //nuestra consulta va a devolver 4 campos, por lo tanto debemos especificar 4 variables
            $state = mysqli_stmt_bind_result($stmt_object, $codigo_articulo, $seccion, $precio, $pais_origen);

            //ultimo paso: leer los valores. Usamos mysqli_stmt_fetch(). Necesita el objeto stmt_object
            echo "Artículos encontrados: <br><br>";

            while (mysqli_stmt_fetch($stmt_object)){
                echo $codigo_articulo . " ";
                echo $seccion . " ";
                echo $precio . " ";
                echo $pais_origen . "<br>";
            }
        }

        //para terminar, cerramos el objeto
        mysqli_stmt_close($stmt_object);

    ?>

    
</body>

</html>