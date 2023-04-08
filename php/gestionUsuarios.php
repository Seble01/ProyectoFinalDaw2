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
       <link href="../estilos/stylesAdmin.css" rel="stylesheet">
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
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        text-align: left;
        padding: 8px;
        background-color: #e2e2ef;

    }


    th {
        background-color: #4CAF50;
        color: white;
    }

    .cambiar-rol {
        background-color: #008CBA;
        border: none;
        color: white;
        padding: 5px 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        margin: 2px;
        cursor: pointer;
    }
</style>

<?php
 // Realizamos la conexión a la base de datos
 $conexion = new mysqli("localhost", "carlosseble", "proyectofinal**1937", "proyectofinalconcesionario");
 if ($conexion->connect_error) 
 {
   die("Error al conectar con la base de datos: " . $conexion->connect_error);
 }
 
 $consulta = "SELECT * FROM usuarios WHERE TIPO_USU = 'U'";
$resultado = mysqli_query($conexion, $consulta);

if (mysqli_num_rows($resultado) > 0) 
{
    // Si hay usuarios, mostrarlos en una tabla HTML
    echo '<table>';
    echo '<tr><th>ID</th><th>Nombre</th><th>Apellidos</th><th>Email</th><th>Tipo de usuario</th><th>Acción</th></tr>';
    while ($fila = mysqli_fetch_assoc($resultado)) 
    {
        echo '<tr>';
        echo '<td>' . $fila['ID'] . '</td>';
        echo '<td>' . $fila['NOMBRE'] . '</td>';
        echo '<td>' . $fila['APELLIDOS'] . '</td>';
        echo '<td>' . $fila['CORREO'] . '</td>';
        echo '<td>' . $fila['TIPO_USU'] . '</td>';
        echo '<td><button class="cambiar-rol" data-id="' . $fila['ID'] . '">Cambiar Rol</button></td>';
        echo '</tr>';
    }
    echo '</table>';
} 

else 
{
    echo 'No hay usuarios registrados';
}
?>
   
  
      <!-- Footer -->
      <footer class="bg-dark text-white py-3">
          <div class="container text-center">
              <p>© 2023 Tech-Beff</p>
          </div>
      </footer>


      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
      <script src="cerrarRestoAdmin.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script>
            $('.cambiar-rol').click(function() {
                // Obtener el ID del usuario
                var id = $(this).data('id');
                var fila = $(this).parents('tr'); // Obtener la fila correspondiente

                // Enviar el ID del usuario a tu archivo PHP
                $.ajax({
                    url: 'cambiar_rol.php',
                    method: 'POST',
                    data: { id: id },
                    dataType: 'json', // Especificar que la respuesta es un JSON
                    success: function(response) {
                        // Actualizar los datos de la fila correspondiente
                        fila.find('td:eq(4)').text(response.TIPO_USU);
                    },
                    error: function(xhr, status, error) {
                        // Manejar errores de la petición (opcional)
                    }
                });
            });
        </script>

</body>
</html>




