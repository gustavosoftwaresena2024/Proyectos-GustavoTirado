<?php 
session_start();


if ($_POST) {
    $usuario = $_POST['usuario'] ?? '';
    $contraseña = $_POST['contraseña'] ?? '';

    
    if ($usuario === "gustavo2025" && $contraseña === "sistema") {
        
        $_SESSION['usuario'] = "OK";
        $_SESSION['nombreUsuario'] = "Develoteca";

        // 👉 Redirige a productos.php
        header('Location:http://localhost/sitioweb/administrador/seccion/productos.php#');
        exit;

    } else {
        $mensaje = "Error: El usuario o contraseña son incorrectos";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador del sitio web</title>

    <link rel="stylesheet" href="./template/login.css">

    <div class="card-header d-flex justify-content-between align-items-center">
    <span>🔑 Inicio de Sesión</span>
    <button type="button" id="toggleDark" class="btn btn-sm btn-outline-light">
        🌙
    </button>
</div>
  
</head>
<body>

<div class="container">
    <div class="row justify-content-center"> 
        <div class="col-md-4">
            <br/><br/><br/>
            <div class="card">
                <div class="card-header text-center">
                    
                    <h5>🔑 Inicio de Sesión Administrador</h5>
                </div>
                <div class="card-body">

                    <?php if (isset($mensaje)) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $mensaje; ?>
                        </div>
                    <?php } ?>

                    <form method="POST">
                        <div class="form-group">
                            <label for="usuario">Usuario</label>
                            <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Ingrese su usuario">
                        </div>

                        <div class="form-group">
                            <label for="contraseña">Contraseña</label>
                            <input type="password" class="form-control" name="contraseña" id="contraseña" placeholder="Ingrese su contraseña" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">
                            Entrar al administrador
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
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
