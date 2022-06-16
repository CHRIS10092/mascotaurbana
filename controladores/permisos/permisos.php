<?php 

require_once '../../clases/usuario.php';
$obj = new usuario();
//si esta reg en la tbla permisos
$ver=$obj->verificarusuarios($_POST['id_usuario']);

if($ver) { ?>
<?php 
$idempresa=$obj->listarempresa($_POST['id_usuario']);	
$empresaord=$obj->listarempresaordenada($idempresa);
 ?> 
<select class="form-control" id="cmb-empresa" name="empresa">
	
	<?php 
foreach ($empresaord as $datos ) { ?>


		<option value="<?php echo $datos['emp_id']; ?>"> <?php echo $datos['emp_nombre']; ?></option>

		


<?php }  ?>
</select>
<?php 
}else{ 
$verificar=$obj->verificarper();
?>
<select class="form-control" id="cmb-empresa" name="empresa">
	<option value="0">Seleccionar</option>
	<?php 
foreach ($verificar as $datos ) { ?>


		<option value="<?php echo $datos['emp_id']; ?>"> <?php echo $datos['emp_nombre']; ?></option>

		


<?php }  ?>
</select>

<?php }  ?>



<?php 
//print_r($_POST['id_usuario']);
?>