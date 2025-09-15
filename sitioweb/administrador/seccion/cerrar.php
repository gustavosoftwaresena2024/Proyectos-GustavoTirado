<?php
// Iniciar sesión si existe
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Destruir sesión
session_destroy();

// Evitar caché del navegador
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");

// Redirigir al login con mensaje
header("Location: login.php?mensaje=logout");
exit;


// ✅ Eliminar todas las variables de sesión
$_SESSION = [];

// ✅ Destruir sesión
session_destroy();

// ✅ Redirigir al login
header("Location: login.php");
exit;
?>


