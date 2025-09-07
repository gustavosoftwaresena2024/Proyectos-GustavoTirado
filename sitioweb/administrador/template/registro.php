<?php
session_start();
include("../config/bd.php"); // conexión PDO (el bd.php que ya usas)

// Evitar caché del navegador
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$mensaje = "";



if ($_POST) {
    $nombre = $_POST['nombre'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $contraseña = $_POST['contraseña'] ?? '';

    if ($nombre && $correo && $telefono && $contraseña) {
        // Verificar si el correo ya existe
        $check = $conexion->prepare("SELECT id FROM usuarios WHERE correo = :correo LIMIT 1");
        $check->bindParam(':correo', $correo);
        $check->execute();

        if ($check->rowCount() > 0) {
            $mensaje = "❌ Error: El correo ya está registrado. Intenta con otro.";
        } else {
            // Encriptar contraseña
            $hash = password_hash($contraseña, PASSWORD_BCRYPT);

            $sentenciaSQL = $conexion->prepare("INSERT INTO usuarios (nombre, correo, telefono, contraseña) 
                                                VALUES (:nombre, :correo, :telefono, :password)");
            $sentenciaSQL->bindParam(':nombre', $nombre);
            $sentenciaSQL->bindParam(':correo', $correo);
            $sentenciaSQL->bindParam(':telefono', $telefono);
            $sentenciaSQL->bindParam(':password', $hash);
            $sentenciaSQL->execute();

            $mensaje = "✅ Registro exitoso. Ahora puedes iniciar sesión.";
        }
    } else {
        $mensaje = "⚠️ Por favor completa todos los campos.";
    }
    // Redirigir al login
        header("Location: http://localhost/sitioweb/administrador/index.php");
        exit;
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>📝Registro Usuario</title>
  
  <link rel="stylesheet" href="../template/login.css"> <!-- mismo estilo que el login -->
   <div class="card-header d-flex justify-content-between align-items-center">
    <span>Registro de usuario</span>
    <button type="button" id="toggleDark" class="btn btn-sm btn-outline-light">
        🌙
    </button>
</div>

</head>
<body>
    
    

<div class="login-container">
  <div class="row">
    <div class="col-md-6 offset-md-3">

      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h1>📝 Registro Inkverso</h1>
          <div></div>
       <a href="login.php">  <button  class="btn btn-success btn-block">Iniciar Sesión</button></a> 
            
        </div>

        <div class="card-body">
          <?php if ($mensaje) { ?>
            <div class="alert alert-info" role="alert">
              <?php echo $mensaje; ?>
            </div>
          <?php } ?>
          

          <form method="POST">

            <div class="form-group">
              <label>Nombre completo</label>
              <input type="text" class="form-control" name="nombre" required>
            </div>

            <div class="form-group">
              <label>Correo electrónico</label>
              <input type="email" class="form-control" name="correo" required>
            </div>

            <div class="form-group">
              <label>Teléfono</label>
              <input type="text" class="form-control" name="telefono" required>
            </div>

            <div class="form-group">
              <label>Contraseña</label>
              <input type="password" class="form-control" name="contraseña" required>
            </div>

            <button type="submit" class="btn btn-success btn-block">Registrarse</button>
          </form>
          
        </div>
      </div>

    </div>
  </div>
</div>
<script>
        // Script de cambio de modo día/noche
     
  const toggleBtn = document.getElementById("toggleDark");
  const body = document.body;

  toggleBtn.addEventListener("click", () => {
    body.classList.toggle("dark-mode");

    if (body.classList.contains("dark-mode")) {
      toggleBtn.textContent = "☀️"; // cambia a sol
    } else {
      toggleBtn.textContent = "🌙"; // vuelve a luna
    }
  });
</script>
</body>
</html>
