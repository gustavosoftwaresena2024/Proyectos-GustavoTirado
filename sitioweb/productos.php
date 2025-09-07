<?php include("template/cabecera.php"); ?>

<?php 
include("administrador/config/bd.php");

$sentenciaSQL = $conexion->prepare("SELECT * FROM libros");
$sentenciaSQL->execute();
$listaLibros = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="col-md-3">
<div class="card">
<img class="card-img-top" src="./img/cienañosdesoledad.jpg" alt="">
<div class="card-body">
        <h4 class="card-title">Cien años de soledad</h4>
        <a name="" id="" class="btn btn-primary" target="_blank" href="https://es.wikipedia.org/wiki/Cien_a%C3%B1os_de_soledad" role="button">Ver más</a>
</div>
</div>
</div>

<div class="col-md-3">

<div class="card">

    <img class="card-img-top" src="./img/elbosquemagico.jpg" alt="">

    <div class="card-body">
        <h4 class="card-title">El bosque mágico</h4>
        <a name="" id="" class="btn btn-primary" target="_blank" href="https://es.scribd.com/document/856103147/Noy-20250501-143310-0000" role="button">Ver más</a>
    </div>

</div>

</div>
<div class="col-md-3">

<div class="card">

    <img class="card-img-top" src="./img/mamánosdijoadios.jpg" alt="">

    <div class="card-body">
        <h4 class="card-title">Mamá nos dijo adiós</h4>
        <a name="" id="" class="btn btn-primary" target="_blank" href="https://www.instagram.com/reel/C_qsxQ2P0mA/" role="button">Ver más</a>
    </div>

</div>

</div>

<div class="col-md-3">

<div class="card">

    <img class="card-img-top" src="./img/romeoyjulieta.jpg" alt="">

    <div class="card-body">
        <h4 class="card-title">Romeo y Julieta</h4>
        <a name="" id="" class="btn btn-primary" target="_blank" href="https://es.wikipedia.org/wiki/Romeo_y_Julieta" role="button">Ver más</a>
    </div>

</div>

</div>




<?php include("template/pie.php"); ?>