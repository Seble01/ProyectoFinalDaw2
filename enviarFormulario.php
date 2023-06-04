<?php
//echo 'Respuesta de prueba';

require 'vendor/autoload.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if (isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['correo']) && isset($_POST['mensaje']) &&
      !empty($_POST['nombre']) && !empty($_POST['apellidos']) && !empty($_POST['correo']) && !empty($_POST['mensaje'])) {


        $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $mensaje = $_POST['mensaje'];


    $validator = new \Egulias\EmailValidator\EmailValidator();
    $isValidEmail = $validator->isValid($correo, new \Egulias\EmailValidator\Validation\RFCValidation());

    if ($isValidEmail) {

      $destinatario = 'proyectofinaltechbeff@gmail.com';
      $asunto = 'Nuevo formulario de contacto';
      $cuerpo = "Nombre: $nombre\nApellidos: $apellidos\nCorreo: $correo\nMensaje: $mensaje";
      $cabeceras = "From: $correo";


      $smtpHost = 'smtp.gmail.com';
      $smtpPort = 587;
      $smtpUsuario = 'proyectofinaltechbeff@gmail.com';
      $smtpClave = 'nkvfxtqoixjrjxrl';


      $opciones = [
        'ssl' => [
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
        ]
      ];


      $transport = new Swift_SmtpTransport($smtpHost, $smtpPort, 'tls');
      $transport->setUsername($smtpUsuario);
      $transport->setPassword($smtpClave);
      $transport->setStreamOptions($opciones);


      $mailer = new Swift_Mailer($transport);

      // Crea el mensaje
      $message = new Swift_Message($asunto);
      $message->setFrom([$correo => $nombre]);
      $message->setTo([$destinatario]);
      $message->setBody($cuerpo);

      http_response_code(200);
      // Envía el correo electrónico
      if ($mailer->send($message)) {
        echo 'El formulario ha sido enviado exitosamente.';
        echo 'Muchas gracias por ponerte en contacto con nosotros.';
      } else {
        echo 'Error al enviar el formulario. Por favor, inténtalo nuevamente.';
      }
    } else {
      echo 'La dirección de correo electrónico no es válida.';
    }
  } else {
    echo 'Todos los campos del formulario son requeridos.';
  }
} else {
  echo 'Acceso no válido.';
}
?>
