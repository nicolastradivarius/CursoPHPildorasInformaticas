<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>CRUD</title>
  <link rel="stylesheet" type="text/css" href="hoja.css">


</head>

<body>

  <?php

  include("conexion.php");

  $db_table = "datos_usuarios";

  $db_query = "SELECT * FROM $db_table";
  //no es necesario hacer consultas preparadas porque no hay ninguna insercion de informacion por parte del usuario y que le de lugar a hacer inyeccion sql
  // prepare() se utiliza con consultas preparadas con parámetros y query() con consultas planas, sin parámetros.
  // $resultset = $db_connection->query($db_query);

  //en $registros hay un array de objetos (los podemos llamar "usuarios", "personas")
  //como objetos, van a tener sus propiedades: ID, NOMBRE, APELLIDO, DIRECCION
  // $registros = $resultset->fetchAll(PDO::FETCH_OBJ);

  //las dos lineas anteriores se pueden simplificar en la siguiente
  $registros = $db_connection->query($db_query)->fetchAll(PDO::FETCH_OBJ);


  ?>


  <h1>CRUD<span class="subtitulo">Create Read Update Delete</span></h1>

  <table width="50%" border="0" align="center">
    <tr>
      <td class="primera_fila">ID</td>
      <td class="primera_fila">NOMBRE</td>
      <td class="primera_fila">APELLIDO</td>
      <td class="primera_fila">DIRECCION</td>
      <td class="sin">&nbsp;</td>
      <td class="sin">&nbsp;</td>
      <td class="sin">&nbsp;</td>
    </tr>


    <?php
    foreach ($registros as $usuario) :
    ?>
      <!-- codigo que hay que repetir -->
      <!-- Recordemos que cada $usuario del arreglo de objetos tiene propiedades, con lo cual se acceden mediante el operador flecha -> -->
      <tr>
        <!-- CAMPO ID -->
        <td><?php echo $usuario->ID ?></td>
        <!-- CAMPO NOMBRE -->
        <td><?php echo $usuario->NOMBRE ?></td>
        <!-- CAMPO APELLIDO -->
        <td><?php echo $usuario->APELLIDO ?></td>
        <!-- CAMPO DIRECCION -->
        <td><?php echo $usuario->DIRECCION ?></td>

        <td class="bot"><a href="borrar.php?id=<?php echo $usuario->ID ?>"><input type='button' name='del' id='del' value='Borrar'></a></td>
        <td class='bot'><input type='button' name='up' id='up' value='Actualizar'></a></td>
      </tr>

    <?php
    endforeach;
    ?>
    <!-- con esta nomenclatura conseguimos reemplazar las llaves {}
        repetimos lo que hay dentro de este bloque -->


    <tr>
      <td></td>
      <td><input type='text' name='Nom' size='10' class='centrado'></td>
      <td><input type='text' name='Ape' size='10' class='centrado'></td>
      <td><input type='text' name=' Dir' size='10' class='centrado'></td>
      <td class='bot'><input type='submit' name='cr' id='cr' value='Insertar'></td>
    </tr>
  </table>

  <p>&nbsp;</p>
</body>

</html>