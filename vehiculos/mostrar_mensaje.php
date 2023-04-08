<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se recibió un request POST
    $mensaje = 'Compra Exitosa';
    // Retornar el mensaje en formato JSON
    echo json_encode(['mensaje' => $mensaje]);
    // Detener la ejecución del script
    exit();
}

?>
