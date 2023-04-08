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
       <link href="../estilos/styles2.css" rel="stylesheet">
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


<style>

body
{
  background-image: url("../imagenes/bmwseriexdrive.jpg");
  background-size: cover;
  background-repeat: no-repeat;
}

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
</style>

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
    </tr>
  </thead>
  <tbody>
    <?php
    // Realizamos la conexión a la base de datos
    $conn = new mysqli("localhost", "root", "", "proyectofinalconcesionario");
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
        echo "<td>" . $row["CV"] . "</td>";
        echo "<td>" . $row["PRECIO"] . "</td>";
        echo "<td>" . $row["STOCK"] . "</td>";
        
        echo "<td><button onclick='borrar(" . $row["ID_COCHE"] . ")'>Borrar</button></td>";
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



    
  
      <!-- Footer -->
      <footer class="bg-dark text-white py-3">
          <div class="container text-center">
          <p>© 2023 Tech-Beff</p>
          </div>
      </footer>


      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
      <script src="cerrarRestoAdmin.js"></script>
      <script>

    function borrar(id) 
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
            xhttp.send("ID_COCHE=" + id);
        }
    }

</script>


</body>
</html>





