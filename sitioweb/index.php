<?php include("template/cabecera.php"); ?>

<div class="jumbotron">
     <hr class="my-2">
    <h1 class="display-3">Bienvenidos a <b>Inkverso</b> Tienda de libros</h1>
    <hr class="my-2">
<img width="400" src="img/librofondo.gif" class="img-thumbnail rounded mx-auto d-block" />

    <p class="lead">Nuestra plataforma va más allá de ser un simple punto de venta. Inkverso es un espacio colaborativo donde la comunidad es protagonista. Aquí, todos tenemos la posibilidad de comprar y vender libros online, fomentando así una red vibrante de lectores y vendedores. Queremos que descubras, compartas y hagas crecer tu propio proyecto emprendedor con nosotros.<br>

<br>¡Prepárate para sumergirte en un mundo de historias, ideas y oportunidades! </p>


 <hr class="my-2">
<h5>Usuarios registrados</h5>
    <p class="lead">
        <a class="btn btn-primary btn-lg" href="./administrador/template/login.php" role="button">Inicia sesion</a>
    </p>
</div>

 <hr class="my-2">
 <h5>¿No te haz registrado?</h5>
    <p class="lead">
        <a class="btn btn-primary btn-lg" href="./administrador/template/registro.php" role="button">Regístrate</a>
    </p>
</div>



 <hr class="my-2">
<script>

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

<?php include("template/pie.php"); ?>



    
