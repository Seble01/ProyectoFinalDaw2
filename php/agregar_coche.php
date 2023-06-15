<?php
try {
    // Conexión a la base de datos
    $db = new PDO('mysql:host=qahz145.techbeff.com;dbname=qahz145', 'qahz145', '45Raty11');

    // Recoger los datos enviados por el formulario
    $nombre = $_POST['nombre'];
    $modelo = $_POST['modelo'];
    $anio = $_POST['anio'];
    $cv = $_POST['cv'];
    $precio = $_POST['precio'];
    $tipo_combustible = $_POST['combustible'];
    $tipo_modelo = $_POST['tipo_modelo'];
    $stock = $_POST['stock'];

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {

        // Ruta donde se guardará la imagen
        $target_dir = "imagenes/";
        $target_file = $target_dir . basename($_FILES["imagen"]["name"]);

        // Comprobar si la imagen es válida
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $extensions_arr = array("jpg", "jpeg", "png", "gif");
        if (in_array($imageFileType, $extensions_arr)) {

            // Consulta de inserción
            $sql = "INSERT INTO coches (nombre, modelo, anio, cv, tipo_coche, modelo_coche, precio, stock, imagen) 
                    VALUES (:nombre, :modelo, :anio, :cv, :tipo_combustible, :tipo_modelo, :precio, :stock, :imagen)";
            $query = $db->prepare($sql);

            // Vincular parámetros
            $query->bindParam(':nombre', $nombre);
            $query->bindParam(':modelo', $modelo);
            $query->bindParam(':anio', $anio);
            $query->bindParam(':cv', $cv);
            $query->bindParam(':tipo_combustible', $tipo_combustible);
            $query->bindParam(':tipo_modelo', $tipo_modelo);
            $query->bindParam(':precio', $precio);
            $query->bindParam(':stock', $stock);
            $query->bindParam(':imagen', $target_file);

            // Mover la imagen al directorio de destino
            move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file);

            // Ejecutar la consulta
            $query->execute();

            echo "El coche se ha añadido correctamente a la base de datos.";
        } else {
            echo "Error al subir la imagen: solo se permiten archivos de imagen JPG, JPEG, PNG o GIF.";
        }
    } else {
        echo "Error al subir la imagen.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
