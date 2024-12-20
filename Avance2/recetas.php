<?php
// Configuración de la base de datos
include 'db_config.php';

// Verifica si se proporciona un ID de receta
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Convierte el ID en entero para evitar inyección SQL

    // Consulta los detalles de la receta
    $query = "SELECT nombre, instrucciones, ingredientes FROM recetas WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $receta = $result->fetch_assoc();
        echo "<h1>" . htmlspecialchars($receta['nombre']) . "</h1>";
        echo "<h2>Ingredientes</h2>";
        echo "<p>" . nl2br(htmlspecialchars($receta['ingredientes'])) . "</p>";
        echo "<h2>Instrucciones</h2>";
        echo "<p>" . nl2br(htmlspecialchars($receta['instrucciones'])) . "</p>";
    } else {
        echo "<p>Receta no encontrada.</p>";
    }

    $stmt->close();
} else {
    echo "<p>ID de receta no especificado.</p>";
}
?>
