$('#listadomadmin').load("../data/mascotas/listado-mascotasadmin.php");
$('#listadom').load("../data/mascotas/listado-mascotas.php");
$('#tenedor').load("../data/mascotas/listado-clientesu.php");
$("#listado").load("../data/articulo/listado.php");
$('#especies').load("../data/mascotas/listar-provincias.php");
$('#razas').load("../data/mascotas/listar-cantonesuadmin.php");

function mascotacap(datos){
  d=datos.split('||');
    //$('#txt-id').val(d[0]);
    $('#txt-codigo').val(d[0]);
    $('#txt-nombre').val(d[1]);
    $('#cmb-sexo').val(d[2]);
    $('#txt-fecha').val(d[3]);
    $('#txt-color').val(d[4]);
    $('#txt-color1').val(d[5]);
   /* $('#txt-provincia').val(d[6]);*/
    //$('#txt-canton').val(d[7]);*/

$.ajax({
  url:'../data/mascotas/listar-cantonesu.php',
  type:'POST',
  data:{idprovincia:d[13]}

}).done(function(r){
  $("#razas").html(r);
  $('#txt-cantonu').val(d[12]);
})
  

    $('#cmb-esterelizado').val(d[8]);
    $("#txtFoto").val(d[9]);
    document.getElementById("imgArticulo").src="../"+d[9];
    $("#cmb-tenedorun").val(d[10]);
}

function detallar(codigo){
  $.ajax({
    url: '../data/mascotas/verinfo.php',
    type: 'POST',
    data: {codigo: codigo},
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

function detallars(codigo_mascota){

document.getElementById('mostrarCodigo').innerHTML = codigo_mascota;
//document.getElementById('mostrarNombre').innerHTML = nombre;
  //alert("sd");
}

document.getElementById("txt-imagen").onchange = function(e) {
    // Creamos el objeto de la clase FileReader
    let reader = new FileReader();
  
    // Leemos el archivo subido y se lo pasamos a nuestro fileReader
    reader.readAsDataURL(e.target.files[0]);
  
    // Le decimos que cuando este listo ejecute el código interno
    reader.onload = function(){
      let preview = document.getElementById('preview'),
              image = document.createElement('img');
  
      image.src = reader.result;
      image.width = "180";
          image.height = "150";
      
  
      preview.innerHTML = '';
      preview.append(image);
    };
  }

  
function editarm(){
    
    //codigo=$('#txt-codigo').val();
    nombre=$('#txt-nombre').val();
    sexo=$('#cmbsexo').val();
    fecha=$('#txt-fecha').val();
    color=$('#txt-color').val();
    color1=$('#txt-color1').val();
    cmbtipomascota=$('#txt-provincia').val();
    cmbraza=$('#txt-canton').val();
    esterilizado=$('#txt-esterilizado').val();
    foto=$("#txt-imagen").val(); 
    id_tenedor=$('#cmb-tenedorun').val();
    nombretenedor=$('#txt-numero').val();
    
    if(!fecha){
        alertify.error("El campo fecha se encuentra vacio");
    }else if(!color){
        alertify.error("El campo color se encuentra vacio");
    }else if(!color1){
        alertify.error("El campo color1 se encuentra vacio");
    }else if(cmbtipomascota == 0){
        alertify.error("Debe elegir un tipo de mascota");
      }else if(cmbraza == 0){
        alertify.error("Debe elegir una raza");
      }else if(esterilizado == 0){
        alertify.error("Debe elegir si esta esterilizado o no");
        
         }else if(!id_tenedor){
        alertify.error("Debe elegir un tenedor para la mascota");
    }else{
        confirmar();
    }

}
  function confirmar(){
	alertify.confirm('Aviso',"Editar Registro ?",
		function(){
			editarmascota();
		},
		function(){
		}
		);
}

function editarmascota(){
	//guardo el frm en una variable
	variable=document.getElementById("frm-mascotau");
	//serializo el frm para guardar la img
	datos=new FormData(variable);
	
	$.ajax({
		url: '../controladores/mascotas/editar.php',
		type: 'POST',
		data: datos,
		contentType: false,
        processData: false,
	})
	.done(function(r) {
        //console.log(r);
	if (r==1) {
            alertify.success("Mascota Editado Correctamente");
                    
        setTimeout(function(){
          window.location.href="../app/listar-mascotas.php";
        },1000); 
      }else{
            alertify.error("No se pudo editar la mascota");
      }
    
	})
	
}

function ok(){
    $('#frm-mascotau')[0].reset();

        $('#frm-mascotau').modal('hide');
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


