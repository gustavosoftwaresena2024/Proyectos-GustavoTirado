<?php
include(__DIR__ . "/../config/bd.php");
header('Content-Type: application/json; charset=utf-8');

$q = $_GET['q'] ?? "";
$filtro = $_GET['filtro'] ?? "nombre";

if ($q === "") {
    $sentencia = $conexion->prepare("SELECT * FROM libros");
    $sentencia->execute();
} else {
    if ($filtro === "precio") {
        // Buscar precios que comiencen con lo escrito
        $sentencia = $conexion->prepare("SELECT * FROM libros WHERE CAST(precio AS CHAR) LIKE :q");
        $sentencia->bindValue(":q", $q . "%");
    } else {
        // Buscar nombre con coincidencia parcial
        $sentencia = $conexion->prepare("SELECT * FROM libros WHERE nombre LIKE :q");
        $sentencia->bindValue(":q", "%" . $q . "%");
    }
    $sentencia->execute();
}

$libros = $sentencia->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(["results" => $libros], JSON_UNESCAPED_UNICODE);




