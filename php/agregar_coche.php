<?php
try {
    // Conexión a la base de datos
    $db = new PDO('mysql:host=localhost;dbname=proyectofinalconcesionario', 'root', '');

    // Recoger los datos enviados por el formulario
    $nombre = $_POST['nombre'];
    $modelo = $_POST['modelo'];
    $ano = $_POST['anio'];
    $cv = $_POST['cv'];
    $precio = $_POST['precio'];
    $tipo_combustible = $_POST['combustible']; // Corregido aquí
    echo "Tipo de combustible: " . $tipo_combustible;
    $stock = $_POST['stock'];

    echo "Datos recogidos del formulario";

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        
        
        $sql = "INSERT INTO coches (nombre, modelo, año, cv, tipo_coche, precio, stock, imagen) VALUES (:nombre, :modelo, :anio, :cv, :tipo_combustible, :precio, :stock, :imagen)";
        $query = $db->prepare($sql);

        $query->bindParam(':nombre', $nombre);
        $query->bindParam(':modelo', $modelo);
        $query->bindParam(':anio', $ano);
        $query->bindParam(':cv', $cv);
        $query->bindParam(':tipo_combustible', $tipo_combustible);
        $query->bindParam(':precio', $precio);
        $query->bindParam(':stock', $stock);

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

            echo "El coche se ha añadido correctamente a la base de datos.";
        } else {
            echo "Error al subir la imagen: solo se permiten archivos de imagen JPG, JPEG, PNG o GIF.";
        }
    } 
    
}

catch(PDOException $e) {
        
        echo "Error: " . $e->getMessage();
        }
        ?>
