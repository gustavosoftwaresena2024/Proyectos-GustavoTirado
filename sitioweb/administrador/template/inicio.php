<?php include('template/cabecera.php'); ?>
<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] != "OK") {
    header("Location: ../sitioweb/administrador/login.php");
    exit;
}
?>


<div class="col-md-12">
    <div class="jumbotron">
        <h1 class="display-3">Bienvenidos a Inkverso <?php echo $nombredelusuario; ?></h1>
        <p class="lead">Vamos a administrar nuestros libros en Inkverso</p>
        <hr class="my-2">
        <p>Más información</p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="/productos.php">Administar libros Inkverso</a>
        </p>
    </div>
</div>

<?php include('template/pie.php'); ?> 







