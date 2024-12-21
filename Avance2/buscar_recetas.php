<?php
include 'db_config.php';

$ingrediente = $_POST['ingrediente'];
$sql = "SELECT nombre, instrucciones,ingredientes FROM recetas WHERE ingredientes LIKE '%$ingrediente%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p><strong>Nombre:</strong> " . $row['nombre'] . "</p>";
        echo "<p><strong>Instrucciones:</strong> " . $row['instrucciones'] . "</p>";
        echo "<p><strong>Ingredientes:</strong> " . $row['ingredientes'] . "</p>";

    }
} else {
    echo "No se encontraron recetas con ese ingrediente.";
}

$conn->close();
?>