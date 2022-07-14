<?php
//session_set_cookie_params(60 * 60 * 24 * 1) //para un dia
session_start();

if (isset($_SESSION['empresa'])) {

?>
<?php include 'contenido/head.php'; ?>
<center>
    <h2 class="green">
        <i class="ace-icon fa fa-home bigger-110">Formulario de Vacunas</i>

       
    </h2>
</center>
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-12">
       
    </div>
</div>
<div class="row">
                
<div class="col-sm-12 width-100">
    <div id="accordion" class="accordion-style1 panel-group">
                                                                                                                    <div class="panel panel-default" id="panel-motivo">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#vacunacion" aria-expanded="true">
                                <i class="bigger-110 ace-icon fa fa-angle-down" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i><i class="icon-i-immunizations bigger-100 blue"></i>
                                Vacunación
                            </a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse in" id="vacunacion" aria-expanded="true" style="">
                            <div class="row">
            <div class="col-xs-12">
                                                        
                    <svg style="display: none;">
    <symbol id="injection" viewBox="0 0 44.805 44.805">
        <path d="M17.05,21.816l6.958,6.504L15.333,37.6l-6.957-6.505l1.823-1.95l1.722,1.609l0.853-0.913l-1.721-1.61l2.732-2.922
		l1.653,1.545l0.854-0.912l-1.653-1.545L17.05,21.816z M24.363,17.586l-1.683-1.574l-0.854,0.913l1.681,1.573L24.363,17.586z
		 M27.508,14.036l-1.683-1.574l-0.854,0.913l1.684,1.573L27.508,14.036z M37.416,9.345L35.2,11.714l4.914,4.594L15.601,42.525
		l-5.161-4.822L4.69,43.85l-4.333,0.955l8.246-8.82l-5.059-4.729L28.059,5.038l5.465,5.109l2.214-2.367l-4.784-4.469L34.051,0
		l10.396,9.711l-3.098,3.311L37.416,9.345z M33.832,13.176l-9.92,10.61l2.329,2.176l-1.321,1.412l-6.96-6.504l1.322-1.412
		l2.956,2.762l9.92-10.611l-4.006-3.744L6.372,31.162l9.133,8.536l21.781-23.296L33.832,13.176z"></path>
    </symbol>
    <symbol id="syringe3" viewBox="0 0 46.457 46.457">
        <path d="M42.154,18.254h1.504V14.95H30.372l1.35-2.373l-5.438-3.094L31.676,0L28.07,1.75l-3.762,6.611l-5.55-3.157L2.722,33.396
		l5.284,3.006l-1.449,2.547l-4.23-2.405l-2.028,3.562l11.176,6.352l2.027-3.561l-5.143-2.924l1.447-2.547l5.877,3.344l14.601-25.664
		v3.148h1.965l-3.715,5.624v22.55h17.625v-22.57L42.154,18.254z M15.007,38.305l-4.305-2.449l6.49-11.408l3.177,1.806l0.866-1.521
		l-7.483-4.251L12.886,22l2.504,1.424L8.9,34.831l-3.713-2.112L19.435,7.67l9.821,5.585L15.007,38.305z M44.158,44.428H30.533
		V24.479l4.111-6.225h5.053l4.461,6.244V44.428z M32.033,26.053h7.5v16.913h-7.5V26.053z M14.354,19.457l5.674-9.979l7.48,4.255
		l-1.191,2.099l-1.853-1.054l-0.56,0.981l1.853,1.055l-1.788,3.141l-1.776-1.01l-0.561,0.981l1.778,1.012l-1.577,2.773
		L14.354,19.457z M16.852,27.984l1.809,1.029l-0.559,0.981l-1.809-1.029L16.852,27.984z M14.835,31.764l1.809,1.029l-0.559,0.98
		l-1.809-1.029L14.835,31.764z"></path>
    </symbol>
    <symbol id="syringe" viewBox="0 0 30.29 30.29">
        <path style="fill: #000" d="M4.468,20.44l5.38,5.38l12.238-12.24l-5.381-5.379L4.468,20.44z M10.019,24.567l-4.297-4.3
		L16.624,9.368l4.295,4.299L10.019,24.567z M16.985,4.986l8.316,8.325l-0.984,0.983L16,5.969L16.985,4.986z M30.29,7.336
		l-0.811,0.811l-1.46-1.461l-4.065,4.065L19.54,6.333l4.063-4.062l-1.46-1.459L22.954,0L30.29,7.336z M5.547,22.95l1.792,1.791
		L0.718,30.29L0,29.57L5.547,22.95z M8.374,17.639l2.691,2.69l-1.006,1.007l-2.691-2.689L8.374,17.639z M10.856,15.158l2.692,2.69
		l-1.007,1.008l-2.692-2.69L10.856,15.158z M13.258,12.757l2.691,2.688l-1.008,1.009l-2.691-2.687L13.258,12.757z M15.385,10.63
		l2.689,2.69l-1.006,1.007l-2.69-2.69L15.385,10.63z"></path>
    </symbol>
    <symbol id="syringe2" viewBox="0 0 511.999 511.999">
        <rect x="85.797" y="202.892" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -132.6311 244.9836)" width="287.217" height="159.398"></rect>
        <rect x="99.917" y="237.002" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -166.7381 230.8618)" width="190.778" height="159.398"></rect>
        <rect x="427.761" y="6.51" transform="matrix(-0.7071 0.7071 -0.7071 -0.7071 809.0594 -205.2141)" style="fill:#EFEEEE;" width="38.541" height="116.889"></rect>
        <rect x="337.017" y="89.511" transform="matrix(-0.7071 0.7071 -0.7071 -0.7071 755.5229 -75.9258)" style="fill:#EFEEEE;" width="112.939" height="57.999"></rect>
        <rect x="238.744" y="153.761" transform="matrix(0.7071 0.7071 -0.7071 0.7071 220.273 -192.2962)" style="fill:#EFEEEE;" width="207.028" height="31.968"></rect>
        <path d="M144.805,312.553c-2.56,0-5.118-0.976-7.071-2.929c-3.905-3.905-3.905-10.237,0-14.142l59.737-59.736
	c3.905-3.904,10.236-3.905,14.142,0c3.905,3.905,3.905,10.237,0,14.142l-59.737,59.736
	C149.924,311.577,147.364,312.553,144.805,312.553z"></path>
        <polygon style="fill:#EFEEEE;" points="104.232,360.519 94.707,417.293 150.645,406.932 "></polygon>
        <path style="fill: #000" d="M509.072,85.584L426.413,2.928c-3.905-3.905-10.237-3.904-14.142,0L385.02,30.179c-3.905,3.905-3.905,10.237,0,14.142
	l13.751,13.751l-65.719,65.719l-38.025-38.026c-0.004-0.004-0.007-0.006-0.011-0.01l-7.581-7.581
	c-1.875-1.875-4.419-2.929-7.071-2.929s-5.196,1.054-7.071,2.929l-22.605,22.605c-3.905,3.905-3.905,10.237,0,14.142l9.768,9.768
	L64.428,320.717c-3.905,3.905-3.905,10.237,0,14.143l29.089,29.089l-8.143,48.536L2.93,494.928c-3.905,3.905-3.905,10.237,0,14.143
	c1.952,1.952,4.512,2.928,7.071,2.928s5.119-0.976,7.071-2.929l82.51-82.51l47.709-8.838l29.848,29.848
	c1.953,1.953,4.512,2.929,7.071,2.929s5.119-0.977,7.071-2.929l196.028-196.026l9.768,9.768c1.953,1.953,4.512,2.929,7.071,2.929
	c2.559,0,5.119-0.977,7.071-2.929l22.605-22.605c1.875-1.875,2.929-4.419,2.929-7.071s-1.054-5.196-2.929-7.071l-45.619-45.62
	l65.719-65.719l13.75,13.751c1.953,1.953,4.512,2.929,7.071,2.929c2.559,0,5.119-0.977,7.071-2.929l27.253-27.252
	c1.875-1.875,2.929-4.419,2.929-7.071S510.947,87.459,509.072,85.584z M106.933,404.858l3.95-23.544l19.247,19.247L106.933,404.858z
	 M284.508,326.061l-21.446-21.447c-3.906-3.906-10.237-3.904-14.142,0c-3.905,3.905-3.906,10.237,0,14.142l21.446,21.447
	l-20.122,20.122L200.96,311.04c-3.906-3.905-10.237-3.905-14.142,0s-3.906,10.237,0,14.142l49.284,49.285l-20.07,20.07
	l-21.446-21.446c-3.905-3.905-10.237-3.905-14.143,0s-3.905,10.237,0,14.143l21.446,21.446l-17.679,17.679l-26.479-26.479
	c-0.006-0.006-0.01-0.013-0.016-0.019l-46.413-46.412c-0.004-0.004-0.008-0.006-0.011-0.01l-25.65-25.65L206.4,207.029
	l98.571,98.571L284.508,326.061z M353.377,257.193l-21.447-21.447c-3.905-3.904-10.237-3.904-14.143,0
	c-3.905,3.905-3.905,10.237,0,14.143l21.447,21.447l-20.121,20.121l-98.571-98.571l54.054-54.055l98.571,98.572L353.377,257.193z
	 M404.149,240.1L271.901,107.849l8.463-8.463l72.88,72.881l13.749,13.75c0.003,0.003,0.007,0.006,0.01,0.009l45.088,45.089
	c0.002,0.002,0.003,0.003,0.005,0.005l0.517,0.517L404.149,240.1z M374.064,164.804l-2.67-2.671l-24.198-24.2l65.716-65.716
	l25.862,25.858l1.01,1.01L374.064,164.804z M474.747,105.765l-13.739-13.739c-0.004-0.004-0.008-0.009-0.012-0.013l-8.738-8.737
	L406.233,37.25l13.109-13.109l68.516,68.514L474.747,105.765z"></path>
    </symbol>
</svg>


    <link href="/bundles/hcuevacunacion/css/style.css" type="text/css" rel="stylesheet" media="screen">
    <div id="tabs" class="panel-body">
        <div class="row">
    <div class="col-md-12 width-100">
        <div class="row">
    <div class="col-md-12 width-100">
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">
                Iconografía
            </legend>
            <div class="row">
                <div class="col-md-3" style="padding-bottom: 5px;">
                    <div class="btn-edadoptima injection_div tooltip-info" style="width: 30px; height: 30px; display: inline-block" data-rel="tooltip" data-placement="top" title="" data-original-title="Edad ideal de aplicación de la vacuna, por lo tanto se debe de proceder a su aplicación.">
                        <svg style="display: inline-block; width: 15px;height: 15px;">
                            <use xlink:href="#injection"></use>
                        </svg>
                    </div>
                    Vacuna óptima para la edad
                </div>
                <div class="col-md-3" style="padding-bottom: 5px;">
                    <div class="btn-success injection_div tooltip-info" style="width: 30px; height: 30px; display: inline-block" data-rel="tooltip" data-placement="top" title="" data-original-title="Vacuna que ha sido aplicada y registrada en la historia clinica electrónica.">
                        <svg style="display: inline-block; width: 15px;height: 15px; fill: white">
                            <use xlink:href="#injection"></use>
                        </svg>
                    </div>
                    Vacuna administrada
                </div>
                <div class="col-md-3" style="padding-bottom: 5px;">
                    <div class="btn-danger injection_div tooltip-info" style="width: 30px; height: 30px; display: inline-block" data-rel="tooltip" data-placement="top" title="" data-original-title="Vacuna que no ha sido aplicada oportunamente y por lo tanto se debe de proceder a su aplicación.">
                        <svg style="display: inline-block; width: 15px;height: 15px; fill: white">
                            <use xlink:href="#injection"></use>
                        </svg>
                    </div>
                    ¡ALERTA ¡
                </div>
                <div class="col-md-3" style="padding-bottom: 5px;">
                    <div class="btn-default injection_div tooltip-info" style="width: 30px; height: 30px; display: inline-block" data-rel="tooltip" data-placement="bottom" title="" data-original-title="Vacuna que no ha sido registrada en la historia clínica, si ha sido aplicada anteriormente se procede a su actualización en el sistema, de lo contrario se deber de proceder a la aplicación y registro.">
                        <svg style="display: inline-block; width: 15px;height: 15px;fill: white">
                            <use xlink:href="#injection"></use>
                        </svg>
                    </div>
                    Vacuna no registrada
                </div>
                <div class="col-md-3" style="padding-bottom: 5px;">
                    <div class="btn-actualizada injection_div tooltip-info" style="width: 30px; height: 30px; display: inline-block" data-rel="tooltip" data-placement="bottom" title="" data-original-title="Vacuna que ha sido aplicada anteriormente en el mismo u otro establecimiento de salud y que no fue registrada en la historia clínica electrónica de manera oportuna.">
                        <svg style="display: inline-block; width: 15px;height: 15px;fill: white">
                            <use xlink:href="#injection"></use>
                        </svg>
                    </div>
                    Vacuna actualizada
                </div>
                <div class="col-md-3" style="padding-bottom: 5px;">
                    <div class="btn-soloactualizar injection_div tooltip-info" style="width: 30px; height: 30px; display: inline-block" data-rel="tooltip" data-placement="bottom" title="" data-original-title="Vacuna que no puede ser aplicada, sólo se procede a actualizar el registro en la historia clínica electrónica, en caso de que haya sido aplicada anteriormente.">
                        <svg style="display: inline-block; width: 15px;height: 15px;fill: white">
                            <use xlink:href="#injection"></use>
                        </svg>
                    </div>
                    Solo actualización
                </div>
                <div class="col-md-3" style="padding-bottom: 5px;">
                    <div class="btn-warning injection_div tooltip-info" style="width: 30px; height: 30px; display: inline-block" data-rel="tooltip" data-placement="bottom" title="" data-original-title="Vacuna no puede ser aplicada, contraindicado por ESAVI Grave">
                        <svg style="display: inline-block; width: 15px;height: 15px;fill: white">
                            <use xlink:href="#injection"></use>
                        </svg>
                    </div>
                    ¡Advertencia!
                </div>
            </div>
        </fieldset>
    </div>
</div>

<style>
    fieldset.scheduler-border {
        border: 1px groove #d5e3ef !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow: 0px 0px 0px 0px #000;
        box-shadow: 0px 0px 0px 0px #000;
    }

    legend.scheduler-border {
        font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
        color: #478fca;
        font-size: 14px;
        font-weight: lighter;
        text-align: left;
        width: auto;
        padding: 10px;
        margin-bottom: 0px;
        border-bottom: none;
    }
</style>

<script type="text/javascript">
    $(function () {
        $('[data-rel="tooltip"]').tooltip();
    });
</script>
    </div>
    
            </div>
    </div>  
        <script type="text/javascript">
    var paciente_id = parseInt('0');
    var especialidad_id = parseInt('665');
    var atencion_id = parseInt('0');
    var view = "new";
    var date = new Date();
    var dia = (date.getDate() <= 9) ? '0' + date.getDate() : date.getDate();
    var mes = parseInt(date.getMonth()) + 1
    var siguientemes = ((mes + 1) > 12) ? 1 : mes + 1;
    mes = (mes <= 9) ? '0' + mes : mes;
    siguientemes = (siguientemes <= 9) ? '0' + siguientemes : siguientemes;
    var hoy = dia + '-' + mes + '-' + date.getFullYear();
    var messiguiente = dia + '-' + siguientemes + '-' + date.getFullYear();
    var datatablenew = "";
    var datatableupdate = "";
    var formatofecha = "dd-mm-yyyy";

    function add(esquemavacunacion_id, puesta) {
        var divh = $("<div/>").modalViewer({
            url: '/hcue/vacunacion/add/' + paciente_id + '/' + especialidad_id + '/' + atencion_id + '/' + esquemavacunacion_id + '/' + puesta,
            width: '60%',
            title: 'Registro de Vacunación',
            buttons: {
                Close: {caption: 'Cerrar', 'class': '', click: null},
            }
        });

        $(divh).modalViewer('show');
    }

    function editarVacunacion(id, esquemavacunacion_id) {
        var divh = $("<div/>").modalViewer({
            url: '/hcue/vacunacion/edit/' + id + '/' + paciente_id + '/' + especialidad_id + '/' + atencion_id + '/' + esquemavacunacion_id,
            width: '60%',
            title: 'Editar Vacunación',
            buttons: {
                Close: {caption: 'Cerrar', 'class': '', click: null},
            }
        });

        $(divh).modalViewer('show');
    }

    function deleteVacunacion(id) {
        $.confirm('Esta seguro que desea eliminar la Vacunación?', function (result) {
            if (result) {
                $.processWait.show();
                $.ajax({
                    url: '/hcue/vacunacion/delete/' + id,
                    type: "POST",
                    success: function (data) {
                        $.processWait.hide();
                        if (data.status) {
                            $.gritter.add({
                                title: 'Información!',
                                text: data.message,
                                time: 3000,
                                class_name: 'gritter-success gritter-light'
                            });
                            $('#tabs').empty().load('/hcue/vacunacion/tabs/undefined/665');
                        } else {
                            $.alert(data.message, "danger");
                        }
                    }
                });
            }
        })
    }

    function saveVacunacion(data, id,view, esquemavacunacion_id) {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "/hcue/vacunacion/save/" + id + '/' + view + '/' + paciente_id + '/' + esquemavacunacion_id,
            data: data,
            success: function (json) {
                $.processWait.hide();
                var status = json.status;
                if (status > 0) {
                    var classgritter = (status==2) ? 'gritter-error gritter-light' : 'gritter-success gritter-light';
                    $.gritter.add({
                        title: 'Información!',
                        text: json.message,
                        time: 3000,
                        class_name: classgritter
                    });
//                    limpiar();
                    $('.modal-footer .btn-sm').click();
                    $('#tabs').empty().load('/hcue/vacunacion/tabs/undefined/665');
                } else {
                    $.alert(json.message, 'danger');
                }
            }
        });
    }

    function historyVacunacion() {
        var divh = $("<div/>").modalViewer({
            url: '/hcue/vacunacion/history/undefined',
            width: '90%',
            title: 'Historial de Vacunación',
            buttons: {
                Close: {caption: 'Cerrar', 'class': '', click: null},
            }
        });

        $(divh).modalViewer('show');
    }

    function imgEsquemavacunacion() {
        var divh = $("<div/>").modalViewer({
            url: '/hcue/vacunacion/imageev',
            width: '90%',
            title: 'Imagen del esquema de vacunación',
            buttons: {
                Close: {caption: 'Cerrar', 'class': '', click: null},
            }
        });

        $(divh).modalViewer('show');
    }

    function validedVacunacion(esquemavacunacion_id, puesta) {
        var response = true;
        $.ajax({
            url: '/hcue/vacunacion/valided/' + esquemavacunacion_id + '/' + paciente_id + '/' + puesta,
            type: "POST",
            async: false,
            success: function (data) {
                if (data.status) {
                    response = false;
                    $.gritter.add({
                        title: 'Información!',
                        text: data.message,
                        time: 3000,
                        class_name: 'gritter-error gritter-light'
                    });
                } else {
                    add(esquemavacunacion_id, puesta);
                }
            }
        });

        return response;
    }
    function reenviarCertificadoByEmail(paciente_id,correo){
        $.processWait.show();
         $.ajax({
                url: '/hcue/vacunacion/forwardingmailcertificado',
                async: false,
                type: "POST",
                data: {'paciente_id':paciente_id}
            }).done(function (json) {
                var gritter = 'gritter-error gritter-light';
                if(json.status){
                    gritter = 'gritter-success gritter-light';
                    $.gritter.add({
                        title: 'Información!', text:'Certificado enviado de manera exitosa al correo: '+correo+'',
                        time: 3000,
                        class_name: gritter
                    });
                }else{
                    $.gritter.add({
                        title: 'Información!', text:'Error al enviar certificado',
                        time: 3000,
                        class_name: gritter
                    });
                }
                $.processWait.hide();
            });
            
    }
    function pointandscript(obj) {
        obj.keyup(function (e) {
            var specialChars = "\"¡!@#$^&%*()+=[]\/{}|ºª:·<>¿?,;´`'¬\\ _çÇ~½¨";
            var cadena = $(this).val();
            for (var i = 0; i < specialChars.length; i++) {
                cadena = cadena.replace(new RegExp("\\" + specialChars[i], 'gi'), '');
            }
            $(this).val(cadena)
        });
    }

    $(function () {
        $.include_once('modalViewer');
        $.include_once('jquery.chosen');
    });

    function viewPacienteCampana(esquemavacunacion_id, paciente_id) {
        var divh = $("<div/>").modalViewer({
            url: '/hcue/vacunacion/historycampana/' + esquemavacunacion_id + '/' + paciente_id,
            width: '90%',
            title: 'Detalle Vacunación Esquema Campaña',
            buttons: {
                Close: {caption: 'Cerrar', 'class': '', click: null},
            }
        });

        $(divh).modalViewer('show');
    }

</script>
    

                    </div>
                </div>
                        </div>
</div>
            </div>
<?php include 'contenido/foot.php'; ?>
<?php } else {
	header("location: ../");
}
?>