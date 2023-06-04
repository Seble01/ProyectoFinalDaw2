<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech-Beff</title>
       <!-- Estilos CSS -->
       
       <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
       <link href="../estilos/estiloCoches.css" rel="stylesheet">
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






<div id="cards-container">

    <div class="contenedor-cards">
    <?php 
      
        // Conexión a la base de datos

        $db = new PDO('mysql:host=localhost;dbname=proyectofinalconcesionario', 'carlosseble', 'proyectofinal**1937');

        $sql = "SELECT * FROM coches WHERE MODELO_COCHE='N'";
        $query = $db->prepare($sql);

        $query->execute();

        // Generar las Cards dinámicamente
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) 
        {
            if ($row['STOCK'] > 0) {
                echo "<div class='card'>";
                echo "<img src='../imagenes/" . basename($row['IMAGEN']) . "'>";
                echo "<h2>Marca: " . $row['NOMBRE'] . "</h2>";
                  echo "<h5>Modelo: " . $row['MODELO'] . "</h5>";
                  echo "<p>Año: " . $row['AÑO'] . "</p>";
                  echo "<p>Caballos: " . $row['CV'] . "</p>";
                  echo "<p>Precio: ". $row['PRECIO'] . "€</p>";
                  echo "<p>Tipo de Coche: ". $row['TIPO_COCHE'] . "</p>";
                  echo "<a href='verModeloCoche.php?id=" . $row['ID_COCHE'] . "' class='comprar-btn'>Ver Modelo</a>";

                echo "</div>";
            } else {
                echo "<div class='card'>";
                echo "<img src='../imagenes/" . basename($row['IMAGEN']) . "'>";
                echo "<h2>Marca: " . $row['NOMBRE'] . "</h2>";
                  echo "<h5>Modelo: " . $row['MODELO'] . "</h5>";
                  echo "<p>Año: " . $row['AÑO'] . "</p>";
                  echo "<p>Caballos: " . $row['CV'] . "</p>";
                  echo "<p>Precio: ". $row['PRECIO'] . "€</p>";
                  echo "<p>Tipo de Coche: ". $row['TIPO_COCHE'] . "</p>";
                  echo "<p class='agotado'>Agotado</p>";
                echo "</div>";
            }
        }


    ?>
    
    </div>

</div>

  
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
      <script src="cerrarSesion.js"></script>

</body>
</html>














