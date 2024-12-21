<?php
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    $sql = "DELETE FROM recetas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Receta eliminada correctamente."]);
    } else {
        echo json_encode(["message" => "Hubo un error al eliminar la receta."]);
    }

    $conn->close();
}
?>
