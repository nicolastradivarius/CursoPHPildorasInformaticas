<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elige el idioma</title>
</head>
<body>
    <?php
        //con isset le preguntamos si la cookie ha sido creada o no
        if(isset($_COOKIE["selected_lang"])){
            switch ($_COOKIE["selected_lang"]) {
                case 'es':
                    header("location:spanish.php");
                    break;

                case "en":
                    header("location:english.php");
                    break;
            }
        } else {
            
        }
    ?>

    <table width="25%" border="0" align="center">
        <tr>
            <td colspan="2" align="center"><h1>Elige idioma</h1></td>
        </tr>
        <tr>
            <td align="center"><a href="crearCookie.php?lang=es">Español</a></td>
            <td align="center"><a href="crearCookie.php?lang=en">English</a></td>
        </tr>
    </table>
</body>
</html>