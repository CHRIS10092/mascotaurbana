<?php 
require_once'../../clases/usuario.php';
$adchb_data=new usuario(); 
?>
<select class="form-control" id="cmb-usuario" name="usuario"  onchange="listarempresa();">
	<option value="0">Seleccionar</option>
	<?php echo $adchb_data->ListarUsuario(); ?>
</select>



