<?php

try{
// Conexión a la base de datos
$db = new PDO('mysql:host=qahz145.techbeff.com;dbname=qahz145', 'qahz145', '45Raty11');

$nombre = $_POST['nombre'];
$modelo = $_POST['modelo'];
$ano = $_POST['annio'];
$cv = $_POST['cv'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];

if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) 
{

        $sql = "INSERT INTO motos (nombre, modelo, anio, cv, precio, stock, imagen) VALUES (:nombre, :modelo, :annio, :cv, :precio, :stock, :imagen)";
        $query = $db->prepare($sql);
        
        $query->bindParam(':nombre', $_POST['nombre']);
        $query->bindParam(':modelo', $_POST['modelo']);
        $query->bindParam(':annio', $_POST['annio']);
        $query->bindParam(':cv', $_POST['cv']);
        $query->bindParam(':precio', $_POST['precio']);
        $query->bindParam(':stock', $_POST['stock']);
        $query->bindParam(':imagen', $ruta_imagen);
        $query->execute();

        // Ruta donde se guardará la imagen
        $target_dir = "imagenes/";
        $target_file = $target_dir . basename($_FILES["imagen"]["name"]);

        // Comprobar si la imagen es válida
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $extensions_arr = array("jpg","jpeg","png","gif");
        if (in_array($imageFileType,$extensions_arr)) {
            
            move_uploaded_file($_FILES['imagen']['tmp_name'],$target_file);

            
            $query->bindParam(':imagen', $target_file);

           
            $query->execute();

            echo "La moto se ha añadido correctamente a la base de datos.";
        } else {
            echo "Error al subir la imagen: solo se permiten archivos de imagen JPG, JPEG, PNG o GIF.";
        }
    } 

else 
{
    // El archivo de imagen no se envió correctamente
    echo "Error al subir la imagen";
}

}
catch(PDOException $e) {
        
    echo "Error: " . $e->getMessage();
    }
?>

