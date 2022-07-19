<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table {
            margin: auto;
            width: 450px;
            border: 1px solid #FF0000;
            border-collapse: collapse;
        }

        tr,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
    <title>Formulario para subir imagenes</title>
</head>

<body>
    <form action="subir_imagen.php" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td><label for="imagen">Imagen: </label></td>
                <td>
                    <input type="file" name="imagen" id="imagen">
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <input type="submit" value="Enviar imagen">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>