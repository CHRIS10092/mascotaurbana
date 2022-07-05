//$('#listadoventas').load('../data/empresa/reporteventasadmin.php');
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





/*
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
*/


function recargar(e){
e.preventDefault();

}
