<?php
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $ingredientes = $_POST['ingredientes'];
    $instrucciones = $_POST['instrucciones'];

    $sql = "UPDATE recetas SET nombre = ?, ingredientes = ?, instrucciones = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nombre, $ingredientes, $instrucciones, $id);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Receta actualizada correctamente."]);
    } else {
        echo json_encode(["message" => "Hubo un error al actualizar la receta."]);
    }

    $conn->close();
}
?>
