<?php
// Verificamos si se recibió el parámetro "id"
if(isset($_POST['ID_COCHE'])) 
{
  // Obtenemos el valor del parámetro "id"
  $id = $_POST['ID_COCHE'];

  // Realizamos la conexión a la base de datos
  $servername = "qahz145.techbeff.com";
  $username = "qahz145";
  $password = "45Raty11";
  $dbname = "qahz145";

  $conn = new mysqli($servername, $username, $password, $dbname);

  // Verificamos si la conexión fue exitosa
  if ($conn->connect_error) 
  {
    die("Conexión fallida: " . $conn->connect_error);
  }

  // Creamos la consulta SQL para borrar la fila correspondiente al ID recibido
  $sql = "DELETE FROM coches WHERE ID_COCHE = $id";

  // Ejecutamos la consulta
  if ($conn->query($sql) === TRUE) 
  {
    // Si la consulta fue exitosa, enviamos una respuesta con estado HTTP 200 (OK)
    http_response_code(200);
    echo "Coche eliminado exitosamente";
  } 
  
  else 
  {
    // Si la consulta falló, enviamos una respuesta con estado HTTP 500 (Internal Server Error)
    http_response_code(500);
    echo "Error al eliminar la moto: " . $conn->error;
  }

  // Cerramos la conexión a la base de datos
  $conn->close();
} 

else 
{
  // Si no se recibió el parámetro "id", enviamos una respuesta con estado HTTP 400 (Bad Request)
  http_response_code(400);
  echo "Se requiere el parámetro 'ID_COCHE'";
}

?>