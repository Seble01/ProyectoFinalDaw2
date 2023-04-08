<?php
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
        $carrito = $_SESSION['carrito'];

        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            $_SESSION['carrito'] = $carrito;
                    // Calcula el precio total
        $precioTotal = 0;
        foreach ($carrito as $producto) {
            $subtotal = $producto['precio'] * $producto['cantidad'];
            $precioTotal += $subtotal;
        }

        // Devuelve una respuesta JSON con el carrito actualizado y el precio total
        $response = [
            'carrito' => $carrito,
            'precioTotal' => $precioTotal
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
        exit(); // Agrega esta línea para detener la ejecución del resto del archivo
    }
}
}