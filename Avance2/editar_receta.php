<?php
include 'db_config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombreReceta = $_POST['nombreReceta'];
    $instrucciones = $_POST['instrucciones'];
    $ingredientes = $_POST['ingredientes'];

    $sql = "UPDATE recetas SET nombre='$nombreReceta', instrucciones='$instrucciones', ingredientes='$ingredientes' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Receta actualizada con éxito";
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>
