<?php include("../template/cabecera.php"); ?>
<?php 
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$txtID       = isset($_POST['txtID']) ? $_POST['txtID'] : "";
$txtNombre   = isset($_POST['txtNombre']) ? $_POST['txtNombre'] : "";
$txtPrecio   = isset($_POST['txtPrecio']) ? $_POST['txtPrecio'] : "";
$txtContacto = isset($_POST['txtContacto']) ? $_POST['txtContacto'] : "";
$txtImagen   = isset($_FILES['txtImagen']['name']) ? $_FILES['txtImagen']['name'] : "";
$accion      = isset($_POST['accion']) ? $_POST['accion'] : "";

include("../config/bd.php");

switch($accion){
    case "Agregar":
        $sentenciaSQL = $conexion->prepare(
            "INSERT INTO libros (nombre, precio, contacto, imagen) VALUES (:nombre, :precio, :contacto, :imagen);"
        );
        $sentenciaSQL->bindParam(':nombre', $txtNombre);
        $sentenciaSQL->bindParam(':precio', $txtPrecio);
        $sentenciaSQL->bindParam(':contacto', $txtContacto);

        $fecha = new DateTime();
        $nombreArchivo = ($txtImagen!= "") ? $fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"] : "imagen.jpg";
        $tmpImagen = $_FILES["txtImagen"]["tmp_name"];
        if ($tmpImagen != "") {
            move_uploaded_file($tmpImagen, "../../img/".$nombreArchivo);
        }

        $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
        $sentenciaSQL->execute();
    break;

    case "Modificar":
        $sentenciaSQL = $conexion->prepare("UPDATE libros SET nombre=:nombre, precio=:precio, contacto=:contacto WHERE id=:id");
        $sentenciaSQL->bindParam(':nombre', $txtNombre);
        $sentenciaSQL->bindParam(':precio', $txtPrecio);
        $sentenciaSQL->bindParam(':contacto', $txtContacto);
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();

        if ($txtImagen != "") {
            $fecha = new DateTime();
            $nombreArchivo = $fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"];
            $tmpImagen = $_FILES["txtImagen"]["tmp_name"];

            move_uploaded_file($tmpImagen, "../../img/".$nombreArchivo);

            $sentenciaSQL = $conexion->prepare("SELECT imagen FROM libros WHERE id=:id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            $libro = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

            if (isset($libro["imagen"]) && $libro["imagen"] != "imagen.jpg" && file_exists("../../img/".$libro["imagen"])) {
                unlink("../../img/".$libro["imagen"]);
            }

            $sentenciaSQL = $conexion->prepare("UPDATE libros SET imagen=:imagen WHERE id=:id");
            $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
        }
        header("Location: productos.php");    
    break;

    case "Cancelar":
        header("Location: productos.php");
    break;

    case "Seleccionar":
        $sentenciaSQL = $conexion->prepare("SELECT * FROM libros WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        $libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtNombre   = $libro['nombre'];
        $txtPrecio   = $libro['precio'];
        $txtContacto = $libro['contacto'];
        $txtImagen   = $libro['imagen'];
    break;

    case "Borrar":
        $sentenciaSQL = $conexion->prepare("SELECT imagen FROM libros WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        $libro = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

        if (isset($libro["imagen"]) && $libro["imagen"] != "imagen.jpg" && file_exists("../../img/".$libro["imagen"])) {
            unlink("../../img/".$libro["imagen"]);
        }

        $sentenciaSQL = $conexion->prepare("DELETE FROM libros WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        header("Location: productos.php");
    break;
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM libros");
$sentenciaSQL->execute();
$listaLibros = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>



<div class="col-md-5">
    <div class="card">
        <div class="card-header">Datos del producto</div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">

                <input type="hidden" name="txtID" value="<?php echo htmlspecialchars($txtID); ?>">

                <div class="form-group">
                    <label for="txtNombre">Nombre:</label>
                    <input type="text" required class="form-control" value="<?php echo htmlspecialchars($txtNombre); ?>" name="txtNombre" id="txtNombre">
                </div>

                <div class="form-group">
                    <label for="txtPrecio">Precio:</label>
                    <input type="number" step="0.01" required class="form-control" value="<?php echo htmlspecialchars($txtPrecio); ?>" name="txtPrecio" id="txtPrecio">
                </div>

                <div class="form-group">
                    <label for="txtContacto">Contacto del vendedor:</label>
                    <input type="text" required class="form-control" value="<?php echo htmlspecialchars($txtContacto); ?>" name="txtContacto" id="txtContacto">
                </div>

                <div class="form-group">
                    <label for="txtImagen">Imagen:</label>
                    <div class="d-flex align-items-center">
                        <input type="file" class="form-control mr-2" name="txtImagen" id="txtImagen" accept="image/*" onchange="mostrarPreview(event)">
                        <img class="img-thumbnail rounded" id="preview" src="../../img/<?php echo htmlspecialchars($txtImagen); ?>" alt="Vista previa" width="80" style="display: <?php echo ($txtImagen!='')?'block':'none'; ?>;">
                    </div>
                </div>

                <div class="btn-group" role="group">
                    <button type="submit" name="accion" value="Agregar"   class="btn btn-success" <?php echo ($accion=="Seleccionar")?"disabled":""; ?>>Agregar</button>
                    <button type="submit" name="accion" value="Modificar" class="btn btn-warning" <?php echo ($accion!=="Seleccionar")?"disabled":""; ?>>Modificar</button>
                    <button type="submit" name="accion" value="Cancelar"  class="btn btn-info">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-md-7">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Contacto</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($listaLibros as $libro) { ?>
            <tr>
                <td><?php echo htmlspecialchars($libro['id']); ?></td>
                <td><?php echo htmlspecialchars($libro['nombre']); ?></td>
                <td>$<?php echo number_format($libro['precio'], 2); ?></td>
                <td><?php echo htmlspecialchars($libro['contacto']); ?></td>
                <td>
                    <img class="img-thumbnail rounded" 
                         src="../../img/<?php echo htmlspecialchars($libro['imagen']); ?>" 
                         width="80">
                         <td style="display:flex; gap:5px; flex-wrap:wrap;">
    <form method="post">
        <input type="hidden" name="txtID" value="<?php echo $libro['id']; ?>"/>
        <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary"/></form>
        
                </td>
                <td>
                    <form method="post" style="display:inline-block;">
                        <input type="hidden" name="txtID" value="<?php echo $libro['id']; ?>"/>
                       
                        <input type="submit" name="accion" value="Borrar" class="btn btn-danger"/>
                    </form>
                </td>
                <td>
                    <!-- Botón Carrito -->
                    <form method="post" action="carrito.php" style="display:inline-block;">
                        <input type="hidden" name="idProducto" value="<?php echo $libro['id']; ?>"/>
                        <input type="hidden" name="nombre" value="<?php echo $libro['nombre']; ?>"/>
                        <input type="hidden" name="precio" value="<?php echo $libro['precio']; ?>"/>
                        <button type="submit" name="accion" value="AgregarCarrito" class="btn btn-success">
                            🛒 Agregar
                        </button>
                    </form>
                </td>
                </td>
            </tr>
    

            
            <?php } ?>  
        </tbody>
    </table>
</div>


<?php include("../template/pie.php"); ?>


