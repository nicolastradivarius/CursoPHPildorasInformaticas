<?php

require_once("modelo/conexion.php");

$db_connection = Conexion::conectar();
$db_table = "datos_usuarios";
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

//al haber un contacto con la BBDD, hay que poner este archivo en la capa Modelo
$db_query = "SELECT COUNT(*) FROM $db_table";
$resultset = $db_connection->prepare($db_query);
$resultset->execute();
$nro_registros = $resultset->fetchColumn();
$resultset->closeCursor();

$total_pages = ceil($nro_registros / $page_size);

?>
