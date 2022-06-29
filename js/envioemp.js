const TblDatos = document.getElementById('tbl-fact-datos')
const TblDatosRecepcion = document.getElementById('tbl-recepcion')
const TblDatosAutorizacion= document.getElementById('tbl-autorizacion')

$('#frm-facturas').submit(function(e){
	e.preventDefault();
	let numero = $("#numero")
	let identificacion = $("#identificacion")
	let inicio = $("#inicio")
	let fin = $("#fin")
	if(numero.val() != ""){
		BuscarFacturas(1)
	}else if(identificacion.val() != ""){
		BuscarFacturas(2)
	}else if(inicio.val() != "" && fin.val() != ""){
		BuscarFacturas(3)
	}else{
		alertify.alert("Alerta","Escribir Algun Campo de Busqueda")
	}
});

const BuscarFacturas = (criterio) => {
	const frm = document.getElementById("frm-facturas")
    datos = new FormData(frm)
    datos.append("criterio",criterio)
	$.ajax({
		type:"POST",
		url:"../controladores/sriempresas/sriControllerEmpresas.php",
		contentType: false,
        processData: false,
		data:datos,
		success:function(r){
			el = JSON.parse(r)
			TblDatos.innerHTML=''
			CrearTabla(el)
		}
	})
}

const CrearTabla = items => {
	
	items.forEach(( el, i) => {
		TblDatos.innerHTML+=`<tr>
		               <td>${el.ven_numero}</td>
					   <td>${el.idcliente}</td>
					   <td>${el.ven_fecha}</td>
					   <td>${el.ven_total}</td>
					   <td>${el.estado}</td>
					   <td>
					        
							<button id="btn-recibir${el.ven_id}" style="display: block" class="btn btn-default btn-sm" data-id="${el.ven_id}" data-xml='${el.xml}' onclick='Recepcion(${el.ven_id})' >Recepcion</button>
							<button id="btn-autorizar${el.ven_id}" style="display: block" class="btn btn-default btn-sm" data-id="${el.ven_id}" data-ven_numero_emision='${el.ven_numero_emision}' onclick='Autorizacion_sri(${el.ven_id})' >Autorizar</button>
					   </td>
					   <td><a target="_black" href="../procesarpdf/procesarpdfsri.php?id=${el.ven_numero}" class="btn btn-danger">PDF</a></td>
					 
					   
		           </tr>`
	})
}

function Recepcion(i){
	var xml = $("#btn-recibir"+i).attr("data-xml");
	var numero = $("#btn-recibir"+i).attr("data-id");
	alert(xml,numero);
	
	$.ajax({
		url:"../controladores/sriempresas/Recepcion.php",
		type:"POST",
		data:{xml:xml,numero:numero},
		success:function(r){
			console.log(r)
		}

		

	})
	
}
function Autorizacion_sri(i){
	var ven_numero_emision = $("#btn-autorizar"+i).attr("data-ven_numero_emision");
	alert(ven_numero_emision);
	
	$.ajax({
		url:"../controladores/sriempresas/Autorizacion.php",
		type:"POST",
		data:{ven_numero_emision:ven_numero_emision},
		success:function(r){
			console.log(r)
		}

		

	})
	
}

const Enviar = e =>{
//llamar al gif
var imagen=document.getElementById('imagen');
	dato = e.dataset.xml
	id = e.dataset.id
	
	$.ajax({
		url: '../controladores/sriempresas/sriControllerEmpresas.php',
		type: 'POST',
		data:{xml:dato,id:id},
		beforeSend:function(){
		  	 imagen.style.display="block"
		},
		success:function(r){
             el = JSON.parse(r);

			if(el.res){
				document.getElementById("tbl-sri").style.display = "block"
				$('#myModal').modal('show')

			     recepcion(el.sms.RespuestaRecepcionComprobante,el.id)
			     

			}else{
				document.getElementById('errores').style.display = "block"
				document.getElementById('errores').innerHTML = el.sms
				$('#myModal').modal('show')

			}
			
		},
		complete:function(){
		   imagen.style.display="none";
		}
	
	})
}




const recepcion = (el,id) =>{

	    if(el.estado == "RECIBIDA"){
	    	document.getElementById('btn-autorizar'+id).style.display = "block";
	    	document.getElementById('btn-recibir'+id).style.display = "none";
	    	document.getElementById('btn-xml'+id).style.display = "block";
	    	TblDatosRecepcion.innerHTML=`<tr>
		               <td>${el.estado}</td>
		              </tr>`
	    }else {
	    	(el.estado=="DEVUELTA" || el.estado=="NO PROCESADA" )
		TblDatosRecepcion.innerHTML=`<tr>
		               <td>${el.estado}</td>
		               <td>${el.comprobantes.comprobante.mensajes.mensaje.identificador}</td>
		               <td>${el.comprobantes.comprobante.mensajes.mensaje.mensaje}</td>
					   <td>${el.comprobantes.comprobante.mensajes.mensaje.informacionAdicional}</td>
					   <td>${el.comprobantes.comprobante.mensajes.mensaje.tipo}</td>
		           </tr>`

		           datos = new FormData();
		           
		           datos.append('identificador',el.comprobantes.comprobante.mensajes.mensaje.identificador)
		           datos.append('mensaje',el.comprobantes.comprobante.mensajes.mensaje.mensaje)
		           datos.append('informacionAdicional',el.comprobantes.comprobante.mensajes.mensaje.informacionAdicional)
		           datos.append('tipo',el.comprobantes.comprobante.mensajes.mensaje.tipo)
		           
		          $.ajax({
		           	type:"POST",
		           	contentType: false,
                    processData: false,
		           	url:"../controladores/sriempresas/guardar.php",
		           	data:datos,
		           	success:function(r){
		           		console.log(r)
		           	}
		           })

	}
	
}




const Autorizar=e =>{
var imagen=document.getElementById('imagen')
dato=e.dataset.ven_numero_emision
id = e.dataset.id


$.ajax({
	url: '../controladores/sriempresas/sriControllerEmpresas.php',
	type: 'POST',
	data: {ven_numero_emision: dato,id:id},

beforeSend:function(){
 imagen.style.display="block"
},
success:function(r){
 	el=JSON.parse(r);
 
if(el.res){
				document.getElementById("tbl-sri").style.display = "block"
				$('#myModal').modal('show')

			     recepcionautorizacion(el.sms.RespuestaAutorizacionComprobante,el.id)
			     

			}else{
				document.getElementById('errores').style.display = "block"
				document.getElementById('errores').innerHTML = el.sms
				$('#myModal').modal('show')

			}
			
		},
		complete:function(){
		   imagen.style.display="none";
		}

})

}


const recepcionautorizacion = (el,id) =>{

	    if(el.autorizaciones.autorizacion.estado == "AUTORIZADO"){
	    	document.getElementById('btn-autorizar'+id).style.display = "block";
	    	TblDatosRecepcion.innerHTML=`<tr>
		               <td>${el.autorizaciones.autorizacion.estado}</td>
		              
		           </tr>`

	    }else{
	    	(el.autorizaciones.autorizacion.estado == "NO AUTORIZADO" || el.autorizaciones.autorizacion.estado == "NO PROCESADA" ) 
		TblDatosRecepcion.innerHTML=`<tr>
		               <td>${el.autorizaciones.autorizacion.estado}</td>
		               <td>${el.autorizaciones.autorizacion.mensajes.mensaje.identificador}</td>
		               <td>${el.autorizaciones.autorizacion.mensajes.mensaje.mensaje}</td>
					   <td>${el.autorizaciones.autorizacion.mensajes.mensaje.informacionAdicional}</td>
					   <td>${el.autorizaciones.autorizacion.mensajes.mensaje.tipo}</td>
		           </tr>`

		           datos = new FormData();
		           
		           datos.append('identificador',el.autorizaciones.autorizacion.mensajes.mensaje.identificador)
		           datos.append('mensaje',el.autorizaciones.autorizacion.mensajes.mensaje.mensaje)
		           datos.append('informacionAdicional',el.autorizaciones.autorizacion.mensajes.mensaje.informacionAdicional)
		           datos.append('tipo',el.autorizaciones.autorizacion.mensajes.mensaje.tipo)

		           $.ajax({
		           	type:"POST",
		           	contentType: false,
                    processData: false,
		           	url:"../controladores/sriempresas/guardar.php",
		           	data:datos,
		           	success:function(r){
		           		console.log(r)
		           	}
		           })

		           }
	
}


const xml=e=>{
dato=e.dataset.xml;
   var element = document.createElement('a');
   
    element.setAttribute('href', 'data:xml;charset=utf-8,' + encodeURIComponent(dato));
    element.setAttribute('download', dato);

    element.style.display = 'block';
    document.body.appendChild(element);

    element.click();

    document.body.removeChild(element);

}




const descargarxml=(xml)=>{
if (xml!='') {
	alert("esta vacio")
}
 var filename = "archivo.xml";
xml();

}

