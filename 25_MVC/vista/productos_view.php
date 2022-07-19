<!-- Este archivo se encarga de construir la vista para el usuario -->
<?php
echo "<table><tr><td>Nombre del artículo</td>";

foreach ($array_productos as $registro) {
    echo "<tr><td>";
    echo $registro["NOMBRE"] . "</td></tr>";
}

echo "</table>";
?>