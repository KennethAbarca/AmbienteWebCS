<?php
header('Content-Type: application/json');
include '../db_config.php';

$sql = "SELECT id, nombre FROM recetas";
$result = $conn->query($sql);
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
$conn->close();
?>
