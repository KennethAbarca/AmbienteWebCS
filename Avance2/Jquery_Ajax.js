$.ajax({
    url: 'api/recetas.php',
    method: 'GET',
    dataType: 'json',
    success: function(response) {
        console.log("Recetas:", response);
        // Podrías iterar y mostrarlas en la página
    }
});
