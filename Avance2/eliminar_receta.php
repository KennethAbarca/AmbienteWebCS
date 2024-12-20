<?php
include 'includes/db_config.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $sql = "DELETE FROM recetas WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        $mensaje = "Receta eliminada con éxito";
    } else {
        $mensaje = "Error: " . $conn->error;
    }
} else {
    $mensaje = "ID no especificado.";
}

$conn->close();


header("Location: eliminar_receta_resultado.html?mensaje=" . urlencode($mensaje));
exit();
?>

