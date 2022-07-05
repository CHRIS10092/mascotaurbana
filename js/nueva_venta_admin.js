$('#listadoventas').load('../data/empresa/reporteventasadmin.php');
$('#list-detalle').load('../data/venta/list_detalle.php');
$('#inp-numero').load('../data/venta/inp_numero.php');
$('#list-medicamento').load('../data/venta/list_articulosadmin.php');
$('#list-categoria').load('../data/venta/list_categoria.php');
$('#list-empresa').load('../data/venta/list_empresa.php');
$('#list-empresaadmin').load('../data/venta/list_empresaadmin.php');

$('#list-empresas').load('../data/empresa/listar_empresaventa.php');
$('#list-empresasventas').load('../data/empresa/reporteventasempresas.php');


function capturarempresa(datos){

		d=datos.split('||');
	$('#txt-id').val(d[5]);
	$('#txt-ruc').val(d[0]);
	$('#txt-nombre').val(d[1]);
	$('#txt-direccion').val(d[2]);
	$('#txt-correo').val(d[3]);
	$('#txt-celular').val(d[4]);
  $("#n-empresas").modal('hide');
}

function detallar(emp_id){
  $.ajax({
    url: '../data/empresa/verinfoventas.php',
    type: 'POST',
    data: {emp_id: emp_id},
  })
  .done(function(r) {
    $('#ver-orden').html(r);
  });
}

function imprimir_documento(){
 
  var codigo=document.getElementById('codigo');
  var ventimp=window.open(' ','_blank');
  ventimp.document.write(codigo.innerHTML);
  ventimp.document.close();
  ventimp.print();
  ventimp.close(); 
}


function detallarempresa(emp_id){
  $.ajax({
    url: '../data/empresa/verinfoventasempresa.php',
    type: 'POST',
    data: {emp_id: emp_id},
  })
  .done(function(r) {
    $('#ver-orden').html(r);
  });
}

function imprimir_documento(){
 
  var codigo=document.getElementById('codigo');
  var ventimp=window.open(' ','_blank');
  ventimp.document.write(codigo.innerHTML);
  ventimp.document.close();
  ventimp.print();
  ventimp.close(); 
}


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
	

 


/*function enviar_facturacion_electronica(){

datos = new FormData();
datos.append('factura[NroFactura]',$('#txt-numero').val());
datos.append('factura[FechaEmision]',$('#txtFecha').val());
datos.append('cliente[NroCedula]',$('#txt-ruc').val());
datos.append('cliente[NombreCompleto]',$('#txt-nombre').val());
datos.append('cliente[Direccion]',$('#txt-direccion').val());
datos.append('cliente[Email]',$('#txt-correo').val());

tabla_detalle=document.getElementById('tbl-detalle');

	for (let i = 1; i < tabla_detalle.rows.length; i++) {

		datos.append(`producto[${i-1}][Codigo]`,tabla_detalle.rows[i].cells[0].innerText);
		datos.append(`producto[${i-1}][Item]`,tabla_detalle.rows[i].cells[1].innerText);
		datos.append(`producto[${i-1}][Cantidad]`,tabla_detalle.rows[i].cells[3].innerText);
		datos.append(`producto[${i-1}][PrecioUnitario]`,tabla_detalle.rows[i].cells[4].innerText);
		
	}



$.ajax({

	url:'https://mbytesoluciones.com/facturacion/index.php/facturacion/facturacion_electronica/facturar',
	type:'POST',
	data:datos,
	contentType: false,
	processData: false
})
.done(function(r){
	console.log(JSON.parse(r));
	
})

}
*/

$('#btn-guarda').click(function(e){
e.preventDefault();
tbl_detalle=document.getElementById('tbl-detalle');
//console.log(tbl_detalle);
	
	id=$('#txt-id').val();
	ruc=$('#txt-ruc').val();
	nombre=$('#txt-nombre').val();
	apellido=$('#txt-apellido').val();
	correo=$('#txt-correo').val();
	telefono=$('#txt-celular').val();
	correo=$('#txt-correo').val();
	//zonas=$('#cmb-categoria').val();
	//tipo = $("#cmbTipo").val();
	empresas=$("#txt-tipoempresa").val();
	
	 if(!nombre){
		alertify.error('Escribir la razon social / nombre del cliente');
	}else if(!telefono){
		alertify.error('Escribir el numero de celular del contacto');
	
	}else if(correo && !verificar_correo(correo)){
		alertify.error('El formato del correo electronico es erroneo');
	}else if(empresas==""){
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
//enviar_facturacion_electronica();

datos=new FormData(frm);
$.ajax({

	url:'../controladores/venta/registrar_venta_admin.php',
	type:'POST',
	data:datos,
	contentType: false,
    processData: false
})
.done(function(r){
	//console.log(r);
	
	$('#list-detalle').load('../data/venta/list_detalle.php');
	$('#list-medicamento').load('../data/venta/list_articulosadmin.php');
	$('#inp-numero').load('../data/venta/inp_numero.php');
	alertify.success("",'VENTA EXITOSA');
	 setTimeout(function() {
                window.location.href = "../app/nueva_venta_admin.php";
            }, 1000);

	frm.reset();

	
})

}


function agregar(datos){
	
	d=datos.split('||');
	descripcion=d[3];

	cant=$('#txt-cantidad'+d[2]).val();

	precio=$('#txt-precio'+d[2]).val();
	existencia=$('#txt-existencia'+d[2]).val();
	if(!cant || cant<0 || cant==0){
		alertify.error('La cantidad de venta del articulo no puede ser cero,negativo ni estar sin definir');
	}else if(!precio || precio<=0 ){
		alertify.error('El precio de venta del articulo no puede ser cero,negativo ni estar sin definir');
	}else if(parseInt(existencia)<parseInt(cant)){
		alertify.error('la cantidad del articulo no se encuentra en stock');
	}else{
		enviar(d[0],d[1],descripcion,cant,precio,d[2]);
		$("#n-medicamento").modal('hide');
	}

}

function enviar(codigo,nombre,descripcion,cantidad,precio,id,subtotal,iva,total){
	$.ajax({
	url: '../data/venta/add_medicamento.php',
	type: 'POST',
	data: {codigo:codigo,nombre:nombre,descripcion:descripcion,cantidad:cantidad,precio:precio,id:id,subtotal:subtotal,iva:iva,total:total},
	})
	.done(function(r) {
		response = JSON.parse(r);

		if(response.res){
			alertify.alert("Verificar",response.mensaje);
		}else{
			$('#list-detalle').load('../data/venta/list_detalle.php');
		}
		
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
        if ((ver >= 2 && ver <= 7) && telefono.length == 10) {
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

if (this.value.length==13) {

cod=this.value;
	$.ajax({
		url: '../controladores/venta/llamarrucempresas.php',
		type: 'GET',
		data: {id:cod}
		

	})
	.done(function(r) {
		
		datos=JSON.parse(r);
		//prueba para ver si trae los datos
		
		$('#txt-id').val(datos.emp_id);
		$('#txt-nombre').val(datos.emp_nombre);
		$('#txt-direccion').val(datos.emp_direccion);
		$('#txt-correo').val(datos.emp_correo);
		$('#txt-celular').val(datos.emp_telefono);
	
	//	alertify.error("Verifique el ruc")
	

	})



}else{
	
		$('#txt-id').val("");
		$('#txt-nombre').val("");
		$('#txt-direccion').val("");
		$('#txt-correo').val("");
		$('#txt-celular').val("");
		
}

});
