$('#list-categoria').load('../data/subcategoria/list_categoria.php');
$('#listado').load('../data/subcategoria/listado.php');

$('#list-categoriau').load('../data/subcategoria/list_categoriau.php');

$('#btn-guardar').click(function(){

    categoria=$('#cmb-categoria').val();
	subcategoria=$('#txt-des').val();

	if(categoria==0){
		mensajes('Seleccionar categoria de articulos');
	}else if(!subcategoria){
		mensajes('Escribir la descripcion de la subcategoria');
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
		url: '../controladores/subcategoria/create.php',
		type: 'POST',
		data: datos,
	})
	.done(function(r) {
		if(r==1){
			ok();
		}else if(r==2){
			alertify.alert('Alerta','El registro ya existe','');
		}else{
			alertify.alert(r);
		}
	})
	
}

function ok(){
	$('#n-subcategoria').modal('hide');
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
	$('#list-categoria').load('../data/subcategoria/list_categoria.php');
    $('#listado').load('../data/subcategoria/listado.php');
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

function capturar(datos){
	d=datos.split('||');
	$('#txt-id').val(d[0]);
	$('#cmb-categoriau').val(d[1]);
	$('#txt-desu').val(d[2]);
}

$('#btn-editar').click(function(){

    categoria=$('#cmb-categoriau').val();
	subcategoria=$('#txt-desu').val();

	if(categoria==0){
		mensajesu('Seleccionar categoria de articulos');
	}else if(!subcategoria){
		mensajesu('Escribir la descripcion de la subcategoria');
	}else{
		editar();
	}

})

function editar(){
	datos=$('#frm-edit').serialize();
	$.ajax({
		url: '../controladores/subcategoria/update.php',
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

function oku(){
	$('#n-subcategoriau').modal('hide');
	mensaje='<div class="alert alert-success">'+
	        '<button type="button" class="close" data-dismiss="alert">'+
	               '<i class="ace-icon fa fa-times"></i>'+
      				'</button>'+
      				'<strong>'+
      					'<i class="ace-icon fa fa-plus"></i>'+'  '+
      				'</strong>'+
      				  'Registro editado'+
      				'<br>'+
      			'</div>';
	$('#correcto').html(mensaje);
	$('#list-categoria').load('../data/subcategoria/list_categoria.php');
    $('#listado').load('../data/subcategoria/listado.php');
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
	$('#list-categoria').load('../data/subcategoria/list_categoria.php');
    $('#listado').load('../data/subcategoria/listado.php');
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
		url: '../controladores/subcategoria/delete.php',
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

