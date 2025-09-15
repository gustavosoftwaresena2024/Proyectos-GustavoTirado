<?php include("template/cabecera.php"); ?>
<div class="jumbotron">
    <hr class="my-2">
    <h1 class="display-3">¡Nosotros!<br></h1> <h2>¡Tienda de libros en línea <b>Inkverso!</b></h1></h2>
    
    <hr class="my-2">
<img width="400" src="img/libros.gif" alt="" class="img-thumbnail rounnded mx-auito d-block" >
   <hr class="my-2">
Más que una tienda, Inkverso es una comunidad. Nace con una idea simple pero poderosa: convertir a cada lector en un emprendedor. Aquí, la página no es un límite, sino una puerta abierta para que todos, desde grandes autores hasta pequeños libreros, puedan comprar y vender libros online, creando así un ecosistema literario en el que todos ganamos.

<br>Nuestro equipo de desarrollo
detrás de Inkverso es un equipo apasionado, dedicado a construir una plataforma robusta y fácil de usar. Cada uno de nosotros aporta su talento y experiencia para que la compraventa de libros sea una experiencia fluida y segura.
Juntos, trabajamos para que Inkverso sea el espacio que la comunidad de lectores y autores merece.<br><br> ¡Gracias por ser parte de esta aventura!<br>
<hr class="my-2">
<br><h5><b>Gustavo Adolfo Tirado Molina</b></h5>
Estudiante de la Tecnología en análisis y de desarrollo de software<br>
Ficha:  2879643<br>
<b>Servicio Nacional de Aprendizaje Sena</b><br>

<hr class="my-2">

<br><h5><b>Contáctanos:</b></h5>

<a class="nav-link" href="https://www.instagram.com/gustavotmolina/" target="_blank">Instagram</a>

<a class="nav-link" href="https://comitederecreacionydeportesaliadas.blogspot.com/?fbclid=IwY2xjawInscNleHRuA2FlbQIxMAABHczOuu-X6SWTg4Rx5wavNHA1jfdXx8uD2DGcMWjH6eoGN2_Z61-D-iyN6Q_aem__M9X1PViaw4zle0cGtzyzA" target="_blank">Blogger</a>
    <hr class="my-2">
</div>
  <p>Administrador del sitio.</p>
    <p class="lead">
        <a  class="btn btn-primary btn-lg" href="./administrador/index.php" role="button">Inicia sesion</a>
    </p>
    <br><br> <b>Gustavo Adolfo Tirado Molina ⓒ2025. </b></p>
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

