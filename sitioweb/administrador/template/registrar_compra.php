<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Conexión a la BD con ruta correcta
include(__DIR__ . "/../config/bd.php");
include(__DIR__ . "/cabecera.php"); // si cabecera.php está en la misma carpeta "template"
include(__DIR__ . "/pie.php");      // lo mismo


// Datos de la compra desde checkout.php
$comprador = $_POST['nombre'] ?? "Cliente Anónimo";
$email = $_POST['email'] ?? "";
$direccion = $_POST['direccion'] ?? "";
$telefono = $_POST['telefono'] ?? "";
$cantidad = $_SESSION['cantidad_total'] ?? 0;
$total = $_SESSION['total_compra'] ?? 0.00;
$lugar = $_SERVER['REMOTE_ADDR']; // puedes cambiarlo por ciudad/país si usas geolocalización

try {
    $sql = "INSERT INTO compras (comprador, email, direccion, telefono, cantidad_libros, total, lugar) 
            VALUES (:comprador, :email, :direccion, :telefono, :cantidad, :total, :lugar)";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(":comprador", $comprador);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":direccion", $direccion);
    $stmt->bindParam(":telefono", $telefono);
    $stmt->bindParam(":cantidad", $cantidad);
    $stmt->bindParam(":total", $total);
    $stmt->bindParam(":lugar", $lugar);
    $stmt->execute();
} catch (Exception $e) {
    echo "Error al registrar compra: " . $e->getMessage();
}
