<?php
require_once "../../clases/distribuir.php";
$obj=new  distribuir();
$datos = $obj->listar_tipos();
?>
<select id="cmbTipo" class="form-control">
	<option value="0">seleccionar</option>
	<?php foreach($datos as $dato):?>
		<option value="<?php echo  $dato["id_tipo"]?>">
			<?php echo  $dato["descripcion"]?>		
		</option>
	<?php endforeach;?>
</select>