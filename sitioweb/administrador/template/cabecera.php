<?php 
session_start();
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
 <link 
    rel="stylesheet" 
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0ixcbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
    crossorigin="anonymous">
    <link  rel="stylesheet" href="./css/bootstrap.min.css"/>
    
</head>

<body>

<?php $url="http://".$_SERVER['HTTP_HOST']."/sitioweb" ?>

<nav class="navbar navbar-expand navbar-light bg-light">
    <div class="nav navbar-nav">
    <a class="nav-item nav-link active" href="http://localhost/sitioweb/administrador/index.php">Administrador del sitio web <span class="sr-only"></span> </a>
   
    <a class="nav-item nav-link " href="http://localhost/sitioweb/administrador/seccion/productos.php#">Inicio</a>

    <a class="nav-item nav-link" href="http://localhost/sitioweb/productos.php">Libros</a>
    <a class="nav-item nav-link" href="http://localhost/sitioweb/">Cerrar</a>
    
    <a class="nav-item nav-link" href="<?php echo $url;?>">Ver sitio web</a>
</div>
</nav>
<div class="container">
    <br>
    <div class="row">