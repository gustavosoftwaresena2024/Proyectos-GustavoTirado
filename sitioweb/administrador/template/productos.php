<?php 
include("template/cabecera.php"); 
include("administrador/config/bd.php");

$sentenciaSQL = $conexion->prepare("SELECT * FROM libros");
$sentenciaSQL->execute();
$listaLibros = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container my-5">
    <div class="row">
        <?php foreach ($listaLibros as $libro): ?>
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <img class="card-img-top" 
                         src="./img/<?php echo htmlspecialchars($libro['imagen']); ?>" 
                         alt="<?php echo htmlspecialchars($libro['nombre']); ?>">

                    <div class="card-body d-flex flex-column">
                        <h4 class="card-title"><?php echo htmlspecialchars($libro['nombre']); ?></h4>
                        <p class="card-text text-success fw-bold">
                            $<?php echo number_format($libro['precio'], 2); ?>
                        </p>

                        <a class="btn btn-primary mb-2" 
                           target="_blank" 
                           href="<?php echo htmlspecialchars($libro['url']); ?>">
                            📖 Ver más
                        </a>

                        <!-- Botón para agregar al carrito -->
                        <form method="post" action="carrito.php" class="mt-auto">
                            <input type="hidden" name="idProducto" value="<?php echo $libro['id']; ?>"/>
                            <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($libro['nombre']); ?>"/>
                            <input type="hidden" name="precio" value="<?php echo $libro['precio']; ?>"/>
                            <input type="hidden" name="imagen" value="<?php echo htmlspecialchars($libro['imagen']); ?>"/>
                            <button type="submit" class="btn btn-success w-100">
                                🛒 Agregar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include("template/pie.php"); ?>


