<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include(__DIR__ . "/cabecera.php"); // si cabecera.php está en la misma carpeta "template"

include("../config/bd.php"); // Conexión PDO

// Verificar que el usuario esté logueado
if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] !== "OK") {
    echo '<div class="alert alert-danger">❌ Debes iniciar sesión para realizar la compra.</div>';
    exit;
}

// Verificar si el carrito tiene productos
$carrito = $_SESSION['carrito'] ?? [];
$total = array_sum(array_column($carrito, 'subtotal'));
$cantidad_total = array_sum(array_column($carrito, 'cantidad'));
$_SESSION['cantidad_total'] = $cantidad_total;
$_SESSION['total_compra'] = $total;

// Procesar formulario de compra
$mensaje = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $direccion = trim($_POST['direccion'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');

    if ($nombre && $email && $direccion && $telefono && !empty($carrito)) {
        try {
            $conexion->beginTransaction();

            $idUsuario = $_SESSION['IdUsuario'] ?? null;

            $stmt = $conexion->prepare("INSERT INTO compras 
                (idUsuario, comprador, email, direccion, telefono, cantidad_libros, total, fecha) 
                VALUES (:idUsuario, :comprador, :email, :direccion, :telefono, :cantidad_libros, :total, NOW())");
            $stmt->execute([
                ':idUsuario' => $idUsuario,
                ':comprador' => $nombre,
                ':email' => $email,
                ':direccion' => $direccion,
                ':telefono' => $telefono,
                ':cantidad_libros' => $cantidad_total,
                ':total' => $total
            ]);

            $idCompra = $conexion->lastInsertId();

            $stmtDetalle = $conexion->prepare("INSERT INTO detalle_compras 
                (idCompra, idLibro, precio, cantidad, subtotal) 
                VALUES (:idCompra, :idLibro, :precio, :cantidad, :subtotal)");

            foreach ($carrito as $item) {
                $stmtDetalle->execute([
                    ':idCompra' => $idCompra,
                    ':idLibro' => $item['id'],
                    ':precio' => $item['precio'],
                    ':cantidad' => $item['cantidad'],
                    ':subtotal' => $item['subtotal']
                ]);
            }

            $conexion->commit();

            unset($_SESSION['carrito']);
            $mensaje = "✅ Compra realizada con éxito. ¡Gracias por tu compra!";
        } catch (PDOException $e) {
            $conexion->rollBack();
            $mensaje = "❌ Error al procesar la compra: " . $e->getMessage();
        }
    } else {
        $mensaje = "⚠️ Por favor completa todos los campos y asegúrate de tener productos en el carrito.";
    }
}
?>

<div class="container my-5">
    <h2 class="mb-4">✅ Finalizar Compra</h2>

   <?php if (!empty($mensaje)): ?>
    <div class="alert alert-info text-center"><?= htmlspecialchars($mensaje) ?></div>
    <div class="text-center mt-3">
        <a href="/sitioweb/administrador/seccion/productos.php" class="btn btn-primary">
            ⬅ Seguir comprando
        </a>
    </div>
<?php endif; ?>


    <?php if (!empty($carrito) && empty($mensaje)): ?>
        <table class="table table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($carrito as $producto): ?>
                    <tr>
                        <td><?= htmlspecialchars($producto['nombre']) ?></td>
                        <td>$<?= number_format($producto['precio'], 2) ?></td>
                        <td><?= $producto['cantidad'] ?></td>
                        <td class="text-success fw-bold">$<?= number_format($producto['subtotal'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="alert alert-info fs-5">
            <strong>Total a pagar: </strong> $<?= number_format($total, 2) ?>
        </div>

        <!-- Formulario de datos del cliente -->
        <div class="card shadow-sm p-4 my-4">
            <h4 class="mb-3">📋 Datos del Cliente</h4>
            <form method="post">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre completo</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección de entrega</label>
                    <textarea class="form-control" id="direccion" name="direccion" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" required>
                </div>

                <div class="d-flex gap-2">
                    <a href="carrito.php" class="btn btn-secondary w-50">⬅ Regresar al carrito</a>
                    <button type="submit" class="btn btn-success w-50">💳 Confirmar compra</button>
                </div>
            </form>
        </div>
    <?php elseif (empty($carrito)): ?>
        <div class="alert alert-warning text-center">
            Tu carrito está vacío. 
        </div>
       <a href="/sitioweb/administrador/seccion/productos.php" class="btn btn-primary">
    ⬅ Volver a productos
</a>

    <?php endif; ?>
</div>

<?php include(__DIR__ . "/pie.php"); ?>




