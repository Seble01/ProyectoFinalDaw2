<?php
    // Recuperar el ID del modelo seleccionado
    if (isset($_GET['id'])) 
    {
        $id = $_GET['id'];
    } 
    
    else 
    {
        // Si no se proporciona un ID válido, redirigir a la página anterior
        header("Location: index.php");
        exit();
    }

    // Conexión a la base de datos
    $db = new PDO('mysql:host=localhost;dbname=proyectofinalconcesionario', 'carlosseble', 'proyectofinal**1937');

    // Preparar la consulta para obtener los detalles del modelo
    $sql = "SELECT * FROM motos WHERE ID_MOTO = :id";
    $query = $db->prepare($sql);
    $query->bindParam(":id", $id, PDO::PARAM_INT);

    // Ejecutar la consulta
    $query->execute();

    // Verificar si se encontró algún resultado
    if ($query->rowCount() == 0) 
    {
        echo "No se encontraron resultados para el modelo seleccionado.";
        exit();
    }

    // Recuperar los detalles del modelo
    $row = $query->fetch(PDO::FETCH_ASSOC);

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech-Beff</title>
       <!-- Estilos CSS -->
       
       <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
       <link href="../estilos/estiloModelo.css" rel="stylesheet">
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
        
        if (!isset($_SESSION)) 
        {
            session_start();

        }
          
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

<!-- Mostrar los detalles del modelo en la página -->

<div class="container">
  <div class="card">
    <div class="card-header">
      Información del Producto
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-4">
          <img src=<?php echo "../imagenes/" . basename($row['IMAGEN'])  ?> width="200">
        </div>
        <div class="col-md-8">
          <h5 class="card-title"><?php echo $row['NOMBRE'] ?></h5>
          <ul class="list-group">
            <li class="list-group-item"><strong>Precio:</strong> <?php echo $row['PRECIO'] ?>€</li>
            <li class="list-group-item"><strong>Stock:</strong> <?php echo $row['STOCK'] ?></li>
            <li class="list-group-item"><strong>Modelo:</strong> <?php echo $row['MODELO'] ?></li>
            <li class="list-group-item"><strong>Año:</strong> <?php echo $row['AÑO'] ?></li>
            <li class="list-group-item"><strong>Potencia:</strong> <?php echo $row['CV'] ?>CV</li>

          </ul>
          <form action="carrito.php" method="POST">
            <input type="hidden" name="nombre" value="<?php echo $row['NOMBRE'] ?>">
            <input type="hidden" name="modelo" value="<?php echo $row['MODELO'] ?>">
            <input type="hidden" name="año" value="<?php echo $row['AÑO'] ?>">
            <input type="hidden" name="cv" value="<?php echo $row['CV'] ?>">
            <input type="hidden" name="precio" value="<?php echo $row['PRECIO'] ?>">
            <input type="hidden" name="stock" value="<?php echo $row['STOCK'] ?>">
            <input type="hidden" name="id" value="<?php echo $row['ID_MOTO'] ?>">
            <input type="hidden" name="tipo_vehiculo" value="moto">
            <input type="hidden" name="cantidad" value="1">
            <div class="form-group mt-3">
              <?php if (isset($_SESSION['correo'])) : ?>
                <button type="submit" class="btn btn-primary">Agregar al Carrito</button>
              <?php else: ?>
                <a class="btn btn-primary" href="../perfilado.html">Inicie Sesión para Comprar</a>
              <?php endif; ?>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>



       <!-- Footer -->
    <footer class="bg-dark text-white py-3">
      <div class="container text-center">
        <p>© 2023 Tech-Beff</p>
        <p>Carlos Serrano Blesa</p>
      </div>
    </footer>


      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
      <script src="cerrarSesion.js"></script>
       
</body>
</html>