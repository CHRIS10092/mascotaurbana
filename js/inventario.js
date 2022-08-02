$('#listadoemp').load('../data/articulo/listadoempresas.php');
$('#list-categoria').load('../data/articulo/list_categoria.php');
//$('#list-subcategoria').load('../data/articulo/list_subcategoria.php');

function capturar(datos){
    d=datos.split("||");
    $("#txtId").val(d[0]);
    $("#txtCodigo").val(d[1]);
    $("#txtNombre").val(d[2]);
    $("#txtDescrip").val(d[3]);
    $("#txtStock").val(d[4]);
    $("#txtCosto").val(d[5]);
    $("#txtCostoIva").val(d[6]);
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

function detallar1(codigo){
  $.ajax({
    url: '../data/inventario/verinfo.php',
    type: 'POST',
    data: {codigo: codigo},
  })
  .done(function(r) {
    $('#ver-orden').html(r);
  });
}
function imprimir_documento(){
 
  var codigo=document.getElementById('codigo1');
  var ventimp=window.open(' ','_blank');
  ventimp.document.write(codigo.innerHTML);
  ventimp.document.close();
  ventimp.print();
  ventimp.close(); 
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
    valor = $("#txtCosto").val();
    valorpvp=$("#txtCostoIva").val();
    cmbsubcategoria=$("#cmb-subcategoria").val();
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
      //}else if(cmbsubcategoria == 0 || cmbsubcategoria==""){
        //alertify.alert("","No se puede editar una subcateoria");
      }else if(cmbsubcategoria == 2 || cmbsubcategoria==""){
        alertify.alert("","No se puede editar la subcategoria CHIP");
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
		url: '../controladores/inventario/editar.php',
		type: 'POST',
		data: datos,
		contentType: false,
        processData: false,
	})
	.done(function(r) {
		if(r==1){
            alertify.success("Articulo Editado Correctamente");
            setTimeout(function() {
                window.location.href = "../app/inventarioempresas.php";
            }, 1000);
        $("#m-articulo").modal("hide");
            preview = document.getElementById('preview').innerHTML="";

       
        }
        
	})

	
}
const precio = document.getElementById("txtCosto");


const precio_iva = document.getElementById("txtCostoIva");



function calcular_precio_iva($costo_siniva){


  imp_iva = costo_siniva * 0.12;


  costo_coniva = costo_siniva + imp_iva;





  return costo_coniva.toFixed(2);





}




precio.addEventListener("keyup",function(){


  if(this.value == ""){


    precio_iva.value = 0;


  }else{


    costo_siniva = parseFloat(this.value);


    precio_iva.value = calcular_precio_iva(costo_siniva);


  }


  


})








function ver_activacion(op){


    if(op == 1){


        document.getElementById('txtCosto').readOnly = false;


        document.getElementById('txtCostoIva').readOnly = true;


    }else{


        document.getElementById('txtCostoIva').readOnly = false;


        document.getElementById('txtCosto').readOnly = true;


    }


    


}





function calcular_costo(costo){


    if(costo == ""){


        document.getElementById('txtCosto').value = 0;


    }else{


        


        costo = parseFloat(costo);


        costo = costo / 1.12;


        document.getElementById('txtCosto').value = costo.toFixed(2);


        


    }


    


}









