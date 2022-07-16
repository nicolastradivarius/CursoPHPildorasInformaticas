<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        table {
            width: 300px;
            margin: auto;
            background-color: #FFC;
            border: 2px solid #F00;
            padding: 5px;
        }

        td {
            text-align: center;
        }

        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>REGISTRATE</h1>

    <form action="pagina_insertar_usuario.php" method="post">
        <table>
            <tr>
                <td>Usuario</td>
                <td><input type="text" name="usuario" id="usuario"></td>
            </tr>
            <tr>
                <td>Contraseña</td>
                <td><input type="password" name="password" id="password"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Enviar" name="enviando"></td>
            </tr>
        </table>
    </form>
    
</body>
</html>