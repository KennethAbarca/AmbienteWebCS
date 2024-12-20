<?php
// Configuración de la base de datos
include 'db_config.php'; 

// Verifica si se proporciona una categoría
if (isset($_GET['categoria'])) {
    $categoria = htmlspecialchars($_GET['categoria']); 

    // Consulta las recetas con base en la categoría seleccionada
    $query = "SELECT id, nombre, ingredientes FROM recetas WHERE ingredientes LIKE ?";
    $stmt = $conn->prepare($query);
    $search = "%$categoria%";
    $stmt->bind_param("s", $search);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<h1>Recetas de la categoría: " . ucfirst($categoria) . "</h1>";

    // Muestra las recetas encontradas
    if ($result->num_rows > 0) {
        echo "<ul>";
        while ($receta = $result->fetch_assoc()) {
            echo "<li>";
            echo "<h3>" . htmlspecialchars($receta['nombre']) . "</h3>";
            echo "<p>Ingredientes: " . htmlspecialchars($receta['ingredientes']) . "</p>";
            echo "<a href='receta.php?id=" . $receta['id'] . "'>Ver receta</a>";
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No se encontraron recetas en esta categoría.</p>";
    }

    $stmt->close();
} else {
    echo "<h1>Categoría no especificada</h1>";
}
?>
