<!-- Este archivo se encarga de comprobar si un usuario que ha introducido sus datos en login.php
ya está registrado en la bbdd. Como las contraseñas estan encriptadas, ya no vale el metodo anterior que teniamos
para corroborar esto. Ahora debemos usar la funcion password_verify() que verifica si dos contraseñas parametrizadas
son iguales. Cuando introduzcamos los datos en login.php, la contraseña la introduciremos tal cual es, sin encriptacion.
La contraseña de ese usuario en la bbdd esta encriptada, con lo cual no hay forma de compararlas mediante un === o algo
por el estilo. Es por eso que usamos dicha funcion
 -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Documento sin título</title>
</head>

<body>


	<?php

	try {
		require "../config.php";

		$db_table = "usuarios_pass";

		$login_usuario = htmlentities(addslashes($_POST["login_usuario"]));
		$login_password = htmlentities(addslashes($_POST["login_password"]));

		//para saber si el login esta en la bbdd o no
		$count = 0;

		$db_connection = new PDO("mysql:host=" . DB_HOST . "; dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
		$db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$db_query = "SELECT * FROM $db_table WHERE USUARIO= :login_usuario";

		$resultset = $db_connection->prepare($db_query);
		$resultset->execute(array(":login_usuario" => $login_usuario));

		while ($row = $resultset->fetch(PDO::FETCH_ASSOC)) {
			echo "Usuario: " . $row['USUARIO'] . " Contraseña: " . $row['PASSWORD'] . "<br>";

			//Devuelve true si ambas son iguales, falso en caso contrario
			if (password_verify($login_password, $row["PASSWORD"])) {
				$count++;
			}
			echo $count;
			echo $row["PASSWORD"] . "<br>";
		}
		echo $login_password;

		//se ha encontrado, minimo, un usuario con la misma contraseña introducida
		if ($count > 0) {
			echo "Usuario registrado";
		} else {
			echo "Usuario no registrado";
		}

		$resultset->closeCursor();
	} catch (Exception $e) {
		die("Error: " . $e->getMessage());
	}
	?>
</body>

</html>