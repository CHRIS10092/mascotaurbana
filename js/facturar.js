
const ruc_cliente = document.getElementById('identificacion');
const txt_descuento = document.getElementById("txtDescuento");
const total_descuento = document.getElementById('totalDescuento');


const valor_total_descuento = document.getElementById('txtTotalDescuento');

const nombre_cliente = document.getElementById('cliente');
const apellido_cliente = document.getElementById('apellido');
const direccion_cliente = document.getElementById('direccion');
const correo_cliente = document.getElementById('correo');
const celular_cliente = document.getElementById('celular');

let detalle = []
$("#listadoProductos").load("../data/facturar/listadoProductos.php")
$("#listadoClientes").load("../data/facturar/listadoClientes.php")

function capturarCliente(e){
	e.preventDefault();
	let cliente = JSON.parse(e.target.dataset.cliente)
	$("#idcliente").val(cliente.idcliente)
	$("#identificacion").val(cliente.cli_rucci)
	$("#cliente").val(cliente.cli_nombre)
	$('#apellido').val(cliente.cli_apellido)
	$("#correo").val(cliente.cli_correo)
	$("#direccion").val(cliente.cli_direccion)
	$("#celular").val(cliente.cli_celular)
	$('#m-clientes').modal('hide')
	
}
function capturarProducto(e){
	e.preventDefault();

	let producto = JSON.parse(e.target.dataset.producto)
	//$("#idproducto").val(producto.inv_id)
	$("#idproducto").val(producto.inv_id)
	$("#codigo").val(producto.inv_codigo)
	$("#detalle").val(producto.detalle)
	$("#stock").val(producto.inv_stock)
	$("#precio").val(producto.inv_valor)
	$("#preciopvp").val(producto.inv_valorpvp)
	$("#chip").val(producto.chip)
	$('#m-productos').modal('hide')
	
}

$('#btnAgregarProducto').click(function(){

	if($('#idproducto').val() == ""){
        alertify.error("Debe seleccionar un producto")
	}else if($('#cantidad').val() == ""){
		alertify.error("Digite la cantidad del producto requerido")
	}else if(parseInt($("#stock").val()) < parseInt($("#cantidad").val())){
		alertify.error("La cantidad requerida soprepasa el stock")
	}else if(verificarProducto($("#idproducto").val()).length > 0){
		alertify.error("El producto ya existe en la lista de detalle")
	}else{
		let item = detalle.length+1
		let total=parseFloat($("#preciopvp").val())*parseFloat($("#cantidad").val())-$("#descuento").val();
		detalle.push({"item":item,
					"codigo":$("#codigo").val(),	          
					"detalle":$("#detalle").val(),
			        "cantidad":$("#cantidad").val(), 
					"precio":$("#preciopvp").val(),
					"total":total.toFixed(2),
			        "id":$("#idproducto").val(),
			        "chip":$("#chip").val(),
					"descuento":$("#descuento").val()
			        })
		agregarDetalle()
		limpiarProducto()
		calculoTotales()
	}
	
})

function agregarDetalle(){
	let tbldetalle = document.getElementById('tbldetalle')
	tbldetalle.innerHTML =""
	detalle.map(x =>{
		tbldetalle.innerHTML+=`<tr id="${x.item}">
		                       <td>
		                       <input type="hidden" value="${x.chip}">
		                       ${x.item}
		                       </td>
							   <td>${x.codigo}</td>
		                       <td>${x.detalle}</td>
		                       <td>${x.cantidad}</td>
		                       <td>${x.precio}</td>
							   <td>${x.descuento}</td>
		                       <td>${x.total}</td>
		                       <td >
		                           <button class="btn btn-danger btn-sm" onclick="eliminarProducto(${x.item})">
		                               <i class="fa fa-remove"></i>
		                            </button>
		                            <input type="hidden" value="${x.id}">
		                            </td>
		                       </tr>`
	})
}

function verificarProducto(id){
	let res = detalle.filter(x =>{
		return x.id == id
	})

	return res
}

function limpiarProducto(){
	$("#idproducto").val("")
	$("#codigo").val("")
	$("#detalle").val("")
	$("#stock").val("")
	$("#precio").val("")
	$("#preciopvp").val("")
	$("#chip").val("")
	$("#cantidad").val("1")
	$('#descuento').val("0.00");
	$('#txtDescuento').val("");
	

}

function eliminarProducto(id){
	detalle = []
	$('#table-detalle tbody tr#' + id).remove()
	let rowctr = $('#table-detalle tbody tr');
	for(let i = 0;i< rowctr.length;i++){
		let properties = {}
		properties.item  = i+1
		properties.codigo  = $(rowctr[i]).find("td:eq(1)").html()
		properties.detalle  = $(rowctr[i]).find("td:eq(2)").html()
		properties.cantidad  = $(rowctr[i]).find("td:eq(3)").html()
		properties.precio  = $(rowctr[i]).find("td:eq(4)").html()
		properties.descuento  = $(rowctr[i]).find("td:eq(5)").html()
		properties.total  = $(rowctr[i]).find("td:eq(6)").html()
		properties.id  = $(rowctr[i]).find("td:eq(8) input[type='hidden']").val()
		detalle.push(properties)
	}

    agregarDetalle()
    calculoTotales()
	


}


function calculardescuento(des){

	//vacios
	
	let txtprecio=(parseFloat(document.getElementById('preciopvp').value));
		let txtdescuento=parseFloat(des.value)
	//dolares
	let desdolar=document.getElementById('chkDescuento');
	let desporcentaje=document.getElementById('chkDescuento1');
	if(des.value!=''){
	
		if(desdolar.checked){
		
			txttotaldes=txtprecio-txtdescuento;
			$('#descuento').val(txttotaldes.toFixed(2));
			//si escoje porcentajes
		}else if(desporcentaje.checked){
			txttotaldes=txtprecio*txtdescuento/100;
			$('#descuento').val(txttotaldes.toFixed(2));
	
		}
	}else{
		$('#descuento').val('0.00');
	}
	
	
	
	


}

function calculoTotales(){
    let subtotal = 0.00
    let total = 0.00
    let iva = 0.00
	let tdescuento=0.00;
	detalle.map(x=>
		{
			subtotal = subtotal + parseFloat(x.total)
			tdescuento=tdescuento+parseFloat(x.descuento)
		})
	
	iva =  subtotal*0.12;
	total= subtotal+iva;
	
	//alert(descuento.value);
	$("#subtotal").val(subtotal.toFixed(2))
	$("#iva").val(iva.toFixed(2))
	$("#total").val(total.toFixed(2))
	$("#txtTotalDesc").val(tdescuento.toFixed(2))
}


$('#btnFacturar').click(function(){
	
	cliente=document.getElementById('identificacion');
	idventa=document.getElementById('nventa');
	let tbldetalle = document.getElementById('tbldetalle').rows.length
	if($("#identificacion").val() == "" || $("#cliente").val() == "" || $("#correo").val() == ""||$("#direccion").val()==""){
     alertify.error("Todos los campos del clientes son obligatorios")
	}else if(tbldetalle == 0){
    alertify.error("El detalle de la venta debe tener al menos un producto")
	}else if($('#fecha').val() == ""){
		alertify.error("El campo fecha es obligatorio")
	}else{
		let detalleChips = CollectChips()
		let datos = new FormData(document.getElementById('frmVenta'))

		datos.append('detalle',JSON.stringify(detalle))
		datos.append('chipsDetails',JSON.stringify(detalleChips))

		fetch('../controladores/venta/prueba.php',{
			body:datos,
			method:"POST"
		}).then(res => res.text())
		  .then(res => {
		  	alertify.success(res)
		  	$('#btnFacturar').prop('disabled',true)
		  			
		setTimeout(function()
		{
		location.href="../app/venta.php", 6000
	}); 
		  })
	}
})

/*
funcion guadado json de solo chips
*/
const http = async (url,metodo,data) => {

	const response = await fetch(url,{method:metodo,body:data});

	return await response.json(); 

}

const buscar_cliente = e => {
	e.preventDefault();

    let url = '../controladores/procesar/buscar_cliente.php';
	let rucci = e.target.value;
    const data = new FormData();
    data.append('rucci',rucci);

	http(url,'POST',data)
	    .then(res => {
	    	if(res.res){

	    		idcliente.value = res.cliente.idcliente;
				nombre_cliente.value = res.cliente.nombre;
	    		apellido_cliente.value = res.cliente.apellido;
	    		direccion_cliente.value = res.cliente.direccion;
	    		correo_cliente.value = res.cliente.correo;
	    		celular_cliente.value = res.cliente.celular;

	    	}else{
				idcliente.value='';	
	    		nombre_cliente.value = '';
	    		apellido_cliente.value = '';
	    		direccion_cliente.value = '';
	    		correo_cliente.value = '';
	    		celular_cliente.value = '';

	    	}
	    });
}

function CollectChips(){
  
	let arrayChips = []
	let rowctr = $('#table-detalle tbody tr');
	for(let i = 0;i< rowctr.length;i++){
		chip  = $(rowctr[i]).find("td:eq(0) input[type='hidden']").val()
		numero  =     $(rowctr[i]).find("td:eq(3)").html()
		if(chip && chip !=""){
			if(chip == "2"){
				for (var j = 0; j < parseInt(numero); j++) {
				let objChips ={}
				objChips.id = `chip${j+1}`
				objChips.quantity = `${j+1}`
				objChips.state = `inactive`
		    arrayChips.push(objChips)
			}
			}
			
		}
	}
 return arrayChips
}


function GenerarTicket(){
	agregarDetalleTicket()
	document.getElementById('tick').style.display = "block"
	document.getElementById('btnImprimir').style.display = "block"
	$('#t-fecha').html($('#fecha').val())

}

function agregarDetalleTicket(){
	let tbldetalle = document.getElementById('t-detalle')
	tbldetalle.innerHTML =""
	detalle.map(x =>{
		tbldetalle.innerHTML+=`<tr id="${x.item}">
		                       <td>${x.item}</td>
		                       <td>${x.detalle}</td>
		                       <td>${x.cantidad}</td>
		                       <td>${x.precio}</td>
		                       <td>${x.total}</td>
		                       </tr>`
	})
}

// #region funciones auxiliares

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



function accion_descuento(e){


	estado = e.target.checked;


	if(estado){


		txt_descuento.readOnly = false;
	


	}else{


	  txt_descuento.readOnly = true;


	  txt_descuento.value = 0;
	  


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


function imprim1(){
var printContents = document.getElementById('tick').innerHTML;
        w = window.open();
        w.document.write(printContents);
        w.document.close(); // necessary for IE >= 10
        w.focus(); // necessary for IE >= 10
		w.print();
		w.close();
        return true;}
// #endregion

document.getElementById('frmVenta').addEventListener('submit',function(e){
	   e.preventDefault();
})

ruc_cliente.addEventListener("keyup",buscar_cliente);
