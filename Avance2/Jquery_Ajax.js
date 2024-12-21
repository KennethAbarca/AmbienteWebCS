$(document).ready(function() {
    // Llamada AJAX para obtener las recetas
    $.ajax({
        url: 'api_recetas.php',  // Asegúrate de que la ruta sea correcta
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log('Recetas:', response);  // Ver la respuesta en la consola

            const recetasContainer = $('#lista-recetas');  // Contenedor donde se insertarán las recetas

            // Verificar si hay recetas
            if (response.length > 0) {
                response.forEach(function(receta) {
                    // Crear el HTML para cada receta
                    const recetaHTML = `
                        <article>
                            <h4>${receta.nombre}</h4>
                            <p><strong>Ingredientes:</strong> ${receta.ingredientes}</p>
                            <p><strong>Instrucciones:</strong> ${receta.instrucciones}</p>
                        </article>
                    `;
                    recetasContainer.append(recetaHTML);  // Insertar receta en el contenedor
                });
            } else {
                recetasContainer.append('<p>No hay recetas disponibles en este momento.</p>');
            }
        },
        error: function(xhr, status, error) {
            console.log('Error en la solicitud AJAX:', error);  // Ver detalles del error
            $('#lista-recetas').append('<p>Error al cargar las recetas. Intenta nuevamente más tarde.</p>');
        }
    });
});
