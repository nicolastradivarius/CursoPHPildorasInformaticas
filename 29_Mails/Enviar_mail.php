<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);


$comentarios = $_POST["comentarios"];
$destinatario = $_POST["destinatario"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$asunto = $_POST["asunto"];
// $headers = "MIME-Version: 1.0\r\n";
// $headers .= "Content-type: text/html; charset='utf8'\r\n";
// $headers .= "From: Prueba Nicolas < xxxxxxxxxxxxx@hotmail.com >\r\n";

try {
    //Server settings
    $mail->SMTPDebug  = SMTP::DEBUG_SERVER;                     //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'xxxxxxxxxxxxxxxx@gmail.com';         //SMTP username
    $mail->Password   = 'consultar en la cuenta';                     //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mail->Charset = "utf8";

    //Recipients
    //en principio setFrom() deberia tener como primer argumento el mismo
    //username que puse antes: xxxxxxxxxxxxxxxxxxxx@gmail.com
    $mail->setFrom('xxxxxxxxxxxxxxxxxx@gmail.com', 'Nicolás Test');
    $mail->addAddress('xxxxxxxxxxxxxxxxxx@hotmail.com', 'Nicolás Hotmail');     //Add a recipient
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');
    $mail->addCustomHeader('MIME-Version', '1.0');;
    $mail->addCustomHeader('Content-type', 'text/html; charset=utf8');;
    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $asunto;
    $mail->Body    = $comentarios;

    $exito = $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
