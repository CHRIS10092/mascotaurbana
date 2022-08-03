$('#tbldetalle').load('../data/autorizacion/listado_autorizacion.php')

let detalle = []
$('#btnFacturar').click(function(e){
    e.preventDefault(); 
    cliente=document.getElementById('identificacion');
	idventa=document.getElementById('nventa');
	let tbldetalle = document.getElementById('table-detalle').rows.length
    //console.log(tbldetalle)
	if(tbldetalle == 0){
    alertify.error("El detalle de la venta debe tener al menos un producto")
	}else if($('#fecha').val() == ""){
		alertify.error("El campo fecha es obligatorio")
	}else{

		let datos = new FormData(document.getElementById('frmVenta'))

		datos.append('detalle',JSON.stringify(detalle))
        

		fetch('../controladores/notascredito/guardar.php',{
			body:datos,
			method:"POST"
		}).then(res => res.text())
		  .then(res => {
		  	alertify.success(res)
		  	$('#btnFacturar').prop('disabled',true)
		  			
		setTimeout(function()
		{
		location.href="../app/venta.php", 6000
	}); 
		  })
	}
})



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
