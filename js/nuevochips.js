$('#listado').load('../data/nuevochip/listarchip.php')

$('#btn-guardar').click(function(e){
	e.preventDefault();

	codigo=$('#txt-codigo').val();
	
	cmbestado=$('#cmb-chip').val();
	if(!codigo){
		alertify.error('Escribir el codigo del articulo');
	
	}else if(cmbestado==0){
		alertify.error('debe selecionar un estado de chip');
	}else{
		confirmar();
	}

})

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
	variable=document.getElementById("frm-chips");
	//serializo el frm para guardar la img
	datos=new FormData(variable);
	
	$.ajax({
		url: '../controladores/chip/create.php',
		type: 'POST',
		data: datos,
		contentType: false,
        processData: false,
	})
	.done(function(r) {
		if(r==1){
			 alertify.success("Articulo Ingresado Correctamente");
                    
        setTimeout(function(){
          window.location.href="../app/nuevochips.php";
        },1000); 
		}else if(r==2){
			alertify.error('El Numero de Codigo ya existe');
		}else{
			alertify.alert(r);
		}
		console.log(r);
	})
	
}

//registrar 
$('#btn-editar').click(function(e){
	e.preventDefault();

	codigo=$('#txt-codigou').val();
	
	cmbestado=$('#cmb-chipu').val();
	if(!codigo){
		alertify.error('Escribir el codigo del articulo');
	
	}else if(cmbestado==0){
		alertify.error('debe selecionar un estado de chip');
	}else{
		editar();
	}

})

function editar(){
	alertify.confirm('Aviso',"Registrar ?",
		function(){
			preguntar_editar();
		},
		function(){
		}
		);
}

function preguntar_editar(){
	//guardo el frm en una variable
	variable=document.getElementById("frm-chipsu");
	//serializo el frm para guardar la img
	datos=new FormData(variable);
	
	$.ajax({
		url: '../controladores/chip/editar.php',
		type: 'POST',
		data: datos,
		contentType: false,
        processData: false,
	})
	.done(function(r) {
		if(r==1){
			 alertify.success("Articulo Ingresado Correctamente");
                    
        setTimeout(function(){
          window.location.href="../app/nuevochips.php";
        },1000); 
		}else if(r==2){
			alertify.error('Alerta','El Numero de Codigo ya existe','');
		}else{
			alertify.alert(r);
		}
		console.log(r);
	})
	
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