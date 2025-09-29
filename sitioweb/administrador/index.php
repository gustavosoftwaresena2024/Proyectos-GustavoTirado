<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $contraseña = $_POST['contraseña'] ?? '';

    if ($usuario === "gustavo2025" && $contraseña === "sistema") {
        $_SESSION['usuario'] = "OK";
        $_SESSION['nombreUsuario'] = "Administrador";

        // 👉 Redirige al panel principal
        header('Location: http://localhost/sitioweb/administrador/template/panel.php');
        exit;
    } else {
        $mensaje = "❌ Usuario o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>🔑 Administrador - Inkverso</title>
  <link rel="stylesheet" href="./template/login.css"> 
  <link rel="stylesheet" href="../seccion/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

<div class="login-container">
  <div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">

      <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white rounded-top-4">
          <h4 class="mb-0">🔑 Inicio  Sesión Administrador</h4>
           
          <a href="http://localhost/sitioweb/nosotros.php">
            <button class="btn btn-sm btn-light">🏠 Inicio</button>
          </a>
        </di>
          <!-- 🌙 Botón Modo Oscuro -->
<div class="container my-3 text-end">
  <button id="toggle-dark" class="btn btn-dark">🌙 Modo Oscuro</button>
</div>
</div>
  
        <div class="card-body">
          <!-- Mensajes -->
          <?php if (!empty($mensaje)): ?>
            <div class="alert alert-danger text-center"><?= htmlspecialchars($mensaje); ?></div>
          <?php endif; ?>

          <!-- Formulario -->
          <form method="POST" novalidate>
            <div class="form-group mb-3">
              <label for="usuario">👤 Usuario</label>
              <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Ingrese su usuario" required>
            </div>

            <div class="form-group mb-3">
              <label for="contraseña">🔒 Contraseña</label>
              <input type="password" class="form-control" name="contraseña" id="contraseña" placeholder="Ingrese su contraseña" required>
            </div>

            <button type="submit" class="btn btn-primary btn-lg btn-block">
              🚀 Entrar al Administrador
            </button>
          </form>
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


