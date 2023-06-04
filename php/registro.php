<?php

$servername = "localhost";
$username = "carlosseble";
$password = "proyectofinal**1937";
$dbname = "proyectofinalconcesionario";

// Crear la conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión a la base de datos
if ($conn->connect_error) {
  die("Error al conectar con la base de datos: " . $conn->connect_error);
}

if (isset($_POST['nombre-usuario']) && isset($_POST['apellidos']) && isset($_POST['correo']) && isset($_POST['password'])) 
{
  $nombre_usuario = $_POST['nombre-usuario'];
  $apellidos = $_POST['apellidos'];
  $correo = $_POST['correo'];
  $contrasena = $_POST['password'];

  // Verificar si el correo ya está registrado en la base de datos
  $query = "SELECT correo FROM usuarios WHERE correo = '$correo'";
  $resultado = mysqli_query($conn, $query);

  if (mysqli_num_rows($resultado) > 0) 
  {
    // Si el correo ya está registrado, mostrar un mensaje de error y detener la ejecución del script
    echo "Este correo ya está registrado.";
    exit();
  }

  // Registrar al nuevo usuario en la base de datos
  $query = "INSERT INTO usuarios (NOMBRE, APELLIDOS, CORREO, PASSWORD, TIPO_USU, ID) VALUES ('$nombre_usuario', '$apellidos', '$correo', '$contrasena', 'U', '')";
  $resultado = mysqli_query($conn, $query);

  // Verificar si se ha producido algún error en la ejecución de la consulta
  if (!$resultado) 
  {
    die("Error al registrar el usuario: " . mysqli_error($conn));
  }

  // Cerrar la conexión a la base de datos
  mysqli_close($conn);

  // Mostrar mensaje de éxito y redireccionar al usuario
  echo "Usuario registrado correctamente.";
  header('Location: ../index.php');
  exit();
}

?>
