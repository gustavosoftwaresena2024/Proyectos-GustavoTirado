<?php
session_start();
include("../config/bd.php"); // conexión PDO

// Evitar caché
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

$mensaje = "";

if ($_POST) {
    $nombre      = $_POST['nombre'] ?? '';
    $correo      = $_POST['correo'] ?? '';
    $telefono    = $_POST['telefono'] ?? '';
    $contraseña  = $_POST['contraseña'] ?? '';
    $confirmar   = $_POST['confirmar_contraseña'] ?? '';

    if ($nombre && $correo && $telefono && $contraseña && $confirmar) {
        if ($contraseña !== $confirmar) {
            $mensaje = "❌ Las contraseñas no coinciden.";
        } else {
            // Verificar si el correo ya existe
            $check = $conexion->prepare("SELECT id FROM usuarios WHERE correo = :correo LIMIT 1");
            $check->bindParam(':correo', $correo);
            $check->execute();

            if ($check->rowCount() > 0) {
                $mensaje = "❌ Error: El correo ya está registrado. Intenta con otro.";
            } else {
                // Encriptar contraseña
                $hash = password_hash($contraseña, PASSWORD_BCRYPT);

                $sentenciaSQL = $conexion->prepare("INSERT INTO usuarios (nombre, correo, telefono, password) 
                                                    VALUES (:nombre, :correo, :telefono, :password)");
                $sentenciaSQL->bindParam(':nombre', $nombre);
                $sentenciaSQL->bindParam(':correo', $correo);
                $sentenciaSQL->bindParam(':telefono', $telefono);
                $sentenciaSQL->bindParam(':password', $hash);
                $sentenciaSQL->execute();

                header("Location: login.php?registro=ok");
                exit;
            }
        }
    } else {
        $mensaje = "⚠️ Por favor completa todos los campos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>📝 Registro Usuario</title>
  <link rel="stylesheet" href="../seccion/css/bootstrap.min.css"> 
  <link rel="stylesheet" href="../template/login.css"> 
  <link rel="stylesheet" href="../template/barra.css"> 
</head>
<body>



<div class="login-container">
  <div class="row justify-content-center">
    <div class="col-md-6">

      <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h2 class="mb-0">📝 Registro Inkverso</h2>
          <!-- Botón modo oscuro -->
<div class="container my-3 text-end">
  <button id="toggle-dark" class="btn btn-dark">🌙 Modo Oscuro</button>
</div>
          <div>
            <a href="http://localhost/sitioweb/" class="btn btn-outline-primary btn-sm">🏠 Inicio</a>
            <a href="login.php" class="btn btn-success btn-sm">🔑 Iniciar Sesión</a>
          </div>
        </div>

        <div class="card-body">
          <?php if ($mensaje) { ?>
            <div class="alert alert-info" role="alert">
              <?= $mensaje; ?>
            </div>
          <?php } ?>

          <form method="POST" id="registroForm">
            <div class="mb-3">
              <label class="form-label">Nombre completo</label>
              <input type="text" class="form-control form-control-lg" name="nombre" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Correo electrónico</label>
              <input type="email" class="form-control form-control-lg" name="correo" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Teléfono</label>
              <input type="text" class="form-control form-control-lg" name="telefono" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Contraseña</label>
              <input type="password" class="form-control form-control-lg" id="contraseña" name="contraseña" required>
              <div class="progress mt-2">
                <div id="fortalezaBar" class="progress-bar" role="progressbar" style="width: 0%">0%</div>
              </div>
              <small id="fortalezaMsg" class="form-text"></small>
            </div>

            <div class="mb-3">
              <label class="form-label">Confirmar contraseña</label>
              <input type="password" class="form-control form-control-lg" id="confirmar_contraseña" name="confirmar_contraseña" required>
              <small id="mensajeError" class="text-danger d-none">❌ Las contraseñas no coinciden</small>
              <small id="mensajeOk" class="text-success d-none">✅ Las contraseñas coinciden</small>
            </div>

            <div class="d-grid">
              <button type="submit" id="btnRegistro" class="btn btn-success btn-lg" disabled>
                Registrarse
              </button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>

<script>
// === Validaciones JS ===
const form = document.getElementById("registroForm");
const pass1 = document.getElementById("contraseña");
const pass2 = document.getElementById("confirmar_contraseña");
const mensajeError = document.getElementById("mensajeError");
const mensajeOk = document.getElementById("mensajeOk");
const fortalezaMsg = document.getElementById("fortalezaMsg");
const fortalezaBar = document.getElementById("fortalezaBar");
const btnRegistro = document.getElementById("btnRegistro");

function validarPasswords() {
  if (pass1.value === "" || pass2.value === "") {
    mensajeError.classList.add("d-none");
    mensajeOk.classList.add("d-none");
    btnRegistro.disabled = true;
  } else if (pass1.value === pass2.value) {
    mensajeError.classList.add("d-none");
    mensajeOk.classList.remove("d-none");
    btnRegistro.disabled = false;
  } else {
    mensajeError.classList.remove("d-none");
    mensajeOk.classList.add("d-none");
    btnRegistro.disabled = true;
  }
}

function evaluarFortaleza(password) {
  let fortaleza = 0;
  if (password.length >= 6) fortaleza++;
  if (/[A-Z]/.test(password)) fortaleza++;
  if (/[0-9]/.test(password)) fortaleza++;
  if (/[@$!%*?&#]/.test(password)) fortaleza++;

  let porcentaje = (fortaleza / 4) * 100;
  fortalezaBar.style.width = porcentaje + "%";
  fortalezaBar.textContent = Math.round(porcentaje) + "%";

  if (fortaleza <= 1) {
    fortalezaBar.className = "progress-bar bg-danger";
    fortalezaMsg.textContent = "⚠️ Contraseña débil";
  } else if (fortaleza === 2) {
    fortalezaBar.className = "progress-bar bg-warning";
    fortalezaMsg.textContent = "ℹ️ Contraseña media";
  } else {
    fortalezaBar.className = "progress-bar bg-success";
    fortalezaMsg.textContent = "✅ Contraseña fuerte";
  }
}

pass1.addEventListener("input", () => {
  evaluarFortaleza(pass1.value);
  validarPasswords();
});
pass2.addEventListener("input", validarPasswords);

form.addEventListener("submit", e => {
  if (pass1.value !== pass2.value) {
    e.preventDefault();
    validarPasswords();
    pass2.focus();
  }
});

// === Modo oscuro ===
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

