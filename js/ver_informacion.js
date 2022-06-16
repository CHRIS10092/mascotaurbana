
$('#detallar').load("data/informacion/detallar.php")

const ver_picture = picture => {

	$('#picture-mascota').html(`<center><img  src="${picture}" class="img-responsive"></center>`);
}

function capturar(emp_ruc){

	$.ajax({
url:'data/informacion/detallar.php',
type:'POST',
data:{emp_ruc:emp_ruc},
})
.done(function(r){
	$('#ver-orden').html(r);
})

}

function imprimir_documento(){
 
	var codigo=document.getElementById('codigo');
	var ventimp=window.open(' ','_blank');
	ventimp.document.write(codigo.innerHTML);
	ventimp.document.close();
	ventimp.print();
	ventimp.close(); 
  }