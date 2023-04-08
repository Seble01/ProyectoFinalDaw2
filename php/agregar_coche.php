<?php
// Conexión a la base de datos
$db = new PDO('mysql:host=localhost;dbname=proyectofinalconcesionario', 'carlosseble', 'proyectofinal**1937');
 
// Recoger los datos enviados por el formulario
$nombre = $_POST['nombre'];
$modelo = $_POST['modelo'];
$ano = $_POST['anio'];
$cv = $_POST['cv'];
$precio = $_POST['precio'];
$tipo_combustible = $_POST['combustible'];
$stock = $_POST['stock'];

if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) 
{

    // Ruta donde se guardará el archivo de imagen
    $ruta_imagen = "../imagenes/" . $_FILES['imagen']['name'];
    
    // Mover el archivo de imagen de la carpeta temporal a la ruta indicada
    move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_imagen);

    // Preparar la consulta para insertar un nuevo registro
    // Insertar la información de la moto en la base de datos, incluyendo la ruta de la imagen
    $sql = "INSERT INTO coches (nombre, modelo, año, cv, tipo_coche, precio, stock, imagen) VALUES (:nombre, :modelo, :anio, :cv, :combustible, :precio, :stock, :imagen)";
    $query = $db->prepare($sql);
    
    $query->bindParam(':nombre', $_POST['nombre']);
    $query->bindParam(':modelo', $_POST['modelo']);
    $query->bindParam(':anio', $_POST['anio']);
    $query->bindParam(':cv', $_POST['cv']);
    $query->bindParam(':precio', $_POST['precio']);
    $query->bindParam(':stock', $_POST['stock']);
    $query->bindParam(':combustible', $_POST['combustible']);
    $query->bindParam(':imagen', $ruta_imagen);
    $query->execute();

    // Redirigir a la página de motos
    header("Location: ../php/anadirCoche.php");
    exit();
} 

else 
{
    // El archivo de imagen no se envió correctamente
    echo "Error al subir la imagen";
}
?>
