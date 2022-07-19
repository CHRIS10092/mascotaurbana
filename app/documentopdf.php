<?php 

$numero=$_GET['ruc'];

require_once "../clases/reporteModel.php";
$obj       = new ReporteModel();
$pdf = $obj->ConsultarFactu($numero);
$datos = $obj->detalle_factura($numero);
//print_r($datos);

?>
<br>
<style>
	.uno{
		color:red;
	}
	.contenido{
    display: inline-block;
    border: 1px solid black;
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


.div1derecha{
     display: inline-block;
    float: right;
    padding-right: 111px;
     border: 1px solid black;
      width: 290px;
    height: 390px;

}

.div1arribaizq{
 display: inline-block;
    float: left;
    padding-right: 111px;
     border: 1px solid ;
      width: 200px;
    height: 180px;

}

.div1aabajoizq{

    display: inline-block;

    margin-top: 11px;
    border: 1px solid ;
    width: 310px;
    height: 190px;

}
.tabla2{
       font-family: sans-serif;
       font-size: 8px;
}

.tipoletra{
       font-family: sans-serif;
       font-size: 8px;
}
</style>



<!--<p class="uno"><?php echo $pdf->numero?></p>-->


<div class="contenido">


<!--PRIMER DIV -->
    <div class="div1derecha">
<label class="tipoletra">Ruc:<?php echo $datos->ruc?>  </label><BR><BR>
<label>Factura</label>
<label class="tipoletra">No.<?php echo '001'.'-'.'001'.'-'.$datos->numero_venta?> </label><BR>
<BR>

<label class="tipoletra">NUMERO DE EMISION:<?php echo $datos->numero_emision?>  </label><BR>
<BR>
<label class="tipoletra">FECHA Y HORA DE AUTORIZACION<?php echo $datos->fecha?>  </label><BR><BR>
<label class="tipoletra">AMBIENTE  PRUEBAS</label><BR><BR>
<label class="tipoletra">EMISION: NORMAL  </label><BR><BR>
<label class="tipoletra">CLAVE DE ACCESO  </label><BR><BR><BR>
<?php echo $datos->numero_emision;?> 
<!--<img src="barcode.php?text=233223"></img>-->
<br>
<br>

	
    </div>
    <div class="div1arribaizq">
<img  src="../../imagenes/logocomprasegura.jpg" width="300px" height="200px">
<!--<img  src="../imagenes/empresa3.jpg" width="300px" height="200px">-->
    </div>
<div class="div1aabajoizq">

<label class="tipoletra">NOMBRE <?php echo $datos->nombre_ruc?></label><BR><BR>
<label class="tipoletra">DIRECCION DE MATRIZ <?php echo $datos->nombre_ruc?> </label><BR>
<BR>
<label class="tipoletra">DIRECCION SUCURSAL <?php echo $datos->direccion?></label><BR>
<label class="tipoletra">CONTRUBUYENTE ESPECIAL </label><BR>
<label class="tipoletra">OBLIGADO A LLEVAR CONTABILIDAD: NO  </label><BR>

    </div>

</div>
<!--FIN DEL PRIMER DIV -->

<!--SEGUNDO DIV -->
<br>
<div class="contenido1">
<p style="margin-top: 0px"> <strong style="color: black;margin-top:0px;font-size: 10" >Razon Social:<?php echo $datos->nombre_cliente ?> </strong>

    <p style="font-size: 10;margin-top: 0px"> Identificacion: <?php echo $datos->ruc_cliente ?> </p>

    <span style="float:left;margin-right: 100px; font-size: 10" id="factTelefono">Fecha: <?php echo $datos->fecha ?></span>
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
        
        <th><?php echo $datos->id_articulo?></th>
        <th><?php echo $datos->id_articulo?></th>
        <th><?php echo $datos->cantidad_articulo?></th>
        <th><?php echo $datos->nombre_articulo?></th>
        <th><?php echo $datos->detalle_articulo?></th>
		<th><?php echo $datos->precio?></th>
        
        <th><?php echo '0.00'?></th>
        <th><?php echo '0.00'?></th>
		<th><?php echo $datos->descuento_articulo?></th>
		<th><?php echo $datos->precio?></th>
    </tr>
	


</table>
<table class="tabla2" border="1" style="float: right;">
<tr>
    <td colspan="7">SUBTOTAL 12%</td>
    <td colspan="4"><?php echo $pdf->subtotal?></td>
</tr>
<tr>
    <td colspan="7">SUBTOTAL 0%</td>
    <td colspan="4">0.00</td>
</tr>
<tr>
    <td colspan="7">SUBTOTAL NO OBJETO DE IVA</td>
    <td colspan="4">0.00</td>
</tr>
<tr>
    <td colspan="7">SUBTOTAL EXENTO DE IVA</td>
    <td colspan="4">0.00</td>
</tr>
<tr>
    <td colspan="7">SUBTOTAL SIN IMPUESTOS</td>
    <td colspan="4"><?php echo $pdf->total?></td>
</tr>
<tr>
    <td colspan="7">TOTAL DESCUENTO</td>
    <td colspan="4">0.00</td>
</tr>
<tr>
    <td colspan="7">ICE</td>
    <td colspan="4">0.00</td>
</tr>
<tr>
    <td colspan="7">IVA 12% </td>
    <td colspan="4"><?php echo $pdf->iva?></td>
</tr>
<tr>
    <td colspan="7">IRBPNR</td>
    <td colspan="4">0.00</td>
</tr>
<tr>
    <td colspan="7">PROPINA</td>
    <td colspan="4">0.00</td>
</tr>
<tr>
    <td colspan="7">VALOR TOTAL</td>
    <td colspan="4"><?php echo $pdf->total?></td>
</tr>


</table>

<div style="float: left;">
<p class="tipoletra">FORMA DE PAGO<p>
<P class="tipoletra">01 - SIN UTILIZACION DEL SISTEMA FINANCIERO </P>
VALOR: <?php echo $pdf->total?>
</div>
</div>
<!--FIN DEL SEGUNDO DIV -->
<br>
