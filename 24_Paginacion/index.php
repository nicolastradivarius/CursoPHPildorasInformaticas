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

    require("../config.php");

    try {

        $db_connection = new PDO('mysql:host=' . DB_HOST . '; dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
        $db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db_connection->exec("SET CHARACTER SET utf8");

        $db_table = "artículos";
        
        //indicamos cuantos registros queremos ver por página
        $page_size = 3;

        //ponemos el isset porque al cargar la pagina, el usuario no ha hecho click en ningun vinculo, lo cual
        //provoca que la variable "page" (que se pasa por la url cuando el usuario clickea en un vinculo)
        //no exista
        if (isset($_GET["page"])) {
            if ($_GET["page"] === 1) {
                header("location: index.php");
            } else {
                $actual_page = $_GET["page"];
            }
        } else {
            $actual_page = 1;
        }

        //mostramos la pagina en la que estamos al cargar por primera vez la pagina web

        //al cargar la pagina por primera vez, mostramos desde el registro 0
        //si el usuario pulsa en, por ejemplo, en el numero 3, $pagina == 3 y $start_from == 6, con lo cual mostramos del reg 6 al 9
        $start_from = ($actual_page - 1) * $page_size;

        //con "LIMIT 0,3", luego del criterio, nos muestra 3 registros a partir del registro 0, o sea, el reg 0, 1 y 2
        // $db_query = "SELECT NOMBRE, SECCIÓN, PRECIO, PAÍSDEORIGEN FROM $db_table WHERE SECCIÓN = 'DEPORTES'";

        //queremos saber cuantos registros nos devuelve en total la consulta sql y en cuantas paginas los va a dividir
        // $resultset = $db_connection->prepare($db_query);
        // $resultset->execute(array());
        // $resultset->closeCursor();

        // $nro_registros = $resultset->rowCount();


        //otra manera mas sencilla y pro-performance es hacer una consulta sql que solo devuelva 1 registro que contiene la cantidad de registros que tiene la tabla
        //dicha cantidad la contiene en la columna, con lo cual habria que hacer un fetchColumn() para obtener ese dato, como sigue:
        $db_query = "SELECT COUNT(*) FROM $db_table";
        $resultset = $db_connection->prepare($db_query);
        $resultset->execute();
        $nro_registros = $resultset->fetchColumn();
        $resultset->closeCursor();

        $total_pages = ceil($nro_registros / $page_size);

        echo "Número de registros de la consulta: " . $nro_registros . ".<br>";
        echo "Mostramos " . $page_size . " registros por página.<br>";
        echo "Mostrando la página " . $actual_page . " de " . $total_pages . ".<br><br>";

        //--------------- SELECCION DE CONTENIDO ---------------\\

        $db_query = "SELECT NOMBRE, SECCIÓN, PRECIO, PAÍSDEORIGEN FROM $db_table LIMIT $start_from, $page_size";
        $resultset = $db_connection->prepare($db_query);
        $resultset->execute();

        while ($registro = $resultset->fetch(PDO::FETCH_ASSOC)) {
            echo "Nombre artículo: " . $registro["NOMBRE"] . " ";
            echo "Sección: " . $registro["SECCIÓN"] . " ";
            echo "Precio: " . $registro["PRECIO"] . " ";
            echo "País de origen: " . $registro["PAÍSDEORIGEN"] . "<br>";
        }

        $resultset->closeCursor();
    } catch (Exception $e) {
        echo $e->getMessage() . ". Línea: " . $e->getLine();
    }

    //------------------ CONSTRUCCION PAGINACION ------------------\\

    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<a href='?page=$i'>$i</a>";
        echo "&nbsp";
    }

    //------------------ END CONSTRUCCION PAGINACION ------------------\\

    ?>

</body>

</html>