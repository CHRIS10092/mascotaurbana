$('#list-perfil').load('../data/usuario/list_perfil.php');
$('#list-categoria').load('../data/venta/list_categoria.php');
$('#list-perfilu').load('../data/usuario/list_perfilu.php');
$('#listado').load('../data/usuario/listado.php');


st=document.getElementById('list-subcategoria');
frm=document.getElementById('frm-per');


 function Traersubcategorias() {
//desplegar id para traer la subct 	
va=document.getElementById('cmb-categoria');

$.ajax({
		url: '../data/venta/list_subcategoria.php',
		type: 'GET',
		//mandar el va 
		data: {'id':va.value},
		
	})
	.done(function(r) {
		
		st.innerHTML="";
		st.innerHTML=r;
	})
}



$('#btn-guardarper').click(function(){

	zonas=$('#cmb-categoria').val();
	subzonas=$('#cmb-subcategoria').val();
	
if (zonas==0) {

	alertify.error('debe escoger una zona para dar permisos');

}else{

	datos=$('#frm-per').serialize();
	$.ajax({
		url: '../controladores/usuario/permisos.php',
		type: 'POST',
		data: datos,
	})
	.done(function(r) {
		if(r==1){
			alertify.alert('REGISTRO Correcto');
		}else{
			alertify.alert('no se pudo registrar');
		}
	})

}



	})

$('#btn-guardar').click(function(){

	nombre=$('#txt-nombre').val();
	usuario=$('#txt-usuario').val();
	correo=$('#txt-correo').val();
	direccion=$('#txt-direccion').val();
	perfil=$('#cmb-perfil').val();

	if(!nombre){
		mensajes('Escribir el nombre completo del usuario');
	}else if(!usuario){
		mensajes('Escribir la cuenta de usuario');
	}else if(!correo){
		mensajes('Escribir el email del usuario');
	}else if(!verificar_correo(correo)){
		mensajes('El formato del correo es incorrecto');
	}else if(!direccion){
		mensajes('Escribir la Direccion ');
	}else if(perfil==0){
		mensajes('Seleccionar un perfil para el usuario');
	}else{
		confirmar();
	}

})

function confirmar(){
	alertify.confirm('Aviso',"Registrar ?",
		function(){
			registrar();
		},
		function(){
		}
		);
}

function registrar(){
	datos=$('#frm-new').serialize();
	$.ajax({
		url: '../controladores/usuario/create.php',
		type: 'POST',
		data: datos,
	})
	.done(function(r) {
		if(r==1){
			ok();
		}else if(r==2){
			alertify.alert('Alerta','La Cuenta de Usuario ya existe','');
		}else if(r==3){
			alertify.alert('Alerta','El email ya esta registrado','');
		}else{
			alertify.alert(r);
		}
	})
	
}


function obtenerusuario(datos){

	d=datos.split('||');

$('#txt-usuariop').val(d[2]);
$('#txt-nombrep').val(d[1]);
$('#txt-id-usuario').val(d[0]);

}


function capturar(datos){
	d=datos.split('||');
	$('#txt-id').val(d[0]);
	$('#txt-nombreu').val(d[1]);
	$('#txt-usuariou').val(d[2]);
	$('#txt-correou').val(d[3]);
	$('#txt-direccionu').val(d[4]);
	$('#cmb-perfilu').val(d[5]);
}

$('#btn-editar').click(function(){

	nombre=$('#txt-nombreu').val();
	usuario=$('#txt-usuariou').val();
	correo=$('#txt-correou').val();
	direccion=$('#txt-direccionu').val();

	perfil=$('#cmb-perfilu').val();

	if(!nombre){
		mensajesu('Escribir el nombre completo del usuario');
	}else if(!usuario){
		mensajesu('Escribir la cuenta de usuario');
	}else if(!correo){
		mensajesu('Escribir el email del usuario');
	}else if(!verificar_correo(correo)){
		mensajesu('El formato del correo es incorrecto');
		}else if(!direccion){
		mensajesu('Escribir la direccion');
		}else if(perfil==0){
		mensajesu('Seleccionar un perfil para el usuario');
	}else{
		editar();
	}

})

function editar(){
	datos=$('#frm-edit').serialize();
	$.ajax({
		url: '../controladores/usuario/update.php',
		type: 'POST',
		data: datos,
	})
	.done(function(r) {
		if(r==1){
			oku();
		}else{
			alertify.alert(r);
		}
	})
	
}

function ok(){
	$('#n-usuario').modal('hide');
	$('#frm-new')[0].reset();
	mensaje='<div class="alert alert-success">'+
	        '<button type="button" class="close" data-dismiss="alert">'+
	               '<i class="ace-icon fa fa-times"></i>'+
      				'</button>'+
      				'<strong>'+
      					'<i class="ace-icon fa fa-plus"></i>'+'  '+
      				'</strong>'+
      				  'Registro Correcto'+
      				'<br>'+
      			'</div>';
	$('#correcto').html(mensaje);
	$('#listado').load('../data/usuario/listado.php');
}

function oku(){
	$('#n-usuariou').modal('hide');
	mensaje='<div class="alert alert-success">'+
	        '<button type="button" class="close" data-dismiss="alert">'+
	               '<i class="ace-icon fa fa-times"></i>'+
      				'</button>'+
      				'<strong>'+
      					'<i class="ace-icon fa fa-plus"></i>'+'  '+
      				'</strong>'+
      				  'Registro Editado'+
      				'<br>'+
      			'</div>';
	$('#correcto').html(mensaje);
	$('#listado').load('../data/usuario/listado.php');
}

function okd(){

	mensaje='<div class="alert alert-success">'+
	        '<button type="button" class="close" data-dismiss="alert">'+
	               '<i class="ace-icon fa fa-times"></i>'+
      				'</button>'+
      				'<strong>'+
      					'<i class="ace-icon fa fa-plus"></i>'+'  '+
      				'</strong>'+
      				  'Registro Eliminado'+
      				'<br>'+
      			'</div>';
	$('#correcto').html(mensaje);
	$('#listado').load('../data/usuario/listado.php');
}


function verificar_correo(correo) {
    if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(correo)) {
        return true;
    } else {
        return false;
    }
}

function mensajes(info){
	mensaje='<div class="alert alert-danger">'+
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

function mensajesu(info){
	mensaje='<div class="alert alert-danger">'+
	        '<button type="button" class="close" data-dismiss="alert">'+
	               '<i class="ace-icon fa fa-times"></i>'+
      				'</button>'+
      				'<strong>'+
      					'<i class="ace-icon fa fa-warning"></i>'+'  '+
      				'</strong>'+
      				  info+
      				'<br>'+
      			'</div>';
	$('#alertasu').html(mensaje);
}
$('#btn-editar').click(function(){

	nombre=$('#txt-nombreu').val();
	usuario=$('#txt-usuariou').val();
	correo=$('#txt-correou').val();
	direccion=$('#txt-direccionu').val();

	perfil=$('#cmb-perfilu').val();

	if(!nombre){
		mensajesu('Escribir el nombre completo del usuario');
	}else if(!usuario){
		mensajesu('Escribir la cuenta de usuario');
	}else if(!correo){
		mensajesu('Escribir el email del usuario');
	}else if(!verificar_correo(correo)){
		mensajesu('El formato del correo es incorrecto');
		}else if(!direccion){
		mensajesu('Escribir la direccion');
		}else if(perfil==0){
		mensajesu('Seleccionar un perfil para el usuario');
	}else{
		editar();
	}

})

function preguntar(id){
	alertify.confirm('Confirmar',"Desea Eliminar el Registro",
		function(){
			eliminar(id);
		},
		function(){}
		);
}

function eliminar(id){
	$.ajax({
		url: '../controladores/empresas/estado.php',
		type: 'POST',
		data: {id:id},
	})
	.done(function(r) {
		if(r==1){
			okd();
		}else{
			alertify.alert(r);
		}
	})
}

function solo_letras(e) {
  tecla = (document.all) ? e.keyCode : e.which;
    //tecla para poder borrar
    if (tecla == 8) {
      return true;
  }
    // expresion para generar espacios \s|$
    patron = /[a-z-A-Z-\s|$]/;
    teclaFinal = String.fromCharCode(tecla);
    return patron.test(teclaFinal);
}

function solo_numeros(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    //tecla para poder borrar
    if (tecla == 8) {
      return true;
  }
  patron = /[0-9]/;
  teclaFinal = String.fromCharCode(tecla);
  return patron.test(teclaFinal);
}

