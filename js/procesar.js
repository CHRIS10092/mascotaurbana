const btn_paso1 = document.getElementById('btnPaso1');
const btn_paso2 = document.getElementById('btnPaso2');
const btn_paso3 = document.getElementById('btnPaso3');

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


const cedula_tenedor = document.getElementById('txtCedulaTenedor');
const fecha_tenedor = document.getElementById('txtFechaTenedor');
const primer_nombre = document.getElementById('txtPrimerNombre');
const segundo_nombre = document.getElementById('txtSegundoNombre');
const apellido_paterno = document.getElementById('txtApellidoPaterno');
const apellido_materno = document.getElementById('txtApellidoMaterno');
const correo_tenedor = document.getElementById('txtCorreoTenedor');
const celular_tenedor = document.getElementById('txtCelularTenedor');
const provincia_tenedor = document.getElementById('cmbProvinciaTenedor');
const canton_tenedor = document.getElementById('cmbCantonTenedor');
const parroquia_tenedor = document.getElementById('cmbParroquiaTenedor');

const barrio_tenedor = document.getElementById('txtBarrioTenedor');
const calle_principal = document.getElementById('txtCallePrincipal');
const calle_secundaria = document.getElementById('txtCalleSecundaria');
const numero_casa = document.getElementById('txtNumeroCasa');
const referencia_casa = document.getElementById('txtReferenciaCasa');

const numero_mascotas = document.getElementById('txtNumeroMascotas');
const datos_mascotas = document.getElementById('datos-mascotas');
const btn_registrar_proceso = document.getElementById('btnRegistrarProceso');
const frm_proceso = document.getElementById('frmProceso');

const proceso = {
	tenedor: {},
	mascotas:[]
};


const http = async (url,metodo,data) => {

	const response = await fetch(url,{method:metodo,body:data});

	return await response.json(); 

}

const listar_provincias = () => {
	let url = '../controladores/procesar/listar_provincias.php';
	http(url,'POST',null)
	    .then(res => {
	    	res.map(provincia => {
	    		let opcion = document.createElement('option');
	    		opcion.value = provincia.id;
	    		opcion.label = provincia.nombre;
	    		provincia_tenedor.appendChild(opcion);
	    	})
	    })
}


(()=>{

	let url = '../controladores/procesar/obtener_numero_venta.php';
	http(url,'POST',null)
	    .then(res => {
	    	numero_venta.style.color = 'red';
	    	numero_venta.style.fontWeight = 'bold';
	    	numero_venta.value = res;
	    })
	listar_provincias();

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
	let url = '../controladores/procesar/listar_articulos.php';
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

const verificar_venta = () => {
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
	let url = '../controladores/procesar/registrar_venta.php';

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
                    document.getElementById('liPaso2').className = "";
                    document.getElementById('liPaso3').className = "";
                    btn_paso2.href="#paso2";
                    btn_paso3.href="#paso3";
                    cedula_tenedor.value = ruc_cliente.value;
                    primer_nombre.value = nombre_cliente.value;
                    apellido_paterno.value = apellido_cliente.value;
                    correo_tenedor.value = correo_cliente.value;
                    celular_tenedor.value = celular_cliente.value;

                    let min_formularios = 0;

	                for (var i = 0; i < factura.detalle.length; i++) {

	    	             min_formularios =  parseInt(min_formularios) + parseInt(factura.detalle[i].cantidad);
	                }

	                numero_mascotas.setAttribute('max',min_formularios);
	    	}

	    })
	    
}

const listar_cantones = e => {
	let idprovincia = e.target.value;
    let url = '../controladores/procesar/listar_cantones.php';
    canton_tenedor.innerHTML='';
    parroquia_tenedor.innerHTML = '';
	if(idprovincia > 0){
		let data = new FormData();
		data.append('id',idprovincia);
		http(url,'POST',data)
		    .then(res => {
		    	crear_opcion_seleccionar(canton_tenedor);
		    	res.map(canton => {
		    		let opcion = document.createElement('option');
	    		    opcion.value = canton.id;
	    		    opcion.label = canton.nombre;
	    		    canton_tenedor.appendChild(opcion);
		    	})
		    })
		crear_opcion_seleccionar(parroquia_tenedor);
	}else{

		crear_opcion_seleccionar(canton_tenedor);
	    crear_opcion_seleccionar(parroquia_tenedor);
	}
}


const listar_parroquias = e => {
	let idcanton = e.target.value;
    let url = '../controladores/procesar/listar_parroquias.php';
    parroquia_tenedor.innerHTML='';
	if(idcanton > 0){
		let data = new FormData();
		data.append('id',idcanton);
		http(url,'POST',data)
		    .then(res => {
		    	res.map(parroquia => {
		    		let opcion = document.createElement('option');
	    		    opcion.value = parroquia.id;
	    		    opcion.label = parroquia.nombre;
	    		    parroquia_tenedor.appendChild(opcion);
		    	})
		    })
	}else{

		crear_opcion_seleccionar(parroquia_tenedor);
	}
}

const crear_opcion_seleccionar = cmb => {

	let opcion = document.createElement('option');
	    opcion.value = 0;
	    opcion.label = '--seleccionar--';
	    cmb.appendChild(opcion);

}

const crear_formulario_mascota = e => {
	cantidad = e.target.value;
	if(cantidad != 0){
		btn_registrar_proceso.disabled = false;
		datos_mascotas.innerHTML = '';
        for (let i = 0; i < cantidad; i++) {

        	let div_row_content = document.createElement('div');
        	div_row_content.className = "row";

        	let div_col_content1 = document.createElement('div');
        	div_col_content1.className = "col-md-9";

        	let div_col_content2 = document.createElement('div');
        	div_col_content2.className = "col-md-3";



        	let div_row1 = document.createElement('div');
	        div_row1.className = "row";

	        let div_row2 = document.createElement('div');
	        div_row2.className = "row";

	        let div_row3 = document.createElement('div');
	        div_row3.className = "row";

	        let label_codigo = document.createElement('label');
	        label_codigo.className = 'col-md-1';
	        label_codigo.innerText = 'Codigo:';

	        let div_col_codigo = document.createElement('div');
	        div_col_codigo.className = "col-md-3";


	        let input_codigo = document.createElement('input');
	        input_codigo.className = 'form-control';
	        input_codigo.id = 'codigo'+ (i+1);

	        let label_nombre = document.createElement('label');
	        label_nombre.className = 'col-md-1';
	        label_nombre.innerText = 'Nombre:';

	        let div_col_nombre = document.createElement('div');
	        div_col_nombre.className = "col-md-3";


	        let input_nombre = document.createElement('input');
	        input_nombre.className = 'form-control';
	        input_nombre.id = 'nombre' + (i+1);

	        let label_fecha = document.createElement('label');
	        label_fecha.className = 'col-md-1';
	        label_fecha.innerText = 'Fecha.Nac:';

	        let div_col_fecha = document.createElement('div');
	        div_col_fecha.className = "col-md-3";


	        let input_fecha = document.createElement('input');
	        input_fecha.className = 'form-control';
	        input_fecha.type = 'date';
	        input_fecha.id = 'fecha' + (i+1);

	        let label_color1 = document.createElement('label');
	        label_color1.className = 'col-md-1';
	        label_color1.innerText = 'Color 1:';

	        let div_col_color1 = document.createElement('div');
	        div_col_color1.className = "col-md-3";


	        let input_color1 = document.createElement('input');
	        input_color1.className = 'form-control';
	        input_color1.id = 'color1' + (i+1);

	        let label_color2 = document.createElement('label');
	        label_color2.className = 'col-md-1';
	        label_color2.innerText = 'Color 2:';

	        let div_col_color2 = document.createElement('div');
	        div_col_color2.className = "col-md-3";


	        let input_color2 = document.createElement('input');
	        input_color2.className = 'form-control';
	        input_color2.id = 'color2' + (i+1);

	        let label_sexo = document.createElement('label');
	        label_sexo.className = 'col-md-1';
	        label_sexo.innerText = 'Sexo:';

	        let div_col_sexo= document.createElement('div');
	        div_col_sexo.className = "col-md-3";


	        let select_sexo = document.createElement('select');
	        select_sexo.className = 'form-control';
	        select_sexo.id = 'sexo' + (i+1);
	        let opcion_sexo1 = document.createElement('option');
	        opcion_sexo1.label = '--seleccionar--';
	        opcion_sexo1.value = 0;
	        select_sexo.appendChild(opcion_sexo1);

	        let opcion_sexo2 = document.createElement('option');
	        opcion_sexo2.label = 'Macho';
	        opcion_sexo2.value = 'Macho';
	        select_sexo.appendChild(opcion_sexo2);

	        let opcion_sexo3 = document.createElement('option');
	        opcion_sexo3.label = 'Hembra';
	        opcion_sexo3.value = 'Hembra';
	        select_sexo.appendChild(opcion_sexo3);


	        let label_esterilizado = document.createElement('label');
	        label_esterilizado.className = 'col-md-1';
	        label_esterilizado.innerText = 'Esterilizado:';

	        let div_col_esterilizado= document.createElement('div');
	        div_col_esterilizado.className = "col-md-3";


	        let select_esterilizado = document.createElement('select');
	        select_esterilizado.className = 'form-control';
	        select_esterilizado.id = "esterilizado" + (i+1);
	        let opcion_esterilizado1 = document.createElement('option');
	        opcion_esterilizado1.label = '--seleccionar--';
	        opcion_esterilizado1.value = 0;
	        select_esterilizado.appendChild(opcion_esterilizado1);

	        let opcion_esterilizado2 = document.createElement('option');
	        opcion_esterilizado2.label = 'Si';
	        opcion_esterilizado2.value = 'No';
	        select_esterilizado.appendChild(opcion_esterilizado2);

	        let opcion_esterilizado3 = document.createElement('option');
	        opcion_esterilizado3.label = 'No';
	        opcion_esterilizado3.value = 'No';
	        select_esterilizado.appendChild(opcion_esterilizado3);

	        let label_tipo = document.createElement('label');
	        label_tipo.className = 'col-md-1';
	        label_tipo.innerText = 'Tip.Mascota:';

	        let div_col_tipo= document.createElement('div');
	        div_col_tipo.className = "col-md-3";


	        let select_tipo = document.createElement('select');
	        select_tipo.className = 'form-control';
	        select_tipo.id = 'tipo' + (i+1);
	        select_tipo.onchange = (e) =>listar_razas(e,(i+1));


	        let opcion_tipo1 = document.createElement('option');
	        opcion_tipo1.label = '--seleccionar--';
	        opcion_tipo1.value = 0;
	        select_tipo.appendChild(opcion_tipo1);

	        let url1 = '../controladores/procesar/listar_tipos.php';

	        http(url1,'POST',null)
	            .then(res => {
	            	res.map(tipo => {
	            		let opcion_tipo2 = document.createElement('option');
	                        opcion_tipo2.label = tipo.nombre;
	                        opcion_tipo2.value = tipo.id;
	                        select_tipo.appendChild(opcion_tipo2);
	            	})
	            })


	        let label_raza = document.createElement('label');
	        label_raza.className = 'col-md-1';
	        label_raza.innerText = 'Razas:';

	        let div_col_raza= document.createElement('div');
	        div_col_raza.className = "col-md-3";


	        let select_raza = document.createElement('select');
	        select_raza.className = 'form-control';
	        select_raza.id = 'raza' + (i+1);
	        let opcion_raza1 = document.createElement('option');
	        opcion_raza1.label = '--seleccionar--';
	        opcion_raza1.value = 0;
	        select_raza.appendChild(opcion_raza1);

	        div_col_codigo.appendChild(input_codigo);
	        div_row1.appendChild(label_codigo);
	        div_row1.appendChild(div_col_codigo);

	        div_col_nombre.appendChild(input_nombre);
	        div_row1.appendChild(label_nombre);
	        div_row1.appendChild(div_col_nombre);

	        div_col_fecha.appendChild(input_fecha);
	        div_row1.appendChild(label_fecha);
	        div_row1.appendChild(div_col_fecha);

	        div_col_color1.appendChild(input_color1);
	        div_row2.appendChild(label_color1);
	        div_row2.appendChild(div_col_color1);

	        div_col_color2.appendChild(input_color2);
	        div_row2.appendChild(label_color2);
	        div_row2.appendChild(div_col_color2);

	        div_col_sexo.appendChild(select_sexo);
	        div_row2.appendChild(label_sexo);
	        div_row2.appendChild(div_col_sexo);

	        div_col_esterilizado.appendChild(select_esterilizado);
	        div_row3.appendChild(label_esterilizado);
	        div_row3.appendChild(div_col_esterilizado);

	        div_col_tipo.appendChild(select_tipo);
	        div_row3.appendChild(label_tipo);
	        div_row3.appendChild(div_col_tipo);

	        div_col_raza.appendChild(select_raza);
	        div_row3.appendChild(label_raza);
	        div_row3.appendChild(div_col_raza);

	        let espacio = document.createElement('hr');

	        div_col_content1.appendChild(div_row1);
	        div_col_content1.appendChild(div_row2);
	        div_col_content1.appendChild(div_row3);

	        let input_imagen = document.createElement('input');
	        input_imagen.type = 'file';
	        input_imagen.name = 'imagen-mascota' + (i+1);
	        input_imagen.id = 'imagen_mascota' + (i+1);
	        input_imagen.onchange = (e) => cargar_img_mascota(e,(i+1));

	        let preview_mascota = document.createElement('div');
	        preview_mascota.id='previewMascota'+(i+1);
	        div_col_content2.appendChild(input_imagen);
	        div_col_content2.appendChild(preview_mascota);


	        div_row_content.appendChild(div_col_content1);
	        div_row_content.appendChild(div_col_content2);

	        /*datos_mascotas.appendChild(div_row1);
	        datos_mascotas.appendChild(div_row2);
	        datos_mascotas.appendChild(div_row3);*/
	        datos_mascotas.appendChild(div_row_content);

	        datos_mascotas.appendChild(espacio);
        }
		
	}
	
}

const cargar_img_mascota = (e,i) =>{
	// Creamos el objeto de la clase FileReader
  let reader = new FileReader();

  // Leemos el archivo subido y se lo pasamos a nuestro fileReader
  reader.readAsDataURL(e.target.files[0]);

  // Le decimos que cuando este listo ejecute el código interno
  reader.onload = function(){
    let preview = document.getElementById('previewMascota'+i);
    let image = document.createElement('img');

    image.src = reader.result;
    image.width = "200";
        image.height = "200";
    

    preview.innerHTML = '';
    preview.append(image);
  };
}

const listar_razas = (e,i) => {
    let idtipo = e.target.value;

    let url = '../controladores/procesar/listar_razas.php';
   document.getElementById("raza"+i).innerHTML='';
	if(idtipo > 0){
		let data = new FormData();
		data.append('id',idtipo);
		http(url,'POST',data)
		    .then(res => {
		    	res.map(raza => {
		    		let opcion = document.createElement('option');
	    		    opcion.value = raza.id;
	    		    opcion.label = raza.nombre;
	    		    document.getElementById("raza"+i).appendChild(opcion);
		    	})
		    })
	}else{
        let cmb_raza = document.getElementById("raza"+i);
		crear_opcion_seleccionar(cmb_raza);
	}
	
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


const control_mascotas = () => {
	let mensaje = "";

	let mascota = {
		res:true,
		mensaje:""
	}

	for (let i = 1; i <= numero_mascotas.value; i++) {

		let codigo_mascota = document.getElementById('codigo'+i);
		let nombre_mascota = document.getElementById('nombre'+i);
		let fecha_mascota = document.getElementById('fecha'+i);
		let color1_mascota = document.getElementById('color1'+i);
		let color2_mascota = document.getElementById('color2'+i);

		let sexo_mascota = document.getElementById('sexo'+i);
		let esterilizado_mascota = document.getElementById('esterilizado'+i);
		let tipo_mascota = document.getElementById('tipo'+i);
		let raza_mascota = document.getElementById('raza'+i);

		let imagen_mascota = document.getElementById('imagen_mascota'+i);

		if(codigo_mascota.value == ""){
			mensaje +="Escriba el Codigo de la Mascota"+i+"<br>";
			mascota.res = false;
		}if(nombre_mascota.value == ""){
			mensaje +="Escriba el Nombre de la Mascota"+i+"<br>";
			mascota.res = false;
		}if(fecha_mascota.value == ""){
			mensaje +="Seleccionar la Fecha de Nacimiento de la Mascota"+i+"<br>";
			mascota.res = false;
		}if(color1_mascota.value == ""){
			mensaje +="Escriba el Color 1 de la Mascota"+i+"<br>";
			mascota.res = false;
		}if(color2_mascota.value == ""){
			mensaje +="Escriba el Color 2 de la Mascota"+i+"<br>";
			mascota.res = false;
		}if(sexo_mascota.value == "0"){
			mensaje +="Seleccionar Sexo de la Mascota"+i+"<br>";
			mascota.res = false;
		}if(esterilizado_mascota.value == "0"){
			mensaje +="Mascota Esterilizada ?"+i+"<br>";
			mascota.res = false;
		}if(tipo_mascota.value == "0"){
			mensaje +="Seleccionar Tipo de Mascota"+i+"<br>";
			mascota.res = false;
		}if(raza_mascota.value == "0"){
			mensaje +="Seleccionar Raza de la Mascota"+i+"<br>";
			mascota.res = false;
		}if(imagen_mascota.value == ""){
			mensaje +="Agregar Imagen de la Mascota"+i+"<br>";
			mascota.res = false;
		}
	}

	mascota.mensaje = mensaje
	return mascota;
}

const verificar_proceso = e => {
	e.preventDefault();
	let mascota = control_mascotas();
	if(!mascota.res){
		alertify.alert('Verificar',mascota.mensaje);
	}else{
		confirmar_proceso();
	}
}

function confirmar_proceso(){
	alertify.confirm('Confirmar',"Registrar el Proceso ?",
		function(){
			registrar_proceso();
		},
		function(){
		}
		);

}

const agregar_mascotas = () => {
	proceso.mascotas = [];
	for (let i = 1; i <= numero_mascotas.value; i++) {

		let codigo_mascota = document.getElementById('codigo'+i);
		let nombre_mascota = document.getElementById('nombre'+i);
		let fecha_mascota = document.getElementById('fecha'+i);
		let color1_mascota = document.getElementById('color1'+i);
		let color2_mascota = document.getElementById('color2'+i);

		let sexo_mascota = document.getElementById('sexo'+i);
		let esterilizado_mascota = document.getElementById('esterilizado'+i);
		let tipo_mascota = document.getElementById('tipo'+i);
		let raza_mascota = document.getElementById('raza'+i);

		proceso.mascotas.push({
			codigo:codigo_mascota.value,
			nombre:nombre_mascota.value,
			fecha:fecha_mascota.value,
			color1:color1_mascota.value,
			color2:color2_mascota.value,
			sexo:sexo_mascota.value,
			esterilizado:esterilizado_mascota.value,
			tipo:tipo_mascota.value,
			raza:raza_mascota.value
		});
	}
}

const registrar_proceso = () => {
	
	let url = '../controladores/procesar/registrar_proceso.php';
	proceso.tenedor.cedula = cedula_tenedor.value;
	proceso.tenedor.primer_nombre = primer_nombre.value;
	proceso.tenedor.segundo_nombre = segundo_nombre.value;
	proceso.tenedor.apellido_paterno = apellido_paterno.value;
	proceso.tenedor.apellido_materno = apellido_materno.value;

	proceso.tenedor.fecha = fecha_tenedor.value;
	proceso.tenedor.correo = correo_tenedor.value;
	proceso.tenedor.celular = celular_tenedor.value;

	proceso.tenedor.provincia = provincia_tenedor.value;
	proceso.tenedor.canton = canton_tenedor.value;
	proceso.tenedor.parroquia = parroquia_tenedor.value;

	proceso.tenedor.barrio = barrio_tenedor.value;
	proceso.tenedor.calle_principal = calle_principal.value;
	proceso.tenedor.calle_secundaria = calle_secundaria.value;

	proceso.tenedor.numero_casa = numero_casa.value;
	proceso.tenedor.referencia_casa = referencia_casa.value;

	agregar_mascotas();

	let data = new FormData(frm_proceso);
	data.append('proceso',JSON.stringify(proceso));
	http(url,'POST',data)
	    .then(res => {
	    	if(res.res){
	    		alertify.alert("Error",res.mensaje);
	    	}else{
	    		alertify.alert("Alerta",res.mensaje);
	    		setTimeout(function(){
	    			window.location.href='http://localhost/mascotaurbana/app/procesar.php';
	    		},1000);

	    	}
	    })
}


document.getElementById("txtImgenTenedor").onchange = function(e) {
  // Creamos el objeto de la clase FileReader
  let reader = new FileReader();

  // Leemos el archivo subido y se lo pasamos a nuestro fileReader
  reader.readAsDataURL(e.target.files[0]);

  // Le decimos que cuando este listo ejecute el código interno
  reader.onload = function(){
    let preview = document.getElementById('previewTenedor'),
            image = document.createElement('img');

    image.src = reader.result;
    image.width = "200";
        image.height = "200";
    

    preview.innerHTML = '';
    preview.append(image);
  };
}




btn_registrar_venta.addEventListener("click",verificar_venta);
ruc_cliente.addEventListener("keyup",buscar_cliente);
btn_articulos.addEventListener("click",listar_articulos);
cmbProvinciaTenedor.addEventListener("change",listar_cantones);
cmbCantonTenedor.addEventListener("change",listar_parroquias);
numero_mascotas.addEventListener("change",crear_formulario_mascota);
cedula_tenedor.addEventListener("keyup",buscar_tenedor);
btn_registrar_proceso.addEventListener("click",verificar_proceso);



