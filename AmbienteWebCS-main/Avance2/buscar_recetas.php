<?php
include 'db_config.php';

$ingrediente = $_POST['ingrediente'];
$sql = "SELECT nombre, instrucciones FROM recetas WHERE ingredientes LIKE '%$ingrediente%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<h3>" . $row['nombre'] . "</h3><p>" . $row['instrucciones'] . "</p>";
    }
} else {
    echo "No se encontraron recetas con ese ingrediente.";
}

$conn->close();
?>