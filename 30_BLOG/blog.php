<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLOG</title>
</head>

<body>
    <h1>Blog</h1>
    <hr>

    <?php
    require("config.php");
    try {

        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $conexion = new PDO('mysql:host=' . DB_HOST . '; dbname=' . DB_NAME . '; charset=' . DB_CHARSET, DB_USER, DB_PASSWORD);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //------------------ BEGIN PAGINACION ------------------\\

        $db_table = "contenido_blog";
        $page_size = 3;

        if (isset($_GET["page"])) {
            if ($_GET["page"] === 1) {
                header("location: index.php");
            } else {
                $actual_page = $_GET["page"];
            }
        } else {
            $actual_page = 1;
        }

        $start_from = ($actual_page - 1) * $page_size;

        $db_query = "SELECT COUNT(*) FROM $db_table";
        $resultset = $conexion->prepare($db_query);
        $resultset->execute();
        $nro_registros = $resultset->fetchColumn();
        $resultset->closeCursor();

        $total_pages = ceil($nro_registros / $page_size);

        //------------------ END PAGINACION ------------------\\

        //ORDER BY: si no especificamos nada, el orden por defecto es ascendente (mas antigua a mas reciente)
        //Hay que especificar DESC para que lo ordene de forma descendente
        $db_query = "SELECT * FROM $db_table ORDER BY FECHA DESC LIMIT ?, ?";
        $resultset = $conexion->prepare($db_query);
        $resultset->bindParam(1, $start_from, PDO::PARAM_INT);
        $resultset->bindParam(2, $page_size, PDO::PARAM_INT);
        $conexion = null;
        
        if ($resultset->execute()) {
            while ($row = $resultset->fetch(PDO::FETCH_ASSOC)) {
                
                echo "<h3>" . $row["TITULO"] . "</h3>";
                echo "<h4>" . $row["FECHA"] . "</h4>";
                echo "<div style='max-width: 500px; border: 1px solid black; word-wrap: break-word;'>" . $row["COMENTARIOS"] . "</div><br>";
                
                if ($row["IMAGEN"] && file_exists("imagenes/" . $row["IMAGEN"])) {
                    echo "<img src='imagenes/" . $row["IMAGEN"] . "' width='300px'/>";
                }
                
                echo "<hr>";
            }
        }
    } catch (Exception $e) {
        $e->getMessage();
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