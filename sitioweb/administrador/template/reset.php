<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("../config/bd.php");

$mensaje = "";
$token = $_GET['token'] ?? '';

if ($_POST) {
    $token = $_POST['token'] ?? '';
    $nueva = $_POST['nueva'] ?? '';
    $confirmar = $_POST['confirmar'] ?? '';

    if ($nueva && $confirmar && $nueva === $confirmar) {
        // Verificar token válido y no expirado
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE token = :token AND token_expira > NOW() LIMIT 1");
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            $hash = password_hash($nueva, PASSWORD_BCRYPT);

            // Actualizar contraseña y limpiar token
            $update = $conexion->prepare("UPDATE usuarios SET contraseña = :pass, token = NULL, token_expira = NULL WHERE id = :id");
            $update->bindParam(':pass', $hash);
            $update->bindParam(':id', $usuario['id']);
            $update->execute();

            $mensaje = "✅ Contraseña actualizada correctamente. <a href='login.php'>Inicia sesión</a>";
        } else {
            $mensaje = "❌ Token inválido o caducado.";
        }
    } else {
        $mensaje = "⚠️ Las contraseñas no coinciden.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Restablecer Contraseña</title>
  <link rel="stylesheet" href="../template/login.css"> 
</head>
<body>
<div class="login-container">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="card">
        <div class="card-header">🔑 Restablecer contraseña</div>
        <div class="card-body">
          <?php if ($mensaje): ?>
            <div class="alert alert-info"><?= $mensaje; ?></div>
          <?php endif; ?>

          <?php if ($token && !$mensaje): ?>
          <form method="POST">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token); ?>">
            <div class="form-group">
              <label>Nueva contraseña</label>
              <input type="password" name="nueva" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Confirmar contraseña</label>
              <input type="password" name="confirmar" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success btn-block">Cambiar contraseña</button>
          </form>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
