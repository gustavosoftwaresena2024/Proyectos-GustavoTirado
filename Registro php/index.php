<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<form method="post">
<h2>Inkverso</h2>
<p>Inicia tu registro </p>

<div class="input-wrapper">
    <input type="text" name="name" placeholder="Nombre">
    <img class="input-icon" src="name.svg" alt="">
</div>

<div class="input-wrapper">
    <input type="email" name="email" placeholder="Email">
    <img class="input-icon" src="email.svg" alt="">
</div>

<div class="input-wrapper">
    <input type="text" name="direction" placeholder="direccion">
    <img class="input-icon" src="direction.svg" alt="">
</div>

<div class="input-wrapper">
    <input type="tel" name="phone" placeholder="telefono">
    <img class="input-icon" src="phone.svg" alt="">
</div>

<div class="input-wrapper">
    <input type="password" name="password" placeholder="Contraseña">
    <img class="input-icon" src="password.svg" alt="">
</div>

<input class="btn" type="submit" name="register" value="Enviar">

</form>

<?php 
    include("registrar.php");
?>


</body>
</html>
