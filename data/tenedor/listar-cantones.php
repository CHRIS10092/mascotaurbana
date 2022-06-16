<?php
require_once"../../clases/tenedor.php";
$obj = new tenedor();
$categorias = $obj->cantones();
?>
<select  name="canton" id="txt-canton" class="form-control"  >
<option value="0">Seleccionar</option>
<?php foreach($categorias as $datos): ?>
<option value="<?php echo $datos['ID_CANTON'] ?>"><?php echo $datos['CANTON'] ?></option>
<?php endforeach ?>
</select>