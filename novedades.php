<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech-Beff</title>
       <!-- Estilos CSS -->
       
       <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
       <link href="estilos/styles2.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-light bg-light">
  <a href="index.php">
    <img class="iconoInicio" src="imagenes/Ensigna.png" alt="">
  </a> 

  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item divider">
        <a class="nav-link"  href="index.php">Inicio</a>
      </li>
      <li class="nav-item divider">
        <a class="nav-link"  href="vehiculosDisponibles.php">Vehículos Disponibles</a>
      </li>
      <li class="nav-item divider">
        <a class="nav-link" href="novedades.php" id="about">Novedades</a>
      </li>
      
      <?php

        session_start();
          if (isset($_SESSION['correo'])) 
          {

            echo '<li class="nav-item divider">
                    <a class="nav-link" href="php/miperfil.php">Mi Perfil ('. $_SESSION['correo'] .')</a>
                  </li>';
            echo '<li class="nav-item divider">
                    <a class="nav-link" href="vehiculos/carrito.php">Carrito</a>
                  </li>';
                  echo '<li class="nav-item divider">
                    <a class="nav-link" href="" onclick="logout()">Cerrar sesión</a>
                  </li>';                   
          } 
          
          else 
          {
            echo '<li class="nav-item divider">
                    <a class="nav-link" href="perfilado.html">Iniciar Sesión</a>
                  </li>';
          }

      ?>
      
    </ul>
  </div>
</nav>


      <main>
        <div class="split-container">
            <a href="vehiculos/motos.php">
                <div class="split left">
                    <h2 class="ocasion">Adéntrate en lo Salvaje</h2>
                </div>
            </a>
            <a href="vehiculos/coches.php">
                <div class="split right">
                    <h2 class="vendidos">Supera tus límites</h2>
                </div>
            </a>
            <div class="line"></div> <!-- línea separadora -->
        </div>
    </main>


      <button id="scroll-top-btn" class="scroll-top-btn" onclick="scrollToTop()">

      </button>
  
      <!-- Footer -->
      <footer class="bg-dark text-white py-3">
          <div class="container text-center">
          <p>© 2023 Tech-Beff</p>
          </div>
      </footer>


      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
      <script src="js/cerrarSesion.js"></script>

</body>
</html>