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

  //-------------------------------------- PAGINACION --------------------------------------\\

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
  $resultset = $db_connection->prepare($db_query);
  $resultset->execute();
  $nro_registros = $resultset->fetchColumn();
  $resultset->closeCursor();

  $total_pages = ceil($nro_registros / $page_size);

  //------------------------------------ END PAGINACION ------------------------------------\\

  $db_query = "SELECT * FROM $db_table LIMIT $start_from, $page_size";
  //no es necesario hacer consultas preparadas porque no hay ninguna insercion de informacion por parte del usuario y que le de lugar a hacer inyeccion sql
  // prepare() se utiliza con consultas preparadas con parámetros y query() con consultas planas, sin parámetros.
  // $resultset = $db_connection->query($db_query);

  //en $registros hay un array de objetos (los podemos llamar "usuarios", "personas")
  //como objetos, van a tener sus propiedades: ID, NOMBRE, APELLIDO, DIRECCION
  // $registros = $resultset->fetchAll(PDO::FETCH_OBJ);

  //las dos lineas anteriores se pueden simplificar en la siguiente
  $registros = $db_connection->query($db_query)->fetchAll(PDO::FETCH_OBJ);

  //si se ha pulsado el boton de insertar entonces...
  if (isset($_POST["boton_insertar"])) {

    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $direccion = $_POST["direccion"];

    $db_query = "INSERT INTO $db_table (NOMBRE, APELLIDO, DIRECCION) VALUES (:nombre, :apellido, :direccion);";

    $resultset = $db_connection->prepare($db_query);

    $resultset->execute(array(":nombre" => $nombre, ":apellido" => $apellido, ":direccion" => $direccion));

    //es necesario refrescar la pagina una vez mas (aunque ya se haya refrescado al pulsar el boton Insertar)
    //ya que de esta forma se realiza de nuevo la busqueda en la bbdd y se muestran todos los campos existentes
    //si no la incluimos, no se mostrara el registro que insertamos
    header("location: index.php");
  }

  ?>


  <h1>CRUD<span class="subtitulo">Create Read Update Delete</span></h1>

  <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

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

          <!-- BOTÓN BORRAR -->
          <td class="bot"><a href="borrar.php?id=<?php echo $usuario->ID ?>"><input type='button' name='del' id='del' value='Borrar'></a></td>

          <!-- BOTÓN ACTUALIZAR -->
          <td class='bot'><a href="editar.php?id=<?php echo $usuario->ID ?>"><input type='button' name='up' id='up' value='Actualizar'></a></td>
        </tr>

      <?php
      endforeach;
      ?>
      <!-- con esta nomenclatura conseguimos reemplazar las llaves {}
        repetimos lo que hay dentro de este bloque -->


      <tr>
        <td></td>
        <td><input type='text' name='nombre' size='10' class='centrado'></td>
        <td><input type='text' name='apellido' size='10' class='centrado'></td>
        <td><input type='text' name='direccion' size='10' class='centrado'></td>
        <td class='bot'><input type='submit' name='boton_insertar' id='boton_insertar' value='Insertar'></td>
      </tr>
    </table>

  </form>

  <?php
  echo "<br>";
  echo "<div class='centrado'>";
  for ($i = 1; $i <= $total_pages; $i++) {
    echo "<a style='text-decoration: none', href='?page=$i'>$i</a>";
    echo "&nbsp";
  }
  echo "</div>";

  ?>

  <p>&nbsp;</p>
</body>

</html>