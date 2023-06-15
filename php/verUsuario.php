<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech-Beff</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="../estilos/stylesAdmin.css" rel="stylesheet">

</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-body">
            <?php
            // Realizamos la conexión a la base de datos
            $conexion = new mysqli("qahz145.techbeff.com", "qahz145", "45Raty11", "qahz145");

            if ($conexion->connect_error) {
                die("Error al conectar con la base de datos: " . $conexion->connect_error);
            }

            $idUsuario = $_GET['id']; // Obtener el ID del usuario de la URL

            // Obtener la información del usuario
            $consultaUsuario = "SELECT * FROM usuarios WHERE ID = $idUsuario";
            $resultadoUsuario = mysqli_query($conexion, $consultaUsuario);

            if ($resultadoUsuario && mysqli_num_rows($resultadoUsuario) > 0) {
                $usuario = mysqli_fetch_assoc($resultadoUsuario);

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Se ha enviado el formulario de modificación de datos

                    // Obtener los nuevos valores del formulario
                    $nombre = $_POST['nombre'];
                    $apellidos = $_POST['apellidos'];
                    $correo = $_POST['correo'];
                    $password = $_POST['contrasena'];

                    // Actualizar los datos del usuario en la base de datos
                    $actualizarUsuario = "UPDATE usuarios SET NOMBRE = '$nombre', APELLIDOS = '$apellidos', CORREO = '$correo', PASSWORD = '$password' WHERE ID = $idUsuario";
                    $resultadoActualizar = mysqli_query($conexion, $actualizarUsuario);

                    if ($resultadoActualizar) {
                        echo '<p class="success-msg">Los datos del usuario han sido actualizados correctamente.</p>';
                    } else {
                        echo '<p class="error-msg">Error al actualizar los datos del usuario.</p>';
                    }
                }

                echo '<h2>Información del Usuario</h2>';
                echo '<div class="form-container">';
                echo '<form method="POST">';
                echo '<div class="form-group">';
                echo '<label for="nombre">Nombre:</label>';
                echo '<input type="text" id="nombre" name="nombre" class="form-control" value="' . $usuario['NOMBRE'] . '">';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label for="apellidos">Apellidos:</label>';
                echo '<input type="text" id="apellidos" name="apellidos" class="form-control" value="' . $usuario['APELLIDOS'] . '">';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label for="correo">Correo:</label>';
                echo '<input type="email" id="correo" name="correo" class="form-control" value="' . $usuario['CORREO'] . '">';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label for="password">Password:</label>';
                echo '<input type="password" class="form-control" id="contrasena" name="contrasena" value="' . $usuario['PASSWORD'] . '">';
                echo '<button type="button" id="togglePassword" class="btn btn-outline-secondary" onclick="togglePasswordVisibility()">Mostrar</button>';
                echo '</div>';
                echo '<input type="submit" value="Guardar cambios" class="btn btn-primary">';
                echo '</form>';
                echo '</div>';

                // Obtener los vehículos comprados por el usuario
                $consultaVehiculos = "SELECT * FROM carrito WHERE ID_USUARIO = $idUsuario";
                $resultadoVehiculos = mysqli_query($conexion, $consultaVehiculos);

                if ($resultadoVehiculos && mysqli_num_rows($resultadoVehiculos) > 0) {
                    echo '<h3>Vehículos Comprados</h3>';
                    echo '<ul>';
                    while ($vehiculo = mysqli_fetch_assoc($resultadoVehiculos)) {
                        echo '<li>';
                        echo 'Nombre: ' . $vehiculo['NOMBRE'] . ', ';
                        echo 'Modelo: ' . $vehiculo['MODELO'] . ', ';
                        echo 'Año: ' . $vehiculo['ANO'] . ', ';
                        echo 'CV: ' . $vehiculo['CV'] . ', ';
                        echo 'Precio: ' . $vehiculo['PRECIO'];
                        echo '</li>';
                    }
                    echo '</ul>';
                } else {
                    echo '<p>No se han encontrado vehículos comprados por este usuario.</p>';
                }
            } else {
                echo 'Usuario no encontrado';
            }
            ?>
        </div>
    </div>
</div>

<div class="container">
  <a href="gestionUsuarios.php" class="btn btn-primary">Volver a la gestión de usuarios</a>
</div>

<script>
        function togglePasswordVisibility() {
          const passwordInput = document.getElementById("contrasena");
          const toggleButton = document.getElementById("togglePassword");
          
          if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleButton.textContent = "Ocultar";
          } else {
            passwordInput.type = "password";
            toggleButton.textContent = "Mostrar";
          }
        }

        // Ocultar la contraseña al cargar la página
        document.addEventListener("DOMContentLoaded", function() {
          const passwordInput = document.getElementById("contrasena");
          const toggleButton = document.getElementById("togglePassword");
          
          passwordInput.type = "password";
          toggleButton.textContent = "Mostrar";
        });
</script>
</body>
</html>
