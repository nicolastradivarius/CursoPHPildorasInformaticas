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

        $db_table = "usuarios_pass";

        $usuario = $_POST["usuario"];
        $password = $_POST["password"];

        //con PASSWORD_DEFAULT le decimos al algoritmo que cree 
        //la "sal" (el código aleatorio que acompaña a la 
        //contraseña encriptada y que hace que dos contraseñas 
        //iguales tengan una encriptacion diferente), de forma automatica
        //El parametro tercero es el coste, la fuerza con la que se aplica el algoritmo
        $encrypted_password = password_hash($password, PASSWORD_DEFAULT, array("cost"=>12));   

        try {
            $db_connection = new PDO('mysql:host='.DB_HOST.'; dbname='.DB_NAME, DB_USER, DB_PASSWORD);
            $db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $db_connection->exec("SET CHARACTER SET utf8");

            $db_query = "INSERT INTO " . $db_table . " (USUARIO, PASSWORD) VALUES (:usuario, :password);";
            echo $db_query . "<br>";

            $result = $db_connection->prepare($db_query);

            $result->execute(array(":usuario"=>$usuario, ":password"=>$encrypted_password));

            echo "Registro insertado";

            $result->closeCursor();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . ".<br>Línea del error: " . $e->getLine();
        } finally {
            $db_connection = NULL;
        }
    ?>
</body>
</html>