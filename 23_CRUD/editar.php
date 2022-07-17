<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Documento sin título</title>
  <link rel="stylesheet" type="text/css" href="hoja.css">
</head>

<body>

  <?php

  include("conexion.php");

  $db_table = 'datos_usuarios';
  //si NO se ha pulsado el boton de actualizar, entonces...
  if (!isset($_POST["bot_actualizar"])) {


    $id = htmlentities((addslashes($_GET["id"])));

    $db_query = "SELECT * FROM $db_table WHERE ID=:id";

    $stmt = $db_connection->prepare($db_query);

    $stmt->execute(array(":id" => $id));

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $nombre = $row["NOMBRE"];
      $apellido = $row["APELLIDO"];
      $direccion = $row["DIRECCION"];
    }

    $stmt->closeCursor();
  } else {
    //codigo que debe ejecutarse cuando pulsamos el boton actualizar

    //con esto almacenamos lo que se envía mediante POST del formulario de este archivo
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $direccion = $_POST["direccion"];

    $db_query = "UPDATE $db_table SET NOMBRE = :nombre, APELLIDO = :apellido, DIRECCION = :direccion WHERE ID = :id;";

    $resultset = $db_connection->prepare($db_query);

    $resultset->execute(array(":nombre"=>$nombre, ":apellido"=>$apellido, ":direccion"=>$direccion, ":id"=>$id));

    header("location: index.php");

  }


  ?>

  <h1>ACTUALIZAR</h1>

  <p>

  </p>
  <p>&nbsp;</p>
  <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <table width="25%" border="0" align="center">
      <tr>
        <td></td>
        <td><label for="id"></label>
          <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
        </td>
      </tr>
      <tr>
        <td>Nombre</td>
        <td><label for="nom"></label>
          <input type="text" name="nombre" id="nombre" value="<?php echo $nombre ?>">
        </td>
      </tr>
      <tr>
        <td>Apellido</td>
        <td><label for="ape"></label>
          <input type="text" name="apellido" id="apellido" value="<?php echo $apellido ?>">
        </td>
      </tr>
      <tr>
        <td>Dirección</td>
        <td><label for="dir"></label>
          <input type="text" name="direccion" id="direccion" value="<?php echo $direccion ?>">
        </td>
      </tr>
      <tr>
        <td colspan="2"><input type="submit" name="bot_actualizar" id="bot_actualizar" value="Actualizar"></td>
      </tr>
    </table>
  </form>
  <p>&nbsp;</p>
</body>

</html>