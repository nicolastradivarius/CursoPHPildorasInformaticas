<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?php
    session_start();

    if (!isset($_SESSION["usuario"])) {
        header("location: login.php");
    }
    ?>


</head>

<body>
    <h1>Bienvenidos usuarios</h1>

    <p>Esto es informacion solo para usuarios registrados</p>

    <?php
    echo "Usuario: " . $_SESSION["usuario"];
    echo "<br><br>";
    ?>

    <table border="1" style="border-collapse: collapse;">
        <tr>
            <td colspan="3">
                Zona usuarios registrados
            </td>
        </tr>

        <tr>
            <td>
                <a href="usuarios_registrados2.php">Pagina 1</a>
            </td>
            <td>
                <a href="usuarios_registrados3.php">Pagina 2</a>
            </td>
            <td>
                <a href="usuarios_registrados4.php">Pagina 3</a>
            </td>

        </tr>
    </table>

    <p><a href="cierre_sesion.php">Cerrar Sesión</a></p>
</body>

</html>