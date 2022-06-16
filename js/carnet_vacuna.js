$("reportesm").load("../data/reporte/reportesmas.php");
$('#btn-buscar').click(function(){

buscar = $('#txt-buscar').val();
if(buscar==""){
	alertify.alert("debe escribir un numero de cedula de la mascota ");
}else{
	reportem(buscar);
}

});
 
function reportem(id){

$.ajax({

url:'../controladores/reporte/carnet.php',
type:'GET',
data:{id:id},


})
.done(function(r){

	console.log(r);
$("#reportems").html(r);

})


}
