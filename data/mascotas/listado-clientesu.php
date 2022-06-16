<?php
require_once '../../clases/mascotas.php';

$objeto = new mascotas();
$obj    = $objeto->listar_clientes();
?>
<select class="form-control" id="cmb-tenedorun" name="tenedor">
	    <option value="0">--Elegir--</option>
	<?php foreach ($obj as $datos): ?>
		<option value="<?php echo $datos["ten_cedula"]; ?>"><?php echo $datos["ten_primer_nombre"]; ?></option>
	<?php endforeach?>
</select>
