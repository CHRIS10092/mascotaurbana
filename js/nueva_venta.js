$('#list-detalle').load('../data/venta/list_detalle.php');
$('#inp-numero').load('../data/venta/inp-numeroemp.php');
$('#list-medicamento').load('../data/venta/list_medicamento.php');
$('#list-categoria').load('../data/venta/list_categoria.php');
$('#list-empresa').load('../data/venta/list_empresa.php');


st=document.getElementById('list-subcategoria');

frm=document.getElementById('frm-registro');


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
	

$('#btn-guarda').click(function(e){
e.preventDefault();
tbl_detalle=document.getElementById('tbl-detalle');
//console.log(tbl_detalle);

	ruc=$('#txt-ruc').val();
	nombre=$('#txt-nombre').val();
	apellido=$('#txt-apellido').val();
	correo=$('#txt-correo').val();
	celular=$('#txt-celular').val();
	correo=$('#txt-correo').val();
	zonas=$('#cmb-categoria').val();
	tipo = $("#cmbTipo").val();
	empresas=$("#txt-empresas").val();
	
	if(!ruc){
		alertify.error('Escribir la cedula del cliente');
	}else if(ruc.length<10){
		alertify.error('El formato de la cedula debe constar de 10 digitos');
	}else if(!verificar_cedula(ruc)){
		alertify.error('El numero de cedula es incorrecto');
	}else if(!nombre){
		alertify.error('Escribir la razon social / nombre del cliente');
	}else if(!celular){
		alertify.error('Escribir el numero de celular del contacto');
	}else if(!verificar_celular(celular)){
		alertify.error('El formato del numero de celular es erroneo y debe constar 09 al inicio');
	
	
	}else if(correo && !verificar_correo(correo)){
		alertify.error('El formato del correo electronico es erroneo');
	}else if(empresas==0){
		alertify.error('Seleccionar una Empresa donde se va a vender el producto');
	}else if(tbl_detalle.rows.length==1){
		alertify.error("debe ingresar al menos un articulo para generar la venta");


	}else {
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
//console.log(frm);
//	para regstrar al frm 
datos=new FormData(frm);
$.ajax({

	url:'../controladores/venta/registrar_ventas.php',
	type:'POST',
	data:datos,
	contentType: false,
    processData: false
})
.done(function(r){
	console.log(r);
	if (r==1) {
	$('#list-detalle').load('../data/venta/list_detalle.php');
	alertify.alert("",'VENTA EXITOSA');
	frm.reset();
	$('#inp-numero').load('../data/venta/inp_numero.php');
	  setTimeout(function(){
          window.location.href="../app/nueva_venta.php";
        },1000); 	
	}else{
		alertify.error("VERIFICAR SI LOS DATOS ESTAN CORRECTOS");
	}
	
    
})
}


function agregar(datos){
	
	d=datos.split('||');
	descripcion=d[3];

	cant=$('#txt-cantidad'+d[2]).val();

	precio=$('#txt-precio'+d[2]).val();
	existencia=$('#txt-existencia'+d[2]).val();
	if(!cant || cant<0  || cant==0){
		mensajes1('La cantidad de venta del articulo no puede ser cero,negativo ni estar sin definir');
	}else if(!precio || precio<=0){
		mensajes1('El precio de venta del articulo no puede ser cero,negativo ni estar sin definir');
	}else if(parseInt(existencia)<parseInt(cant)){
		mensajes1('la cantidad del articulo no se encuentra en stock');
	}else{
		enviar(d[0],d[1],descripcion,cant,precio,d[2]);
		$("#n-medicamento").modal('hide');
	}

}

function enviar(codigo,nombre,descripcion,cantidad,precio,id){
	$.ajax({
		url: '../data/venta/add_medicamento.php',
		type: 'POST',
		data: {codigo:codigo,nombre:nombre,descripcion:descripcion,cantidad:cantidad,precio:precio,id:id},
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






function recargar(e){
e.preventDefault();

}

function verificar_cedula(cedula) {
    let cad = cedula;
    let total = 0;
    let longitud = cad.length;
    let longcheck = longitud - 1;

    if (cad !== "" && longitud === 10){
      for(i = 0; i < longcheck; i++){
        if (i%2 === 0) {
          var aux = cad.charAt(i) * 2;
          if (aux > 9) aux -= 9;
          total += aux;
      } else {
              total += parseInt(cad.charAt(i)); // parseInt o concatenará en lugar de sumar
          }
      }

      total = total % 10 ? 10 - total % 10 : 0;

      if (cad.charAt(longitud-1) == total) {
        return true;
    }else{
        return false;
    }
}
}

function verificar_telefono(telefono) {

    if (/^([0-9])*$/.test(telefono)) {
        var arrn = Array.from(telefono);
        ver = arrn[0] + arrn[1];
        if ((ver >= 2 && ver <= 7) && telefono.length == 9) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
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
function mensajes1(info){
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
	$('#alertas1').html(mensaje);
}




cedula=document.getElementById('txt-ruc');

cedula.addEventListener('keyup',function(){

//alert(this.value);

if (this.value.length==10) {

cod=this.value;
	$.ajax({
		url: '../controladores/venta/llamarcedulacliente.php',
		type: 'GET',
		data: {id:cod}
		

	})
	.done(function(r) {
datos=JSON.parse(r);
		//prueba para ver si trae los datos
		$('#txt-nombre').val(datos.nombre);
		$('#txt-apellido').val(datos.apellidos);
		$('#txt-correo').val(datos.correo);
		$('#txt-celular').val(datos.celular);
		$('#txt-direccion').val(datos.direccion);
		
	})



}else{

		$('#txt-nombre').val("");
		$('#txt-apellido').val("");
		$('#txt-correo').val("");
		$('#txt-celular').val("");
		$('#txt-direccion').val("");
}

});
