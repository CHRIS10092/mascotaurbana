$('#listado-clientes').load("../data/mascotas/listado-tenedor.php");

$('#listadom').load("../data/mascotas/listado-mascotas.php");
$('#tenedor').load("../data/mascotas/listado-clientesu.php");

$('#especies').load("../data/mascotas/listar-provincias.php");
$('#razas').load("../controladores/mascotas/listarcantonesid.php");

function capturar(datos){
	d=datos.split('||');
	
  $('#txt-tenedor').val(d[0]);
	$('#txt-numero').val(d[1]);
	$('#txt-nombre-usu').val(d[2]);
	$('#txt-apellido-usu').val(d[3]);
  $("#m-tenedor").modal('hide');

}



//llamar a las especies 
function listar_cantones(){
idprovincia=$('#txt-provincia').val();
$.ajax({
url:'../controladores/mascotas/listarcantonesid.php',
type:'POST',
data:{idprovincia:idprovincia}

})
.done(function(r){

 $('#razas').html(r);

})


}

document.getElementById("txt-img").onchange = function(e) {
  // Creamos el objeto de la clase FileReader
  let reader = new FileReader();

  // Leemos el archivo subido y se lo pasamos a nuestro fileReader
  reader.readAsDataURL(e.target.files[0]);

  // Le decimos que cuando este listo ejecute el código interno
  reader.onload = function(){
    let preview = document.getElementById('preview'),
            image = document.createElement('img');

    image.src = reader.result;
    image.width = "250";
        image.height = "250";
    

    preview.innerHTML = '';
    preview.append(image);
  };
}

function confirmar(){
	alertify.confirm('Aviso',"Registrar ?",
		function(){
			registrar();
		},
		function(){
		}
		);
}

$("#btn-registrar").click(function(e){
   
    e.preventDefault();
    codigo=$('#txt-codigo').val();
    nombre=$('#txt-nombre').val();
    sexo=$('#cmbsexo').val();
    fecha=$('#txt-fecha').val();
    color=$('#txt-color').val();
    color1=$('#txt-color1').val();
    cmbtipomascota=$('#txt-provincia').val();
    cmbraza=$('#txt-canton').val();
    esterilizado=$('#txt-esterilizado').val();
    foto=$("#txt-img").val(); 
    id_tenedor=$('#txt-tenedor').val();
    nombretenedor=$('#txt-numero').val();
    if(!codigo){
        alertify.alert("El campo codigo se encuentra vacio");
    }else if(codigo.length<15){
        alertify.alert("debe seleccionar 14 caracteres");
    }else if(!fecha){
        alertify.alert("El campo fecha se encuentra vacio");
    }else if(!color){
        alertify.alert("El campo color se encuentra vacio");
    }else if(!color1){
        alertify.alert("El campo color1 se encuentra vacio");
    }else if(sexo == 0){
        alertify.alert("Debe Escoger si es Macho o Hembra");
    }else if(cmbtipomascota == 0){
        alertify.alert("Debe elegir un tipo de mascota");
      }else if(cmbraza == 0){
        alertify.alert("Debe elegir una raza");
      }else if(esterilizado == 0){
        alertify.alert("Debe elegir si esta esterilizado o no");
         }else if(!foto){
        alertify.alert("Debe cargar una foto para la mascota");
         }else if(!nombretenedor){
        alertify.alert("Debe elegir un tenedor para la mascota");
    }else{
        confirmar();
    }
  });

function confirmar(){

  alertify.confirm('Aviso',"Editar Registro ?",
    function(){
      registrar();
    },
    function(){
    }
    );

}
function registrar(){
	//guardo el frm en una variable
	variable=document.getElementById("frm-mascotas");
	//serializo el frm para guardar la img
	datos=new FormData(variable);
	
	$.ajax({
		url: '../controladores/mascotas/registrar.php',
		type: 'POST',
		data: datos,
		contentType: false,
    processData: false,
	})
	.done(function(r) {
		console.log(r);
    if(r==1){

			      alertify.success("Registro Mascota Correctamente");
        $('#listadom').load("../data/mascotas/listado-mascotas.php");            
        setTimeout(function(){
          window.location.href="../app/listar-mascotas.php";
        },1000); 
        
		}else if(r==2){
			alertify.alert('Alerta','El registro ya existe','');
			
		}else{
		  alertify.alert(r);
		}
		//console.log(r);

  
	})
	

}

//general codigos qr



function ok(){
	$('#frm-mascotas')[0].reset();

        $('#frm-mascotas').modal('hide');
	mensaje='<div class="alert alert-success">'+
	        '<button type="button" class="close" data-dismiss="alert">'+
	               '<i class="ace-icon fa fa-times"></i>'+
      				'</button>'+
      				'<strong>'+
      					'<i class="ace-icon fa fa-plus"></i>'+'  '+
      				'</strong>'+
      				  'Registro Correcto <a href="mascotas.php">ir al catalogo de tenedor'+
      				'<br>'+
      			'</div>';
	$('#correcto').html(mensaje);
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

function validar_numeros(e) {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla == 8) return true;
        patron = /[qwertyuiopasdfghjkllñzxcvbnmQWERTYUIOPÑLKJHGFDSAZXCVBNM]/;
        te = String.fromCharCode(tecla);
        if (patron.test(te)) {
            alertify.error('SOLO SE ACEPTAN NUMEROS');
            return false;

        }

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


function verificar_decimales(costo){
  patron=/^([0-9])*[.]?[0-9]*$/;

  if(patron.test(costo)){
    return true;
}else{
    return false;
}
}

$("#btn-buscar-detalle").click(function(e){

  e.preventDefault();
  numero_venta = $("#txt-numero-venta").val();
  cedula_tenedor = $("#txt-numero").val();
  id_tenedor = $("#txt-tenedor").val();
  if(cedula_tenedor == ""){
    alertify.alert("Verificación","Seleccione un Tenedor");
  }else if(numero_venta == ""){
    alertify.alert("Verificacion","Escriba el Numero de Venta");
  }else{
    buscar_detalle_venta(numero_venta,cedula_tenedor,id_tenedor)
  }

})


function buscar_detalle_venta(numero,tenedor,idtenedor){

  data = new FormData();
  data.append("numero",numero);
  data.append("tenedor",tenedor);
  data.append("idtenedor",idtenedor);

  fetch("../controladores/mascotas/buscar_detalle_venta.php",{
    method:"POST",
    body:data
  }).then(res => res.json())
  .then(res => {
    if(res.res){
      if(res.cantidad > 0){
        document.getElementById('btn-registrar').disabled = false;
        document.getElementById("datos-registros").innerHTML = `<p style="color:blue">ARTICULO:  ${res.articulo.nombre}</p>
                                                                <p style="color:blue">CANTIDAD:${res.articulo.cantidad}</p>
                                                                <p style="color:red">CANTIDAD PARA REGISTRAR ${res.cantidad}</p>`;
      }else{
        document.getElementById("datos-registros").innerHTML = `<p style="color:blue">ARTICULO:  ${res.articulo.nombre}</p>
                                                                <p style="color:blue">CANTIDAD:${res.articulo.cantidad}</p>
                                                                <p style="color:red">CANTIDAD PARA REGISTRAR ${res.cantidad}</p>`;
      }
    }else{
      $("#datos-registros").html(`<p style="color:red">${res.mensaje}</p>`);
    }
  })
  
}
