<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech-Beff</title>
       <!-- Estilos CSS -->
       
       <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
       <link href="../estilos/estiloMotos.css" rel="stylesheet">
      
</head>
<body>

<nav class="navbar navbar-light bg-light">
  <a href="../index.php">
    <img class="iconoInicio" src="../imagenes/Ensigna.png" alt="">
  </a> 

  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                    <a class="nav-link" href="carrito_moto.php">Carrito</a>
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

extract($_POST);
echo "<pre>";
print_r($_POST);
echo "</pre>";

$id = isset($_POST['id']) ? $_POST['id'] : null;

$nombre_moto = "";
$modelo_moto = "";
$año_moto = "";
$cv_moto = "";
$precio_moto = "";
$stock_moto = "";

if(isset($_POST['submit'])) 
{
  // Recogemos los datos del formulario
  //$id = $_POST['id'];
  $nombre_moto = $_POST['nombre'];
  $modelo_moto = $_POST['modelo'];
  $año_moto = $_POST['año'];
  $cv_moto = $_POST['cv'];
  $precio_moto = $_POST['precio'];
  $stock_moto = $_POST['stock'];

  // Creamos un array asociativo con los datos de la moto
  $moto = array(
    'id_moto' => $id,
    'nombre' => $nombre_moto,
    'modelo' => $modelo_moto,
    'año' => $año_moto,
    'cv' => $cv_moto,
    'precio' => $precio_moto,
    'stock' => $stock_moto
);

  // Comprobamos si el carrito está vacío
  if(!isset($_SESSION['carrito'])) 
  {
    $_SESSION['carrito'] = array();
  }

  // Comprobamos si la moto ya está en el carrito
  $en_carrito = false;
  $cantidad_en_carrito = 1;
  foreach($_SESSION['carrito'] as &$m) 
  {
      if($m['id_moto'] === $id) 
      {
          $m['stock']++;
          $en_carrito = true;
          $cantidad_en_carrito = $m['stock'];
          break;
      }
  }

  // Si la moto no está en el carrito, la añadimos
  if(!$en_carrito) 
  {
      $moto['stock'] = $cantidad_en_carrito;
      array_push($_SESSION['carrito'], $moto);
  }
}
?>

<?php

// Verificar si hay motos en el carrito antes de mostrarlas
if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) 
{
  ?>
  <div class="container">
    <div class="details">
      <h1>Carrito de Compra</h1>
      <table>
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Modelo</th>
            <th>Año</th>
            <th>Caballos</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Comprar</th>
            <th>Borrar</th>
          </tr>
        </thead>
        <tbody>
          <?php
          
          // Recorrer el array "carrito" y mostrar la información de cada moto en filas de la tabla
          foreach ($_SESSION['carrito'] as $key => $moto) 
          {
            ?>
            <tr>
              <td><?php echo $moto['nombre'] ?></td>
              <td><?php echo $moto['modelo'] ?></td>
              <td><?php echo $moto['año'] ?></td>
              <td><?php echo $moto['cv'] ?> CV</td>
              <td><?php echo $moto['precio'] ?>€</td>
              <td><?php echo $moto['stock'] ?></td>
              <td>
              <form action="comprar.php" method="post" id="comprarMoto">
                  <input type="hidden" name="id_moto" value="<?php echo $moto['id_moto'] ?>">                 
                  <input type="hidden" name="nombre" value="<?php echo $moto['nombre'] ?>">
                 <input type="hidden" name="modelo" value="<?php echo $moto['modelo'] ?>">
                 <input type="hidden" name="año" value="<?php echo $moto['año'] ?>">
                 <input type="hidden" name="cv" value="<?php echo $moto['cv'] ?>">
                 <input type="hidden" name="precio" value="<?php echo $moto['precio'] ?>">
                 <input type="hidden" name="stock" value="<?php echo $moto['stock'] ?>">
                 <button id="comprar" type="submit">Comprar</button>                
              </form>
              </td>
              <td>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
              <input type="hidden" name="id" value="<?php echo $id ?>">                
              <button type="submit" name="borrar_moto">Borrar del Carrito</button>
              </form>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
<?php
} 

else 
{
  echo "<h2>No se ha agregado ningún vehículo al carrito</h2>";
}

?>

<?php
if (isset($_POST['borrar_moto'])) 
{
  $id = $_POST['id'];
  foreach ($_SESSION['carrito'] as $key => $moto) 
  {
      if (isset($moto['id']) && $moto['id'] == $id) 
      {
          unset($_SESSION['carrito'][$key]);
          echo json_encode(array('success' => true));
          exit();
      }
  }
  echo json_encode(array('success' => false));
  exit();
}

?>
      <!-- Footer -->
      <footer class="bg-dark text-white py-3">
          <div class="container text-center">
              <p>© 2023 Mi Sitio Web</p>
          </div>
      </footer>


      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
      <script src="cerrarSesion.js"></script>

    

</body>
</html>
