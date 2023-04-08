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
       <link href="../estilos/stylesAnadirMoto.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-light bg-light">
  <a href="../admin.php">
    <img class="iconoInicio" src="../imagenes/Ensigna.png" alt="">
  </a> 

  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item divider">
        <a class="nav-link"  href="../admin.php">Inicio</a>
      </li>

      <li class="nav-item divider">
        <a class="nav-link"  href="anadirMoto.php">Añadir Moto</a>
      </li>

      <li class="nav-item divider">
        <a class="nav-link"  href="anadirCoche.php">Añadir Coche</a>
      </li>

      <li class="nav-item divider">
        <a class="nav-link"  href="borrarMoto.php">Borrar Moto</a>
      </li>

      <li class="nav-item divider">
        <a class="nav-link"  href="borrarCoche.php">Borrar Coche</a>
      </li>


      <li class="nav-item divider">
        <a class="nav-link"  href="gestionUsuarios.php">Gestión de Usuarios</a>
      </li>

      <li class="nav-item divider">
        <a class="nav-link" href="#" onclick="logout(); return false;">Cerrar sesión</a>     
      </li>
    </ul>
  </div>
</nav>


<form action="agregar_moto.php" id="formulario" method="post" class="formularioInscripcion" enctype="multipart/form-data">
<h2>Agregar nueva Moto</h2>

  <label for="nombre">Nombre:</label>
  <input type="text" name="nombre" id="nombre" required>

  <label for="modelo">Modelo:</label>
  <input type="text" name="modelo" id="modelo" required>

  <label for="año">Año:</label>
  <input type="number" name="annio" id="annio" required>

  <label for="cv">CV:</label>
  <input type="number" name="cv" id="cv" required>

  <label for="precio">Precio:</label>
  <input type="number" name="precio" id="precio" required>

  <label for="stock">Stock:</label>
  <input type="number" name="stock" id="stock" required>

  <label for="imagen">Imagen:</label>
  <input type="file" name="imagen" id="imagen" required>

  <button type="submit">Agregar</button>
</form>



    
  
      <!-- Footer -->
      <footer class="bg-dark text-white py-3">
          <div class="container text-center">
          <p>© 2023 Tech-Beff</p>
          </div>
      </footer>


      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
      <script src="cerrarRestoAdmin.js"></script>

      <script>
            $(document).ready(function() 
            {
                $("#formulario").submit(function(event) 
                {
                    // Prevenir que el formulario se envíe de forma tradicional
                    event.preventDefault();
                    
                    // Recoger los datos del formulario
                    var formData = $(this).serialize();
                    
                    // Enviar la petición AJAX
                    $.ajax(
                        {
                            type: "POST",
                            url: "agregar_moto.php",
                            data: formData,
                            success: function() 
                            {
                                alert("Inserción Correcta");
                                // Actualizar la página sin recargarla
                                $("#motos").load("vehiculos/motos.php #motos");
                            }
                        });
                });
            });
    </script>


</body>
</html>