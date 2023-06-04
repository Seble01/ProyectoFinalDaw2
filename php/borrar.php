<?php
// Verificamos si se recibió el parámetro "id"
if(isset($_POST['ID_MOTO'])) 
{
  // Obtenemos el valor del parámetro "id"
  $id = $_POST['ID_MOTO'];

  // Realizamos la conexión a la base de datos
  $servername = "localhost";
  $username = "carlosseble";
  $password = "proyectofinal**1937";
  $dbname = "proyectofinalconcesionario";

  $conn = new mysqli($servername, $username, $password, $dbname);

  // Verificamos si la conexión fue exitosa
  if ($conn->connect_error) 
  {
    die("Conexión fallida: " . $conn->connect_error);
  }

  // Eliminamos las filas correspondientes en la tabla "carrito_moto" que tienen el ID de la moto
  $sqlCarrito = "DELETE FROM carrito_moto WHERE ID_MOTO = $id";
  $conn->query($sqlCarrito);

  // Creamos la consulta SQL para borrar la moto de la tabla "motos"
  $sql = "DELETE FROM motos WHERE ID_MOTO = $id";

  // Ejecutamos la consulta
  if ($conn->query($sql) === TRUE) 
  {
    // Si la consulta fue exitosa, enviamos una respuesta con estado HTTP 200 (OK)
    http_response_code(200);
    echo "Moto eliminada exitosamente";
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
  echo "Se requiere el parámetro 'ID_MOTO'";
}

?>
