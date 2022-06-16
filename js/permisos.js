$('#permisos').load("../data/permisos/list_usuario.php");


function listarempresa(){
id_usuario=$('#cmb-usuario').val();
$.ajax({
url:'../controladores/permisos/permisos.php',
type:'POST',
data:{id_usuario:id_usuario},

})
.done(function(r){

$('#listarempresa').html(r);

})


}

$('#btn-agregar').click(function(){
	
	id_usuario=$('#cmb-usuario').val();
	id_empresa=$('#cmb-empresa').val();
	if (id_empresa==0) {

		alert("Debe seleccionar una empresa");
	}else{
		registrar();
	}


})

function registrar(){

	$.ajax({

		url:'../controladores/permisos/guardar.php',
		type:'POST',
		data:{id_usuario,id_empresa}

	})
	.done(function(r){

		if (r) {
			alertify.success("Registro Permiso Correcto");
			setTimeout(function(){
          window.location.href=('../app/empresas.php');
        },1000); 
			
			
		}else {
			alertify.error("No se pudo actualizar");

		}


	})
}

