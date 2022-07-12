<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="pagina_datos.php" method="get">
        <table>
            <!-- fila usuario -->
            <tr>
                <td>
                    <label>
                        Usuario:
                    </label>
                </td>
                <td>
                    <input type="text" name="usuario">
                </td>
            </tr>
            <!-- fila contraseña -->
            <tr>
                <td>
                    <label>Contraseña:</label>
                </td>
                <td>
                    <input type="text" name="password">
                </td>
            </tr>
        </table>
        <input type="submit" value="Login">
    </form>
</body>

</html>