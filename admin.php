<?php 
    session_start();
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
       <link href="estilos/stylesAdmin.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-light bg-light">
  <a href="admin.php">
    <img class="iconoInicio" src="imagenes/Ensigna.png" alt="">
  </a> 

  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item divider">
        <a class="nav-link"  href="admin.php">Inicio</a>
      </li>

      <li class="nav-item divider">
        <a class="nav-link"  href="php/anadirCoche.php">Gestión de Vehículos</a>
      </li>

      <li class="nav-item divider">
        <a class="nav-link"  href="php/gestionUsuarios.php">Gestión de Usuarios</a>
      </li>

      <li class="nav-item divider">
        <a class="nav-link" href="#" onclick="logout(); return false;">Cerrar sesión</a>     
      </li>
    </ul>
  </div>
</nav>


      


    
  
        <!-- Footer -->
    <footer class="bg-dark text-white py-3">
      <div class="container text-center">
        <p>© 2023 Tech-Beff</p>
        <p>Carlos Serrano Blesa</p>
        <div class="social-icons">
          <a href="https://twitter.com/" target="_blank" rel="noopener noreferrer" class="twitter"><i class="fab fa-twitter"></i></a>
          <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer" class="instagram"><i class="fab fa-instagram"></i></a>
          <a href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer" class="linkedin"><i class="fab fa-linkedin"></i></a>
        </div>
      </div>
    </footer>


      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
      <script src="php/cerrarSesionAdmin.js"></script>

</body>
</html>