<?php
include 'includes/db_config.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $sql = "SELECT * FROM recetas WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $receta = $result->fetch_assoc();
    } else {
        die("Receta no encontrada.");
    }
} else {
    die("ID no especificado.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $nombreReceta = $conn->real_escape_string($_POST['nombreReceta']);
    $instrucciones = $conn->real_escape_string($_POST['instrucciones']);
    $ingredientes = $conn->real_escape_string($_POST['ingredientes']);

    $sql = "UPDATE recetas SET nombre='$nombreReceta', instrucciones='$instrucciones', ingredientes='$ingredientes' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        $mensaje = "Receta actualizada con éxito";
    } else {
        $mensaje = "Error: " . $conn->error;
    }
    // Recargamos la receta actualizada
    $sql = "SELECT * FROM recetas WHERE id = $id";
    $result = $conn->query($sql);
    $receta = $result->fetch_assoc();
}

$conn->close();
?>
