$('#listado').load('../data/categoria/listado.php');
$('#btn-guardar').click(function(){

	categoria=$('#txt-des').val();

	if(!categoria){
		mensajes('Escribir la descripcion de la categoria');
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
		url: '../controladores/categoria/create.php',
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
	$('#n-categoria').modal('hide');
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
	$('#listado').load('../data/categoria/listado.php');
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
	$('#txt-desu').val(d[1]);
}

$('#btn-editar').click(function(){

	categoria=$('#txt-desu').val();

	if(!categoria){
		mensajesu('Escribir la descripcion de la categoria');
	}else{
		editar();
	}

})

function editar(){
	datos=$('#frm-edit').serialize();
	$.ajax({
		url: '../controladores/categoria/update.php',
		type: 'POST',
		data: datos,
	})
	.done(function(r) {
		if(r==1){
			oku();
		}else if(r==2){
			alertify.alert("no se puede editar, el registro ya existe ");
		}else{
			alertify.alert(r);
		}
	})
	
}


function oku(){
	$('#n-categoriau').modal('hide');
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
	$('#listado').load('../data/categoria/listado.php');
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
	$('#listado').load('../data/categoria/listado.php');
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
		url: '../controladores/categoria/delete.php',
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

     function validar_letras(e) {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla == 8) return true;
        patron = /[0123456789]/;
        te = String.fromCharCode(tecla);
        if (patron.test(te)) {
            alertify.error('SOLO SE ACEPTAN LETRAS');
            return false;

        } 
}

