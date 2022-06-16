const btn_paso1 = document.getElementById('btnPaso1');
const btn_paso2 = document.getElementById('btnPaso2');
const btn_paso3 = document.getElementById('btnPaso3');
let min_formularios = 0;

const numero_venta = document.getElementById('txtNumeroVenta');
const fecha_venta = document.getElementById('txtFechaVenta');
const ruc_cliente = document.getElementById('txtRucCliente');
const nombre_cliente = document.getElementById('txtNombreCliente');
const apellido_cliente = document.getElementById('txtApellidoCliente');
const direccion_cliente = document.getElementById('txtDireccionCliente');
const correo_cliente = document.getElementById('txtCorreoCliente');
const celular_cliente = document.getElementById('txtCelularCliente');

const btn_articulos = document.getElementById('btnArticulos');
const tbl_datos_articulos = document.getElementById('tblDatosArticulos');
const tbl_datos_detalle = document.getElementById('tblDatosDetalle');

const subtotal_venta = document.getElementById('subtotal-venta');
const iva_venta = document.getElementById('iva-venta');
const total_venta = document.getElementById('total-venta');

const factura = {
	detalle : [],
	subtotal: 0.00,
	iva:0.00,
	total: 0.00,
	cliente:{
		rucci: '',
		nombre: '',
		apellido: '',
		direccion: '',
		correo: '',
		celular: ''
	},
	fecha:'',
	numero: ''
};


const btn_registrar_venta = document.getElementById('btnRegistrarVenta');
const btn_registrar_proceso = document.getElementById('btnRegistrarProceso');
const frm_proceso = document.getElementById('frmProceso');

const proceso = {
	tenedor: {},
	mascota:{}
};


const http = async (url,metodo,data) => {

	const response = await fetch(url,{method:metodo,body:data});

	return await response.json(); 

}


(()=>{

	let url = '../controladores/exzequial/obtener_numero_venta.php';
	http(url,'POST',null)
	    .then(res => {
	    	numero_venta.style.color = 'red';
	    	numero_venta.style.fontWeight = 'bold';
	    	numero_venta.value = res;
	    })


})()

const buscar_cliente = e => {

    let url = '../controladores/procesar/buscar_cliente.php';
	let rucci = e.target.value;
    const data = new FormData();
    data.append('rucci',rucci);

	http(url,'POST',data)
	    .then(res => {
	    	if(res.res){

	    		nombre_cliente.value = res.cliente.nombre;
	    		apellido_cliente.value = res.cliente.apellido;
	    		direccion_cliente.value = res.cliente.direccion;
	    		correo_cliente.value = res.cliente.correo;
	    		celular_cliente.value = res.cliente.celular;

	    	}else{

	    		nombre_cliente.value = '';
	    		apellido_cliente.value = '';
	    		direccion_cliente.value = '';
	    		correo_cliente.value = '';
	    		celular_cliente.value = '';

	    	}
	    });
}

const listar_articulos = e => {
    
    e.preventDefault();
    tbl_datos_articulos.innerHTML = '';
	let url = '../controladores/exzequial/listar_articulos.php';
	http(url,'POST',null)
	    .then(res => {

	         res.map(articulo => {
                datos = [
                            articulo.codigo,
                            articulo.nombre,
                            articulo.descripcion,
                            articulo.stock,
                            1,
                            articulo.valor,
                            articulo.valor,
                            articulo.id
                        ];
	    	    let fila = document.createElement('tr');
	    	    let btn_seleccionar = `<button class="btn btn-success" onclick="agregar_detalle('${datos}')">
	    	                                <i class="fa fa-pencil"></i>
	    	                           </button>`;

	    	    tabla_articulos(articulo.codigo,fila);
	    	    tabla_articulos(articulo.nombre,fila);
	    	    tabla_articulos(articulo.descripcion,fila);
	    	    tabla_articulos(articulo.stock,fila);
	    	    tabla_articulos(articulo.valor,fila);
	    	    tabla_articulos(btn_seleccionar,fila);
	    	    tbl_datos_articulos.appendChild(fila);
	         })	    	
	    })

}

const tabla_articulos = (articulo,fila) => {
	let columna = document.createElement('td');
	columna.innerHTML = articulo;
	fila.appendChild(columna);
}

const agregar_detalle = dato => {
dato = dato.split(',');

	if(verificar_articulo(factura.detalle,dato[7])){
		alertify.alert("Verificar","El articulo: "+dato[0]+" ya esta en el detalle");

	}else{

	numero_fila = tbl_datos_detalle.rows.length;
	fila = tbl_datos_detalle.insertRow(numero_fila);

	for (let i = 0; i < 8; i++) {

		columna = fila.insertCell(i);
		if(i == 4){

			nodo = document.createElement('input');
			nodo.type = 'number';
			nodo.value = dato[i];
			nodo.min = 1;
			nodo.max = dato[3];
			nodo.onkeyup = (e) => agregar_total(e);
			nodo.onchange = (e) => agregar_total(e);
	        columna.appendChild(nodo);
		}else if(i == 7){

			nodo = document.createElement('button');
			nodo.className = 'btn btn-danger';
			nodo.innerText = 'X';
			nodo.onclick = (e) => eliminar_item_detalle(e);
			columna.appendChild(nodo);
		}else{

			nodo = document.createTextNode(dato[i]);
	        columna.appendChild(nodo);
		}
	}

	subtotal = calcular_subtotal(dato[4],dato[5]);
	iva = calcular_iva(subtotal);
	total = calcular_total(subtotal,iva);

	ver_totales_venta(subtotal,iva,total);

	agregar_factura(dato[7],dato[4],dato[5],subtotal,iva,total);

	}

}

function verificartabla(){
	//e.preventDefault();
	tabla=document.getElementById('tblDatosDetalle');
	datos= [];

for (var i = 0; i<tabla.rows.length; i++) {
	
	art={};
	art.codigo=tabla.rows[i].cells[0].innerHTML;
	art.nombre=tabla.rows[i].cells[1].innerHTML;
	art.descripcion=tabla.rows[i].cells[2].innerHTML;
	art.cantidad=tabla.rows[i].cells[4].childNodes[0].value;
	datos.push(art);

}
//console.log(datos);
return datos;

}//

function verificar_articulo(coleccion,article) {

	let ok = false;

	for (let i = 0; i < coleccion.length; i++) {

		if(coleccion[i].articulo == article){
			ok = true;
		}

	}

	return ok;
  
}

const calcular_subtotal = (cantidad,precio) => {

	let subtotal = parseFloat(subtotal_venta.innerHTML);
	subtotal = subtotal + (precio * cantidad); 

	return subtotal.toFixed(3);

}

const calcular_iva = (subtotal) => {
   
	let iva = subtotal  * 0.12; 

	return iva.toFixed(3);

}

const calcular_total = (subtotal,iva) => {

	let total = parseFloat(subtotal) + parseFloat(iva);

	return total.toFixed(3);

}

const ver_totales_venta = (subtotal,iva,total) => {
	subtotal_venta.innerHTML = subtotal;
	iva_venta.innerHTML = iva;
	total_venta.innerHTML = total;
}

const eliminar_item_detalle = e => {

	let fila = e.path[2].rowIndex;
	let index_fila = fila - 1;
	let precio_total = parseFloat(e.path[2].cells[6].innerHTML);

	tbl_datos_detalle.deleteRow(index_fila);
	factura.detalle.splice(index_fila,1);
    restar_totales_venta(precio_total);
}

const restar_totales_venta = precio_total => {

	let subtotal = parseFloat(subtotal_venta.innerHTML);
	subtotal = (subtotal - precio_total).toFixed(3);
	iva = calcular_iva(subtotal);
	total = calcular_total(subtotal,iva);
	ver_totales_venta(subtotal,iva,total);

	factura.subtotal = subtotal;
	factura.iva = iva;
	factura.total = total;
}

const agregar_total = (e) => {
	let fila = e.path[2].rowIndex;
	let index_fila = fila - 1;
	let cantidad = e.target.value;
	let stock =  parseInt(e.path[2].cells[3].innerHTML);

	if(cantidad == '' || cantidad > stock ){
		e.path[2].cells[6].innerHTML = '0.000';
	}else{

		let precio = parseFloat(e.path[2].cells[5].innerHTML);
	    let precio_total = parseFloat(cantidad) * precio;
	    e.path[2].cells[6].innerHTML = precio_total.toFixed(3);

	    factura.detalle[index_fila].cantidad = cantidad;
	    factura.detalle[index_fila].precio = precio_total.toFixed(3);
	}

	sumar_totales();

}

const sumar_totales = () => {
	let detalle = tbl_datos_detalle;
	let precio_total = 0.00;

	for (var i = 0; i < detalle.rows.length; i++) {
		precio_total = precio_total + parseFloat(detalle.rows[i].cells[6].innerHTML);
	}

	subtotal = precio_total.toFixed(3);
	iva = calcular_iva(subtotal);
	total = calcular_total(subtotal,iva);

	factura.subtotal = subtotal;
	factura.iva = iva;
	factura.total = total;

	ver_totales_venta(subtotal,iva,total);
}

const agregar_factura = (articulo,cantidad,precio,subtotal,iva,total) => {

	factura.detalle.push({articulo:articulo,cantidad:cantidad,precio:precio});
	factura.subtotal = subtotal;
	factura.iva = iva;
	factura.total = total;
}

const verificar_venta = e => {
	e.preventDefault();
	if(ruc_cliente.value == ""){
		alertify.alert("Verificar","Escriba el Ruc del Cliente");
	}else if(nombre_cliente.value == ""){
		alertify.alert("Verificar","Escriba el Nombre del Cliente");
	}else if(apellido_cliente.value == ""){
		alertify.alert("Verificar","Escriba el Apellido del Cliente");
	}else if(direccion_cliente.value == ""){
		alertify.alert("Verificar","Escriba la Direccion del Cliente");
	}else if(correo_cliente.value == ""){
		alertify.alert("Verificar","Escriba la Direccion del Cliente");
	}else if(celular_cliente.value == ""){
		alertify.alert("Verificar","Escriba la Direccion del Cliente");
	}else if(tbl_datos_detalle.rows.length == 0 ){
		alertify.alert("Verificar","Agregar al Menos un Articulo al Detalle");
	}else {
		confirmar_venta();
	}
}

function confirmar_venta(){
	alertify.confirm('Confirmar',"Registrar la Nueva Venta ?",
		function(){
			registrar_venta();
		},
		function(){
		}
		);

}


const registrar_venta = () => {
	listado=document.getElementById('cmblistado');
	datos=verificartabla();
	datos.map(x=>{ 
		
		listado.innerHTML+=`<option value="${x.codigo}">
		${x.nombre}
		${x.descripcion}
		${x.cantidad}
		</option> `
	})

	let url = '../controladores/exzequial/registrar_venta.php';

	factura.cliente.rucci = ruc_cliente.value;
	factura.cliente.nombre = nombre_cliente.value;
	factura.cliente.apellido = apellido_cliente.value;
	factura.cliente.direccion = direccion_cliente.value;
	factura.cliente.correo = correo_cliente.value;
	factura.cliente.celular = celular_cliente.value;
	factura.numero = numero_venta.value;
	factura.fecha = fecha_venta.value;
	let data = new FormData();
	data.append('factura',JSON.stringify(factura));

	http(url,'POST',data)
	    .then(res => {
	    	if(res.res){

	    		    alertify.alert('Verificar',res.mensaje);
	    		    ruc_cliente.disabled =true;
                    nombre_cliente.disabled =true;
                    apellido_cliente.disabled =true;
                    direccion_cliente.disabled =true;
                    correo_cliente.disabled =true;
                    celular_cliente.disabled =true;
                    btn_articulos.disabled =true;
                    btn_registrar_venta.disabled =true;
                    document.getElementById('liPaso2').className = "active";
                    document.getElementById('liPaso1').className = "";

                    document.getElementById('paso2').className = "tab-pane fade active in";
                    document.getElementById('paso1').className = "tab-pane fade";
                    btn_paso2.href="#paso2";
                    cedula_tenedor.value = ruc_cliente.value;
                    primer_nombre.value = nombre_cliente.value;
                    apellido_paterno.value = apellido_cliente.value;
                    correo_tenedor.value = correo_cliente.value;
                    celular_tenedor.value = celular_cliente.value;

                    

	                for (var i = 0; i < factura.detalle.length; i++) {

	    	             min_formularios =  parseInt(min_formularios) + parseInt(factura.detalle[i].cantidad);
	                }

	                document.getElementById('numero-mascotas').innerHTML = min_formularios;

	    	}

	    })
	    
}


const buscar_tenedor = e => {

    let url = '../controladores/procesar/buscar_tenedor.php';
	let cedula= e.target.value;
    const data = new FormData();
    data.append('cedula',cedula);

	http(url,'POST',data)
	    .then(res => {
	    	if(res.res){

	    		primer_nombre.value = res.tenedor.primer_nombre;
	    		segundo_nombre.value = res.tenedor.segundo_nombre;
	    		apellido_paterno.value = res.tenedor.apellido_paterno;
	    		apellido_materno.value = res.tenedor.apellido_materno;
	    		fecha_tenedor.value = res.tenedor.fecha;
	    		correo_tenedor.value = res.tenedor.correo;
	    		celular_tenedor.value = res.tenedor.celular;

	    		provincia_tenedor.value = res.tenedor.provincia;

	    		res.cantones.map(canton => {
		    		let opcion = document.createElement('option');
	    		    opcion.value = canton.id;
	    		    opcion.label = canton.nombre;
	    		    canton_tenedor.appendChild(opcion);
		    	})

		    	canton_tenedor.value = res.tenedor.canton;

		    	res.parroquias.map(parroquia => {
		    		let opcion = document.createElement('option');
	    		    opcion.value = parroquia.id;
	    		    opcion.label = parroquia.nombre;
	    		    parroquia_tenedor.appendChild(opcion);
		    	})

		    	parroquia_tenedor.value = res.tenedor.parroquia;

	    		calle_principal.value = res.tenedor.calle_principal;
	    		calle_secundaria.value = res.tenedor.calle_secundaria;
	    		barrio_tenedor.value = res.tenedor.barrio;
	    		numero_casa.value = res.tenedor.numero_casa;
	    		referencia_casa.value = res.tenedor.referencia_casa;

	    	}else{

	    		primer_nombre.value = '';
	    		segundo_nombre.value = '';
	    		apellido_paterno.value = '';
	    		apellido_materno.value = '';
	    		fecha_tenedor.value = '';
	    		correo_tenedor.value = 	'';
	    		celular_tenedor.value = ''; 		
	    		calle_principal.value = '';
	    		calle_secundaria.value = '';
	    		barrio_tenedor.value = 	'';
	    		numero_casa.value =  '';   		
	    		referencia_casa.value = '';
	    		provincia_tenedor.value = '0';
	    		canton_tenedor.value = '0';
	    		parroquia_tenedor.value = '0';


	    	}
	    });
}

const verificar_proceso = e =>{
	e.preventDefault();
	buscar=$('#txt-buscar').val();
	fecha=$('#txtfecha').val();
	//fechafin=$('#txtfecha-fin').val();
	if (!buscar) {
		alertify.error("Debe Colocar el numero de la mascota");
	}else if (!fecha) {
		alertify.error("Debe Colocar la fecha de hoy");
	
	} else{

	confirmar();
	
}

}



function confirmar(){
	alertify.confirm('Aviso',"Registrar ?",
		function(){
			guardar();
		},
		function(){
		}
		);
}


function guardar() {
	
	variable=document.getElementById("frmProceso");
	//console.log(variable);
	datosq=new FormData(variable);


	$.ajax({
		url:'../controladores/exzequial/crear.php' ,
		type:'POST' ,
		data:datosq ,
		contentType: false,
        processData: false,

	})
	
	.done(function(r) {
		//console.log(r);
		if (r==1) {
			alertify.success("Registro de exzequial Exitosa");
			setTimeout(function() {
				window.location.href="../app/exzequial.php";
			}, 1000);
		}else{
			alertify.error("No se pudo Regisrar el exzequial");
		}
	})
	
}


btn_registrar_venta.addEventListener("click",verificar_venta);
ruc_cliente.addEventListener("keyup",buscar_cliente);
btn_articulos.addEventListener("click",listar_articulos);
//cedula_tenedor.addEventListener("keyup",buscar_tenedor);
btn_registrar_proceso.addEventListener('click',verificar_proceso);

//btnverificartabla.addEventListener("click",verificartabla);

