$("#listado-tipos").load("../data/distribuir/listado_tipo.php");

$("#btnBuscarTipo").click(function(){

	tipo = $("#cmbTipo").val();
	if(tipo == 0){
		alertify.success("Seleccionar un tipo de articulo");
		$("#listado-articulos").html("");
	}else{
		buscar_articulo(tipo);
	}
})

function buscar_articulo(tipo){

	$.ajax({
		type:"GET",
		url:"../data/distribuir/listado_articulos.php",
		data:{tipo:tipo},
		success:function(r){
			$("#listado-articulos").html(r);
		}
	})

}

function listar_zonas(datos){
	d = datos.split("||");

	$.ajax({
		type:"GET",
		url:"../data/distribuir/listado_zonas.php",
		data:{articulo:d[0],stock:d[1]},
		success:function(r){
			$("#listado-zonas").html(r);
		}
	})
}

function listar_subzonas(datos){

	d = datos.split("||");

	$.ajax({
		type:"GET",
		url:"../data/distribuir/listado_subzonas.php",
		data:{zona:d[0],articulo:d[1],stock:d[2]},
		success:function(r){
			$("#listado-subzonas").html(r);
		}
	})
}

function mostrar_cantidad(datos){

	d= datos.split("||");

	contenido = `<input type="number" id="txtCantidad" class="form-control">
	             <br>
	             <button class="btn btn-info" onclick="verificar_campos('${d[0]}','${d[1]}','${d[2]}')">Guardar</button>`;
  
    $("#elementos").html(contenido);


}

function verificar_campos(subzona,articulo,stock){

	cantidad = $("#txtCantidad").val();

	if(cantidad == ""){
		alertify.error("Escriba la cantidad");

	}else if(parseInt(cantidad)>parseInt(stock)){
		alertify.error("No se puede distribuir, la cantidad debe ser menor al stock");
	}else{
		guardar(articulo,subzona,cantidad);
	}

}

function guardar(articulo,subzona,cantidad){

	$.ajax({
		type:"GET",
		url:"../controladores/distribuir/guardar.php",
		data:{articulo:articulo,subzona:subzona,cantidad:cantidad},
		success:function(r){
			alertify.success(r);
			setTimeout(function(){
				window.location.href="http://localhost/vetersoft/app/distribuir.php";
			},1000);
			

		}
	})
}