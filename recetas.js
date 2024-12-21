$(document).ready(function () {
    function cargarRecetas() {
        $.ajax({
            url: 'api_recetas.php',  
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                $("#recetasTable tbody").html(""); 

                if (response.length > 0) {
                    response.forEach(function (receta) {
                        $("#recetasTable tbody").append(
                            `<tr>
                                <td>${receta.nombre}</td>
                                <td>${receta.ingredientes}</td>
                                <td>${receta.instrucciones}</td>
                                <td>
                                    <button class="editar" data-id="${receta.id}" data-nombre="${receta.nombre}" data-ingredientes="${receta.ingredientes}" data-instrucciones="${receta.instrucciones}">Editar</button>
                                    <button class="eliminar" data-id="${receta.id}">Eliminar</button>
                                </td>
                            </tr>`
                        );
                    });
                } else {
                    $("#recetasTable tbody").append("<tr><td colspan='4'>No hay recetas disponibles.</td></tr>");
                }
            },
            error: function () {
                alert("Hubo un error al cargar las recetas.");
            }
        });
    }

    cargarRecetas();

    // Eliminar receta
    $(document).on("click", ".eliminar", function () {
        var id = $(this).data("id");

        if (confirm("¿Estás seguro de eliminar esta receta?")) {
            $.ajax({
                url: 'api_eliminarReceta.php',  
                method: 'POST',
                data: { id: id },
                success: function (response) {
                    alert("Receta eliminada correctamente");
                    cargarRecetas();
                },
                error: function () {
                    alert("Hubo un error al eliminar la receta.");
                }
            });
        }
    });

    // Editar receta
    $(document).on("click", ".editar", function () {
        var id = $(this).data("id");
        var nombre = $(this).data("nombre");
        var ingredientes = $(this).data("ingredientes");
        var instrucciones = $(this).data("instrucciones");

        var nuevaNombre = prompt("Editar nombre de la receta:", nombre);
        var nuevosIngredientes = prompt("Editar ingredientes de la receta:", ingredientes);
        var nuevasInstrucciones = prompt("Editar instrucciones de la receta:", instrucciones);

        if (nuevaNombre && nuevosIngredientes && nuevasInstrucciones) {
            $.ajax({
                url: 'api_actualizarReceta.php', 
                method: 'POST',
                data: { id: id, nombre: nuevaNombre, ingredientes: nuevosIngredientes, instrucciones: nuevasInstrucciones },
                success: function (response) {
                    alert("Receta actualizada correctamente");
                    cargarRecetas(); 
                },
                error: function () {
                    alert("Hubo un error al actualizar la receta.");
                }
            });
        }
    });
});
