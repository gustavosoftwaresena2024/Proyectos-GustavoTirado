<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])){
  header("Location:../index.php");
}else{

    if($_SESSION['usuario']=="OK")
        $nombredelusuario=$_SESSION["nombreUsuario"];
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
     <title>Administrador del sitio</title>
<!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Bootstrap css -->
  <link rel="stylesheet" href="./login.css"> 
 <link 
    rel="stylesheet" 
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0ixcbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
    crossorigin="anonymous">
    <link  rel="stylesheet" href="./css/bootstrap.min.css"/>
     <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- Tus estilos personalizados -->
  
    <link rel="stylesheet" href="../seccion/css/bootstrap.min.css">
</head>

<body>

<?php $url="http://".$_SERVER['HTTP_HOST']."/sitioweb" ?>

<nav class="navbar navbar-expand navbar-light bg-light">
    <div class="nav navbar-nav">
    <a class="nav-item nav-link active" href="http://localhost/sitioweb/administrador/index.php">Administrador del sitio  <span class="sr-only"></span> </a>
   
    <a class="nav-item nav-link " href="#"></a>

    <a class="nav-item nav-link" href="http://localhost/sitioweb/productos.php">Libros</a>
    <a class="nav-item nav-link" href="http://localhost/sitioweb/index.php">Cerrar</a>
    
    <a class="nav-item nav-link" href="<?php echo $url;?>">Ver web de Inkverso</a>
     <a class="nav-item nav-link" href="http://localhost/sitioweb/administrador/template/carrito.php">🛒Carrito de compras</a>
</div>
</nav>
<div class="container">
    <br>
    <div class="row">