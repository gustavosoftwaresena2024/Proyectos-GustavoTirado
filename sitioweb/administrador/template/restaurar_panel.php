<?php
session_start();
include("../config/bd.php");

// ✅ Solo el admin puede restaurar
if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] !== 'OK') {
    header("Location: ../login.php");
    exit;
}

try {
    // Vaciar tablas relacionadas
    $conexion->exec("DELETE FROM compras");
    $conexion->exec("DELETE FROM visitas");

    $_SESSION['mensaje'] = "✅ Panel restaurado correctamente.";
} catch (Exception $e) {
    $_SESSION['error'] = "❌ Error al restaurar: " . $e->getMessage();
}

header("Location: panel.php");
exit;
?>
