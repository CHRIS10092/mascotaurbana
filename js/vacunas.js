

$('#listadovacunas').load("../data/vacunas/listadov.php");
$('#listar-tipovu').load("../data/vacunas/listartipou.php");
$('#listar-tipov').load("../data/vacunas/listartipo.php");




function capturar(datos){
	d=datos.split("||");
	$('#txt-codigou').val(d[0]);
	$('#txt-descripcionu').val(d[1]);
	$('#cmb-tipovacunau').val(d[3]);

	$("#n-vacunas").modal('hide');
	
}

$('#btn-guardar').click(function() {
	
    
	descripcion=$('#txt-descripcion').val();
	tipovac=$('#cmb-tipovacuna').val();
	if (descripcion=="") {
		alertify.error("ingrese corecamente la descripcion")
	}else if(tipovac==0){
		alertify.error("Debe seleccionar un tipo de vacuna");

	}else {
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
	datos=$('#frm-new').serialize();

	$.ajax({
		url:'../controladores/vacunas/crear.php',
		type:'POST',
		data:datos,
	})
	.done(function(r){
//	/7/console.log(r)	;
if (r==1) {

	alertify.success("Registro de vacunas exitoso");
	setTimeout(function(){
window.location.href="../app/agregar_vacunas.php";
	},1000);
}else{
	alertify.error("No se puedo Registrar la Vacuna");
}
	})
}

$('#btn-editar').click(function() {
	codigou=$('#txt-codigou').val();
	descripcionu=$('#txt-descripcionu').val();
	tipovacu=$('#cmb-tipovacunau').val();
	if (descripcionu=="") {
		alertify.error("Debe escribir la descripcion");

	}else if(tipovacu==0){
		alertify.error("debe escribir un tipo de especie");
	}
	else{
		editarv();
	}
});

function editarv(){

	
  alertify.confirm('Aviso',"Editar Registro ?",
    function(){
      editarvac();
    },
    function(){
    }
    );

}
function editarvac(){
	datos=$('#frm-edit').serialize();

	$.ajax({
		url:'../controladores/vacunas/editar.php',
		type:'POST',
		data:datos,
	})
	.done(function(r){
//	/7/console.log(r)	;
if (r==1) {

	alertify.success("Registro Editado de vacunas exitoso");
	setTimeout(function(){
window.location.href="../app/agregar_vacunas.php";
	},1000);
}else{
	alertify.error("No se puedo Registrar la Vacuna");
}
	})
}
