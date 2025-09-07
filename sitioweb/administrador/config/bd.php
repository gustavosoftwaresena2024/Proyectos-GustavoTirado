<?php
$host = "localhost";
$bd   = "sitio";
$usuario = "root";
$contraseña = "";

try {
    // Crear la conexión usando atributos recomendados
    $conexion = new PDO(
        "mysql:host=$host;dbname=$bd;charset=utf8mb4",
        $usuario,
        $contraseña,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Errores como excepciones
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,      // Resultados como arrays asociativos
            PDO::ATTR_EMULATE_PREPARES   => false,                 // Usar consultas preparadas nativas
        ]
    );
    
    // Opcional: Confirmación de conexión
    // echo "✅ Conexión exitosa";

} catch (PDOException $ex) {
    // Mensaje de error más seguro
    die("❌ Error de conexión: " . $ex->getMessage());
}
?>
