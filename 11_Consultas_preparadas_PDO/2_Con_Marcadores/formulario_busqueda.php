<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="pagina_busqueda.php" method="get">
        <table>
            <tr>
                <td>
                    <label>Sección: </label>
                </td>
                <td>
                    <input type="text" name="seccion">
                </td>
            </tr>
            <tr>
                <td>
                    <label>País de origen: </label>
                </td>
                <td>
                    <input type="text" name="pais_origen">
                </td>
            </tr>
        </table>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>