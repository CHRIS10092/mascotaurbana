$('#listadoadmin').load("../data/tenedor/listadoadmin.php");

$('#listado').load("../data/tenedor/listadot.php");
$('#provincias').load("../data/tenedor/listar-provincias.php");
$('#cantones').load("../controladores/tenedor/listarcantonesid.php");
$('#parroquias').load("../controladores/tenedor/listarparroquiasid.php");
//para editar el tenedor
$('#provinciasu').load("../data/tenedor/listar-provinciasu.php");


$('#btn-registrar').click(function(e){


	e.preventDefault();
cedula=$('#txt-ten-cedula').val();
nombrep=$('#txt-ten-nombre-p').val()
nombres=$('#txt-ten-nombre-s').val()
apellidop=$('#txt-ten-apellido-p').val()
apellidos=$('#txt-ten-apellido-s').val()
fecha=$('#txt-ten-fecha').val()
correo=$('#txt-ten-correo').val()
celular=$('#txt-ten-celular').val()

provincia=$('#txt-provincia').val();
canton=$('#txt-canton').val();
parroquia=$('#txt-parroquia').val();
barrio=$('#txt-ten-barrio').val();
calleprincial=$('#txt-ten-calleprincial').val();
numerocasa=$('#txt-ten-numerocasa').val();
callesecundaria=$('#txt-ten-callesecundaria').val();
referencia=$('#txt-ten-referencia').val();
img=$('#txt-img').val();
	
	if(!cedula){
		alertify.error('Escribir la cedula');
	}else if(cedula.length<10){
		alertify.error('El formato de la cedula debe constar de 10 digitos');
	}else if(!verificar_cedula(cedula)){
		alertify.error('El numero de cedula es incorrecto');
	}else if(!nombrep){
		alertify.error('Escribir El primer nombre');
    }else if(!nombres){
    alertify.error('Escribir El segundo nombre');
	}else if(!apellidop){
		alertify.error('Escribir el primer  apellido');
  }else if(!apellidos){
    alertify.error('Escribir el segundo apellido');
	}else if(!fecha){
		alertify.error('Escribir la fecha ANIO-MES-DIA');
	}else if(!correo){
		alertify.error('Escribir el Correo');
	}else if(!verificar_correo(correo)){
		alertify.error('El formato debe incluir un @ejemplo.com');
	}else if(!celular){
		alertify.error('Escribir el Correo');
	}else if(!verificar_celular(celular) ){
		alertify.error('debe empezar con 09');
	
  }else if(!provincia){
    alertify.error('Debe ingresar una provincia'); 
	}else if(!canton){
		alertify.error('Debe ingresar un Canton');	
   }else if(!parroquia){
    alertify.error('Debe ingresar una parroquia');   
  }else if(!barrio){
    alertify.error('Debe ingresar un barrio');
  }else if(!calleprincial){
    alertify.error('Debe ingresar una calle principal');    
  }else if(!numerocasa){
    alertify.error('Debe ingresar un numero de casa ');  
  }else if(!callesecundaria){
    alertify.error('Debe ingresar una calle secundaria');  
  }else if(!referencia){
    alertify.error('Debe ingresar una referencia de casa');  
	}else if(!img){
		alertify.error("debe cargar una imagen");
	
	}else{
		confirmar();
	}

});
//REGISTRAR
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


//listar cantones
function listar_cantones(){
idprovincia=$('#txt-provincia').val();
$.ajax({
url:'../controladores/tenedor/listarcantonesid.php',
type:'POST',
data:{idprovincia:idprovincia}

})
.done(function(r){

 $('#cantones').html(r);

})


}

//listar parroquias
function listarparroquias(){
 //alert("dfgf");
  idcanton=$('#txt-canton').val();
  $.ajax({

url:'../controladores/tenedor/listarparroquiasid.php',
type:'POST',
data:{idcanton:idcanton}
  })
  .done(function(r){
$('#parroquias').html(r);
  })
}

//editar cantones
function listar_cantonesu(){
  //alert("dfgf");
idprovinciau=$('#txt-provinciau').val();
$.ajax({
url:'../controladores/tenedor/listarcantonesidu.php',
type:'POST',
data:{idprovinciau:idprovinciau}

})
.done(function(r){

 $('#cantonesu').html(r);

})


}
//editar paaroquias
function listarparroquiasu(){
 //alert("dfgf");
  idcantonu=$('#txt-cantonu').val();
  $.ajax({

url:'../controladores/tenedor/listarparroquiasidu.php',
type:'POST',
data:{idcantonu:idcantonu}
  })
  .done(function(r){
$('#parroquiasu').html(r);
  })
}

function capturar(datos){
d=datos.split("||");
//$('#txt-codigou').val(d[0]);
$('#txt-cedulau').val(d[0]);
$('#txt-nombre-pu').val(d[1]);
$('#txt-nombre-su').val(d[2]);
$('#txt-apellido-pu').val(d[3]);
$('#txt-apellido-su').val(d[4]);
$('#txt-fechau').val(d[5]);
$('#txt-correou').val(d[6]);
$('#txt-celularu').val(d[7]);
$('#txt-provinciau').val(d[8]);

$.ajax({
  url:'../data/tenedor/listar-cantonesu.php',
  type:'POST',
  data:{provincia:d[8]}

}).done(function(r){
  $("#cantonesu").html(r);
  $('#txt-cantonu').val(d[9]);
})

$.ajax({
  url:'../data/tenedor/listar-parroquiasu.php',
  type:'POST',
  data:{canton:d[9]}

}).done(function(r){
  $("#parroquiasu").html(r);
  $('#txt-parroquiau').val(d[10]);
})


$('#txt-barriou').val(d[11]);
$('#txt-calleprincialu').val(d[12]);
$('#txt-numerocasau').val(d[13]);
$('#txt-callesecundariau').val(d[14]);
$('#txt-referenciau').val(d[15]);
$('#txtFoto').val(d[16]);
imagen=$('#txtFoto').val();
document.getElementById("imgArticulo").src="../"+d[16];
$('#frm-edit-tenedor').modal('hide');
}


function detallar(ten_cedula){
  $.ajax({
    url: '../data/tenedor/verinfo.php',
    type: 'POST',
    data: {ten_cedula: ten_cedula},
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

//para editar 
document.getElementById("txt-imagen").onchange = function(e) {


  // Creamos el objeto de la clase FileReader
  let reader = new FileReader();

  // Leemos el archivo subido y se lo pasamos a nuestro fileReader
  reader.readAsDataURL(e.target.files[0]);

  // Le decimos que cuando este listo ejecute el código interno
  reader.onload = function(){
    let preview1 = document.getElementById('preview1'),
            image = document.createElement('img');

    image.src = reader.result;
    image.width = "250";
        image.height = "250";
    

    preview1.innerHTML = '';
    preview1.append(image);
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

function registrar(){
	//guardo el frm en una variable
	variable=document.getElementById("frm-tenedor");
	//serializo el frm para guardar la img
	datos=new FormData(variable);
	
	$.ajax({
		url: '../controladores/tenedor/create.php',
		type: 'POST',
		data: datos,
		contentType: false,
        processData: false,
	})
	.done(function(r) {
		//console.log(r);
    if(r==1){
			     $('#frm-tenedor')[0].reset();
           alertify.success("Registro Tenedor Correctamente");
                    
        setTimeout(function(){
          window.location.href="../app/tenedor.php";
        },1000); 
        
		}else if(r==2){
			alertify.error('El registro ya existe');

		}else{
			alertify.alert(r);
      alertify.success("Registro Tenedor Correctamente");
       setTimeout(function(){
          window.location.href="../app/tenedor.php";
        },1000); 
      
		}
		//console.log(r);
    
	})
	
}

$("#btn-editar").click(function(){
//codigou=$('#txt-codigou').val();
cedulau=$('#txt-cedulau').val();
nombrepu=$('#txt-nombre-pu').val()
nombresu=$('#txt-nombre-su').val()
apellidopu=$('#txt-apellido-pu').val()
apellidosu=$('#txt-apellido-su').val()
fechau=$('#txt-fechau').val()
correou=$('#txt-correou').val()
celularu=$('#txt-celularu').val()
provinciau=$('#txt-provinciau').val();
cantonu=$('#txt-cantonu').val();
parroquiau=$('#txt-parroquiau').val();
barriou=$('#txt-barriou').val();
calleprincialu=$('#txt-calleprincialu').val();
numerocasau=$('#txt-numerocasau').val();
callesecundariau=$('#txt-callesecundariau').val();
referenciau=$('#txt-referenciau').val();
fotou=$('#txtFoto').val();
    if(nombrepu == ""){
        alertify.alert("","El campo nombre se encuentra vacio");
        }else if(provinciau == 0){
        alertify.alert("","El campo provincia se encuentra vacio");
    }else if(!cantonu){
        alertify.alert("","El campo canton se encuentra vacio");
      }else if(cantonu==0){
        alertify.alert("","El campo canton se encuentra vacio");
    }else if(!parroquiau){
        alertify.alert("","El campo parroquia se encuentra vacio");
      }else if(parroquiau==0){
        alertify.alert("","El campo parroquia se encuentra vacio");
    }else{
        confirmareditar();
    }
  })

  function confirmareditar(){
  alertify.confirm('Aviso',"Editar Registro ?",
    function(){
      editartenedor();
    },
    function(){
    }
    );
}
function editartenedor(){

  variable=document.getElementById("frm-edit-tenedor");
  datos=new FormData(variable);
  $.ajax({
    url:"../controladores/tenedor/editar.php",
    type:"POST",
    data:datos,
    contentType:false,
    processData:false,
  })
  .done(function(r){
  //console.log(r);
    if (r==1) {
      alertify.success("Tenedor Editado Correctamente");
                    
        setTimeout(function(){
          window.location.href="../app/tenedoradmin.php";
        },1000); 
        
 }else{
  alertify.error("No se puedo editar el tenedor");
 }
 
  })

 
}


function ok(){
	$('#frm-tenedor')[0].reset();

        $('#frm-tenedor').modal('hide');
	mensaje='<div class="alert alert-success">'+
	        '<button type="button" class="close" data-dismiss="alert">'+
	               '<i class="ace-icon fa fa-times"></i>'+
      				'</button>'+
      				'<strong>'+
      					'<i class="ace-icon fa fa-plus"></i>'+'  '+
      				'</strong>'+
      				  'Registro Correcto <a href="tenedor.php">ir al catalogo de tenedor'+
      				'<br>'+
      			'</div>';
	$('#correcto').html(mensaje);
}

function oku(){
  $('#frm-edit-tenedor')[0].reset();

        $('#frm-edit-tenedor').modal('hide');
  mensaje='<div class="alert alert-success">'+
          '<button type="button" class="close" data-dismiss="alert">'+
                 '<i class="ace-icon fa fa-times"></i>'+
              '</button>'+
              '<strong>'+
                '<i class="ace-icon fa fa-plus"></i>'+'  '+
              '</strong>'+
                'Registro Correcto <a href="tenedor.php">ir al catalogo de tenedor'+
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

