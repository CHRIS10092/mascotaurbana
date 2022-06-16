$('#inp-numero').load("../data/empresa/inp-numero.php");
$('#listado').load("../data/empresa/listado.php");
//tipo de empresa
$('#tipoempresa').load("../data/empresa/listar_tipoempresa.php");
$('#tipoempresaub').load("../data/empresa/listar_tipoempresau.php");
//tipo ambiente
$('#tipoambiente').load("../data/empresa/listar_tipoambiente.php");
$('#tipoambienteu').load("../data/empresa/listar_tipoambienteu.php");

$('#btn-guardar').click(function() {
    //alert("sd")
    id = $('#txt-emp-id').val();
    empresa = $('#txt-emp-nombre').val();
    ruc = $('#txt-emp-ruc').val();
    direccion = $('#txt-emp-direccion').val();
    correo = $('#txt-emp-correo').val();
    celular = $('#txt-emp-celular').val();
    foto = $('#txt-img').val();
    provincia = $('#txt-provincia').val();
    canton = $('#txt-canton').val();
    parroquia = $('#txt-parroquia').val();
    calleprincipal = $('#txt-emp-calleprincipal').val();
    callesecundaria = $('#txt-emp-callesecundaria').val();
    numeracionoficina = $('#txt-emp-numerooficina').val();
    referencia = $('#txt-emp-referencia').val();
    estado = $('#cmb-emp-estado').val();
    tipoempresa = $('#cmb-emp-tipoempresa').val();
    ambiente = $('#cmb-tipoambiente').val();
    const rutaFirma = document.getElementById('txtRutaFirma');
    txtContrasenaFirma=$('#txtContrasenaFirma').val();
    //datos del usuario
    primernombreres = $('#txt-usu-nombreprimer').val();
    segundonombreres = $('#txt-usu-segundonombre').val();
    primerapellidores = $('#txt-usu-apellidopaterno').val();
    segundoapellidores = $('#txt-usu-apellidomaterno').val();
    direccionres = $('#txt-usu-direccion').val();
    telefonores = $('#txt-usu-celular').val();
    correores = $('#txt-usu-correo').val();
    correorepitares = $('#txt-usu-correo-rep').val();
    usuariores = $('#txt-usu-usuario').val();
    contraseniares = $('#txt-usu-contrasenia').val();
    contraseniarepres = $('#txt-usu-contrasenia-rep').val();
    if (!ruc) {
        alertify.error('Escribir el ruc');
    } else if (ruc.length < 13) {
        alertify.error('Escribir el Ruc con 001');
    } else if (!verificar_ruc(ruc)) {
        alertify.error('Escriba Correctamente el ruc ');
    } else if (!empresa) {
        alertify.error('Escribir el nombre completo de la Empresa');
    }else if(foto==""){
        alertify.error("Debe cargar una foto");
    } else if (!verificar_extension_imagen(foto)) {
        alertify.error('el formato de la imagen no es correcto ');
    }else if (!correo) {
        alertify.error('Escribir el email de la empresa');
    } else if (!verificar_correo(correo)) {
        alertify.error('El formato del correo es incorrecto');
    } else if (!celular) {
        alertify.error('Escriba el celular ');
    } else if (estado == 0) {
        alertify.error('Debe escoger un estado para la empresa');
    }else if(!provincia){
    alertify.error('Debe Seleccionar la provincia');
    }else if(!canton){
    alertify.error('Debe Seleccionar el canton');
    }else if(!parroquia){
    alertify.error('Debe seleccionar la parroquia');
    } else if (!direccion) {
    alertify.error('Escribir la Direccion de la empresa ');
    }else if(!calleprincipal){
    alertify.error('Debe seleccionar la calleprincipal');
    }else if(!callesecundaria){
    alertify.error('Debe seleccionar la callesecundaria');
    }else if(!referencia){
    alertify.error('Debe seleccionar la referencia');
    }else if(!numeracionoficina){
    alertify.error('Debe seleccionar la numerooficina');
    }else if (tipoempresa == 0) {
        alertify.error('Debe escoger un tipo de empresa');
    }else if(!verificar_extension_p12(rutaFirma.value)){
        alertify.error("El Formato del archivo es incorrecto debe cargar una extension .p12");
    }else if(rutaFirma.value == ""){
        alertify.error("Vericacion de Datos","CARGUE El ARCHIVO DE LA FIRMA ELECTRONICA:");
    }else if(!txtContrasenaFirma){
        alertify.error('Debe Colocar una Contraseña para el .P12');
    } else if (ambiente==0) {
        alertify.error('Escribir el tipo de ambiente');
    } else if (!correores) {
        alertify.error('Escribir el email del usuario');
    } else if (!verificar_correo(correores)) {
        alertify.error('El formato del correo es incorrecto');
    } else if (!correorepitares) {
        alertify.error('Escribir el email del usuario');
    } else if (!verificar_correo(correorepitares)) {
        alertify.error('El formato del correo es incorrecto');
    } else if (correorepitares != correores) {
        alertify.error('Los  correo no coinciden');
    } else if (contraseniares != contraseniarepres) {
        alertify.error('Las Contraseñas no coinciden');
    } else if (!direccionres) {
        alertify.error('Escribir la Direccion ');
    } else if (!telefonores) {
        alertify.error('Debe seleccionar el Telefono con 09 ');
    } else if (!usuariores) {
        alertify.error('Seleccionar un usuario');
    } else if (!contraseniares || !contraseniarepres) {
        alertify.error('Escriba una contraseña para el usuario');
    } else if (contraseniares != contraseniarepres) {
        alertify.error('Las contraseñas deben ser iguales');
    } else {
        confirmar();
    }
})
//verificar con span el ocultar o mostrar contraeeñas
document.querySelector('.campo span').addEventListener('click', e => {
    const passwordInput = document.querySelector('#txt-usu-contrasenia-rep');
    if (e.target.classList.contains('show')) {
        e.target.classList.remove('show');
        e.target.textContent = 'Ocultar';
        passwordInput.type = 'text';
    } else {
        e.target.classList.add('show');
        e.target.textContent = 'Mostrar';
        passwordInput.type = 'password';
    }
});

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
        url: '../controladores/registrarempresa.php',
        type: 'POST',
        data: datos,
        contentType: false,
        processData: false,
    }).done(function(r) {
        console.log(r);
      
        if (r == 1) {
            alertify.success("Registrada Empresa Correctamente");
            setTimeout(function() {
                window.location.href = "../app/crear-empresas.php";
            }, 1000);
        } else if (r == 2) {
            alertify.error('Alerta', 'La Cuenta de Empresa ya existe', '');
        } else if (r == 3) {
            alertify.error('Alerta', 'El email ya esta registrado', '');
        } else {
            alertify.alert(r);
        }
        
    })
}

function habilitar(datos) {
    d = datos.split('||');
    $('#txt-emp-idu').val(d[0]);
    $('#cmb-emp-estadou').val(d[15]);
    $('#frm-edit-empresas1').modal('hide');
}

function capturaremp(datos) {
    d = datos.split('||');
    $('#txt-emp-idu1').val(d[0]);
    $('#txt-emp-rucu').val(d[1]);
    $('#txt-emp-nombreu').val(d[2]);
    $('#txt-emp-correou').val(d[3]);
    $('#txt-emp-direccionu').val(d[4]);
    $('#txt-emp-telefonou').val(d[5]);
    $('#txtFoto').val(d[6]);
    imagen = $('#txtFoto').val();
    document.getElementById("imgArticulo").src = "../" + d[6];
    $('#cmb-emp-tipoempresau').val(d[7]);
    $('#txt-emp-provinciau').val(d[8]);
    $('#txt-emp-cantonu').val(d[9]);
    $('#txt-emp-parroquiau').val(d[10]);
    $('#txt-emp-calleprincipalu').val(d[11]);
    $('#txt-emp-callesecundariau').val(d[12]);
    $('#txt-emp-numerooficinau').val(d[13]);
    $('#txt-emp-referenciau').val(d[14]);
    $('#cmb-emp-estadou').val(d[15]);
    $('#txtRutaFirmau').val(d[16]);
    $('#txtContrasenaFirmau').val(d[17]);
    $('#cmb-tipoambiente').val(d[18]);

    $('#frm-edit-empresas').modal('hide');
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
        image.width = "70";
        image.height = "70";
        preview.innerHTML = '';
        preview.append(image);
    };
}

//recoger datos completos para ver la empresa
function detallar(emp_ruc){
  $.ajax({
    url: '../data/empresa/verinfo.php',
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

//recoger datso completos para saber la sucursal
function versucursales(emp_id){
$.ajax({
    url: '../data/empresa/versucursal.php',
    type:'POST',
    data:{emp_id:emp_id},
})
.done(function(r){
$('#ver-sucursal').html(r);
});
}
function imprimir_documentosuc(){
 
  var codigo=document.getElementById('codigo');
  var ventimp=window.open(' ','_blank');
  ventimp.document.write(codigo.innerHTML);
  ventimp.document.close();
  ventimp.print();
  ventimp.close(); 
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
    idu = $('#txt-emp-idu').val();
    empresau = $('#txt-emp-nombreu').val();
    rucu = $('#txt-emp-rucu').val();
    direccionu = $('#txt-emp-direccionu').val();
    correou = $('#txt-emp-correou').val();
    celularu = $('#txt-emp-telefonou').val();
    //foto=$('#txt-emp-img').val(); 
    provinciau = $('#txt-provinciau').val();
    cantonu = $('#txt-cantonu').val();
    parroquiau = $('#txt-parroquiau').val();
    calleprincipalu = $('#txt-emp-calleprincipalu').val();
    callesecundariau = $('#txt-emp-callesecundariau').val();
    numeracionoficinau = $('#txt-emp-numerooficinau').val();
    referenciau = $('#txt-emp-referenciau').val();
    //estadou=$('#cmb-emp-estadou').val(); 
    tipoempresau = $('#cmb-emp-tipoempresau').val();
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
        url: "../controladores/empresas/editarempresa.php",
        type: "POST",
        data: datos,
        contentType: false,
        processData: false,
    }).done(function(r) {
        //console.log(r);
        if (r==1) {
            alertify.success("Empresa Editado Correctamente");
            setTimeout(function() {
                window.location.href = "../app/crear-empresas.php";
            }, 1000);
        } else {
            alertify.error("No se modifico la empresa")
        }
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
$('#btn-guardarper').click(function() {
    idu = $('#txt-emp-idu').val();
    estadou = $('#cmb-emp-estadou').val();
    //tipoempresau=$('#cmb-emp-tipoempresau').val(); 
    if (estadou == 0) {
        alertify.error('debe escoger una ');
    } else {
        datos = $('#frm-edit-empresas1').serialize();
        $.ajax({
            url: '../controladores/empresas/estado.php',
            type: 'POST',
            data: datos,
        }).done(function(r) {
            if (r == 1) {
                alertify.success('Registro Correcto');
                setTimeout(function() {
                    window.location.href = "../app/crear-empresas.php";
                }, 1000);
            } else {
                alertify.alert('no se pudo registrar');
            }
        })
    }
})

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
    numero = document.getElementById('txt-emp-ruc').value;
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

function verificar_extension_p12(nombre_img){
    extensiones = ["p12"];
    res = nombre_img.lastIndexOf('.');
    extension = nombre_img.substring(res+1,nombre_img.length);
    if(extensiones.includes(extension)){
        return true;
    }else{
        return false;
    }
}
function verificar_extension_imagen(nombre_img){
  extensiones = ["jpg","png","jpeg"];
  res = nombre_img.lastIndexOf('.');
  extension = nombre_img.substring(res+1,nombre_img.length);
  if(extensiones.includes(extension)){
      return true;
  }else{
      return false;
  }
}

function previsualizar(e){
let reader = new FileReader();
reader.readAsDataURL(e.target.files[0]);
reader.onload = function(){
            image = document.createElement('img');

    image.src = reader.result;

    preview.innerHTML = '';
    preview.append(image);
  };

}

function verificar_ruc(documento) {

	var ruc=documento.substring(10,0);
  if (typeof(ruc) == 'string' && ruc.length == 10 && /^\d+$/.test(ruc)) {
    var digitos = ruc.split('').map(Number);
    var codigo_provincia = digitos[0] * 10 + digitos[1];

    if (codigo_provincia >= 1 && (codigo_provincia <= 24 || codigo_provincia == 30)) {
      var digito_verificador = digitos.pop();

      var digito_calculado = digitos.reduce(
        function (valorPrevio, valorActual, indice) {
          return valorPrevio - (valorActual * (2 - indice % 2)) % 9 - (valorActual == 9) * 9;
        }, 1000) % 10;
      return digito_calculado === digito_verificador;
}
  }
  return false;
}
/*
  rutaFirma.addEventListener('click',function(e){
    if(this.value!=""){
      if(!verificar_extension_p12(this.value)){
          alert("El Formato del archivo es incorrecto");
          this.value="";
      }
    }else{
        alertify.alert('Verificacion Archivo','Cargar el Archivo .p12');
    }
    
})*/

/*  function calcular_edad(fecha) {
    var hoy = new Date();
    var cumpleanos = new Date(fecha);
    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
    var m = hoy.getMonth() - cumpleanos.getMonth();
    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
      edad--;
    }
    return edad;
  }

  $('#txt-fecha').keyup(function(){
    alerta=$('.alerta');
    fecha=$('#txt-fecha').val();
    edad=calcular_edad(fecha);
    if (isNaN(edad)) {
      alerta.css('color','red');
      alerta.html('Fecha Incorrecta');
      $('#txt-edad').val(0);
    }else{

      if(edad<0){
        alerta.css('color','red');
        alerta.html('Edad negativa');
        $('#txt-edad').val(edad);
      }else if(edad<18){
        alerta.css('color','red');
        alerta.html('Es Menor de Edad');
        $('#txt-edad').val(edad);
      }else {
        alerta.html('');
        $('#txt-edad').val(edad);
      }
      
    }
    
  })
*/
