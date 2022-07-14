<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>

    <style>
        h1,
        h2 {
            text-align: center;
        }

        table {
            width: 25%;
            background-color: #FFC;
            border: 2px dotted #F00;
            margin: auto;
        }

        .izq {
            text-align: right;
        }

        .der {
            text-align: left;
        }

        td {
            text-align: center;
            padding: 10px;
        }
    </style>
</head>

<body>

    <?php

    require "../config.php";

    //verificamos si el usuario ya le dió o no al boton de Enviar del formulario
    if (isset($_POST["enviar"])) {
        try {

            $db_connection = new PDO('mysql:host=' . DB_HOST . '; dbname=' . DB_NAME, 'root', '');

            $db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $db_table = "usuarios_pass";

            $db_query = "SELECT * FROM $db_table WHERE USUARIO = :usuario AND PASSWORD = :password";

            $stmt = $db_connection->prepare($db_query);

            //htmlentities es una funcion que convierte cualquier simbolo en html 
            //addslashes escapa cualquier caracter extraño (comillas, puntos, etc)
            $login_usuario = htmlentities((addslashes($_POST["login_usuario"])));
            $login_password = htmlentities((addslashes($_POST["login_password"])));

            $stmt->bindValue(":usuario", $login_usuario);
            $stmt->bindValue(":password", $login_password);

            $stmt->execute();

            //rowCount() retorna el numero de registros que devuelve una funcion

            if ($affected_rows = $stmt->rowCount()) {

                session_start();

                $_SESSION["usuario"] = $login_usuario;
            } else {
                echo "Error: Usuario o contraseña incorrectos";
            }
        } catch (Exception $e) {
            die("Error: " . $e->getMessage() . " en la línea " . $e->getLine());
        }
    }

    ?>

    <?php

    //preguntamos si se ha iniciado sesion o no, para cargar o no el formulario
    if (!isset($_SESSION["usuario"])) {
        include("formulario_login.html");
    } else {
        echo "Usuario: " . $_SESSION["usuario"];
    }
    ?>

    <h2>CONTENIDO DE LA WEB</h2>
    <table width="800" border="0">
        <tr>
            <td><img src="img/1.jpg" width="300" height="166"></td>
            <td><img src="img/2.jpg" width="300" height="171"></td>
        </tr>
        <tr>
            <td><img src="img/3.jpg" width="300" height="166"></td>
            <td><img src="img/4.jpg" width="300" height="197"></td>
        </tr>
    </table>
</body>

</html>