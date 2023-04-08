<?php

require 'phpmail/src/PHPMailer.php';
require 'phpmail/src/SMTP.php';
require 'phpmail/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $nombre = $_POST["nombre"];
  $apellidos = $_POST["apellidos"];
  $correo = $_POST["correo"];
  $mensaje = $_POST["mensaje"];

  // Configuración del servidor de correo
  $mail = new PHPMailer(true);
  $mail->isSMTP();
  $mail->Host       = 'smtp.gmail.com';
  $mail->SMTPAuth   = true;
  $mail->Username   = 'utr.serranocarlos@gmail.com';
  $mail->Password   = 'cocopoty19';
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Port       = 587;

  // Configuración del mensaje
  $mail->setFrom($correo, $nombre . ' ' . $apellidos);
  $mail->addAddress('carlossvqcsb@gmail.com');
  $mail->isHTML(false);
  $mail->Subject = 'Nuevo mensaje del formulario de contacto';
  $mail->Body    = "Nombre: $nombre\n" .
                   "Apellidos: $apellidos\n" .
                   "Correo electrónico: $correo\n" .
                   "Mensaje:\n$mensaje\n";

  // Envío del correo
  try {
    $mail->send();
    echo 'Mensaje enviado correctamente';
  } catch (Exception $e) {
    echo 'No se pudo enviar el mensaje. Error: ', $mail->ErrorInfo;
  }

}

?>
