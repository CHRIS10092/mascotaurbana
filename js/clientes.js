$("#listado").load("../data/cliente/listado.php");
$('#btnEditar').click(function(){

	nombre =$('#txtNombre').val();
	apellido = $('#txtApellido').val();
	correo= $('#txtCorreo').val();
	celular =$('#txtCelular').val();

	if(!nombre){
		alertify.error("",'Escribir el nombre del cliente');
	}else if(!apellido){
		alertify.error("",'Escribir el apellido del cliente');
	}else if(!correo){
		alertify.error("",'Escribir el correo del cliente');
	}else if(!verificar_correo(correo)){
		alertify.error("",'El formato del correo electronico es erroneo');
	}else if(!celular){
		alertify.error("",'Escribir el celular del cliente');
	}else if(!verificar_celular(celular)){
		alertify.error("",'El formato del numero de celular es erroneo y debe constar de 10 digitos');
	}else{
		confirmar();
	}

})

function confirmar(){
	alertify.confirm('Aviso',"Actualizar ?",
		function(){
			editar();
		},
		function(){
		}
		);
}

function editar(){
	datos=$('#frm-edit').serialize();
	$.ajax({
		url: '../controladores/cliente/update.php',
		type: 'POST',
		data: datos,
	})
	.done(function(r) {
		if(r=="ok"){
			alertify.success("cliente actualizado correctamente");
            $("#m-articulo").modal("hide");
            $("#listado").load("../data/cliente/listado.php");
		}
	})
	
}

function verificar_celular(dato) {
    if (/^([0-9])*$/.test(dato)) {
        var arrn = Array.from(dato);
        ver = arrn[0] + arrn[1];
        if (ver == 9 && dato.length == 10) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function verificar_correo(correo) {
    if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(correo)) {
        return true;
    } else {
        return false;
    }
}

function capturar(datos){
	d=datos.split('||');
	$('#txtCedula').val(d[0]);
	$('#txtNombre').val(d[1]);
	$('#txtApellido').val(d[2]);
	$('#txtCorreo').val(d[3]);
	$('#txtCelular').val(d[4]);
}