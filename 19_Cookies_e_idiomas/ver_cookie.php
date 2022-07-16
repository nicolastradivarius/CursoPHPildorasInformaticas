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
        //no ponemos isset porque lanza un warning de undefined index
        //al hacerlo asi, arrojará un true si existe la variable y un false si no existe
        if(isset($_COOKIE["selected_lang"])) {
            header("location: pag1.php");
        } else {
            switch ($_COOKIE["selected_lang"]) {
                case 'es':
                    header("location:spanish.php");
                    break;

                case "en":
                    header("location:english.php");
                    break;
            }
        }
    ?>
</body>
</html>