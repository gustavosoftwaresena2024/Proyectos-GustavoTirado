<?php
session_start();
include(__DIR__ . "/../config/bd.php");

// 🔹 Verificar sesión de cliente
if (!isset($_SESSION['idUsuario']) || $_SESSION['usuario'] !== 'OK') {
    die("❌ Debes iniciar sesión para realizar una compra.");
}

// 🔹 Recuperar datos del cliente desde sesión
$idUsuario  = $_SESSION['idUsuario'] ?? null;
$comprador  = $_SESSION['nombre'] ?? null;
$cantidadLibros = $_POST['cantidad_libros'] ?? 0;
$total = $_POST['total'] ?? 0;
$lugar = $_POST['lugar'] ?? '';
$email      = $_SESSION['emailCliente'] ?? null;
$direccion  = $_SESSION['direccionCliente'] ?? '';
$ciudad     = $_SESSION['ciudadCliente'] ?? '';
$lugar      = $_SERVER['REMOTE_ADDR']; // IP del cliente
$fecha = date("Y-m-d H:i:s");
// 🔹 Recuperar carrito de la sesión
$cantidad_libros = $_SESSION['carrito']['cantidad'] ?? 0;
$total           = $_SESSION['carrito']['total'] ?? 0;

// 🔹 Validar datos
if (!$comprador || !$email) {
    die("❌ No se encontraron los datos del cliente. Inicia sesión nuevamente.");
}
if ($cantidad_libros <= 0 || $total <= 0) {
    die("❌ Carrito vacío o datos de compra inválidos.");
}

try {
    // 🔹 Registrar compra en la base de datos
    $stmt = $conexion->prepare("
       $sql =   INSERT INTO compras 
        (idUsuario,comprador, email, cantidad_libros, total, lugar, ciudad, direccion, fecha)
        VALUES (:idUsuario, :comprador, :email, :cantidad_libros, :total, :lugar, :ciudad, :direccion, :fecha)"; 

    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(":idUsuario", $idUsuario);
    $stmt->bindParam(":comprador", $comprador);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":cantidad_libros", $cantidadLibros);
    $stmt->bindParam(":total", $total);
    $stmt->bindParam(":lugar", $lugar);
    $stmt->bindParam(":ciudad", $ciudad);
    $stmt->bindParam(":direccion", $direccion);
    $stmt->bindParam(":fecha", $fecha);

    $stmt->execute();
    
  
    // 🔹 Vaciar carrito
    unset($_SESSION['carrito']);

    echo "✅ Compra registrada correctamente.";

} catch (Exception $e) {
    echo "❌ Error al procesar la compra: " . $e->getMessage();
}






