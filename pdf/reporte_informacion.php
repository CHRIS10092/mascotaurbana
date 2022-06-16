<?php
require_once '../clases/usuario.php';
$obj = new usuario();

$tenedor  = $obj->obtener_tenedor($_GET['correo'], $_GET['cedula']);
$mascotas = $obj->obtener_mascotas($tenedor->cedula);
?>
<style type="text/css">
	*{
		margin-left:2px;
		margin-right: 2px;
		margin-top:2px;
	}
	.panel-tenedor{
		border: 1px solid;
		display: inline-block;
		width: 68%;
		margin-bottom: 0px;

	}

	.titulo1-tenedor{
		font-size: 14px;
		font-weight: 100;
		margin: 5px;
		color: #31708f;
	}
	.des-tenedor{
		color: #777;
		text-align: right;
	}
</style>
<div style="text-align: center;">
	<img src="../imagenes/logocomprasegura.jpg" width="100px" height="100px">
	<br>
</div><br><br>
<img style="margin-top: -50px;" src="../<?php echo $tenedor->foto; ?>" width="210px">
<div class="panel-tenedor">
	<div style="margin-top: 0px;margin-left: 0px;margin-right: 0px">
		<h4 style="text-align: center;background: #ddd;margin: 0px;height: 3%;padding-top:10px: ">TENEDOR</h4>
		<div style="margin-top: 5px">
			<h4 class="titulo1-tenedor">Identificacion: <span class="des-tenedor"><?php echo $tenedor->cedula; ?></span> Provincia: <span class="des-tenedor"><?php echo $tenedor->provincia ?></span></h4>
			<h4 class="titulo1-tenedor">Nombres y Apellidos: <span class="des-tenedor"><?php echo $tenedor->primer_nombre ?> <?php echo $tenedor->segundo_nombre ?> <?php echo $tenedor->apellido_paterno ?> <?php echo $tenedor->apellido_materno ?></span> Canton: <span class="des-tenedor"><?php echo $tenedor->canton ?></span></h4>
			<h4 class="titulo1-tenedor">Fecha de Nacimiento: <span class="des-tenedor"><?php echo $tenedor->fecha ?></span> Parroquia: <span class="des-tenedor"><?php echo $tenedor->parroquia ?></span></h4>
			<h4 class="titulo1-tenedor">Correo Electronico: <span class="des-tenedor"><?php echo $tenedor->correo ?></span> Barrio: <span class="des-tenedor"><?php echo $tenedor->barrio ?></span></h4>
			<h4 class="titulo1-tenedor">Numero de Celular: <span class="des-tenedor"><?php echo $tenedor->celular ?></span> Calle Principal: <span class="des-tenedor"><?php echo $tenedor->calle_principal ?></span></h4>
			<h4 class="titulo1-tenedor">Calle Secundaria: <span class="des-tenedor"><?php echo $tenedor->calle_secundaria ?></span></h4>
			<h4 class="titulo1-tenedor">Numero de Casa: <span class="des-tenedor"><?php echo $tenedor->numero_casa ?></span></h4>
			<h4 class="titulo1-tenedor">Referencia Casa: <span class="des-tenedor"><?php echo $tenedor->referencia_casa ?></span></h4>
		</div>
	</div>

</div>

<h4 style="text-align: center;background: #ddd;margin: 0px;height: 3%;padding-top:10px: ">MASCOTAS</h4>
<br>
	<table style="width: 100%;font-size: 13px">
		<thead>
			<tr style="background: #d9edf7">
				<th>Codigo</th>
				<th>Nombre</th>
				<th>Sexo</th>
				<th>Fecha de Nacimiento</th>
				<th>Colores</th>
				<th>Esterilizado?</th>
				<th>Tipo</th>
				<th>Raza</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($mascotas as $datos): ?>
				<tr>
					<td><?php echo $datos['mas_codigo']; ?></td>
					<td><?php echo $datos['mas_nombre']; ?></td>
					<td><?php echo $datos['mas_sexo']; ?></td>
					<td><?php echo $datos['mas_fecha']; ?></td>
					<td>
						<p><?php echo $datos['mas_color']; ?></p>
						<p><?php echo $datos['mas_color_secundario']; ?></p>
					</td>
					<td><?php echo $datos['mas_esterilizado']; ?></td>
					<td><?php echo $datos['tipo']; ?></td>
					<td><?php echo $datos['raza']; ?></td>
					<td>
						<img src="../<?php echo $datos['mas_imagen']; ?>" width="50px">
						<br>
						<img src="../<?php echo $datos['mas_codigo_qr']; ?>" width="60px">

					</td>
				</tr>
			<?php endforeach?>
		</tbody>
	</table>

