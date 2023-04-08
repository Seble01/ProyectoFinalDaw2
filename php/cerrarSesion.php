<?php
    session_start();
    session_unset();
    session_destroy();
    
    // Mostrar mensaje de confirmación
    echo '<script>alert("Has cerrado sesión exitosamente"); window.location.href="../index.php";</script>';
    exit();
?>

