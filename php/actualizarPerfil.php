<?php
session_start();

if (!isset($_SESSION['correo'])) 
{
  header("Location: ../index.php");
  exit();
}
 
// Obtener los datos del formulario
echo "<pre>";
print_r($_POST);
echo "</pre>";

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

// Conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$database = "proyectofinalconcesionario";
$conn = mysqli_connect($host, $user, $password, $database);

// Actualizar los datos del usuario en la base de datos
$query = "UPDATE usuarios SET NOMBRE = '$nombre', APELLIDOS = '$apellidos', PASSWORD = '$contrasena' WHERE CORREO = '$correo'";
$resultado = mysqli_query($conn, $query);

// Cerrar la conexión a la base de datos
mysqli_close($conn);

// Redirigir al usuario de vuelta a la página de perfil
header("Location: miperfil.php");
exit();
?>
