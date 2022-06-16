<?php

session_start();

if (isset($_SESSION["usuario"])) {
    require_once ".././app/contenido/head.php";
    require_once "../clases/mascotas.php";
    require_once "../app/contenido/librerias/phpqrcode/qrlib.php";
    $obj      = new mascotas();
    $mascotas = $obj->ReporteQr();
    $empresas = $obj->empresas();
    foreach ($empresas as $d) {
        //$logo=$d[6];
    }
    ?>

<h2>imprimir codigo qr</h2>
<button class="btn btn-primary" onclick="printDiv('contenidoe')">IMPRIMIR</button>
<hr>
<div class="row">
    <div class="col-md-9">
        <div id="contenidoe">
        <table class="table" >
    <tr >
    <th></th>
    <th></th>
    <th></th>
    </tr>
    <?php foreach ($mascotas as $datos):

    ?>

    <tr>
        <td></td>
        <td>
            <div style="border:solid 1px;">
                <img height="50px" width="50px" src="../<?php echo $d['emp_logo'] ?>" class="img-circle"  >
                <center><?php echo $datos['mas_codigo'] ?><br>
                <?php echo $datos['mas_codigo_qr'] ?><hr style="
    padding-top: 0px;
    margin-top: 0px;
    margin-bottom: 3px;
">
 <?php

    $dir       = "../codigosQr/";
    $filename  = $dir . $datos['mas_codigo'] . ".png";
    $tam       = "2";
    $level     = "H";
    $frameSize = 3;
    $contenido = "\tcodigo: " . $datos['mas_codigo'] .
        "\n\t nombre mascota: " . $datos['mascota'] .
        " \n\t sexo: " . $datos['mas_sexo'] .
        "\n\t raza: " . $datos['idraza'] .
        "\n\t Tipo Mascota: " . $datos['mas_tipo'] .

        "\n\t esterelizado: " . $datos['mas_esterilizado'] .
        "\n\t nombre Tenedor: " . $datos['idtenedor'] .
        "\n\t nombre Tenedor: " . $filename;

    Qrcode::png($contenido, $filename, $level, $tam, $frameSize);

    ?>
<img src="<?php echo $filename; ?>">
            </center>
            </div>
        </td>
        <td></td>
    </tr>

    <?php endforeach?>
</table>

</div>
    </div>
</div>


 <?php
require_once ".././app/contenido/foot.php";
    ?>
 <script type="text/javascript">
    function printDiv(contenidoe) {
     var contenido= document.getElementById(contenidoe).innerHTML;
     var contenidoOriginal= document.body.innerHTML;

     document.body.innerHTML = contenido;

     window.print();

     document.body.innerHTML = contenidoOriginal;
}

 </script>
  <?php } else {

}
?>
