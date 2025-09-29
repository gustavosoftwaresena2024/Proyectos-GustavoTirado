<?php
session_start();
include('template/cabecera.php'); 

// Evitar caché del navegador
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Validación de sesión
if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] !== "OK") {
    header("Location: login.php?mensaje=expirado");
    exit;
}


// Recuperar nombre del usuario si existe
$nombredelusuario = isset($_SESSION['nombreUsuario']) ? $_SESSION['nombreUsuario'] : "Usuario";
?>

<div class="col-md-12">
    <div class="jumbotron text-center bg-light shadow rounded p-5">
        <h1 class="display-4">
            ¡Hola 👋 Bienvenid@ a <strong>Inkverso!</strong>, 
            <?php echo htmlspecialchars($nombredelusuario); ?>
        </h1>
        <p class="lead mt-3">
            📚 Aquí podrás administrar tus libros de manera sencilla y rápida.
        </p>
        
        <hr class="my-4">

        <p class="text-muted">
            Haz clic en el botón para gestionar tus libros.
        </p>
        <p class="lead">
            <a class="btn btn-primary btn-lg shadow" href="http://localhost/sitioweb/administrador/seccion/productos.php">
                📖 Administrar libros Inkverso
            </a>
        </p>
    </div>
</div>

<?php include('template/pie.php'); ?>









