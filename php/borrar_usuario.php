<?php
// Realizamos la conexión a la base de datos
$conexion = new mysqli("qahz145.techbeff.com", "qahz145", "45Raty11", "qahz145");
if ($conexion->connect_error) {
    die("Error al conectar con la base de datos: " . $conexion->connect_error);
}

// Obtener el ID del usuario desde la petición POST
$id = $_POST['id'];

// Eliminar el usuario de la base de datos
$stmt = $conexion->prepare("DELETE FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id);
$resultado = $stmt->execute();

// Devolver una respuesta (puede ser un JSON vacío o algún mensaje)
$response = array('status' => 'success');
echo json_encode($response);
?>
