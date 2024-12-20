<?php
include 'includes/db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['ingrediente'])) {
        $ingrediente = $conn->real_escape_string($_POST['ingrediente']);

        $sql = "SELECT nombre, instrucciones FROM recetas WHERE ingredientes LIKE '%$ingrediente%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h2>Recetas encontradas:</h2>";
            while ($row = $result->fetch_assoc()) {
                echo "<div class='receta'>";
                echo "<h3>" . htmlspecialchars($row['nombre']) . "</h3>";
                echo "<p><strong>Instrucciones:</strong> " . htmlspecialchars($row['instrucciones']) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No se encontraron recetas con el ingrediente proporcionado.</p>";
        }
    } else {
        echo "<p>Por favor, ingresa un ingrediente.</p>";
    }
    $conn->close();
} else {
    echo "<p>Método no permitido.</p>";
}
