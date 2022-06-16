

$('#ListProducts').load("../controladores/unificar/list_products.php")
const TablaDetalle = document.getElementById('DataProducts') 
const arrayProducts = []
let total = 0.00;
const agregar = e =>{
 objProduct = {}
 datos = e.target.dataset.info
 data = datos.split('||')
 objProduct.id = data[0]
 objProduct.codigo = data[1] 
 objProduct.descripcion = data[2]
 objProduct.stock = data[3]
 objProduct.precio = data[4]

 arrayProducts.push(objProduct)

 TablaDetalle.innerHTML += `<tr>
                              <td width='5%'>1</td>
                              <td width='2%'><input class="form-control-sm" type="text" value="1" onkeyup="calculate_ptotal_product(this,${objProduct.stock},${objProduct.precio},${objProduct.id})" onkeypress="return solo_numeros(event)"></td>

                              <td width='25%'>${objProduct.descripcion}</td>

                              <td width='5%'>${objProduct.precio}</td>
                              <td width='5%' id="IdProduct${objProduct.id}">${objProduct.precio}</td>
                              
                              <td width='25%'>
                                 <button id="Remove${objProduct.id}" onclick="Remove()">Eliminar</button>
                              </td>

                           </tr>`

  arrayProducts.map(el =>{
  	total = total + parseFloat(el.precio)

  })
  
  calculate_head()
}

function calculate_ptotal_product(cantidad,stock,punit,id){
   if(parseInt(cantidad.value)>parseInt(stock)){
      alert("la cantidad no puede superar el stock")
   }else{
      $('#IdProduct'+id).html(parseFloat(punit)*parseInt(cantidad.value))
      calculate_head()
   }

}
//calcular guardado


function calculate_head(){
   let subtotal = 0;
   let iva = 0;
   let total = 0;
   var detalle = $('#detalle_product tbody tr');
   for (let i = 0; i < detalle.length; i++) {
      
      ptotal_product = $(detalle[i]).find("td:eq(4)").html();
      subtotal = subtotal + parseFloat(ptotal_product)

   }

   iva = subtotal * 0.12
   total = subtotal + iva;

   $('#subtotal').html(subtotal)
   $('#iva').html(iva)
   $('#total').html(total)
   
}

function guardar(){
  
  var detalle = $('#detalle_product tbody tr');
  if(detalle.length == 0){
    alert("necesita tener al menos un item en el detalle")
  }else{
    alert('guardar')

  }
}

function Remove(){
//alert('seleccionar los datos para eliminar')
var detalle = $('#detalle_product tbody tr');
console.log(detalle.prevObject)
}

function VerificarCliente(el){
  if(el.value != ""){
     dato = new FormData()
     dato.append("cedula",el.value)
    fetch('../controladores/unificar/data_customs.php',{method:"POST",body:dato})
            .then(res => res.json())
            .then(res =>{
             //  debugger
              if(res.success == true){
                $("#razon").val(res.cliente.razon)
                $("#direccion").val(res.cliente.direccion)
                $("#correo").val(res.cliente.correo)
                $("#telefono").val(res.cliente.telefono)
              }else{
                alert("El cliente no existe")
                $("#razon").val("")
                $("#direccion").val("")
                $("#correo").val("")
                $("#telefono").val("")
              }
              

            })

  }else{
    alert("Debe llenar el campo ruc/cedula")
  }
}

function CrearHistorial(){
  let datos = document.getElementById("tbl-historial")
  datos.innerHTML += `<tr>
   <td> 
                     <button>X</button>
                     </td>

                     <td>
                     <select><option value="">Seleccionar</option></select>
                     </td>
                     <td>
                     <input type="text">
                     </td>
                     <td>
                     <input type="text">
                     </td>
                     <td>
                     <input type="text">
                     </td>
                     <td><input type="text">
                     </td>
                     <td><input type="text">
                     </td>
                     
                     </tr>`
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
