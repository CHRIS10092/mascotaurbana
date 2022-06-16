



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

//mascota 
const codigo_mascota = document.getElementById('txtCodigoMascota');
const fecha_mascota = document.getElementById('txtFechaMascota');
const nombre_mascota = document.getElementById('txtNombreMascota');
const color1_mascota = document.getElementById('txtColor1Mascota');
const color2_mascota = document.getElementById('txtColor2Mascota');
const sexo_mascota = document.getElementById('cmbSexoMascota');
const esterilizado_mascota = document.getElementById('cmbEsterilizadoMascota');
const tipo_mascota = document.getElementById('cmbTipoMascota');
const raza_mascota = document.getElementById('cmbRazaMascota');


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


const listar_tipo = () => {
	let url = '../controladores/procesar/listar_tipos.php';
	http(url,'POST',null)
	    .then(res => {
	    	res.map(tipo => {
	    		let opcion = document.createElement('option');
	    		opcion.value = tipo.id;
	    		opcion.label = tipo.nombre;
	    		tipo_mascota.appendChild(opcion);
	    	})
	    })
}


(()=>{

	
	listar_provincias();
	listar_tipo();

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


const listar_razas = e => {
    let idtipo = e.target.value;

    let url = '../controladores/procesar/listar_razas.php';
   raza_mascota.innerHTML='';
	if(idtipo > 0){
		let data = new FormData();
		data.append('id',idtipo);
		http(url,'POST',data)
		    .then(res => {
		    	res.map(raza => {
		    		let opcion = document.createElement('option');
	    		    opcion.value = raza.id;
	    		    opcion.label = raza.nombre;
	    		    raza_mascota.appendChild(opcion);
		    	})
		    })
	}else{
        let cmb_raza = raza_mascota;
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

const verificar_proceso = e =>{
	e.preventDefault();

	if($('#cmbChips').val() == ''){
		alertify.alert("Verificar","Seleccione un chip a la mascota");
	}else if(codigo_mascota.value == ''){
		alertify.alert("Verificar","Escriba el Codigo de la Mascota");
	}else if(codigo_mascota.value.length < 15){
		alertify.alert("Verificar","el codigo  de la Mascota debe constar de 15 numeros");
	}else if(primer_nombre.value == ''){
		alertify.alert("Verificar","Seleccione el primer nombre del tenedor");

	}else if(segundo_nombre.value == ''){
		alertify.alert("Verificar","Seleccione el segundo_nombre del Tenedor");

	}else if(apellido_paterno.value == ''){	
		alertify.alert("Verificar","Seleccione el apellido paterno del Tenedor");

	}else if(apellido_materno.value == ''){
		alertify.alert("Verificar","Seleccione el apellido materno del Tenedor");

	}else if(fecha_tenedor.value == ''){
		alertify.alert("Verificar","Seleccione la fecha del Tenedor");
	}else if(correo_tenedor.value == ''){
		alertify.alert("Verificar","Seleccione el Correo del Tenedor");

	}else if(celular_tenedor.value == ''){
		alertify.alert("Verificar","Seleccione el Celular del Tenedor");

	}else if(calle_principal.value == ''){
		alertify.alert("Verificar","Seleccione la calle principal del Tenedor");
	}else if(calle_secundaria.value == ''){
		alertify.alert("Verificar","Seleccione la calle secundaria del Tenedor");
	}else if(barrio_tenedor.value == ''){
		alertify.alert("Verificar","Seleccione el barrio del Tenedor");
	}else if(provincia_tenedor.value =='0'){
		alertify.alert("Verificar","Seleccione la provincia del Tenedor");
	}else if(canton_tenedor.value == '0'){
		alertify.alert("Verificar","Seleccione el canton del Tenedor");
	}else if(parroquia_tenedor.value == '0'){
		alertify.alert("Verificar","Seleccione la parroquia del Tenedor");
	}else if(numero_casa.value == ''){
		alertify.alert("Verificar","Seleccione el numero de casa del Tenedor");
	}else if(referencia_casa.value == ''){
		alertify.alert("Verificar","Seleccione la referencia de casa del Tenedor");
	}else if(fecha_mascota.value == ''){
		alertify.alert("Verificar","Fecha de Nacimiento de la Mascota");

	}else if(nombre_mascota.value == ''){
		alertify.alert("Verificar","Escriba el Nombre de la Mascota");


	}else if(color1_mascota.value == ''){
		alertify.alert("Verificar","Escriba el Color 1  de la Mascota");


	}else if(color2_mascota.value == ''){
		alertify.alert("Verificar","Escriba el Color 2 de la Mascota");


	}else if(sexo_mascota.value == '0'){
		alertify.alert("Verificar","Seleccione Sexo de la Mascota");


	}else if(esterilizado_mascota.value == '0'){
		alertify.alert("Verificar","La Mascota esta Esterilizada ?");


	}else if(tipo_mascota.value == '0'){
		alertify.alert("Verificar","Seleccione el Tipo de la Mascota");


	}else if(raza_mascota.value == '0'){
		alertify.alert("Verificar","Seleccione la Raza de la Mascota");

	
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
    // mascota
	proceso.mascota.codigo = codigo_mascota.value;
	proceso.mascota.nombre = nombre_mascota.value;
	proceso.mascota.color1 = color1_mascota.value;
	proceso.mascota.fecha = fecha_mascota.value;
	proceso.mascota.sexo = sexo_mascota.value;
	proceso.mascota.tipo = tipo_mascota.value;
	proceso.mascota.esterilizado = esterilizado_mascota.value;
	proceso.mascota.raza = raza_mascota.value;
	proceso.mascota.color2 = color2_mascota.value;
	proceso.mascota.chip = $('#cmbChips').val();
    
	idv= $('#idv').val()

	let detallevds = document.getElementById('detalleChips').value;
	

	
		let arrChip = JSON.parse(detallevds)
		
        arrChip.map(x =>{
        	if(x.id == $("#cmbChips").val()){
        		x.state = 'active'
        	}
        	
        })

        let arrnu = arrChip.filter(x =>{
        	return x.state == 'inactive'
        })
	

	let detallev =JSON.stringify(arrChip)

	estadov='P'
	if(arrnu.length == 0){
		estadov = 'E'
	}

	let data = new FormData(frm_proceso);
	data.append('proceso',JSON.stringify(proceso));
	http(url,'POST',data)
	    .then(res => {
	    	if(res.res){
	    		alertify.alert("Error",res.mensaje);
	    	}else{
	    		alertify.alert("Alerta",res.mensaje);
                  ventaUpdate(estadov,detallev,idv)
	    		setTimeout(function(){
          		window.location.href="../app/EntregaChips.php";
        		},1000);

	    		codigo_mascota.value = "";
	            nombre_mascota.value = "";
	            color1_mascota.value = "";
	            fecha_mascota.value = "";
	            sexo_mascota.value = "0";
	            tipo_mascota.value = "0";
	            esterilizado_mascota.value = "0";
	            raza_mascota.value = "0";
	            color2_mascota.value = "";
	            document.getElementById("txtImagenMascota").value = "";
	            document.getElementById('preview-mascota').innerHTML = "";
	            document.getElementById("txtImgenTenedor").value = "";
	            document.getElementById('previewTenedor').innerHTML = "";
	            

	    	}
	    })
    
}

function ventaUpdate(estado,detalle,id){
	let fd = new FormData();
	fd.append('estado',estado)
	fd.append('detalle',detalle)
	fd.append('id',id)
	fetch(`../controladores/venta/UpdateVenta.php`,{
		method:"POST",
		body:fd
	})
	    .then(res => res.text())
	    .then(res =>{
	    	
	    	console.log(res)
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
    image.width = "150";
        image.height = "150";
    

    preview.innerHTML = '';
    preview.append(image);
  };
}


document.getElementById("txtImagenMascota").onchange = function(e) {
  // Creamos el objeto de la clase FileReader
  let reader = new FileReader();

  // Leemos el archivo subido y se lo pasamos a nuestro fileReader
  reader.readAsDataURL(e.target.files[0]);

  // Le decimos que cuando este listo ejecute el código interno
  reader.onload = function(){
    let preview = document.getElementById('preview-mascota'),
            image = document.createElement('img');

    image.src = reader.result;
    image.width = "150";
        image.height = "150";
    

    preview.innerHTML = '';
    preview.append(image);
  };
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


function cargarChips(){
	
	let cmb = document.getElementById('cmbChips')
	let detalle = document.getElementById('detalleChips').value;
	let opcion = `<option value="">Seleccione</option>`

	if(detalle){
		let arrChip = JSON.parse(detalle)
		let nuevarr = arrChip.filter(x => {
			return x.state == 'inactive'
		})
        nuevarr.map(x =>{
        	opcion+=`<option value="${x.id}">Registro ${x.id}</option>`
        })
	}
	cmb.innerHTML = opcion
	

}
function traerchips(){
	fetch(`../controladores/venta/chipsaleatorio.php`)
	.then(async res => await res.text())
	.then(res=>{
		$('#txtCodigoMascota').val(res)
	})
}
document.addEventListener("DOMContentLoaded", function () {
cmbProvinciaTenedor.addEventListener("change",listar_cantones);
cmbCantonTenedor.addEventListener("change",listar_parroquias);
cedula_tenedor.addEventListener("keyup",buscar_tenedor);
btn_registrar_proceso.addEventListener('click',verificar_proceso);
tipo_mascota.addEventListener('change',listar_razas);

cargarChips()
})
//ruc_cliente.addEventListener("keyup",buscar_cliente);




