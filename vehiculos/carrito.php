

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech-Beff</title>
       <!-- Estilos CSS -->
       <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
       <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
       <link href="../estilos/estiloCarrito.css" rel="stylesheet">
      
</head>
<body>

<nav class="navbar navbar-light bg-light">
  <a href="../index.php">
    <img class="iconoInicio" src="../imagenes/Ensigna.png" alt="">
  </a> 

  <button class="navbar-toggler menu-activo" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item divider">
        <a class="nav-link"  href="../index.php">Inicio</a>
      </li>
      <li class="nav-item divider">
        <a class="nav-link"  href="../vehiculosDisponibles.php">Vehículos Disponibles</a>
      </li>
      <li class="nav-item divider">
        <a class="nav-link" href="../novedades.php" id="about">Novedades</a>
      </li>

      <?php
        
        session_start();

          if (isset($_SESSION['correo'])) 
          {
            echo '<li class="nav-item divider">
                    <a class="nav-link" href="../php/miperfil.php">Mi Perfil ('. $_SESSION['correo'] .')</a>
                  </li>';
            echo '<li class="nav-item divider">
                    <a class="nav-link" href="carrito.php">Carrito</a>
                  </li>';
            echo '<li class="nav-item divider">
                    <a class="nav-link" href="" onclick="logout()">Cerrar sesión</a>
                  </li>';                  
          } 
          
          else 
          {
            echo '<li class="nav-item divider">
                    <a class="nav-link" href="../perfilado.html">Iniciar Sesión</a>
                  </li>';
          }

      ?>

    </ul>
  </div>
</nav>

<?php

// Conexión a la base de datos
$conexion = new mysqli("localhost", "carlosseble", "proyectofinal**1937", "proyectofinalconcesionario");

// Inicializa el precio total
$precioTotal = 0;

if (isset($_POST['tipo_vehiculo'], $_POST['id'], $_POST['nombre'], $_POST['modelo'], $_POST['año'], $_POST['cv'], $_POST['precio'])) 
{
  // Crear un array con la información del producto
  $producto = array(
      'tipo_vehiculo' => $_POST['tipo_vehiculo'],
      'id' => $_POST['id'],
      'nombre' => $_POST['nombre'],
      'modelo' => $_POST['modelo'],
      'año' => $_POST['año'],
      'cv' => $_POST['cv'],
      'precio' => $_POST['precio'],
      'cantidad' => 1 // Agregar la cantidad al array del producto
  );

  // Agregar el producto al array del carrito en la sesión
  if (isset($_SESSION['carrito'])) {
      $_SESSION['carrito'][] = $producto;
  } else {
      $_SESSION['carrito'] = array($producto);
  }
}




?>

<div class="container">
    
    <h1>Carrito de Compras</h1>
    
    <table>
        <thead>
            <tr>
                <th>Tipo Vehículo</th>
                <th>Nombre</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>Caballos</th>
                <th>Precio</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
  <?php
  // Verifica si el carrito no está vacío
  if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) 
  {
/*
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    <form action="vaciarCarrito.php" method="POST">
        <input type="submit" name="submit" class="boton-vaciar" value="Vaciar Carrito">
      </form>
*/
    $precioTotal = 0;
    
    // Recorre el carrito y muestra los productos
    foreach ($_SESSION['carrito'] as $key => $moto) {
    ?>
    <tr>
      <?php if(isset($moto['tipo_vehiculo'])): ?>

    
  <td><?php echo $moto['tipo_vehiculo'] ?></td>
  <?php endif; ?>
  <td><?php echo $moto['nombre'] ?></td>
  <td><?php echo $moto['modelo'] ?></td>
  <td><?php echo $moto['año'] ?></td>
  <td><?php echo $moto['cv'] ?>CV</td>
  <?php if(isset($moto['tipo_coche'])): ?>
  <td><?php echo $moto['tipo_coche'] ?></td>
  <?php endif; ?>
  <td><?php echo $moto['precio'] ?>€</td>
  <td>
  <form class="eliminar-form" data-producto-id="<?php echo $key ?>">
  <button type="submit" class="boton-eliminar" data-producto-id="<?php echo $key ?>">Eliminar</button>
</form>
  </td>
</tr>
<?php 
// Actualizar el precio total
$precioTotal += $moto['precio'];
} }
?>
  
  <tr>
    <td colspan="6"><strong>Precio Total:</strong></td>
    <td><strong><?php echo $precioTotal ?>€</strong></td>
    <td>
      <!--
      <form id="vaciar-carrito-form" method="POST">
        <input type="hidden" name="action" value="vaciar">
        <input type="submit" class="boton-vaciar" value="Vaciar Carrito">
      </form>
      -->
    </td>
    <td>
      <?php if (isset($_SESSION['correo'])) : ?>
        <form action="comprar.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $moto['id']; ?>">
        <input type="hidden" name="nombre" value="<?php echo $moto['nombre'] ?>">
        <input type="hidden" name="modelo" value="<?php echo $moto['modelo'] ?>">
        <input type="hidden" name="año" value="<?php echo $moto['año'] ?>">
        <input type="hidden" name="cv" value="<?php echo $moto['cv'] ?>">
        <input type="hidden" name="tipo_vehiculo" value="<?php echo $moto['tipo_vehiculo'] ?>">
        <input type="hidden" name="precio" value="<?php echo $moto['precio'] ?>">

          <input type="submit" name="submit" class="boton-comprar" value="Comprar">
        </form>
      <?php else : ?>
        <button class="btn-buy" disabled>Comprar</button>
        <p>Inicie Sesión para comprar los productos</p>
      <?php endif; ?>
    </td>
  </tr>
</tbody>
</table>
</div>
</body>
<?php

// Si hay una solicitud AJAX de eliminación de un producto
if (isset($_GET['action']) && $_GET['action'] == 'eliminar' && isset($_GET['id'])) {
  $productoId = $_GET['id'];

  // Busca el producto en el carrito y lo elimina
  if (isset($_SESSION['carrito'][$productoId])) {
    unset($_SESSION['carrito'][$productoId]);

    // Calcula el precio total del carrito
    $precioTotal = 0;
    foreach ($_SESSION['carrito'] as $producto) {
      $precioTotal += $producto['precio'];
    }

    // Devuelve una respuesta JSON con el carrito actualizado y el precio total
    $response = [
      'carrito' => $_SESSION['carrito'],
      'precioTotal' => $precioTotal
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
  }
}

// Si hay una solicitud AJAX de vaciado del carrito
if (isset($_GET['action']) && $_GET['action'] == 'vaciar') {
  // Vacía el carrito
  unset($_SESSION['carrito']);

  // Devuelve una respuesta JSON con el carrito vacío
  $response = [
    'carrito' => [],
    'precioTotal' => 0
  ];
  header('Content-Type: application/json');
  echo json_encode($response);
  exit();
}
?>


<script>
 // Agrega un controlador de eventos de clic al botón de eliminar
const botonesEliminar = document.querySelectorAll('.boton-eliminar');
botonesEliminar.forEach(botonEliminar => {
  botonEliminar.addEventListener('click', () => {
    const productoId = botonEliminar.getAttribute('data-producto-id');
    // Envía una solicitud AJAX para eliminar el producto del carrito
    fetch(`borrarProducto.php?id=${productoId}`)
      .then(response => response.json())
      .then(data => {
        // Actualiza la fila correspondiente al producto eliminado
        const filaEliminada = document.querySelector(`tr[data-producto-id="${productoId}"]`);
        filaEliminada.parentNode.removeChild(filaEliminada);
        // Actualiza el precio total
        const precioTotal = document.querySelector('.precio-total');
        precioTotal.textContent = data.precioTotal;
      })
      .catch(error => console.error(error));
  });
});

</script>

<script>
  document.querySelector('.boton-comprar').addEventListener('click', function() {
    alert('¡GRACIAS POR SU COMPRA!');
  }); 
</script>



<script>
 const navbarToggle = document.querySelector('.navbar-toggler');
navbarToggle.addEventListener('click', () => {
  const navbarCollapse = document.querySelector('.navbar-collapse');
  navbarCollapse.classList.toggle('show');
});
</script>
<script src="cerrarSesion.js"></script>

</html>