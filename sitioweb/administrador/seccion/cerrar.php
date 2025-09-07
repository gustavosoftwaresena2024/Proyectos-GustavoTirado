<?php
session_start();        // Inicia la sesión
session_destroy();      // Destruye la sesión y borra variables

// También evitar que se guarde en caché
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
<?php if (isset($_GET['mensaje'])) { ?>
  <?php if ($_GET['mensaje'] == 'logout') { ?>
    <div class="alert alert-success">✅ Sesión cerrada correctamente</div>
  <?php } elseif ($_GET['mensaje'] == 'expirado') { ?>
    <div class="alert alert-warning">⚠️ Tu sesión ha expirado. Vuelve a iniciar sesión.</div>
  <?php } ?>
<?php } ?>


// Redirige al login con mensaje de confirmación
header("Location: ../sitioweb/administrador/login.php?mensaje=logout");
exit;
?>

if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'logout') { ?>
    <div class="alert alert-success" role="alert">
        ✅ Sesión cerrada correctamente
    </div>
Redirige al login

header("Location: ../sitioweb/administrador/login.php");
exit;


<?php include("../template/pie.php"); ?>
