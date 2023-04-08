<!DOCTYPE html>
<html>
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
 
  
  <!-- Carousel -->
    

<?php
       
        extract($_POST);

        /*
          echo "<pre>";
          print_r($_POST);
          echo "</pre>";
        */

        $id = $_POST['id_moto'];
        $nombre = $_POST['nombre'];
        $modelo = $_POST['modelo']; 
        $cv = $_POST['cv'];
        $precio = $_POST['precio'];
        $stock = $_POST['stock'];

        $cantidad_en_carrito = isset($_POST['stock']) ? $_POST['stock'] : 0;

        $correo = $_SESSION['correo'];

        // Conectarse a la base de datos
        $conexion = new mysqli("localhost", "root", "", "proyectofinalconcesionario");

        $sqlID = "SELECT ID FROM usuarios WHERE CORREO = '$correo'";
        //echo $sqlID;
        $resultado = $conexion->query($sqlID);

        if ($resultado->num_rows > 0) 
        {
            $fila = $resultado->fetch_assoc();
            $idUsuario = $fila['ID'];
            //echo $idUsuario;

            
              $insert = "INSERT INTO carrito_moto (ID_CARRITO, ID_USUARIO, ID_MOTO, NOMBRE, MODELO, ANO, CV, PRECIO) VALUES ('', '$idUsuario', '$id', '$nombre', '$modelo', '$cv', '$año', '$precio')";
              $resultado = $conexion->query($insert);
          
              if ($resultado) 
              {
                  echo '<h1 class="resultado">La moto se ha comprado exitosamente.</h1>';
              } 
              
              else 
              {
                  echo '<h1 class="ruina">No se ha podido comprar la moto. Por favor, inténtalo de nuevo más tarde.</h1>';
              }
        } 

        else 
        {
            echo "<h1 class='ruina2'>No se ha encontrado ningún usuario con el correo electrónico '$correo'.</h1>";
        }

        // Actualizar el stock de la moto en la tabla motos
        $sqlUpdate = "UPDATE motos SET STOCK = STOCK - $cantidad_en_carrito WHERE ID_MOTO = $id";
        
        //echo $sqlUpdate;

        if ($conexion->query($sqlUpdate) === TRUE) 
        {
            echo "<h1 class='resultado'>El stock de la moto se ha actualizado correctamente.</h1>";
        } 

        else 
        {
            echo "Error al actualizar el stock de la moto: " . $conexion->error;
        }

        $conexion->close();
?>
    


    <!-- Footer -->
    <footer class="bg-dark text-white py-3">
        <div class="container text-center">
            <p>© 2023 Mi Sitio Web</p>
        </div>
    </footer>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/slider.js"></script>
    <script src="js/cerrarSesion.js"></script>
