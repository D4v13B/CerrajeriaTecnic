<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
   
   $nombre = $_POST['nombre'];
   $email = $_POST['email'];
   $mensaje = $_POST['mensaje'];
   $telefono = $_POST['telefono'];

   // $nombre = "David";
   // $email = "hola@gmail.com";
   // $mensaje = "klklklk";
   // $telefono = "6666-6666";

   try {
      //Server settings
      // $mail->SMTPDebug = SMTP::DEBUG_SERVER;//Enable verbose debug output
      $mail->isSMTP();//Send using SMTP
      $mail->Host       = 'smtp.gmail.com';//Set the SMTP server to send through
      $mail->SMTPAuth   = true;//Enable SMTP authentication
      $mail->Username   = 'cerratecnic@gmail.com';//SMTP username
      $mail->Password   = 'gbwnclarnsvjcgxn';//SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;//Enable implicit TLS encryption
      $mail->Port       = 465;//TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
      
      echo "Hola";
      //Recipients
      $mail->setFrom("cerratecnic@gmail.com");
      $mail->addAddress("cerratecnic@gmail.com");
      
      //Attachments
      //  $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
      //  $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
      
      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = "{$nombre} quiere contactarse contigo para tus servicios";
      $mail->Body    = "<b>{$nombre}</b> quiere contactarte desde tu pagina web. Su email de contacto es <b>{$email} y su celular es: {$telefono}</b>;
      <p>El mensaje dice lo siguiente: {$mensaje}</p>";
      // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
      
      $mail->send();
      echo 'Message has been sent';
   } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
   }
}
?>