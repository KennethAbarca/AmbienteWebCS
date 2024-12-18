<?php
include 'db_config.php';
$sql = "SELECT id, nombre, instrucciones FROM recetas";
$result = $conn->query($sql);
$recetas = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $recetas[] = $row;
    }
}

foreach ($recetas as $receta) {
    echo "<h3>" . $receta['nombre'] . "</h3>";
    echo "<p>" . $receta['instrucciones'] . "</p>";
}

$conn->close();
?>
