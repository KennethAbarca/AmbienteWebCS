<?php
include 'db_config.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM recetas WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Receta eliminada con éxito";
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>
