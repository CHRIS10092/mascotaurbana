<?php
require_once "../../clases/sucursales.php";
$obj        = new sucursal();
$categorias = $obj->listadoempresasu();
?>
<select  name="emp-tipoempresau" id="cmb-emp-tipoempresau" class="form-control"  >
<option value="0">Seleccionar</option>
<?php foreach ($categorias as $datos): ?>
<option value="<?php echo $datos['emp_id'] ?>"><?php echo $datos['emp_nombre'] ?></option>

<?php endforeach?>
</select>
