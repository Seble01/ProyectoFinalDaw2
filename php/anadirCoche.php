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
       <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <a class="nav-link"  href="anadirCoche.php">Gestión de Vehículos</a>
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

<style>


table {
  border-collapse: collapse;
  width: 100%;
  background-color: #f2f2f2; 
}

th, td {
  text-align: left;
  padding: 8px;
}

th {
  background-color: #333;
  color: white;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

button {
  background-color: #f44336;
  color: white;
  padding: 6px 12px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

button:hover {
  background-color: #d32f2f;
}

#botones-opciones button {
    margin-bottom: 10px;
  }

@media screen and (max-width: 767px) {
  table {
    font-size: 14px;
    table-layout: fixed;
    overflow-x: scroll;
  }

  th, td {
    padding: 4px;
  }

  button {
    padding: 4px 8px;
  }

  button {
    display: block;
    margin-bottom: 5px;
  }
}

</style>

<div id="opciones">
  
  <div id="opcion-coche">
    <!-- formulario para agregar moto -->

    
<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Modelo</th>
      <th>Año</th>
      <th>Tipo Combustible</th>
      <th>CV</th>
      <th>Precio</th>
      <th>Stock</th>
      <th>Borrar</th>
      <!--<th>Editar</th>-->
    </tr>
  </thead>
  <tbody>
    <?php
    // Realizamos la conexión a la base de datos
    $conn = new mysqli("localhost", "carlosseble", "proyectofinal**1937", "proyectofinalconcesionario");

    if ($conn->connect_error) {
      die("Error al conectar con la base de datos: " . $conn->connect_error);
    }

    // Realizamos la SELECT para obtener los datos de la tabla motos
    $sql = "SELECT * FROM coches";
    $result = $conn->query($sql);

    // Mostramos los datos en la tabla
    if ($result->num_rows > 0) 
    {
      while($row = $result->fetch_assoc()) 
      {
        echo "<tr>";
        echo "<td>" . $row["ID_COCHE"] . "</td>";
        echo "<td>" . $row["NOMBRE"] . "</td>";
        echo "<td>" . $row["MODELO"] . "</td>";
        echo "<td>" . $row["AÑO"] . "</td>";
        echo "<td>" . $row["TIPO_COCHE"] . "</td>";
        echo "<td>" . $row["MODELO_COCHE"] . "</td>";
        echo "<td>" . $row["CV"] . "</td>";
        echo "<td>" . $row["PRECIO"] . "</td>";
        echo "<td>" . $row["STOCK"] . "</td>";
        
        echo "<td><button onclick='borrarCoche(" . $row["ID_COCHE"] . ")'>Borrar</button></td>";
        echo "</tr>";
      }
    } 
    
    else 
    {
      echo "<tr><td colspan='9'>No hay resultados</td></tr>";
    }

    // Cerramos la conexión a la base de datos
    $conn->close();
    ?>
  </tbody>
</table>
  </div>
  <div id="opcion-moto">
    <!-- tabla para mostrar las motos -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>CV</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Borrar</th>
                <!--<th>Editar</th>-->
            </tr>
        </thead>
        <tbody>
            <?php
            // Realizamos la conexión a la base de datos
            $conn = new mysqli("localhost", "carlosseble", "proyectofinal**1937", "proyectofinalconcesionario");
            if ($conn->connect_error) {
                die("Error al conectar con la base de datos: " . $conn->connect_error);
            }

             // Realizamos la SELECT para obtener los datos de la tabla motos
             $sql = "SELECT * FROM motos";
             $result = $conn->query($sql);
 
             // Mostramos los datos en la tabla
             if ($result->num_rows > 0) {
                 while ($row = $result->fetch_assoc()) {
                     echo "<tr>";
                     echo "<td>" . $row["ID_MOTO"] . "</td>";
                     echo "<td>" . $row["NOMBRE"] . "</td>";
                     echo "<td>" . $row["MODELO"] . "</td>";
                     echo "<td>" . $row["AÑO"] . "</td>";
                     echo "<td>" . $row["CV"] . "</td>";
                     echo "<td>" . $row["PRECIO"] . "</td>";
                     echo "<td>" . $row["STOCK"] . "</td>";
 
                     echo "<td><button onclick='borrarMoto(" . $row["ID_MOTO"] . ")'>Borrar</button></td>";
                     /*echo "<td><button onclick='editar(" . $row["ID_MOTO"] . ")'>Editar</button></td>";*/
                     echo "</tr>";
                 }
             } else {
                 echo "<tr><td colspan='9'>No hay resultados</td></tr>";
             }
 
             // Cerramos la conexión a la base de datos
             $conn->close();
             ?>
         </tbody>
     </table>
 </div>
   <div id="opcion-anadir-coche">
     <!-- formulario para anadir coche -->
 
     <form action="agregar_coche.php" id="formulario" method="post" class="formularioInscripcion" enctype="multipart/form-data">
         <h2>Agregar nuevo Coche</h2>
         <label for="nombre">Nombre:</label>
         <input type="text" id="nombre" name="nombre" pattern="[a-zA-Z]{3,20}" title="El nombre debe tener entre 3 y 20 letras" required><br>
 
         <label for="modelo">Modelo:</label>
         <input type="text" id="modelo" name="modelo" pattern="^(?=.*\d)[a-zA-Z\d]{2,20}$" title="El modelo debe tener entre 2 y 20 letras y al menos 1 número" required><br>
 
         <label for="combustible">Combustible:</label>
         <select id="combustible" name="combustible">
             <option value="G">Gasolina</option>
             <option value="D">Diésel</option>
             <option value="E">Eléctrico</option>
         </select>
 
         <label for="tipo_modelo">Tipo de Modelo:</label>
         <select id="tipo_modelo" name="tipo_modelo">
             <option value="O">Ocasión</option>
             <option value="N">Novedades</option>
             <option value="A">Gama Alta</option>
         </select>
 
         <label for="anio">Año:</label>
         <input type="text" id="anio" name="anio" pattern="[0-9]+" title="El año debe ser numérico" required><br>
 
         <label for="cv">CV:</label>
         <input type="number" id="cv" name="cv" pattern="[0-9]+" title="La potencia debe ser numérico" required><br>
 
         <label for="stock">Stock:</label>
         <input type="number" id="stock" name="stock" min="1" title="El stock debe ser mayor que 0" required><br>
 
         <label for="precio">Precio:</label>
         <input type="text" id="precio" name="precio" pattern="[0-9]+(\.[0-9]+)?" title="El precio debe ser numérico" required><br>
 
         <label for="imagen">Imagen:</label>
         <input type="file" name="imagen" id="imagen" required>
         <span id="error-message" class="d-none">La extensión del archivo debe ser gif, png, jpg o jpeg</span>
 
         <input type="submit" value="Agregar">
     </form>
   </div>
 
   <div id="opcion-anadir-moto">
     <!-- formulario para anadir moto -->
 
     <form action="agregar_moto.php" id="formulario" method="post" class="formularioInscripcion" enctype="multipart/form-data">
         <h2 id="formulario-titulo">Agregar nueva Moto</h2>
 
         <input type="hidden" name="ID_MOTO" id="id-moto-input">
 
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
 
         <button type="submit" id="submit-btn">Agregar</button>
   
         <div class="alert alert-danger d-none" id="error-message" role="alert">
             El archivo seleccionado no es una imagen válida.
         </div>
     </form>
   </div>
 </div>
 <br>
 <div id="botones-opciones" class="text-center">
   <button type="button" class="btn btn-primary" data-form-id="opcion-coche">Listado de Coches</button>
   <br>
   <button type="button" class="btn btn-primary" data-form-id="opcion-moto">Listado de Motos</button>
   <br>
   <button type="button" class="btn btn-primary" data-form-id="opcion-anadir-coche">Añadir Coche</button>
   <br>
   <button type="button" class="btn btn-primary" data-form-id="opcion-anadir-moto">Añadir Moto</button>
 </div>
 
 
                     
 
 
     
   
       <!-- Footer -->
       <footer class="bg-dark text-white py-3">
           <div class="container text-center">
           <p>© 2023 Tech-Beff</p>
           </div>
       </footer>
 
 
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
       <script src="cerrarRestoAdmin.js"></script>
 
       <script>
     $(document).ready(function() {
         $("#formulario").submit(function(event) {
             // Prevenir que el formulario se envíe de forma tradicional
             event.preventDefault();
 
             // extensión archivo seleccionado
             var extension = $('#imagen').val().split('.').pop().toLowerCase();
 
             // verifica si extensión es válida
             if (jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1) {
                 $('#error-message').removeClass('d-none'); // Quitamos la clase d-none
                 return false;
             }
 
             // Recoger los datos del formulario
             var formData = new FormData(this);
 
             // Enviar la petición AJAX
             $.ajax({
                 type: "POST",
                 url: "agregar_coche.php",
                 data: formData,
                 processData: false,
                 contentType: false,
                 success: function() {
                     alert("Inserción Correcta");
                     // Actualizar la página sin recargarla
                     $("#coches").load("(vehiculos/coches.php #coches");
                 }
             });
         });
     });
 </script>
 
 <script>
   $(document).ready(function() {
   // ocultar todos los formularios al principio
   $('#opciones > div').hide();
 
   // manejar clic en opciones
   $('#botones-opciones > button').click(function() {
     // obtener el ID del formulario correspondiente
     var formID = $(this).data('form-id');
     
     // ocultar formulario actualmente abierto
     $('#opciones > div:visible').hide();
     
     // mostrar el formulario seleccionado
     $('#' + formID).show();
   });
 });
 </script>
 
 <script>
     
     function borrarMoto(idMoto) {
       if (confirm("¿Estás seguro de que quieres borrar esta moto?")) 
         {
             var xhttp = new XMLHttpRequest();
             xhttp.onreadystatechange = function() 
             {
                 if (this.readyState == 4 && this.status == 200) 
                 {
                     // Recargamos la página para actualizar la tabla
                     location.reload();
                 }
             };
             xhttp.open("POST", "borrar.php", true);
             xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
             xhttp.send("ID_MOTO=" + idMoto);
         }
     }
 
 
     function borrarCoche(idCoche) 
     {
         if (confirm("¿Estás seguro de que quieres borrar este coche?")) 
         {
             var xhttp = new XMLHttpRequest();
             xhttp.onreadystatechange = function() 
             {
                 if (this.readyState == 4 && this.status == 200) 
                 {
                     // Recargamos la página para actualizar la tabla
                     location.reload();
                 }
             };
             xhttp.open("POST", "borrarcoches.php", true);
             xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
             xhttp.send("ID_COCHE=" + idCoche);
         }
     }
 
 </script>
 <!--
 <script>
     function editar(idMoto) {
         // Obtener referencia al formulario y al título
         var formulario = document.getElementById("formulario");
         var titulo = document.getElementById("formulario-titulo");
 
         // Cambiar el título del formulario a "Editar Moto"
         titulo.textContent = "Editar Moto";
 
         // Obtener referencia al botón de agregar/editar
         var botonAgregarEditar = document.getElementById("submit-btn");
 
         // Cambiar el texto del botón a "Editar"
         botonAgregarEditar.textContent = "Editar";
 
         // Obtener referencia al input oculto del ID de la moto
         var idMotoInput = document.getElementById("id-moto-input");
 
         // Asignar el ID de la moto al input oculto
         idMotoInput.value = idMoto;
 
         // Realizar una petición al servidor para obtener los datos de la moto seleccionada
         var xhr = new XMLHttpRequest();
         xhr.onreadystatechange = function() {
             if (xhr.readyState === 4 && xhr.status === 200) {
                 // Convertir la respuesta en un objeto JSON
                 var moto = JSON.parse(xhr.responseText);
 
                 // Llenar los campos del formulario con los valores de la moto
                 document.getElementById("nombre").value = moto.nombre;
                 document.getElementById("modelo").value = moto.modelo;
                 document.getElementById("annio").value = moto.annio;
                 document.getElementById("cv").value = moto.cv;
                 document.getElementById("precio").value = moto.precio;
                 document.getElementById("stock").value = moto.stock;
             }
         };
         xhr.open("GET", "obtener_moto.php?id=" + idMoto, true);
         xhr.send();
     }
 </script>
   -->
 </body>
 </html>