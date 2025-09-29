<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Incluir cabecera y conexión a BD


// Inicializar carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Manejo de acciones
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
    $accion = $_POST['accion'];

    switch ($accion) {
        case "Agregar":
            $id       = $_POST['idProducto'];
            $nombre   = $_POST['nombre'];
            $precio   = floatval($_POST['precio']);
            $imagen   = $_POST['imagen'];
            $cantidad = isset($_POST['cantidad']) ? (int)$_POST['cantidad'] : 1;

            $encontrado = false;
            foreach ($_SESSION['carrito'] as &$item) {
                if ($item['id'] == $id) {
                    $item['cantidad'] += $cantidad;
                    $item['subtotal'] = $item['cantidad'] * $item['precio'];
                    $encontrado = true;
                    break;
                }
            }
            unset($item);

           if (!$encontrado) {
    $_SESSION['carrito'][] = [
        'id'        => $id,
        'nombre'    => $nombre,
        'precio'    => $precio,
        'imagen'    => $imagen,
        'vendedor'  => $_POST['vendedor'],   // nuevo
        'ubicacion' => $_POST['ubicacion'], // nuevo
        'cantidad'  => $cantidad,
        'subtotal'  => $cantidad * $precio
    ];
}


        break;

      case "Agregar":
    $id       = $_POST['idProducto'];
    $nombre   = $_POST['nombre'];
    $precio   = floatval($_POST['precio']);
    $imagen   = $_POST['imagen'];
    $vendedor = $_POST['vendedor'];
    $ubicacion= $_POST['ubicacion'];
    $cantidad = isset($_POST['cantidad']) ? (int)$_POST['cantidad'] : 1;

    $encontrado = false;
    foreach ($_SESSION['carrito'] as &$item) {
        if ($item['id'] == $id) {
            $item['cantidad'] += $cantidad;
            $item['subtotal'] = $item['cantidad'] * $item['precio'];
            $encontrado = true;
            break;
        }
    }
    unset($item);

    if (!$encontrado) {
        $_SESSION['carrito'][] = [
            'id'        => $id,
            'nombre'    => $nombre,
            'precio'    => $precio,
            'imagen'    => $imagen,
            'vendedor'  => $vendedor,
            'ubicacion' => $ubicacion,
            'cantidad'  => $cantidad,
            'subtotal'  => $cantidad * $precio
        ];
    }
break;



        case "Eliminar":
            $index = $_POST['index'];
            if (isset($_SESSION['carrito'][$index])) {
                unset($_SESSION['carrito'][$index]);
                $_SESSION['carrito'] = array_values($_SESSION['carrito']);
            }
        break;

        case "Vaciar":
            $_SESSION['carrito'] = [];
        break;
    }

    header("Location: carrito.php");
    exit;
}
?>

<div class="container my-5">
    <h2 class="mb-4">🛒 Carrito de Compras</h2>
    <!-- Bootstrap css -->
  <link rel="stylesheet" href="./login.css"> 
 <link 
    rel="stylesheet" 
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0ixcbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
    crossorigin="anonymous">
    <link  rel="stylesheet" href="./css/bootstrap.min.css"/>
     <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- Tus estilos personalizados -->
  
    <link rel="stylesheet" href="../seccion/css/bootstrap.min.css">

    <?php if (!empty($_SESSION['carrito'])): ?>


       <table class="table table-bordered text-center align-middle">
    <thead class="table-dark">
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Vendedor</th>
            <th>Ubicación</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        
        <?php $total = 0; ?>
        <?php foreach ($_SESSION['carrito'] as $index => $item): ?>
            <?php $total += $item['subtotal']; ?>
            <tr>
                <td><img src="../../img/<?php echo htmlspecialchars($item['imagen']); ?>" width="60"></td>
                <td><?php echo htmlspecialchars($item['nombre']); ?></td>
                <td><?php echo htmlspecialchars($item['vendedor']); ?></td>
                <td><?php echo htmlspecialchars($item['ubicacion']); ?></td>
                <td>$<?php echo number_format($item['precio'], 2); ?></td>
                <td><?php echo $item['cantidad']; ?></td>
                <td class="text-success fw-bold">$<?php echo number_format($item['subtotal'], 2); ?></td>
                <td>
                    <form method="post" action="carrito.php" style="display:inline-block;">
                        <input type="hidden" name="index" value="<?php echo $index; ?>">
                        <button type="submit" name="accion" value="Eliminar" class="btn btn-danger btn-sm">❌ Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>





<div class="alert alert-success fs-5">
            <strong>Total:</strong> $<?php echo number_format($total, 2); ?>
        </div>

        <div class="d-flex justify-content-between">
            <a href="../seccion/productos.php" class="btn btn-primary">⬅ Seguir comprando</a>

            <form method="post" action="carrito.php" style="display:inline-block;">
                <button type="submit" name="accion" value="Vaciar" class="btn btn-warning">🗑 Vaciar carrito</button>
            </form>

            <a href="checkout.php" class="btn btn-success">✅ Finalizar compra</a>
        </div>
    <?php else: ?>
        <div class="alert alert-secondary text-center">
            Tu carrito está vacío.
        </div>
        <a href="../seccion/productos.php" class="btn btn-primary">⬅ Ir a productos</a>
    <?php endif; ?>
</div>

<?php include(__DIR__ . "/../../template/pie.php"); ?>













