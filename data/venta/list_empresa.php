<?php
require_once"../../clases/nueva_venta.php";
$obj = new nueva_venta();
$categorias = $obj->listarempresas();
?>
<select  name="empresas" id="txt-empresas" class="form-control"  >
<option value="0">Seleccionar</option>
<?php foreach($categorias as $datos): ?>
<option value="<?php echo $datos['emp_id'] ?>"><?php echo $datos['emp_nombre'] ?></option>
<?php endforeach ?>
</select>