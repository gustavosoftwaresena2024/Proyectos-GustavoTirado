<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include(__DIR__ . "/config/bd.php");

// Datos de la visita
$ip = $_SERVER['REMOTE_ADDR'];
$pagina = basename($_SERVER['PHP_SELF']); // nombre del archivo actual

try {
    $sql = "INSERT INTO visitas (ip_usuario, pagina) VALUES (:ip, :pagina)";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(":ip", $ip);
    $stmt->bindParam(":pagina", $pagina);
    $stmt->execute();
} catch (Exception $e) {
    // Opcional: logear el error
    error_log("Error registrando visita: " . $e->getMessage());
}
