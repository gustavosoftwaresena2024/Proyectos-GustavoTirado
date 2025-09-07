<?php
session_start();

// Si se envía un producto desde productos.php
if ($_POST && isset($_POST['idProducto'])) {
    $id = $_POST['idProducto'];
    $nombre = $_POST['nombre'];
    $precio = floatval($_POST['precio']); // aseguramos número
    $contacto = $_POST['contacto'] ?? '';
    $imagen = $_POST['imagen'] ?? '';

    // Si no existe carrito lo creamos
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Agregar producto
    $_SESSION['carrito'][] = [
        'id' => $id,
        'nombre' => $nombre,
        'precio' => $precio,
        'contacto' => $contacto,
        'imagen' => $imagen
    ];
}
?>



<h2>🛒 Carrito de Compras</h2>

<?php if (!empty($_SESSION['carrito'])) { 
    $total = 0; // acumulador
?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Contacto</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['carrito'] as $index => $producto) { 
                $total += $producto['precio']; // sumar precio
            ?>
            <tr>
                <td><img src="../img/<?php echo $producto['imagen']; ?>" width="60"></td>
                <td><?php echo $producto['nombre']; ?></td>
                <td>$<?php echo number_format($producto['precio'], 2); ?></td>
                <td><?php echo $producto['contacto']; ?></td>
                <td>
                    <form method="post" action="eliminar_carrito.php">
                        <input type="hidden" name="index" value="<?php echo $index; ?>">
                        <button type="submit" class="btn btn-danger">❌ Quitar</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Mostrar total -->
    <h4>Total: $<?php echo number_format($total, 2); ?></h4>

<?php } else { ?>
    <div class="alert alert-secondary">El carrito está vacío.</div>
<?php } ?>

<a href="../administrador/seccion/productos.php" class="btn btn-primary">⬅ Seguir comprando</a>
