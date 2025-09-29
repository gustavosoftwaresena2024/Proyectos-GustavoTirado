<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("../config/bd.php"); // conexión PDO

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = trim($_POST['correo'] ?? '');

    if ($correo) {
        // Buscar usuario
        $sentenciaSQL = $conexion->prepare("SELECT * FROM usuarios WHERE correo = :correo LIMIT 1");
        $sentenciaSQL->bindParam(':correo', $correo);
        $sentenciaSQL->execute();

        $usuario = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            // Generar token y fecha de expiración
            $token = bin2hex(random_bytes(32));
            $expira = date("Y-m-d H:i:s", strtotime("+1 hour"));

           

            // Enlace de recuperación
            $link = "http://localhost/sitioweb/administrador/restablecer.php?token=" . $token;

            // 🚀 Enviar correo (ejemplo simple, se recomienda PHPMailer)
            $asunto = "Recuperación de contraseña - Inkverso";
            $cuerpo = "Hola " . htmlspecialchars($usuario['nombre']) . ",\n\n";
            $cuerpo .= "Haz clic en este enlace para restablecer tu contraseña (válido por 1 hora):\n";
            $cuerpo .= $link . "\n\n";
            $cuerpo .= "Si no solicitaste este cambio, ignora este mensaje.\n\n";
            $cuerpo .= "Atte,\nInkverso";

            @mail($correo, $asunto, $cuerpo);

            $mensaje = "✅ Se ha enviado un enlace de recuperación a tu correo.";
        } else {
            $mensaje = "❌ El correo ingresado no está registrado.";
        }
    } else {
        $mensaje = "⚠️ Por favor ingresa tu correo.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>🔑 Recuperar Contraseña</title>
  <link rel="stylesheet" href="../seccion/css/bootstrap.min.css"> 
  <link rel="stylesheet" href="./login.css"> 
  <link rel="stylesheet" href="./css/barra.css">
</head>
<body>



<div class="login-container">
  <div class="row">
    <div class="col-md-6 offset-md-3">

      <div class="card shadow-lg rounded">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h4>🔑 Recuperar Contraseña</h4>
          <div class="container my-3 text-end">
  <button id="toggle-dark" class="btn btn-dark">🌙 Modo Oscuro</button>
</div>
          <a href="http://localhost/sitioweb/">
            <button class="btn btn-sm btn-outline-primary">🏠 Inicio</button>
          </a>
        </div>

        <div class="card-body">
          <!-- Mensajes -->
          <?php if ($mensaje): ?>
            <div class="alert alert-info text-center"><?= htmlspecialchars($mensaje); ?></div>
          <?php endif; ?>

          <!-- Formulario -->
          <form method="POST" novalidate>
            <div class="form-group">
              <label for="correo">Correo electrónico</label>
              <input type="email" id="correo" name="correo" class="form-control" 
                     placeholder="ejemplo@correo.com" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block mt-3">📩 Enviar enlace</button>
          </form>

          <!-- Volver al login -->
          <div class="mt-3 text-center">
            <a href="login.php" class="btn btn-link">⬅ Volver al inicio de sesión</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<script>
// 🌙 Botón para alternar modo oscuro
const toggleBtn = document.getElementById("toggle-dark");
const body = document.body;

function actualizarBoton() {
    if (body.classList.contains("dark-mode")) {
        toggleBtn.textContent = "☀️ Modo Claro";
        toggleBtn.classList.remove("btn-dark");
        toggleBtn.classList.add("btn-warning");
    } else {
        toggleBtn.textContent = "🌙 Modo Oscuro";
        toggleBtn.classList.remove("btn-warning");
        toggleBtn.classList.add("btn-dark");
    }
}

// Inicializar estado
if (localStorage.getItem("dark-mode") === "enabled") {
    body.classList.add("dark-mode");
}
actualizarBoton();

toggleBtn.addEventListener("click", () => {
    body.classList.toggle("dark-mode");

    if (body.classList.contains("dark-mode")) {
        localStorage.setItem("dark-mode", "enabled");
    } else {
        localStorage.setItem("dark-mode", "disabled");
    }

    actualizarBoton();
});
</script>

</body>
</html>



