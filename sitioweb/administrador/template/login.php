<?php 
session_start();
include("../config/bd.php"); // conexión PDO

// Evitar caché del navegador
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$mensaje = "";

// Si viene con parámetro de registro exitoso
if (isset($_GET['registro']) && $_GET['registro'] == "ok") {
    $mensaje = "✅ Registro exitoso. Ahora inicia sesión.";
}

if ($_POST) {
    $correo = $_POST['correo'] ?? '';
    $contraseña = $_POST['contraseña'] ?? '';

    if ($correo && $contraseña) {
        // Buscar usuario en la tabla "usuarios"
        $sentenciaSQL = $conexion->prepare("SELECT * FROM usuarios WHERE correo = :correo LIMIT 1");
        $sentenciaSQL->bindParam(':correo', $correo);
        $sentenciaSQL->execute();

        $usuario = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($contraseña, $usuario['contraseña'])) {
            // Crear sesión
            $_SESSION['usuario'] = "OK";
            $_SESSION['nombreUsuario'] = $usuario['nombre'];
            $_SESSION['idUsuario'] = $usuario['id'];

            // Redirigir al área protegida (ejemplo: inicio.php)
            header("Location: http://localhost/sitioweb/administrador/seccion/productos.php#");
            exit;
        } else {
            $mensaje = "❌ Usuario o contraseña incorrectos.";
        }
    } else {
        $mensaje = "⚠️ Por favor ingresa tus credenciales.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>🔑 Iniciar Sesión</title>
  <link rel="stylesheet" href="../template/login.css"> 
  <!-- mismo estilo que el login -->
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
          <h2>🔑 Inicio de Sesión Inkverso</h2>
          <!-- Botón para ir al registro -->
          <a href="registro.php">  <button  class="btn btn-success btn-block">Registrarse</button></a> 
          

        <div class="card-body">
          <?php if ($mensaje) { ?>
            <div class="alert alert-info" role="alert">
              <?php echo $mensaje; ?>
            </div>
          <?php } ?>

          <form method="POST">
            <div class="form-group">
              <label>Correo electrónico</label>
              <input type="email" class="form-control" name="correo" placeholder="Ingrese su correo" required>
            </div>

            <div class="form-group">
              <label for="contraseña">Contraseña</label>
              <input type="password" class="form-control" name="contraseña" placeholder="Ingrese su contraseña" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Entrar a Inkverso</button>
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
