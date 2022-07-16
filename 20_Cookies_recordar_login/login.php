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

    $auth = false;

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
            //como se trata de un logeo, devolverá 0 o 1, indicando que no hay registro que coincida con la informacion introducida por el usuario,
            //o que hay un registro que coincide, y por lo tanto permite logearse al usuario
            if ($affected_rows = $stmt->rowCount()) {
                $auth = true;
               
                //verificamos si el usuario marcó el checkbox
                if(isset($_POST["recordar"])) {
                    setcookie("user_name", $login_usuario, time() + 86400);
                }
            } else {
                echo "Error: Usuario o contraseña incorrectos";
            }
        } catch (Exception $e) {
            die("Error: " . $e->getMessage() . " en la línea " . $e->getLine());
        }
    }

    ?>

    <?php

    //vemos si el usuario NO se ha autenticado
    if(!$auth){
        //y tambien vemos si NO se ha creado una cookie "user_name", que se crea cuando el usuario marca el checkbox de recordar
        //para en ese caso mostrarle el formulario de login
        if (!isset($_COOKIE["user_name"])) {
            include("formulario_login.html");
        }
    }

    //si se creó la cookie...
    if (isset($_COOKIE["user_name"])) {
        echo "¡Hola " . $_COOKIE["user_name"] . "!";
    } else if($auth) {
        echo "¡Hola " . $login_usuario . "!";
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

    <?php
        //si el login ha tenido exito o si tenemos cookie creada
        if($auth || isset($_COOKIE["user_name"])){
            include("zona_registrados.html");
        }
    ?>
</body>

</html>