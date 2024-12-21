<?php
header('Content-Type: application/json');
include 'db_config.php';

$sql = "SELECT id, nombre, ingredientes, instrucciones FROM recetas";
$result = $conn->query($sql);
$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo json_encode([]); 
}

$conn->close();
?>
