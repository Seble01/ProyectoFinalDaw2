<?php
session_start(); // Iniciamos la sesión

// Si el usuario ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
  // Conectamos a la base de datos utilizando PDO
  $dsn = 'mysql:host=qahz145.techbeff.com;dbname=qahz145';
  $usuario = 'qahz145';
  $contrasena = '45Raty11';
  $opciones = array(
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_EMULATE_PREPARES => false
  );
  
  try {
    $pdo = new PDO($dsn, $usuario, $contrasena, $opciones);
  } catch (PDOException $e) {
    die('Error al conectarse a la base de datos: ' . $e->getMessage());
  }

  // Preparamos los datos para la consulta
  $correo = $_POST['correo'];
  $password = $_POST['password'];

  // Consultamos los datos del usuario en la base de datos
  // Preparar la consulta SQL
  $query = "SELECT TIPO_USU FROM usuarios WHERE CORREO= :correo AND PASSWORD= :password";
  $stmt = $pdo->prepare($query);

  // Enlazar los valores a los placeholders
  $stmt->bindParam(':correo', $correo);
  $stmt->bindParam(':password', $password);

  // Ejecutar la consulta
  $stmt->execute();

  // Vinculamos las variables de resultado
  $stmt->bindColumn('TIPO_USU', $tipo_usu);

  // Recuperamos los resultados
  $stmt->fetch();

  if ($stmt->rowCount() == 1) 
  { 
    // Si encontramos un usuario
    $_SESSION['tipo_usu'] = $tipo_usu;
    $_SESSION['correo'] = $correo;

    if ($_SESSION['tipo_usu'] == 'U') 
    { // Si es un usuario normal
      echo 'index.php'; // Redirigimos al usuario a la página de usuario
    } 
    
    elseif ($_SESSION['tipo_usu'] == 'A') 
    { // Si es un administrador
      echo 'admin.php'; // Redirigimos al usuario a la página de administrador
    }
  } 
  
  else 
  { 
    // Si no encontramos un usuario
    http_response_code(400); // Cambiamos el código de respuesta HTTP a 400 para indicar un error
    echo json_encode(['error' => 'Usuario desconocido o contraseña errónea']); // Devolvemos un JSON con el mensaje de error
  }

  // Cerrar la conexión
  $pdo = null;
}
?>
