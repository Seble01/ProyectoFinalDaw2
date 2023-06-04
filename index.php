<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tech-Beff</title>
    
    <!-- CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="estilos/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <script src="js/botonContacto.js"></script>


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
        <a class="nav-link" href="index.php">Inicio</a>
      </li>
      <li class="nav-item divider">
        <a class="nav-link" href="vehiculosDisponibles.php">Vehículos Disponibles</a>
      </li>
      <li class="nav-item divider">
        <a class="nav-link" href="novedades.php" id="about">Novedades</a>
      </li>
      
      <?php
        session_start();
        if (isset($_SESSION['correo'])) 
        {
          //$_SESSION['correo'] = null;

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

 
  
  <!-- Carousel -->
    <div class="container-fluid">
      </div>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class=""></li>
        </ol>
        <div class="carousel-caption d-none d-md-block">
            <h4 class="comienzaCambio">Comienza el Cambio</h5>
            <p class="comienzaCambio">Concesionario Tech-Beff, déjate llevar</p>
        </div>
        <div class="carousel-inner">
            
            <div class="carousel-item active">
                
                <img src="imagenes/bmwserie1.jpg" class="d-block w-100" alt="...">
                
            </div>
        </div>
    </div>
    <div class="card-description">
			<h2 class="ultimosLanzamientos">Últimos lanzamientos</h2>
		</div>

    <div class="card-container">
      
      <div class="card">
        <img src="imagenes/cosySec.jpg" class="imagen1" alt="Imagen 1">
        <h2>Supera tus límites</h2>
        <p>Conoce nuestra lado más Salvaje <br>con la <b>Serie M</b></p>
        <p>Desde 160.500€</p>
        <button><a href="vehiculos/coches.php">Ver Modelo</a></button>
      </div>
      <div class="card">
        <img src="imagenes/bmw-1-series-modelfinder.png" alt="Imagen 2">
        <h2>Cámbiate a la Comodidad</h2>
        <p>Conduce hoy mismo nuestro <br>nuevo <b>BMW Serie 1</b></p>
        <p>Desde 31.000€</p>
        <button href="vehiculosDisponibles.html"><a href="vehiculos/coches.php">Ver Modelo</a></button>
      </div>
      <div class="card">
        <img src="imagenes/cosySec i3.jpg" alt="Imagen 3">
        <h2>Lánzate a la innovación</h2>
        <p>Nuevo <b>BMW i3</b>, totalmente eléctrico, <br>perfecto para ciudades</p>
        <p>Desde 40.000€</p>
        <button><a href="vehiculos/coches.php">Ver Modelo</a></button>
      </div>
    </div>

<div class="slider-container">
  <div class="gallery">
    <div class="slides">
      <img src="imagenes/bmw-1-series-modelfinder.png" alt="Imagen 1">
      <img src="imagenes/x3.jpg" alt="Imagen 2">
      <img src="imagenes/cosySec i3.jpg" alt="Imagen 3">
      <img src="imagenes/bmw-5-series-touring-posi-modelfinder_v2.png" alt="Imagen 4">
      <img src="imagenes/cosySec i3.jpg" alt="Imagen 5">
      <img src="imagenes/bmw-1-series-modelfinder.png" alt="Imagen 6">
      <img src="imagenes/cosySec.jpg" alt="Imagen 7">
      <img src="imagenes/cosySec i3.jpg" alt="Imagen 8">
    </div>
  </div>
 
</div>

    <div class="boxes">
      <div class="box">
        <a href="vehiculosDisponibles.php">
          <h3 class="todoVehiculos">Vehículos Disponibles</h3>
          <!--<img class="box-icon-right" src="coche.png" alt="Icono de Coche">-->
        </a>
      </div>
      <div class="box">
        <a href="novedades.php">
          <h3>Novedades</h3>
          <!--<img class="box-icon-right" src="configuraciones.png" alt="Icono de Configuración">-->
        </a>
      </div>
      <div class="box">
        <a href="perfilado.html">
          <h3>Perfil del Cliente</h3> 
          <!--<img class="box-icon-right" src="usuario.png" alt="Icono de inicio de sesión">-->
        </a>
      </div>
    </div>

    <div class="container">
  <div class="row map-form-row">
    <div class="col-xs-12 col-md-6">
      <div class="map" id="map" ></div>
    </div>
    <div class="col-xs-12 col-md-6">
      <div class="contacto-container">
        <form id="formulario-contacto" class="contacto-form" method="POST" action="enviarFormulario.php">
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
          </div>
          <div class="mb-3">
            <label for="apellidos" class="form-label">Apellidos</label>
            <input type="text" class="form-control" id="apellidos" name="apellidos" required>
          </div>
          <div class="mb-3">
            <label for="correo" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="correo" name="correo" required>
          </div>
          <div class="mb-3">
            <label for="mensaje" class="form-label">Mensaje</label>
            <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required></textarea>
          </div>
          
          <?php
          
            if (session_status() == PHP_SESSION_NONE) {
              session_start();
            }      
            if (isset($_SESSION['correo'])) 
            {
              echo '<button type="submit" class="btn btn-primary">Enviar</button>';
            } 
            else 
            {
              echo '<button type="button" class="btn btn-primary" disabled>Inicie sesión para enviar Mensaje</button>';
            }
            ?>

        </form>
      </div>
    </div>
  </div>
</div>




    <button id="scroll-top-btn" class="scroll-top-btn" onclick="scrollToTop()">

    </button>

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
    <script src="js/slider.js"></script>
    <script src="js/cerrarSesion.js"></script>
   
    <script>

      function initMap() 
      {

        var map = new google.maps.Map(document.getElementById('map'), 
        {
          center: {lat: 37.350121, lng:  -5.943317},
          zoom: 8
        });

        var marker = new google.maps.Marker({
          position: {lat: 37.350121, lng:  -5.943317},
          map: map,
          title: 'Mi Tienda - Tech-Beff'
        });
      }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkUx6bM2Wqb7FnNXlvtnMHEd0MpdsIaRI&callback=initMap" async defer></script>

    <script>
      document.getElementById("formulario-contacto").addEventListener("submit", function(event) {
        event.preventDefault();

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "enviarFormulario.php", true);
        // No es necesario establecer el encabezado "Content-Type" cuando se envía "multipart/form-data"

        xhr.onload = function() {
          if (xhr.status === 200) {
            console.log(xhr.responseText);
            alert(xhr.responseText);
            // Restablecer el formulario después de mostrar el mensaje
            document.getElementById("formulario-contacto").reset();
          } else {
            alert("Error al enviar el formulario. Por favor, inténtalo nuevamente.");
          }
        };

        var formData = new FormData(this);
        xhr.send(formData);

        return false;
      });

    </script>


    