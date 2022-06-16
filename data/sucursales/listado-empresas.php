<?php
require_once "../../clases/sucursales.php";
$obj        = new sucursal();
$categorias = $obj->listadoempresas();
?>
<select  name="emp-tipoempresa" id="cmb-emp-tipoempresa" class="form-control"  >
<option value="0">Seleccionar</option>
<?php foreach ($categorias as $datos): ?>
<option value="<?php echo $datos['emp_id'] ?>"><?php echo $datos['emp_nombre'] ?></option>

<?php endforeach?>
</select>
