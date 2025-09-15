<?php  
include(__DIR__ . "/template/cabecera.php"); 
include(__DIR__ . "/administrador/config/bd.php");

// Traer todos los libros al cargar la página (antes de usar el buscador)
$sentenciaSQL = $conexion->prepare("SELECT * FROM libros");
$sentenciaSQL->execute();
$listaLibros = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

 <link rel="stylesheet" href="./css/barra.css">
<hr class="my-2">
<h1>¡Catálogo de libros <b>Inkverso!</b></h1>
<hr class="my-2">

<div class="container my-4">
    <form id="form-busqueda" class="d-flex">
        <select id="filtro" class="form-select w-auto me-2">
            <option value="nombre">Nombre</option>
            <option value="precio">Precio</option>
        </select>
        <input type="text" id="buscar" class="form-control me-2" placeholder="Buscar libro...">
        <button class="btn btn-primary" type="submit">Buscar</button>
    </form>
</div>

 <hr class="my-2">

<div class="container my-5">
    <div class="row" id="resultados">
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
                        <a href="./administrador/template/login.php">
                            <button class="btn btn-success w-100">Comprar</button>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", () => {
    const inputBuscar = document.getElementById("buscar");
    const filtroSelect = document.getElementById("filtro");
    const contenedor = document.getElementById("resultados");

    function buscarLibros() {
        let query = inputBuscar.value.trim();
        let filtro = filtroSelect.value;

        // Si está vacío, traer todos los libros
        if (query === "") {
            fetch("./administrador/api/buscar_libros.php")
                .then(res => res.json())
                .then(data => renderLibros(data.results))
                .catch(err => console.error("Error cargando libros:", err));
            return;
        }

        // Si hay texto, buscar con filtro
        fetch(`./administrador/api/buscar_libros.php?q=${encodeURIComponent(query)}&filtro=${filtro}`)
            .then(res => res.json())
            .then(data => renderLibros(data.results))
            .catch(err => console.error("Error en la búsqueda:", err));
    }

    function renderLibros(libros) {
        contenedor.innerHTML = "";

        if (libros.length > 0) {
            libros.forEach(libro => {
                contenedor.innerHTML += `
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="./img/${libro.imagen}" class="card-img-top" alt="${libro.nombre}">
                            <div class="card-body d-flex flex-column">
                                <h4 class="card-title">${libro.nombre}</h4>
                                <p class="card-text text-success fw-bold">
                                    $${parseFloat(libro.precio).toFixed(2)}
                                </p>
                                <a href="./administrador/template/login.php">
                                    <button class="btn btn-success w-100">Comprar</button>
                                </a>
                            </div>
                        </div>
                    </div>
                `;
            });
        } else {
            contenedor.innerHTML = "<p>No se encontraron resultados</p>";
        }
    }

    // Buscar en tiempo real
    inputBuscar.addEventListener("input", buscarLibros);
    filtroSelect.addEventListener("change", buscarLibros);

    // Cargar todos al inicio
    buscarLibros();
});

// Cambiar dinámicamente el tipo de input según filtro
document.getElementById("filtro").addEventListener("change", function() {
    let inputBuscar = document.getElementById("buscar");
    if (this.value === "precio") {
        inputBuscar.type = "number";
        inputBuscar.placeholder = "Buscar por precio...";
    } else {
        inputBuscar.type = "text";
        inputBuscar.placeholder = "Buscar por nombre...";
    }
});

// 🌙 Botón para alternar modo oscuro
const toggleBtn = document.getElementById("toggle-dark");
const body = document.body;

// Función para actualizar el botón según el modo
function actualizarBoton() {
    if (body.classList.contains("dark-mode")) {
        toggleBtn.textContent = "☀️ Modo Claro";
        toggleBtn.classList.remove("btn-dark");
        toggleBtn.classList.add("btn-warning"); // Amarillo en oscuro
    } else {
        toggleBtn.textContent = "🌙 Modo Oscuro";
        toggleBtn.classList.remove("btn-warning");
        toggleBtn.classList.add("btn-dark"); // Oscuro en claro
    }
}

// Cargar preferencia desde localStorage
if (localStorage.getItem("dark-mode") === "enabled") {
    body.classList.add("dark-mode");
}
actualizarBoton();

// Evento al hacer clic
toggleBtn.addEventListener("click", () => {
    body.classList.toggle("dark-mode");

    if (body.classList.contains("dark-mode")) {
        localStorage.setItem("dark-mode", "enabled");
    } else {
        localStorage.setItem("dark-mode", "disabled");
    }

    actualizarBoton();
});



</script>

 <hr class="my-2">

<?php include(__DIR__ . "/template/pie.php"); ?>


