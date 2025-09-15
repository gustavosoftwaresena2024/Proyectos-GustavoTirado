<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("../config/bd.php"); // conexión PDO

// Evitar caché
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

$mensaje = "";

// Mensaje después de registro
if (isset($_GET['registro']) && $_GET['registro'] === "ok") {
    $mensaje = "✅ Registro exitoso. Ahora inicia sesión.";
}

// Procesar login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo   = trim($_POST['correo'] ?? '');
    $password = $_POST['contraseña'] ?? ''; // 👈 ahora coincide con el formulario

    if (!empty($correo) && !empty($password)) {
        $sentenciaSQL = $conexion->prepare("SELECT * FROM usuarios WHERE correo = :correo LIMIT 1");
        $sentenciaSQL->bindParam(':correo', $correo, PDO::PARAM_STR);
        $sentenciaSQL->execute();

        $usuario = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($password, $usuario['password'])) {
            // Guardar datos en sesión
            $_SESSION['usuario'] = "OK";
            $_SESSION['nombreUsuario'] = $usuario['nombre'];
            $_SESSION['idUsuario'] = $usuario['id'];

            header("Location: http://localhost/sitioweb/administrador/inicio.php");
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
  <link rel="stylesheet" href="../seccion/css/bootstrap.min.css"> 
  <link rel="stylesheet" href="../template/login.css"> 
  <link rel="stylesheet" href="../template/barra.css"> 
</head>
<body>

<div class="login-container">
  <div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">

      <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header text-center bg-primary text-white rounded-top-4">
          <h2 class="mb-0">🔑 Inicio de Sesión Inkverso</h2>
          <!-- 🌙 Botón modo oscuro -->
          <div class="container my-3 text-end">
            <button id="toggle-dark" class="btn btn-dark">🌙 Modo Oscuro</button>
          </div>
        </div>

        <div class="card-body p-4">
          <!-- Botones de navegación -->
          <div class="d-flex justify-content-between mb-3">
            <a href="http://localhost/sitioweb/" class="btn btn-outline-primary btn-sm">🏠 Inicio</a>
            <a href="registro.php" class="btn btn-success btn-sm">📝 Registrarse</a>
          </div>

          <!-- Mensajes -->
          <?php if (!empty($mensaje)): ?>
            <div class="alert alert-info text-center" role="alert">
              <?= htmlspecialchars($mensaje); ?>
            </div>
          <?php endif; ?>

          <!-- Formulario -->
          <form method="POST" novalidate>
            <div class="mb-3">
              <label for="correo" class="form-label">Correo electrónico</label>
              <input type="email" id="correo" class="form-control form-control-lg" name="correo" placeholder="Ingrese su correo" required>
            </div>

            <div class="mb-3">
              <label for="contraseña" class="form-label">Contraseña</label>
              <input type="password" id="contraseña" class="form-control form-control-lg" name="contraseña" placeholder="Ingrese su contraseña" required>
            </div>

            <div class="d-grid">
              <button type="submit" class="btn btn-primary btn-lg">Entrar a Inkverso</button>
            </div>
          </form>

          <!-- Recuperar contraseña -->
          <div class="text-center mt-3">
            <a href="recuperar.php" class="btn btn-link">¿Olvidaste tu contraseña?</a>
          </div>
        </div>
      </div>

      <!-- Mensajes adicionales -->
      <?php if (isset($_GET['mensaje'])): ?>
        <?php if ($_GET['mensaje'] === 'logout'): ?>
          <div class="alert alert-success mt-3">✅ Sesión cerrada correctamente</div>
        <?php elseif ($_GET['mensaje'] === 'expirado'): ?>
          <div class="alert alert-warning mt-3">⚠️ Tu sesión ha expirado. Vuelve a iniciar sesión.</div>
        <?php endif; ?>
      <?php endif; ?>

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
        toggleBtn.classList.replace("btn-dark", "btn-warning");
    } else {
        toggleBtn.textContent = "🌙 Modo Oscuro";
        toggleBtn.classList.replace("btn-warning", "btn-dark");
    }
}

if (localStorage.getItem("dark-mode") === "enabled") {
    body.classList.add("dark-mode");
}
actualizarBoton();

toggleBtn.addEventListener("click", () => {
    body.classList.toggle("dark-mode");
    localStorage.setItem("dark-mode", body.classList.contains("dark-mode") ? "enabled" : "disabled");
    actualizarBoton();
});
</script>

</body>
</html>



