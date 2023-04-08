$(document).ready(function() 
{
	// función para generar las Cards de los artículos
	function generarCards(articulos) 
    {
		// seleccionamos el contenedor de las Cards
		var contenedor = $('.contenedor-cards');

		// vaciamos el contenedor
		contenedor.empty();

		// recorremos los datos de los artículos
		$.each(articulos, function(index, articulo) 
        {
			// creamos la Card
			var card = $('<div>', {'class': 'card'});
			var modelo = $('<h2>').text('Modelo: ' + articulo.modelo);
			var año = $('<p>').text('Año: ' + articulo.año);
			var cv = $('<p>').text('Caballos de Potencia: ' + articulo.cv);
			var stock = $('<p>').text('Stock: ' + articulo.stock);
			var precio = $('<p>').text('Precio: ' + articulo.precio + ' €');

			// añadimos los elementos a la Card
			card.append(modelo);
			card.append(año);
			card.append(cv);
			card.append(stock);
			card.append(precio);

			// añadimos la Card al contenedor
			contenedor.append(card);
		});
	}

	// función para cargar los datos de los artículos
	function cargarArticulos() 
    {
		$.ajax(
            {
			url: '../vehiculos/motos.php',
			dataType: 'json',
			success: function(articulos) 
            {
				generarCards(articulos);
			},
			error: function() {
				alert('Error al cargar los artículos');
			}
		});
	}

	// cargamos los datos al cargar la página
	cargarArticulos();
});
