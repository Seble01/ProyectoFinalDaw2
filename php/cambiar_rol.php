<?php
// Realizamos la conexión a la base de datos
$conexion = new mysqli("localhost", "carlosseble", "proyectofinal**1937", "proyectofinalconcesionario");
if ($conexion->connect_error) {
    die("Error al conectar con la base de datos: " . $conexion->connect_error);
}

// Obtener el ID del usuario desde la petición POST
$id = $_POST['id'];

// Actualizar el rol del usuario en la base de datos
$stmt = $conexion->prepare("UPDATE usuarios SET TIPO_USU = 'A' WHERE id = ?");
$stmt->bind_param("i", $id);
$resultado = $stmt->execute();

// Obtener los nuevos datos del usuario
$consulta = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $conexion->prepare($consulta);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$fila = $resultado->fetch_assoc();

// Devolver los nuevos datos del usuario en formato JSON
echo json_encode($fila);
?>
