<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Documento sin título</title>
    <style>
        h1 {
            text-align: center;
            color: #00F;
            border-bottom: dotted #0000FF;
            width: 50%;
            margin: auto;


        }

        table {
            border: 1px solid #F00;
            padding: 20px 50px;
            margin-top: 50px;
        }

        body {
            background-color: #FFC;
        }
    </style>
</head>

<body>
    <h1>Eliminacion de Artículos</h1>
    <form name="form1" method="get" action="eliminar_registro.php">
        <table border="0" align="center">
            <tr>
                <td>Código Artículo</td>
                <td><label for="c_art"></label>
                    <input type="text" name="c_art" id="c_art">
                </td>
            </tr>
            
            <tr>
                <td align="center"><input type="submit" name="borrar" id="borrar" value="Borrar"></td>
            </tr>
        </table>
    </form>
</body>

</html>