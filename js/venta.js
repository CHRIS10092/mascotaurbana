$('#list-proveedor').load('../data/venta/list_proveedor.php');
$('#inp-numero').load('../data/venta/inp_numero.php');

function verificar_datos(){
	tabla=document.getElementById("tbl-detalle").rows.length;
	proveedor=$('#cmb-proveedor').val();
	numero=$('#txt-numero').val();
	total=$('#txt-total').val();

	if(tabla==1){
		validar('El detalle de la venta no tiene ningun articulo');
	}else if(proveedor==0){
		validar('Elegir un cliente para generar la venta');
	}else{
		confirmar(numero,proveedor,total);
	}
}

function confirmar(numero,proveedor,total){
	alertify.confirm('Aviso',"Registrar la venta ?",
		function(){
			registrar(numero,proveedor,total);
		},
		function(){
		}
		);
}

function registrar(numero,proveedor,total){
	$.ajax({
		url: '../controladores/venta/create.php',
		type: 'POST',
		data: {numero:numero,proveedor:proveedor,total:total},
	})
	.done(function(r) {
		if(r==1){
			ok();
		}else{
			alertify.alert(r);
		}
	})
	
}

function ok(){
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
	$('#verificacion').html(mensaje);
	$('#list-proveedor').load('../data/venta/list_proveedor.php');
    $('#inp-numero').load('../data/venta/inp_numero.php');
    $('#list-detalle').load('../data/venta/list_detalle.php');
}


function agregar(datos){
	d=datos.split('||');
	cantidad=$('#txt-cantidad'+d[2]).val();
	precio=$('#txt-precio'+d[2]).val();
	existencia=$('#txt-existencia'+d[2]).val();
	if(!cantidad || cantidad<=0){
		mensajes('La cantidad de venta del articulo no puede ser cero,negativo ni estar sin definir');
	}else if(!precio || precio<=0){
		mensajes('El precio de venta del articulo no puede ser cero,negativo ni estar sin definir');
	}else if(parseInt(existencia)<parseInt(cantidad)){
		mensajes('la cantidad del articulo no se encuentra en stock');
	}else{
		enviar(d[0],d[1],cantidad,precio,d[2]);
	}
}

function enviar(codigo,nombre,cantidad,precio,id){
	$.ajax({
		url: '../data/venta/add_medicamento.php',
		type: 'POST',
		data: {codigo:codigo,nombre:nombre,cantidad:cantidad,precio:precio,id:id},
	})
	.done(function() {
		$('#list-detalle').load('../data/venta/list_detalle.php');
	})
	
}

function quitar(id){

	$.ajax({
		url: '../data/venta/remove_medicamento.php',
		type: 'POST',
		data: {id:id},
	})
	.done(function() {
		$('#list-detalle').load('../data/venta/list_detalle.php');
	})
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

function validar(info){
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
	$('#verificacion').html(mensaje);
}