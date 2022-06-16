<?php 
require_once'../../clases/usuario.php';
$adchb_data=new usuario(); 
?>
<select class="form-control" id="cmb-perfil" name="perfil">
	<option value="0">Seleccionar</option>
	<?php echo $adchb_data->ListarRoles(); ?>
</select>