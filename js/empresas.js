$('#listado').load("../data/empresa/listado.php");
$('#tipoempresa').load("../data/empresa/listar_tipoempresa.php");
$('#tipoempresaub').load("../data/empresa/listar_tipoempresau.php");
$('#btn-guardar').click(function() {
    //alert("sd")
    ruc = $('#txt-ruc').val();
    empresa = $('#txt-empresa').val();
    correo = $('#txt-correo').val();
    direccion = $('#txt-direccion').val();
    telefono = $('#txt-telefono').val();
    foto = $('#txt-img').val();
    tipoempresa = $('#txt-tipoempresa').val();
    correores = $('#txt-correores').val();
    direccionres = $('#txt-direccionres').val();
    telefonores = $('#txt-telefonores').val();
    if (!ruc) {
        alertify.error('Escribir el ruc');
    } else if (ruc.length < 13) {
        alertify.error('Escribir el Ruc con 001');
    } else if (!validarDocumento(ruc)) {
        alertify.error('Escriba Correctamente el ruc ');
    } else if (!empresa) {
        alertify.error('Escribir el nombre completo de la Empresa');
    } else if (!correo) {
        alertify.error('Escribir el email de la empresa');
    } else if (!verificar_correo(correo)) {
        alertify.error('El formato del correo es incorrecto');
    } else if (!direccion) {
        alertify.error('Escribir la Direccion de la empresa ');
    } else if (!telefono) {
        alertify.error('Seleccionar un perfil para el usuario');
    } else if (!foto) {
        alertify.error('Debe cargar una foto');
    } else if (tipoempresa == 0) {
        alertify.error('Debe escoger un tipo de empresa');
    } else if (!correores) {
        alertify.error('Escribir el email del usuario');
    } else if (!verificar_correo(correores)) {
        alertify.error('El formato del correo es incorrecto');
    } else if (!direccionres) {
        alertify.error('Escribir la Direccion ');
    } else if (!telefonores) {
        alertify.error('Seleccionar un perfil para el usuario');
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
    variable = document.getElementById("frm-new-empresas");
    //serializo el frm para guardar la img
    datos = new FormData(variable);
    $.ajax({
        url: '../controladores/empresas/create.php',
        type: 'POST',
        data: datos,
        contentType: false,
        processData: false,
    }).done(function(r) {
        if (r == 1) {
            alertify.success("Registrada Empresa Correctamente");
            setTimeout(function() {
                window.location.href = "../app/empresas.php";
            }, 1000);
        } else if (r == 2) {
            alertify.alert('Alerta', 'La Cuenta de Empresa ya existe', '');
        } else if (r == 3) {
            alertify.alert('Alerta', 'El email ya esta registrado', '');
        } else {
            alertify.alert(r);
           
        }
    })
}

function capturaremp(datos) {
    d = datos.split('||');
    $('#txt-idu').val(d[0]);
    $('#txt-rucu').val(d[1]);
    $('#txt-empresau').val(d[2]);
    $('#txt-correou').val(d[3]);
    $('#txt-direccionu').val(d[4]);
    $('#txt-telefonou').val(d[5]);
    $('#txtFoto').val(d[6]);
    imagen = $('#txtFoto').val();
    document.getElementById("imgArticulo").src = "../" + d[6];
    $('#txt-tipoempresau').val(d[7]);
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

//recoger imagen create
document.getElementById("txt-img").onchange = function(e) {
    // Creamos el objeto de la clase FileReader
    let reader = new FileReader();
    // Leemos el archivo subido y se lo pasamos a nuestro fileReader
    reader.readAsDataURL(e.target.files[0]);
    // Le decimos que cuando este listo ejecute el código interno
    reader.onload = function() {
        let preview = document.getElementById('preview'),
            image = document.createElement('img');
        image.src = reader.result;
        image.width = "250";
        image.height = "250";
        preview.innerHTML = '';
        preview.append(image);
    };
}
//recoger imagen para editar
//para editar 
document.getElementById("txt-imagen").onchange = function(e) {
    // Creamos el objeto de la clase FileReader
    let reader = new FileReader();
    // Leemos el archivo subido y se lo pasamos a nuestro fileReader
    reader.readAsDataURL(e.target.files[0]);
    // Le decimos que cuando este listo ejecute el código interno
    reader.onload = function() {
        let preview1 = document.getElementById('preview1'),
            image = document.createElement('img');
        image.src = reader.result;
        image.width = "250";
        image.height = "250";
        preview1.innerHTML = '';
        preview1.append(image);
    };
}
$("#btn-editar").click(function() {
    rucu = $('#txt-rucu').val();
    empresau = $('#txt-empresau').val();
    correou = $('#txt-correou').val();
    direccionu = $('#txt-direccionu').val();
    telefonou = $('#txt-telefonou').val();
    tipoempresau = $('#txt-tipoempresau').val();
    fotou = $('#txtFoto').val();
    if (tipoempresau == 0) {
        alertify.alert("debe escoger un tipo de empresa");
    } else if (direccionu == "") {
        alertify.alert("El campo nombre se encuentra vacio");
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
    variable = document.getElementById("frm-edit-empresas");
    datos = new FormData(variable);
    $.ajax({
        url: "../controladores/empresas/update.php",
        type: "POST",
        data: datos,
        contentType: false,
        processData: false,
    }).done(function(r) {
        //console.log(r);
        alertify.success("Empresa Editado Correctamente");
        setTimeout(function() {
            window.location.href = "../app/empresas.php";
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
validarDocumento = function() {
    numero = document.getElementById('txt-ruc').value;
    /* alert(numero); */
    var suma = 0;
    var residuo = 0;
    var pri = false;
    var pub = false;
    var nat = false;
    var numeroProvincias = 22;
    var modulo = 11;
    /* Verifico que el campo no contenga letras */
    var ok = 1;
    for (i = 0; i < numero.length && ok == 1; i++) {
        var n = parseInt(numero.charAt(i));
        if (isNaN(n)) ok = 0;
    }
    if (ok == 0) {
        alert("No puede ingresar caracteres en el número");
        return false;
    }
    if (numero.length < 10) {
        alert('El número ingresado no es válido');
        return false;
    }
    /* Los primeros dos digitos corresponden al codigo de la provincia */
    provincia = numero.substr(0, 2);
    if (provincia < 1 || provincia > numeroProvincias) {
        alert('El código de la provincia (dos primeros dígitos) es inválido');
        return false;
    }
    /* Aqui almacenamos los digitos de la cedula en variables. */
    d1 = numero.substr(0, 1);
    d2 = numero.substr(1, 1);
    d3 = numero.substr(2, 1);
    d4 = numero.substr(3, 1);
    d5 = numero.substr(4, 1);
    d6 = numero.substr(5, 1);
    d7 = numero.substr(6, 1);
    d8 = numero.substr(7, 1);
    d9 = numero.substr(8, 1);
    d10 = numero.substr(9, 1);
    /* El tercer digito es: */
    /* 9 para sociedades privadas y extranjeros   */
    /* 6 para sociedades publicas */
    /* menor que 6 (0,1,2,3,4,5) para personas naturales */
    if (d3 == 7 || d3 == 8) {
        alert('El tercer dígito ingresado es inválido');
        return false;
    }
    /* Solo para personas naturales (modulo 10) */
    if (d3 < 6) {
        nat = true;
        p1 = d1 * 2;
        if (p1 >= 10) p1 -= 9;
        p2 = d2 * 1;
        if (p2 >= 10) p2 -= 9;
        p3 = d3 * 2;
        if (p3 >= 10) p3 -= 9;
        p4 = d4 * 1;
        if (p4 >= 10) p4 -= 9;
        p5 = d5 * 2;
        if (p5 >= 10) p5 -= 9;
        p6 = d6 * 1;
        if (p6 >= 10) p6 -= 9;
        p7 = d7 * 2;
        if (p7 >= 10) p7 -= 9;
        p8 = d8 * 1;
        if (p8 >= 10) p8 -= 9;
        p9 = d9 * 2;
        if (p9 >= 10) p9 -= 9;
        modulo = 10;
    }
    /* Solo para sociedades publicas (modulo 11) */
    /* Aqui el digito verficador esta en la posicion 9, en las otras 2 en la pos. 10 */
    else if (d3 == 6) {
        pub = true;
        p1 = d1 * 3;
        p2 = d2 * 2;
        p3 = d3 * 7;
        p4 = d4 * 6;
        p5 = d5 * 5;
        p6 = d6 * 4;
        p7 = d7 * 3;
        p8 = d8 * 2;
        p9 = 0;
    }
    /* Solo para entidades privadas (modulo 11) */
    else if (d3 == 9) {
        pri = true;
        p1 = d1 * 4;
        p2 = d2 * 3;
        p3 = d3 * 2;
        p4 = d4 * 7;
        p5 = d5 * 6;
        p6 = d6 * 5;
        p7 = d7 * 4;
        p8 = d8 * 3;
        p9 = d9 * 2;
    }
    suma = p1 + p2 + p3 + p4 + p5 + p6 + p7 + p8 + p9;
    residuo = suma % modulo;
    /* Si residuo=0, dig.ver.=0, caso contrario 10 - residuo*/
    digitoVerificador = residuo == 0 ? 0 : modulo - residuo;
    /* ahora comparamos el elemento de la posicion 10 con el dig. ver.*/
    if (pub == true) {
        if (digitoVerificador != d9) {
            alert('El ruc de la empresa del sector público es incorrecto.');
            return false;
        }
        /* El ruc de las empresas del sector publico terminan con 0001*/
        if (numero.substr(9, 4) != '0001') {
            alert('El ruc de la empresa del sector público debe terminar con 0001');
            return false;
        }
    } else if (pri == true) {
        if (digitoVerificador != d10) {
            alert('El ruc de la empresa del sector privado es incorrecto.');
            return false;
        }
        if (numero.substr(10, 3) != '001') {
            alert('El ruc de la empresa del sector privado debe terminar con 001');
            return false;
        }
    } else if (nat == true) {
        if (digitoVerificador != d10) {
            alert('El número de cédula de la persona natural es incorrecto.');
            return false;
        }
        if (numero.length > 10 && numero.substr(10, 3) != '001') {
            alert('El ruc de la persona natural debe terminar con 001');
            return false;
        }
    }
    return true;
}