$('#inp-numero').load("../data/sucursales/inp-numero.php");
$('#listado').load("../data/sucursales/listado-sucursales.php");
$('#listadoempresas').load("../data/sucursales/listado-empresas.php");
$('#listadoempresasu').load("../data/sucursales/listado-empresasu.php");

$('#btn-guardar').click(function() {
    //alert("sd")
   	numero= $('#txt-numero').val();
    nombre=$('#txt-sucu-nombre').val();
    direccion=$('#txt-sucu-direccion').val();
    telefono=$('#txt-sucu-telefono').val();
    numeroest=$('#cmb-sucu-numest').val();
    numerofact=$('#cmb-sucu-numfac').val();
    estado=$('#cmb-sucu-estado').val();
    empresa=$('#cmb-emp-tipoempresa').val();
    
    if (!numero) {
        alertify.error('Escribir el ruc');
     } else if (!nombre) {
        alertify.error('Escribir el nombre completo de la Empresa');
    
    } else if (!direccion) {
        alertify.error('Escribir la Direccion de la empresa ');
    } else if (!telefono) {
        alertify.error('Seleccionar un Telefono');
      } else if (numeroest == 0) {
        alertify.error('Debe escoger un numero de punto de emision de empresa');
       } else if (numerofact == 0) {
        alertify.error('Debe escoger un numero secuencial empresa');
    
       } else if (estado == 0) {
        alertify.error('Debe escoger un esatdo de empresa');
       } else if (empresa == 0) {
        alertify.error('Debe escoger una empresa');
    
    } else {
        confirmar();
    }
})

function confirmar() {
    alertify.confirm('Aviso', "Registrar ?", function() {
        registrar();
    }, function() {});
}

function registrar() {
    //datos=$('#frm-new-empresas').serialize();
    variable = document.getElementById("frm-new-sucursales");
    //serializo el frm para guardar la img
    datos = new FormData(variable);
    $.ajax({
        url: '../controladores/sucursales/create.php',
        type: 'POST',
        data: datos,
        contentType: false,
        processData: false,
    }).done(function(r) {
        if (r == 1) {
            alertify.success("Registrada Sucursal Correctamente");
            setTimeout(function() {
                window.location.href = "../app/crear-sucursales.php";
            }, 1000);
        } else if (r == 2) {
            alertify.error('Alerta', 'La Cuenta de Sucursal ya existe', '');
        } else if (r == 3) {
            alertify.error('Alerta', 'El email ya esta registrado', '');
        } else {
            alertify.alert(r);
           
        }
    })
}

function capturaremp(datos) {
    d = datos.split('||');
    $('#txt-sucu-numerou').val(d[0]);
    $('#txt-sucu-nombreu').val(d[1]);
    $('#txt-sucu-direccionu').val(d[2]);
    $('#txt-sucu-telefonou').val(d[3]);
    $('#cmb-sucu-numestu').val(d[4]);
    $('#cmb-sucu-numfacu').val(d[5]);
    $('#cmb-sucu-estadou').val(d[6]);
     $('#cmb-emp-tipoempresau').val(d[7]);
    $('#frm-edit-empresas').modal('hide');
}

function detallar(emp_ruc){
  $.ajax({
    url: '../data/empresa/verempresa.php',
    type: 'POST',
    data: {emp_ruc: emp_ruc},
  })
  .done(function(r) {
    $('#ver-orden').html(r);
  });
}

function imprimir_documento(){
 
  var codigo=document.getElementById('codigo');
  var ventimp=window.open(' ','_blank');
  ventimp.document.write(codigo.innerHTML);
  ventimp.document.close();
  ventimp.print();
  ventimp.close(); 
}


$("#btn-editar").click(function() {
   	numerou= $('#txt-sucu-numerou').val();
    nombreu=$('#txt-sucu-nombreu').val();
    direccionu=$('#txt-sucu-direccionu').val();
    telefonou=$('#txt-sucu-telefonou').val();
    numeroestu=$('#cmb-sucu-numestu').val();
    numerofactu=$('#cmb-sucu-numfacu').val();
    estadou=$('#cmb-sucu-estadou').val();
    empresau=$('#cmb-emp-tipoempresau').val();
    
    if (!nombreu) {
        alertify.error("debe Elegir un nombre de Sucursal");
    } else if (!direccionu) {
        alertify.error('Escribir la Direccion de la Sucursal ');
    } else if (!telefonou) {
        alertify.error('Seleccionar un Telefono');
      } else if (numeroestu == 0) {
        alertify.error('Debe escoger un numero de punto de emision de Sucursal');
       } else if (numerofactu == 0) {
        alertify.error('Debe escoger un numero secuencial Sucursal');
    
       } else if (estadou == 0) {
        alertify.error('Debe escoger un estado de Sucursal');
       } else if (empresau == 0) {
        alertify.error('Debe escoger una empresa');
    
    } else {
        confirmareditar();
    }
})

function confirmareditar() {
    alertify.confirm('Aviso', "Editar Registro ?", function() {
        editarempresa();
    }, function() {});
}

function editarempresa() {
    variable = document.getElementById("frm-edit-sucursales");
    datos = new FormData(variable);
    $.ajax({
        url: "../controladores/sucursales/update.php",
        type: "POST",
        data: datos,
        contentType: false,
        processData: false,
    }).done(function(r) {
        //console.log(r);
        alertify.success("Empresa Editado Correctamente");
        setTimeout(function() {
            window.location.href = "../app/crear-sucursales.php";
        }, 1000);
    })
}

function ok() {
    $('#n-usuario').modal('hide');
    $('#frm-new')[0].reset();
    mensaje = '<div class="alert alert-success">' + '<button type="button" class="close" data-dismiss="alert">' + '<i class="ace-icon fa fa-times"></i>' + '</button>' + '<strong>' + '<i class="ace-icon fa fa-plus"></i>' + '  ' + '</strong>' + 'Registro Correcto' + '<br>' + '</div>';
    $('#correcto').html(mensaje);
    $('#listado').load('../data/usuario/listado.php');
}

function oku() {
    $('#n-usuariou').modal('hide');
    mensaje = '<div class="alert alert-success">' + '<button type="button" class="close" data-dismiss="alert">' + '<i class="ace-icon fa fa-times"></i>' + '</button>' + '<strong>' + '<i class="ace-icon fa fa-plus"></i>' + '  ' + '</strong>' + 'Registro Editado' + '<br>' + '</div>';
    $('#correcto').html(mensaje);
    $('#listado').load('../data/usuario/listado.php');
}

function okd() {
    mensaje = '<div class="alert alert-success">' + '<button type="button" class="close" data-dismiss="alert">' + '<i class="ace-icon fa fa-times"></i>' + '</button>' + '<strong>' + '<i class="ace-icon fa fa-plus"></i>' + '  ' + '</strong>' + 'Registro Eliminado' + '<br>' + '</div>';
    $('#correcto').html(mensaje);
    $('#listado').load('../data/usuario/listado.php');
}

function verificar_correo(correo) {
    if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(correo)) {
        return true;
    } else {
        return false;
    }
}

function mensajes(info) {
    mensaje = '<div class="alert alert-danger">' + '<button type="button" class="close" data-dismiss="alert">' + '<i class="ace-icon fa fa-times"></i>' + '</button>' + '<strong>' + '<i class="ace-icon fa fa-warning"></i>' + '  ' + '</strong>' + info + '<br>' + '</div>';
    $('#alertas').html(mensaje);
}

function mensajesu(info) {
    mensaje = '<div class="alert alert-danger">' + '<button type="button" class="close" data-dismiss="alert">' + '<i class="ace-icon fa fa-times"></i>' + '</button>' + '<strong>' + '<i class="ace-icon fa fa-warning"></i>' + '  ' + '</strong>' + info + '<br>' + '</div>';
    $('#alertasu').html(mensaje);
}

function preguntar(id) {
    alertify.confirm('Confirmar', "Desea Eliminar el Registro", function() {
        eliminar(id);
    }, function() {});
}

function eliminar(id) {
    $.ajax({
        url: '../controladores/usuario/delete.php',
        type: 'POST',
        data: {
            id: id
        },
    }).done(function(r) {
        if (r == 1) {
            okd();
        } else {
            alertify.alert(r);
        }
    })
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
