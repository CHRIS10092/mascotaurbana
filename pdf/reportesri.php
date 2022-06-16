<?php
require_once "../clases/enviosri.php";

$obj       = new enviosri();
$buscarmas = $obj->ConsultarFactu($_GET['da']);

?>



<style>

.img1{


          height:180px ;
          width:180px ;
          border-radius:100px;
          margin-top: 20;
    }

.img2{


          height:100px ;
          width:100px ;
          border-radius:100px;
          margin-top: 20;
    }

.contenido{
    display: inline-block;
    border: 1px solid skyblue;
    width: 720px;
    height: 390px;

}

.contenido1{
    display: inline-block;
    border: 1px solid black;
    width: 720px;
    height: 103px;
    margin-top: 0px;
}

.contenido2{
    display: inline-block;
    border: 1px solid black;
    width: 720px;
    height: 433px;
    margin-top: 0px;
}
.contenido3{
    display: inline-block;
    border: 1px solid black;
    width: 720px;
    height: 53px;
    margin-top: 0px;
}


.contenidoimg{
float: left;
}


.div1derecha{
     display: inline-block;
    float: right;
    padding-right: 111px;
     border: 1px solid blue;
      width: 290px;
    height: 390px;

}

.div1arribaizq{
 display: inline-block;
    float: left;
    padding-right: 111px;
     border: 1px solid red;
      width: 200px;
    height: 180px;

}

.div1aabajoizq{

    display: inline-block;

    margin-top: 199px;
    border: 1px solid green;
    width: 310px;
    height: 190px;

}

.izquierda{
display: inline-block;
float: left;
border: 1px solid red;
width: 200;
height: 30;
}
.derecha{
      display: inline-block;
    float: right;
    padding-right: 111px;
     border: 1px solid blue;
      width: 250;
    height: 40px;
}
.tabla2{
       font-family: sans-serif;
       font-size: 8;
}

.tipoletra{
       font-family: sans-serif;
       font-size: 8;
}
</style>

<div class="contenido">


<!--PRIMER DIV -->
    <div class="div1derecha">
<label class="tipoletra">Ruc </label><BR><BR>
<label class="tipoletra">FACTURA </label><BR>
<BR>
<label class="tipoletra">Nº </label><BR><BR>
<label class="tipoletra">NUMERO DE AUTORIZACION  </label><BR>
<BR>
<label class="tipoletra">FECHA Y HORA DE AUTORIZACION  </label><BR><BR>
<label class="tipoletra">AMBIENTE  </label><BR><BR>
<label class="tipoletra">EMISION  </label><BR><BR>
<label class="tipoletra">CLAVE DE ACCESO  </label><BR>
    </div>
    <div class="div1arribaizq">
<img  src="../imagenes/empresa3.jpg" width="300px" height="200px">
<!--<img  src="../imagenes/empresa3.jpg" width="300px" height="200px">-->
    </div>
<div class="div1aabajoizq">

<label class="tipoletra">NOMBRE </label><BR><BR>
<label class="tipoletra">DIRECCION DE MATRIZ </label><BR>
<BR>
<label class="tipoletra">DIRECCION SUCURSAL </label><BR>
<label class="tipoletra">CONTRUBUYENTE ESPECIAL </label><BR>
<label class="tipoletra">OBLIGADO A LLEVAR CONTABILIDAD  </label><BR>

    </div>

</div>
<!--FIN DEL PRIMER DIV -->

<!--SEGUNDO DIV -->
<br>
<div class="contenido1">
<p style="margin-top: 0px"> <strong style="color: red;margin-top:0px;font-size: 10" >Razon Social: hrisjdj</strong>

    <p style="font-size: 10;margin-top: 0px"> Identificacion: 1723348 </p>

    <span style="float:left;margin-right: 100px; font-size: 10" id="factTelefono">Fecha: <?php echo "09-01-2000"; ?></span>
    <span style="float:left;margin-left: 1px;font-size: 10" id="factTelefono">Placa: </span>
    <span style="float:right;margin-right: 118px;font-size: 10" id="factCiudad">Guia:</span>
<p style="font-size: 10;margin-top: 20px"> Direccion </p>

</div>
<!--FIN DEL SEGUNDO DIV -->

<!--SEGUNDO DIV -->
<br>
<div class="contenido2">

<table class="tabla2" border="1" width="100%">
    <tr>
        <th>CodigoP</th>
        <th>C.Aux</th>
        <th>Cantidad</th>
        <th>Descripcion</th>
        <th>Detalle Aux</th>
        <th>Precio u.</th>
        <th>Subsidio</th>
        <th>Precio Sin Subsidio</th>
        <th>Descuento</th>
        <th>Precio Total</th>
    </tr>
    <tr>
        <th>010</th>
        <th></th>
        <th>1.00</th>
        <th>jjjfue dfjdf</th>
        <th></th>
        <th>22.3</th>
        <th>0.00</th>
        <th>0.00</th>
        <th>0.00</th>
        <th>22.3</th>
    </tr>
     <tr>
        <th>010</th>
        <th></th>
        <th>1.00</th>
        <th>jjjfue dfjdf</th>
        <th></th>
        <th>22.3</th>
        <th>0.00</th>
        <th>0.00</th>
        <th>0.00</th>
        <th>22.3</th>
    </tr>
     <tr>
        <th>010</th>
        <th></th>
        <th>1.00</th>
        <th>jjjfue dfjdf</th>
        <th></th>
        <th>22.3</th>
        <th>0.00</th>
        <th>0.00</th>
        <th>0.00</th>
        <th>22.3</th>
    </tr>
     <tr>
        <th>010</th>
        <th></th>
        <th>1.00</th>
        <th>jjjfue dfjdf</th>
        <th></th>
        <th>22.3</th>
        <th>0.00</th>
        <th>0.00</th>
        <th>0.00</th>
        <th>22.3</th>
    </tr>
     <tr>
        <th>010</th>
        <th></th>
        <th>1.00</th>
        <th>jjjfue dfjdf</th>
        <th></th>
        <th>22.3</th>
        <th>0.00</th>
        <th>0.00</th>
        <th>0.00</th>
        <th>22.3</th>
    </tr>
   <tr>
        <th>010</th>
        <th></th>
        <th>1.00</th>
        <th>jjjfue dfjdf</th>
        <th></th>
        <th>22.3</th>
        <th>0.00</th>
        <th>0.00</th>
        <th>0.00</th>
        <th>22.3</th>
    </tr>   <tr>
        <th>010</th>
        <th></th>
        <th>1.00</th>
        <th>jjjfue dfjdf</th>
        <th></th>
        <th>22.3</th>
        <th>0.00</th>
        <th>0.00</th>
        <th>0.00</th>
        <th>22.3</th>
    </tr>   <tr>
        <th>010</th>
        <th></th>
        <th>1.00</th>
        <th>jjjfue dfjdf</th>
        <th></th>
        <th>22.3</th>
        <th>0.00</th>
        <th>0.00</th>
        <th>0.00</th>
        <th>22.3</th>
    </tr>   <tr>
        <th>010</th>
        <th></th>
        <th>1.00</th>
        <th>jjjfue dfjdf</th>
        <th></th>
        <th>22.3</th>
        <th>0.00</th>
        <th>0.00</th>
        <th>0.00</th>
        <th>22.3</th>
    </tr>


</table>
<table class="tabla2" border="1" style="float: right;">
<tr>
    <td colspan="7">SUBTOTAL 12%</td>
    <td colspan="4">S</td>
</tr>
<tr>
    <td colspan="7">SUBTOTAL 0%</td>
    <td colspan="4">S</td>
</tr>
<tr>
    <td colspan="7">SUBTOTAL NO OBJETO DE IVA</td>
    <td colspan="4">S</td>
</tr>
<tr>
    <td colspan="7">SUBTOTAL EXENTO DE IVA</td>
    <td colspan="4">S</td>
</tr>
<tr>
    <td colspan="7">SUBTOTAL SIN IMPUESTOS</td>
    <td colspan="4">S</td>
</tr>
<tr>
    <td colspan="7">TOTAL DESCUENTO</td>
    <td colspan="4">S</td>
</tr>
<tr>
    <td colspan="7">ICE</td>
    <td colspan="4">S</td>
</tr>
<tr>
    <td colspan="7">IVA 12% </td>
    <td colspan="4">S</td>
</tr>
<tr>
    <td colspan="7">IRBPNR</td>
    <td colspan="4">S</td>
</tr>
<tr>
    <td colspan="7">PROPINA</td>
    <td colspan="4">S</td>
</tr>
<tr>
    <td colspan="7">VALOR TOTAL</td>
    <td colspan="4">S</td>
</tr>


</table>

<div style="float: left;">
<p class="tipoletra">FORMA DE PAGO<p>
<P class="tipoletra">01 - SIN UTILIZACION DEL SISTEMA FINANCIERO </P>
VALOR:
</div>
</div>
<!--FIN DEL SEGUNDO DIV -->
<br>
