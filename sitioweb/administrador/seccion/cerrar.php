<?php
// ✅ Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ✅ Eliminar todas las variables de sesión
$_SESSION = [];

// ✅ Destruir sesión completamente
session_destroy();

// ✅ Evitar que el navegador guarde en caché
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");

// ✅ Redirigir al login con un mensaje
header("Location: login.php?mensaje=logout");
exit;



