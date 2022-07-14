<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    require "../config.php";

    try {

        $db_connection = new PDO('mysql:host=' . DB_HOST . '; dbname=' . DB_NAME, 'root', '');

        $db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $db_table = "usuarios_pass";

        $db_query = "SELECT * FROM $db_table WHERE USUARIO = :usuario AND PASSWORD = :password";

        $stmt = $db_connection->prepare($db_query);

        //htmlentities es una funcion que convierte cualquier simbolo en html 
        //addslashes escapa cualquier caracter extraño (comillas, puntos, etc)
        $login_usuario = htmlentities((addslashes($_POST["usuario"])));
        $login_password = htmlentities((addslashes($_POST["password"])));

        $stmt->bindValue(":usuario", $login_usuario);
        $stmt->bindValue(":password", $login_password);

        $stmt->execute();

        //rowCount() retorna el numero de registros que devuelve una funcion

        if ($affected_rows = $stmt->rowCount()) {

            $session_state = session_start();

            $_SESSION["usuario"] = $_POST["usuario"];

            header("location: usuarios_registrados1.php");
        } else {
            //redirigimos a una pagina
            header("location: login.php");
        }
    } catch (Exception $e) {
        die("Error: " . $e->getMessage() . " en la línea " . $e->getLine());
    }

    ?>
</body>

</html>