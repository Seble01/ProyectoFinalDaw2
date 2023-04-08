<?php
session_start();

if (!isset($_SESSION['correo'])) 
{
  header("Location: ../index.php");
  exit();
}

// Conexión a la base de datos
$host = "localhost";
$user = "carlosseble";
$password = "proyectofinal**1937";
$database = "proyectofinalconcesionario";
$conn = mysqli_connect($host, $user, $password, $database);

// Obtener los datos del usuario
$correo = $_SESSION['correo'];
$query = "SELECT NOMBRE, APELLIDOS, CORREO, PASSWORD FROM usuarios WHERE CORREO = '$correo'";
$resultado = mysqli_query($conn, $query);
$usuario = mysqli_fetch_assoc($resultado);

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tech-Beff</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="../estilos/styles4.css" rel="stylesheet">
    <script src="../js/botonContacto.js"></script>


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
      <li class="nav-item divider">
          <a class="nav-link" href="miperfil.php"><?php echo 'Mi Perfil ('. $_SESSION['correo'] .')' ?></a>
      </li>
      <li class="nav-item divider">
        <a class="nav-link" href="carrito.php" id="about">Carrito</a>
      </li>
      <li class="nav-item divider">
        <a class="nav-link" href="" onclick="logout()">Cerrar sesión</a>
      </li>
    </ul>
  </div>
</nav>

<!-- Mostrar los datos del usuario en el HTML -->

<div class="perfil-container">

<form action="actualizarPerfil.php" method="post" class="p-3">
  <div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $usuario['NOMBRE']; ?>">
  </div>
  <div class="mb-3">
    <label for="apellidos" class="form-label">Apellidos</label>
    <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $usuario['APELLIDOS']; ?>">
  </div>
  <div class="mb-3">
    <label for="correo" class="form-label">Correo</label>
    <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $usuario['CORREO']; ?>" readonly>
  </div>
  <div class="mb-3">
    <label for="contrasena" class="form-label">Contraseña</label>
    <div class="input-group">
      <input type="password" class="form-control" id="contrasena" name="contrasena" value="<?php echo $usuario['PASSWORD']; ?>">
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Actualizar</button>
</form>
</div>


<button id="scroll-top-btn" class="scroll-top-btn" onclick="scrollToTop()">

</button>

<footer class="bg-dark text-white py-3">
          <div class="containers text-center">
          <p>© 2023 Tech-Beff</p>
          </div>
      </footer>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
      <script src="cerrarSesion.js"></script>

      </body>
</html>
