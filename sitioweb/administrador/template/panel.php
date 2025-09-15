<?php
session_start();
include("../config/bd.php");

// ✅ Inicializar variables para evitar warnings
$totalCompradores = 0;
$totalLibros = 0;
$totalVentas = 0;
$totalVisitas = 0;
$lugares = [0];
$ultimosCompradores = [0];



try {
    // Total compradores (sin anónimos)
    $totalCompradores = $conexion->query("
        SELECT COUNT(DISTINCT comprador) AS total_compradores 
        FROM compras 
        WHERE comprador IS NOT NULL AND comprador != '' AND comprador != 'Cliente Anónimo'
    ")->fetch(PDO::FETCH_ASSOC)['total_compradores'] ?? 0;

    // Total libros vendidos
    $totalLibros = $conexion->query("
        SELECT SUM(cantidad_libros) AS total_libros 
        FROM compras 
        WHERE comprador IS NOT NULL AND comprador != '' AND comprador != 'Cliente Anónimo'
    ")->fetch(PDO::FETCH_ASSOC)['total_libros'] ?? 0;

    // Total ventas en $
    $totalVentas = $conexion->query("
        SELECT SUM(total) AS total_ventas 
        FROM compras 
        WHERE comprador IS NOT NULL AND comprador != '' AND comprador != 'Cliente Anónimo'
    ")->fetch(PDO::FETCH_ASSOC)['total_ventas'] ?? 0;

    // Lugares más frecuentes
    $lugares = $conexion->query("
        SELECT lugar, ciudad, COUNT(*) AS cantidad 
        FROM compras 
        WHERE comprador IS NOT NULL AND comprador != '' AND comprador != 'Cliente Anónimo'
        GROUP BY lugar, ciudad
        ORDER BY cantidad DESC
        LIMIT 5
    ")->fetchAll(PDO::FETCH_ASSOC) ?? [];

    // Total visitas
    $totalVisitas = $conexion->query("SELECT COUNT(*) AS total_visitas FROM visitas")
        ->fetch(PDO::FETCH_ASSOC)['total_visitas'] ?? 0;

    // Últimos compradores
    $ultimosCompradores = $conexion->query("
        SELECT comprador, cantidad_libros, total, lugar, ciudad, direccion, fecha
        FROM compras
        WHERE comprador IS NOT NULL AND comprador != '' AND comprador != 'Cliente Anónimo'
        ORDER BY fecha DESC
        LIMIT 10
    ")->fetchAll(PDO::FETCH_ASSOC) ?? [];

} catch (Exception $e) {
    $_SESSION['error'] = "Error en consultas: " . $e->getMessage();
}
?>
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>🔑 Panel del administrador</title>
  <link rel="stylesheet" href="../seccion/css/bootstrap.min.css"> 
  <link rel="stylesheet" href="../template/login.css"> 
  <link rel="stylesheet" href="../template/barra.css"> 
</head>
<body></body>

<?php include("../template/cabecera.php"); ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="panel.php">📊 Panel</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="../inicio.php">🏠 Inicio</a>
        </li>
      </ul>
      <div class="d-flex align-items-center">
        <!-- Botón modo oscuro -->
         <div class="container my-3 text-end">
    <button id="toggle-dark" class="btn btn-dark">🌙 Modo Oscuro</button>
</div>

        <!-- Botón restaurar panel -->
        <button id="restorePanel" class="btn btn-outline-warning btn-sm me-2">🔄 Restaurar</button>

        <!-- Botón cerrar sesión -->
        <a href="../index.php" class="btn btn-outline-danger btn-sm">🚪 Cerrar sesión</a>
      </div>
    </div>
  </div>
</nav>


<div class="container mt-4">
    <h2 class="text-center mb-4">📊 Panel de Control</h2>
    <div class="row">
        <!-- Total Compradores -->
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Compradores</h5>
                    <p class="card-text fs-4"><?= $totalCompradores ?></p>
                </div>
            </div>
        </div>

        <!-- Libros Vendidos -->
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Libros Vendidos</h5>
                    <p class="card-text fs-4"><?= $totalLibros ?></p>
                </div>
            </div>
        </div>

        <!-- Ventas Totales -->
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Ventas Totales</h5>
                    <p class="card-text fs-4">$<?= number_format($totalVentas, 2) ?></p>
                </div>
            </div>
        </div>

        <!-- Visitas -->
        <div class="col-md-3">
            <div class="card text-white bg-dark mb-3">
                <div class="card-body">
                    <h5 class="card-title">Visitas</h5>
                    <p class="card-text fs-4"><?= $totalVisitas ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Lugares principales -->
    <div class="card mt-4">
        <div class="card-header">📍 Lugares más frecuentes</div>
        <ul class="list-group list-group-flush">
            <?php if (!empty($lugares)): ?>
                <?php foreach ($lugares as $lugar): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?= htmlspecialchars($lugar['lugar']) ?> - <?= htmlspecialchars($lugar['ciudad']) ?>
                        <span class="badge bg-primary rounded-pill"><?= $lugar['cantidad'] ?></span>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="list-group-item">No hay registros aún</li>
            <?php endif; ?>
        </ul>
    </div>

    <!-- Últimos compradores -->
    <div class="card mt-4">
        <div class="card-header">🛒 Últimos compradores</div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Comprador</th>
                        <th>Libros</th>
                        <th>Total</th>
                        <th></th>
                        <th></th>
                        <th>Lugar</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($ultimosCompradores)): ?>
                        <?php foreach ($ultimosCompradores as $compra): ?>
                            <tr>
                                <td><?= htmlspecialchars($compra['comprador']) ?></td>
                                <td><?= $compra['cantidad_libros'] ?></td>
                                <td>$<?= number_format($compra['total'], 2) ?></td>
                                <td><?= htmlspecialchars($compra['lugar']) ?></td>
                                <td><?= htmlspecialchars($compra['ciudad']) ?></td>
                                <td><?= htmlspecialchars($compra['direccion']) ?></td>
                                <td><?= $compra['fecha'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7" class="text-center">No hay compras registradas</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<script>
// 🌙 Botón para alternar modo oscuro
const toggleBtn = document.getElementById("toggle-dark");
const body = document.body;

// Función para actualizar el botón según el modo
function actualizarBoton() {
    if (body.classList.contains("dark-mode")) {
        toggleBtn.textContent = "☀️ Modo Claro";
        toggleBtn.classList.remove("btn-dark");
        toggleBtn.classList.add("btn-warning"); // Amarillo en oscuro
    } else {
        toggleBtn.textContent = "🌙 Modo Oscuro";
        toggleBtn.classList.remove("btn-warning");
        toggleBtn.classList.add("btn-dark"); // Oscuro en claro
    }
}

// Cargar preferencia desde localStorage
if (localStorage.getItem("dark-mode") === "enabled") {
    body.classList.add("dark-mode");
}
actualizarBoton();

// Evento al hacer clic
toggleBtn.addEventListener("click", () => {
    body.classList.toggle("dark-mode");

    if (body.classList.contains("dark-mode")) {
        localStorage.setItem("dark-mode", "enabled");
    } else {
        localStorage.setItem("dark-mode", "disabled");
    }

    actualizarBoton();
});

// 🔄 Confirmar restaurar panel
document.getElementById("restorePanel").addEventListener("click", function () {
    if (confirm("⚠️ ¿Seguro que deseas restaurar el panel? Se eliminarán todas las estadísticas.")) {
        window.location.href = "restaurar_panel.php";
    }
});
</script>


<?php include("../template/pie.php"); ?>


