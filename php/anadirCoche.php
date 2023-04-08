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
       <link href="../estilos/stylesAnadirCoche.css" rel="stylesheet">
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



                    
                        <form action="agregar_coche.php" id="formulario" method="post" class="formularioInscripcion" enctype="multipart/form-data">
                        <h2>Agregar nuevo Coche</h2>
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" required><br>

                            <label for="modelo">Modelo:</label>
                            <input type="text" id="modelo" name="modelo" required><br>

                            <label for="combustible">Combustible:</label>
                            <select id="combustible" name="combustible">
                            <option value="GASOLINA">Gasolina</option>
                            <option value="DIÉSEL">Diésel</option>
                            <option value="ELÉCTRICO">Eléctrico</option>
                            </select>

                            <label for="anio">Año:</label>
                            <input type="text" id="anio" name="anio" required><br>

                            <label for="cv">CV:</label>
                            <input type="number" id="cv" name="cv" required><br>

                            <label for="stock">Stock:</label>
                            <input type="number" id="stock" name="stock" required><br>

                            <label for="precio">Precio:</label>
                            <input type="number" id="precio" name="precio" required><br>

                            <label for="imagen">Imagen:</label>
                            <input type="file" id="imagen" name="imagen" accept="image/*" required><br>

                            <input type="submit" value="Agregar">
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
                            url: "agregar_coche.php",
                            data: formData,
                            success: function() 
                            {
                                alert("Inserción Correcta");
                                // Actualizar la página sin recargarla
                                $("#coches").load("(vehiculos/coches.php #coches");
                                
                            }
                        });
                });
            });
    </script>


</body>
</html>