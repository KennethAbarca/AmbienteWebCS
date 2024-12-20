<?php
// Mostrar errores en desarrollo
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'includes/db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("INSERT INTO recetas (nombre, instrucciones, ingredientes) VALUES (?, ?, ?)");
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $nombre = $_POST['nombreReceta'];
    $instrucciones = $_POST['instrucciones'];
    $ingredientes = $_POST['ingredientes'];
    
    
    $stmt->bind_param("sss", $nombre, $instrucciones, $ingredientes);

    if ($stmt->execute()) {
        $mensaje = "Receta agregada con éxito.";
    } else {
        $mensaje = "Error al agregar la receta: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    $mensaje = "Método no permitido.";
}
?>
