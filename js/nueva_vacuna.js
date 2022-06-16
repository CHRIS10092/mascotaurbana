$("#reportesm").load("../data/reporte/reportesmas.php");
//$('#historial_vacunas').load('../data/vacunas/historial_vacunas.php');
$('#btn-buscar').click(function(e) {
	e.preventDefault();
	buscar=$('#txt-buscar').val();
	if (buscar=="") {
		alertify.error("Verifique el codigo de la Mascota");
	}else{
		
		buscarmascota(buscar);
		//buscar_detalle(buscar);
	}
});


function buscarmascota(id){


$.ajax({
url:'../controladores/vacunas/listarmascotas.php',
type:'GET',
data:{id:id},
})
.done(function(r){
//console.log(r);
$("#reportems").html(r);
})

}

function buscar_detalle(busqueda){
	jugador=document.getElementById('historial_vacunas');
	$.ajax({
		type:'POST',
		url:'datos/vacunas/historial_vacunas.php',
		data:{busqueda:busqueda},
		success:function(r){
			jugador.innerHTML=r;
		}
	})
}



function capturar(datos){
	
	d=datos.split('||');
	$('#txt-buscar').val(d[0]);
}

function listarvacuna(id){

	$.ajax({
		url: 'data/vacunas/list_vacunas.php',
		type: 'POST',
		data: {id:id},
	})
	.done(function(r) {
		$('#list-vacunas').html(r);
	});
	
	
}