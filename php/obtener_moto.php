<?php
// Verificamos si se recibió el parámetro "id"
if (isset($_GET['id'])) {
    // Obtenemos el valor del parámetro "id"
    $idMoto = $_GET['id'];

    // Realizamos la conexión a la base de datos
    $servername = "qahz145.techbeff.com";
    $username = "qahz145";
    $password = "45Raty11";
    $dbname = "qahz145";
    
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificamos si la conexión fue exitosa
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Creamos la consulta SQL para obtener los datos de la moto correspondiente al ID recibido
    $sql = "SELECT * FROM motos WHERE ID_MOTO = $idMoto";
    $result = $conn->query($sql);

    // Verificamos si se encontró la moto
    if ($result->num_rows > 0) {
        // Obtenemos los datos de la moto como un array asociativo
        $moto = $result->fetch_assoc();

        // Devolvemos los datos de la moto en formato JSON
        echo json_encode($moto);
    } else {
        // No se encontró la moto, devolvemos un mensaje de error en formato JSON
        echo json_encode(array('error' => 'Moto no encontrada'));
    }

    // Cerramos la conexión a la base de datos
    $conn->close();
} else {
    // No se recibió el parámetro "id", devolvemos un mensaje de error en formato JSON
    echo json_encode(array('error' => 'Se requiere el parámetro "id"'));
}
?>
