$('#list-categoria').load('../data/articulo/list_categoria.php');
//$('#list-subcategoria').load('../data/articulo/list_subcategoria.php');
$("#listado").load("../data/articulo/listado.php");

function capturar(datos){
    d=datos.split("||");
    $("#txtId").val(d[0]);
    $("#txtCodigo").val(d[1]);
    $("#txtNombre").val(d[2]);
    $("#txtDescrip").val(d[3]);
    $("#txtStock").val(d[4]);
    $("#txtValor").val(d[5]);
    $("#txtValorpvp").val(d[6]);
    $("#txtFoto").val(d[7]);
    document.getElementById("imgArticulo").src="../"+d[7];
    $("#cmb-categoria").val(d[8]);
    
    $.ajax({
      url: '../data/articulo/list_subcategoria.php',
      type: 'POST',
      data: {id:d[8]},
    })
    .done(function(r) {

      $('#list-subcategoria').html(r);

      $('#cmb-subcategoria').val(d[9]);
    });
    

}


//funcion para el crear
function listar_subcategorias(){

    id=$('#cmb-categoria').val();
    $.ajax({
        url: '../data/articulo/list_subcategoria.php',
        type: 'POST',
        data: {id:id},
    })
    .done(function(r) {
        $('#list-subcategoria').html(r);
    })

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
    valorpvp=$("#txtValorpvp").val();
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
        }else if(valorpvp == ""){
        alertify.alert("","El campo valor pvp se encuentra vacio");
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

function editar(){
	//guardo el frm en una variable
	variable=document.getElementById("frm-edit");
	//serializo el frm para guardar la img
	datos=new FormData(variable);
	
	$.ajax({
		url: '../controladores/articulo/edit.php',
		type: 'POST',
		data: datos,
		contentType: false,
        processData: false,
	})
	.done(function(r) {
		if(r==1){
            alertify.success("Articulo Editado Correctamente");
             setTimeout(function(){
          window.location.href="../app/historial_articulo.php";
        },1000); 
            $("#listado").load("../data/articulo/listado.php");
            $("#m-articulo").modal("hide");
            preview = document.getElementById('preview').innerHTML="";
    
        }
        
	})

	
}
