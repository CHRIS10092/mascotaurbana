<?php
require_once "../../clases/empresas.php";
$obj        = new empresa();
$categorias = $obj->tipoempresa();
?>
<select  name="emp-tipoempresa" id="cmb-emp-tipoempresa" class="form-control"  >
<option value="0">Seleccionar</option>
<?php foreach ($categorias as $datos): ?>
<option value="<?php echo $datos['ser_id'] ?>"><?php echo $datos['ser_descripcion'] ?></option>

<?php endforeach?>
</select>
