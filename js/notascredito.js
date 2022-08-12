$('#tbldetalle').load('../data/autorizacion/listado_autorizacion.php')

let detalle = []
$('#btnFacturar').click(function(e){
    e.preventDefault(); 
    cliente=document.getElementById('identificacion');
	idventa=document.getElementById('nventa');
	
    //console.log(tbldetalle)
	if($('#fecha').val() == ""){
		alertify.error("El campo fecha es obligatorio")
	}else{
        let guardardatos=[];
        let tbldetalle = Array.from(document.getElementById('idtbody').rows);
        
        for(i=0;i<tbldetalle.length;i++){
            //console.log(tbldetalle[i].cells);

            let datosdetalle=tbldetalle[i].cells
            //console.log(datosdetalle)
            let obj={};
            for(j=0;j<datosdetalle.length;j++){

                let items =datosdetalle[j].innerHTML
  
                
                  
                  if(j==0){
                    obj.id=items
                  }else if(j==1){
                    obj.codigo=items
                  }else if(j==2){
                    obj.detalle=items
                  }else if(j==3){
                    obj.cantidad=items
                }else if(j==4){
                    obj.precio=items
                }else if(j==5){
                    obj.descuento=items
                }else if(j==6){
                    obj.preciototal=items
                }
  
                   
                             
        }
        guardardatos.push(obj)
    }
    let datos = new FormData(document.getElementById('frmVenta'))
    
    datos.append('DATO1',JSON.stringify(guardardatos))
    
      console.log(guardardatos)
		fetch('../controladores/notascredito/guardar.php',{
			body:datos,
			method:"POST"
		}).then(res => res.text())
		  .then(res => {
		  	alertify.success(res)
		  	$('#btnFacturar').prop('disabled',false)
		  			
		console.log(res);
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
