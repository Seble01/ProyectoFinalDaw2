<?php
// Conexión a la base de datos
$db = new PDO('mysql:host=localhost;dbname=proyectofinalconcesionario', 'root', '');
 
// Recoger los datos enviados por el formulario
$nombre = $_POST['nombre'];
$modelo = $_POST['modelo'];
$ano = $_POST['annio'];
$cv = $_POST['cv'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];

if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) 
{
    // Verificar que el archivo subido sea una imagen
    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
    if($check !== false) {
        
        
        $ruta_imagen = "../imagenes/" . $_FILES['imagen']['name'];
        
        // Mover el archivo de imagen de la carpeta temporal a la ruta indicada
        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_imagen);

        $sql = "INSERT INTO motos (nombre, modelo, año, cv, precio, stock, imagen) VALUES (:nombre, :modelo, :annio, :cv, :precio, :stock, :imagen)";
        $query = $db->prepare($sql);
        
        $query->bindParam(':nombre', $_POST['nombre']);
        $query->bindParam(':modelo', $_POST['modelo']);
        $query->bindParam(':annio', $_POST['annio']);
        $query->bindParam(':cv', $_POST['cv']);
        $query->bindParam(':precio', $_POST['precio']);
        $query->bindParam(':stock', $_POST['stock']);
        $query->bindParam(':imagen', $ruta_imagen);
        $query->execute();

        // Redirigir a la página de motos
        header("Location: ../php/anadirCoche.php");
        exit();
    } 
} 
else 
{
    // El archivo de imagen no se envió correctamente
    echo "Error al subir la imagen";
}
?>
