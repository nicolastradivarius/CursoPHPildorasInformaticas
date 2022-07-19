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
    foreach ($array_personas as $usuario) :
    ?>
      <!-- codigo que hay que repetir -->

      <tr>
        <!-- CAMPO ID -->
        <td><?php echo $usuario["ID"] ?></td>
        <!-- CAMPO NOMBRE -->
        <td><?php echo $usuario["NOMBRE"] ?></td>
        <!-- CAMPO APELLIDO -->
        <td><?php echo $usuario["APELLIDO"] ?></td>
        <!-- CAMPO DIRECCION -->
        <td><?php echo $usuario["DIRECCION"] ?></td>

        <!-- BOTÓN BORRAR -->
        <td class="bot"><a href="borrar.php?id=<?php echo $usuario["ID"] ?>"><input type='button' name='del' id='del' value='Borrar'></a></td>

        <!-- BOTÓN ACTUALIZAR -->
        <td class='bot'><a href="editar.php?id=<?php echo $usuario["ID"] ?>"><input type='button' name='up' id='up' value='Actualizar'></a></td>
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

  <?php

  require("modelo/paginacion.php");

  echo "<br>";
  echo "<div class='centrado'>";
  for ($i = 1; $i <= $total_pages; $i++) {
    echo "<a style='text-decoration: none', href='?page=$i'>$i</a>";
    echo "&nbsp";
  }
  echo "</div>";
  ?>

</form>