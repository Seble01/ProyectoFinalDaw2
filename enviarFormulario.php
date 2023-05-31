<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtén los valores del formulario
  $nombre = $_POST['nombre'];
  $apellidos = $_POST['apellidos'];
  $correo = $_POST['correo'];
  $mensaje = $_POST['mensaje'];

  // Configura el correo electrónico
  $destinatario = 'proyectofinaltechbeff@gmail.com';
  $asunto = 'Nuevo formulario de contacto';
  $cuerpo = "Nombre: $nombre\nApellidos: $apellidos\nCorreo: $correo\nMensaje: $mensaje";
  $cabeceras = "From: $correo";

  // Envía el correo electrónico
  if (mail($destinatario, $asunto, $cuerpo, $cabeceras)) {
    echo 'El formulario ha sido enviado exitosamente.';
  } else {
    echo 'Error al enviar el formulario. Por favor, inténtalo nuevamente.';
  }
} else {
  echo 'Acceso no válido.';
}
?>
