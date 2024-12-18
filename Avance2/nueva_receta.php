<?php
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreReceta = $_POST['nombreReceta'];
    $instrucciones = $_POST['instrucciones'];
    $ingredientes = $_POST['ingredientes'];

    $sql = "INSERT INTO recetas (nombre, instrucciones, ingredientes) VALUES ('$nombreReceta', '$instrucciones', '$ingredientes')";
    if ($conn->query($sql) === TRUE) {
        echo "Receta agregada con éxito";
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>
