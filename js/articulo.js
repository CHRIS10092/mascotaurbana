$('#list-categoria').load('../data/articulo/list_categoria.php');
$('#list-subcategoria').load('../data/articulo/list_subcategoria.php');

$('#listado').load('../data/articulo/listado.php');
$('#listadotipo').load('../data/articulo/list_tipo.php');

$('#btn-guardar').click(function(e){
	e.preventDefault();

	codigo=$('#txt-codigo').val();
	nombre=$('#txt-nombre').val();
	descripcion=$('#txt-des').val();
	stock=$('#txt-stock').val();
	precio=$('#txtCosto').val();
	preciopvp=$('#txtCostoIva').val();
	imagen=$('#txt-img').val();
	cmbcategoria=$('#cmb-categoria').val();
	cmbsubcategoria=$('#cmb-subcategoria').val();
	expiracion=$('#txt-expiracion').val();
	let lote=document.getElementById('txt-lote')
	if(!codigo){
		alertify.error('Escribir el codigo del articulo');
	}else if(!nombre){
		alertify.error('Escribir el nombre del articulo');
	}else if(!descripcion){
		alertify.error('Escribir una descripcion del articulo');
	}else if(!stock){
		alertify.error('Escribir la cantidad de articulos');
	}else if(cmbcategoria==0){
		alertify.error('debe selecionar un tipo de Categoria');
	}else if(cmbsubcategoria==0){
		alertify.error('debe selecionar un tipo de Subcategoria');
	}else if(!precio){
		alertify.error('Escribir el precio de compra');
	}else if(!preciopvp){
		alertify.error('Escribir el precio de venta');
	}else if(!imagen){
		alertify.error("debe cargar una imagen");
	}else if(precio<=0){
		alertify.error('El precio de venta debe ser mayor a  $ 0.00');
	}else if(!lote){
		alertify.error('Debe colocar el numero de lote ');
	}else{
		confirmar();
	}

})


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
    image.width = "70";
        image.height = "50";
    

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

function registrar(){
	//guardo el frm en una variable
	variable=document.getElementById("frm-new");
	//serializo el frm para guardar la img
	datos=new FormData(variable);
	
	$.ajax({
		url: '../controladores/articulo/create.php',
		type: 'POST',
		data: datos,
		contentType: false,
        processData: false,
	})
	.done(function(r) {
		if(r==1){
			 alertify.success("Articulo Ingresado Correctamente");
                    
        setTimeout(function(){
          window.location.href="../app/inventarioempresas.php";
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


function accion(){
	id=$('#cmb-forma').val();
	if(id==2){
		$('#txt-cantidad').prop('readOnly',true);
		$('#txt-cantidad').val('1');
	}else if(id==1){
		$('#txt-cantidad').prop('readOnly',false);
		$('#txt-cantidad').val('');
	}
}


const costo = document.getElementById('txtCosto');


const costocompra = document.getElementById('txtCostoCompra');


const costo_iva = document.getElementById('txtCostoIva');


costo.addEventListener("keyup",function(){


	if(this.value == ""){
  
  
	  costo_iva.value = 0;
  
  
	}else{
  
  
	  costo_siniva = parseFloat(this.value);
  
  
	  costo_iva.value = calcular_precio_iva(costo_siniva);
  
  
	}
  
  
	
  
  
  })
  
  
  

function calcular_precio_iva($costo_siniva){


	imp_iva = costo_siniva * 0.12;
  
  
	costo_coniva = costo_siniva + imp_iva;
  
  
  
  
  
	return costo_coniva.toFixed(3);
  
  
  
  
  
  }
  

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


        document.getElementById('txtCosto').value = costo.toFixed(3);


        


    }


    


}
