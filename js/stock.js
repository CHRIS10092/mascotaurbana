$("#listado").load("../data/stock/listadostock.php");
function capturar(datos){
    d=datos.split("||");
    
    $("#txtCodigo").val(d[0]);
    $("#txtNombre").val(d[1]);
    $("#txtDescrip").val(d[2]);
    $("#txtStock").val(d[3]);
    $("#txtValor").val(d[5]);
    $("#txtFoto").val(d[6]);
    document.getElementById("imgArticulo").src="../"+d[6];
    
}

document.getElementById("txtFotoActual").onchange = function(e) {
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

  $("#btnEditar").click(function(){
    codigo = $("#txtCodigo").val();
    nombre = $("#txtNombre").val();
    descrip = $("#txtDescrip").val();
    stock = $("#txtStock").val();
    valor = $("#txtValor").val();
    
    if(codigo == ""){
        alertify.alert("","El campo codigo se encuentra vacio");
    }else if(nombre == ""){
        alertify.alert("","El campo nombre se encuentra vacio");
    }else if(descrip == ""){
        alertify.alert("","El campo descripcio se encuentra vacio");
    }else if(stock == ""){
        alertify.alert("","El campo stock se encuentra vacio");
    }else if(valor == ""){
        alertify.alert("","El campo valor se encuentra vacio");
       
    }else{
        confirmar();
    }
  })

  function confirmar(){
	alertify.confirm('Aviso',"Editar Registro ?",
		function(){
			editar();
		},
		function(){
		}
		);
}


function detallar1(codigo){
  $.ajax({
    url: '../data/stock/verinfo.php',
    type: 'POST',
    data: {codigo: codigo},
  })
  .done(function(r) {
    $('#ver-orden').html(r);
  });
}
function imprimir_documento(){
 
  var codigo=document.getElementById('panel');
  var ventimp=window.open(' ','_blank');
  ventimp.document.write(codigo.innerHTML);
  ventimp.document.close();
  ventimp.print();
  ventimp.close(); 
}

function editar(){
	//guardo el frm en una variable
	variable=document.getElementById("frm-edit-stock");
	//serializo el frm para guardar la img
	datos=new FormData(variable);
	
	$.ajax({
		url: '../controladores/articulo/stock_edit.php',
		type: 'POST',
		data: datos,
		contentType: false,
        processData: false,
	})
	.done(function(r) {
		//console.log(r);
		
		if(r==1){

              
           alertify.success("Stock Editado Correctamente");
                    
        setTimeout(function(){
          window.location.href="../app/stock.php";
        },1000); 
            $("#m-stock").modal("hide");
    
        }
    
	})

	
}





