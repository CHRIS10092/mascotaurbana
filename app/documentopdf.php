<?php 
//require_once '../modelos/ModelConsultas.php';
$codigo=$_GET['ruc'];
$numero=$_GET['venta'];

require_once "../clases/reporteModel.php";

//print_r($_GET['buscar']);

$obj       = new ReporteModel();
$pdf = $obj->ConsultarFactu($numero);
/*$empresa=detalle_empresa();
foreach ($empresa as $datos) {
	$ruc=$datos[1];
	$razon=$datos[2];
	$telefono=$datos[3];
	$correo=$datos[4];
	$direccion=$datos[5];
	$logo=$datos[6];
}
$cliente=datos_cliente($codigo);
foreach ($cliente as $datos1) {
	$ruc1=$datos1[1];
	$razon1=$datos1[2];
	$telefono1=$datos1[3];
	$correo1=$datos1[5];
	$direccion1=$datos1[6];
}
$cabecera=datos_ultima_factura($codigo);
foreach ($cabecera as $datos2) {
	$folio=$datos2[0];
	$total=$datos2[1];
	$subtotal=$datos2[2];
	$iva=$datos2[3];
	$fecha=$datos2[4];
}
$detalle=detalle_ultima_factura($folio);
*/
?>
<!DOCTYPE html>
<html>
<head>
	<title>Factura</title>
</head>
<body>

	
	<div  style="border:solid 1px blue; border-radius: 6px;width:710px;padding-left: 8px;">
		 <img style="float: right;padding:0;border: none;margin-right: 15px;margin-top: 12px;"src="<?php echo '../imagenes/logocomprasegura.jpg';?>" width="100px" height="80px">
	<center><span style="color: blue;font-weight: bold;font-style: cursive;"><?php echo $pdf->numero;?></span>
    </center>
		<br>
	<span style="font-size: 10pt; margin-top:0px;color: blue; ">
		RUC: <?php echo $pdf->numero;?>	
	</span><br>
	<span style="font-size: 10pt;margin-top:0px;color: blue; ">
		DIRECCION: <?php echo $pdf->numero;?>
    </span><br>
    <span style="font-size: 10pt;margin-top:0px;color: blue; ">
		TELEFONO: <?php echo $pdf->numero;?>
    </span><br>
    <span style="font-size: 10pt;margin-top:0px;color: blue; ">
		CORREO: <?php echo $pdf->numero;?>
    </span>
    </div><br>
    <div style="border:solid 1px blue; border-radius: 6px;width:190px;float: right;padding-top: 15px;padding-right: 14px;margin-right: 3px;margin-left: 2px;">
	<center><span style="color:black;font-weight: bold;">FACTURA</span></center>
		<center><span style="font-size: 12pt; margin-top:0px;color: red;font-weight: bolder; ">
			<?php echo $pdf->numero;?>	
		</span></center>
		<center><span style="color:black;font-weight: bold;">FECHA DE EMISION</span>
    </center>
		<center>
			<span style="font-size: 12pt; margin-top:0px;color:red;font-weight: bolder; ">
			 <?php echo $pdf->numero;?>	
		</span>
		</center>
	</div>
	<div style="border:solid 1px blue; border-radius: 6px;width:490px;padding-left: 8px;">
		<span style="font-size: 10pt; margin-top:0px;color: blue; ">
			CLIENTE: <?php echo $pdf->numero;?>	
		</span><br>
		<span style="font-size: 10pt; margin-top:0px;color: blue; ">
			RUC: <?php echo $pdf->numero;?>	
		</span><br>
		<span style="font-size: 10pt;margin-top:0px;color: blue; ">
			DIRECCION: <?php echo $pdf->numero;?>
		</span><br>
		<span style="font-size: 10pt;margin-top:0px;color: blue; ">
			TELEFONO: <?php echo $pdf->numero;?>
		</span><br>
		<span style="font-size: 10pt;margin-top:0px;color: blue; ">
			CORREO: <?php echo $pdf->numero;?>
		</span>
	</div>



		<br> 	


		<div style="width: 800px;padding: 2px;">
			<div style="width: 500px;float: left;">
				<table style="width: 100%;text-align: center;">
					<tr style="background:blue;color:#fff; ">
						<th style="font-size: 12pt;">CANTIDAD</th>
						<th style="font-size: 12pt;">DETALLE</th>
						<th style="font-size: 13pt;">V.UNITARIO</th>
						<th style="font-size: 13pt;">V.TOTAL</th>
					</tr>
					
						
					<tr>
						<td>
							<span style="font-size: 13pt;color:gray;font-weight: bolder;"><?php echo 1; ?></span>
						</td>
						<td>
							<span style="font-size: 13pt;color:gray;font-weight: bolder;"><?php echo 2; ?></span>
						</td>
						<td>
							<span style="font-size: 13pt;color:gray;font-weight: bolder;"><?php echo 3; ?></span>
						</td>
						<td>
							<span style="font-size: 13pt;color:gray;font-weight: bolder;"><?php echo 5; ?></span>
						</td>
					</tr>
					
				</table>

			</div>
			<div style="width: 287px;float: right;margin-left: 16px;">
				<table style="border:solid 1px blue;width: 70%;border-radius: 6px;padding-left:18px;">

					<tr style="border-bottom:solid 2px blue;">
						<td>
							<span style="font-size: 13pt;color: blue;border-bottom:solid 2px blue;">SUBTOTAL</span><br>
							<span  style="font-size: 12pt;color: gray;"><?php echo 11; ?></span>
						</td>
					</tr>
					<tr>
						<td>
							<span style="font-size: 13pt;color: blue;border-bottom:solid 2px blue;">IVA 12%</span><br>
							<span style="font-size: 12pt;color: gray;"><?php echo 1.20; ?></span>

						</td>
					</tr>
					<tr>
						<td>
							<span style="font-size: 13pt;color: blue;border-bottom:solid 2px blue;">TOTAL</span>
							<span style="color:gray"><?php echo 12.20; ?></span>
						</td>
					</tr>
				</table>
			</div>

		</div>
<br><br><br><br><br>
		
	</body>
	</html>
