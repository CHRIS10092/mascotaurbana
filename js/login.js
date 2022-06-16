
$('#btn-entrar').click(function(){
	usuario=$('#txt-usuario').val();
	clave=$('#txt-clave').val();
	if(!usuario || !clave){
		mensajes('Escribir las Credenciales de Acceso');
	}else{
		login();
	}
})

function login(){
	datos=$('#frm-login').serialize();
	$.ajax({
		url: 'controladores/usuario/access.php',
		type: 'POST',
		data: datos,
	})
	.done(function(r) {
		response=JSON.parse(r);
		if (response.res) {
			cambiar_estado(['#label-sucursal','#cmb-sucursales'])

			iniciar(response.mensaje,response.tipo);
			cargar_sucursal(response.sucursales);

		}else{
			
			
			error(response.mensaje);

		}



	})
	
}

function cambiar_estado(components){
	components.forEach(el => {
		$(el).removeClass('ocultar');
		$(el).addClass('view-component');
	})

}

function cargar_sucursal(sucursales) {
	
	let x = "";
	let options = sucursales.forEach(el => {

	 	return   x+= `<option value="${el.codigo_suc}">${el.nombre_suc}</option>`;
	})

	$('#cmb-sucursales').html(options)
}

function iniciar(mensaje,tipo){

	correcto(mensaje);
	$('#btn-entrar').prop('disabled',true);
	$("body").fadeOut(1000,function(){
		if (tipo == '1') {
			window.location.href='app/inicio.php';
		}else{
			window.location.href='ver_informacion.php';
		}
		
	});
}


function mensajes(info){
	mensaje='<div class="alert alert-warning">'+
	        '<button type="button" class="close" data-dismiss="alert">'+
	               '<i class="ace-icon fa fa-times"></i>'+
      				'</button>'+
      				'<strong>'+
      					'<i class="ace-icon fa fa-warning"></i>'+'  '+
      				'</strong>'+
      				  info+
      				'<br>'+
      			'</div>';
	$('#alertas').html(mensaje);
}

function error(men){
	mensaje='<div class="alert alert-danger">'+
	        '<button type="button" class="close" data-dismiss="alert">'+
	               '<i class="ace-icon fa fa-times"></i>'+
      				'</button>'+
      				'<strong>'+
      					'<i class="ace-icon fa fa-warning"></i>'+'  '+
      				'</strong>'+
      				 men+
      				'<br>'+
      			'</div>';
	$('#alertas').html(mensaje);
}

function correcto(info){
	mensaje='<div class="alert alert-success">'+
      				'<strong>'+
      					'<i class="ace-icon fa fa-plus"></i>'+'  '+
      				'</strong>'+
      				  info+
      				'<br>'+
      			'</div>';
	$('#alertas').html(mensaje);
}