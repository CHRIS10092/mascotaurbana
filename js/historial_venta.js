$('#listado').load('../data/venta/listado.php');

function capturar(datos){
    d=datos.split("||");
    $("#infoVenta").html("Numero Venta: "+d[0]+"<br>Cliente: "+d[1]);
    $.ajax({
		url: '../data/venta/detalle.php',
		type: 'GET',
		data: {id:d[0]},

	})
	.done(function(r) {
		$("#detallar").html(r);
	})
}