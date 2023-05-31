<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech-Beff</title>
       <!-- Estilos CSS -->
       
       <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
       <link href="../estilos/estiloMotos.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-light bg-light">
  <a href="../index.php">
    <img class="iconoInicio" src="../imagenes/Ensigna.png" alt="">
  </a> 

  <button class="navbar-toggler menu-activo" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
        
        if (!isset($_SESSION)) 
        {
            session_start();

        }
          
          if (isset($_SESSION['correo'])) 
          {
            echo '<li class="nav-item divider">
                    <a class="nav-link" href="../php/miperfil.php">Mi Perfil ('. $_SESSION['correo'] .')</a>
                  </li>';
            echo '<li class="nav-item divider">
                    <a class="nav-link" href="carrito_moto.php">Carrito</a>
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



<?php

// Inicia la sesión solo si no está activa
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}
/*
// Generar el PDF del resumen de la compra
require_once('D:\xampp\htdocs\ProyectoFinal-local\vehiculos\fpdf185\fpdf.php');

unset($_SESSION['carrito']);
// Crear la clase PDF extendiendo la clase FPDF
class PDF extends FPDF {
  // Cabecera de página
  function Header() {
      // Logo
      $this->Image('F:\carpetaXAMP\htdocs\ProyectoFinal-DAW\imagenes\Ensigna.png',10,6,30);
      // Arial bold 15
      $this->SetFont('Arial','B',15);
      // Movernos a la derecha
      $this->Cell(80);
      // Título
      $this->Cell(30,10,'Resumen de la compra',0,0,'C');
      // Salto de línea
      $this->Ln(20);
  }

  // Pie de página
  function Footer() {
      // Posición: a 1,5 cm del final
      $this->SetY(-15);
      // Arial italic 8
      $this->SetFont('Arial','I',8);
      // Número de página
      $this->Cell(0,10,'Página '.$this->PageNo().'/{nb}',0,0,'C');
  }
}

// Recuperamos los datos del formulario de compra
$productos = $_SESSION['carrito'];

// Calculamos el precio total
$precioTotal = 0;
foreach ($productos as $producto) {
  $precioTotal += $producto['precio'];
}

// Crear un nuevo objeto PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);

// Escribir el contenido del PDF
$pdf->Cell(0,10,'Productos:',0,1);
foreach ($productos as $producto) 
{
  $pdf->Cell(0,10,$producto['nombre'].' - '.$producto['precio'].'€',0,1);
}
$pdf->Cell(0,10,'Precio total: '.$precioTotal.'€');

// Descargar el PDF
ob_clean(); // Borrar cualquier posible salida anterior
$pdf->Output('D', 'doc.pdf');
exit(); // Detener la ejecución del script


// Enviar el archivo PDF al navegador
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="resumen_compra.pdf"');
echo $pdfContent;
*/

// Conexión a la base de datos
$db = new PDO('mysql:host=localhost;dbname=proyectofinalconcesionario', 'root', '');

// Recuperamos los datos del formulario de compra
$productos = $_SESSION['carrito'];

// Comprobamos si el usuario ha iniciado sesión
if (isset($_SESSION['correo'])) {

    $correo = $_SESSION['correo'];
    $query = "SELECT ID FROM usuarios WHERE correo = :correo";
    $statement = $db->prepare($query);
    $statement->execute(array(':correo' => $correo));
    $row = $statement->fetch();
    $id_usuario = $row['ID'];

    // Insertamos los datos del pedido en la tabla carrito
    $query = "INSERT INTO carrito (ID_USUARIO, ID_PRODUCTO, TIPO_PRODUCTO, NOMBRE, MODELO, ANO, CV, PRECIO) VALUES (:id_usuario, :id_producto, :tipo_producto, :nombre, :modelo, :ano, :cv, :precio)";
    $statement = $db->prepare($query);

    foreach ($productos as $producto) {
      $id_producto = $producto['id'];
      $tipo = $producto['tipo_vehiculo'];
      $cantidad = 1; 

      $query = "SELECT STOCK FROM " . ($tipo == 'moto' ? "motos" : "coches") . " WHERE ID_" . ($tipo == 'moto' ? "MOTO" : "COCHE") . " = :id_producto";
      $statement = $db->prepare($query);
      $statement->execute(array(':id_producto' => $id_producto));
      $row = $statement->fetch();
      $stock_actual = $row['STOCK'];

      $nuevo_stock = $stock_actual - $cantidad;
      $query = "UPDATE " . ($tipo == 'moto' ? "motos" : "coches") . " SET STOCK = :nuevo_stock WHERE ID_" . ($tipo == 'moto' ? "MOTO" : "COCHE") . " = :id_producto";
      $statement = $db->prepare($query);
      $statement->execute(array(':nuevo_stock' => $nuevo_stock, ':id_producto' => $id_producto));
}


    

    // Eliminamos los productos del carrito
    unset($_SESSION['carrito']);

    // Redirigimos al usuario a la página de carrito de compras
    header("Location: ../novedades.php");
    exit();
} else {
    // Si el usuario no ha iniciado sesión, lo redirigimos a la página de inicio de sesión
    header("Location: perfilado.html");
    exit();
}



?>

<!-- Agrega el enlace a jsPDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.10.2/jspdf.umd.min.js"></script>

<script>
  // Recuperamos los datos del formulario de compra
  var productos = <?php echo json_encode($_SESSION['carrito']); ?>;

  // Crear un nuevo objeto PDF
  var doc = new jsPDF();

  // Agregar el contenido del PDF
  doc.text("Detalles de la compra", 10, 10);
  doc.setFontSize(12);
  var y = 20;
  productos.forEach(function(producto, index) {
    var row = (index + 1) + ". " + producto.nombre + ": " + producto.precio + "€";
    doc.text(row, 10, y);
    y += 10;
  });

  // Descargar el PDF
  doc.save("carrito.pdf");
</script>


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

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/slider.js"></script>
    <script src="js/cerrarSesion.js"></script>
    <script>
 const navbarToggle = document.querySelector('.navbar-toggler');
navbarToggle.addEventListener('click', () => {
  const navbarCollapse = document.querySelector('.navbar-collapse');
  navbarCollapse.classList.toggle('show');
});
</script>