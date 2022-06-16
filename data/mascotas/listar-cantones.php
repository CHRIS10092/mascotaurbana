<?php
require_once"../../clases/mascotas.php";
$obj = new mascotas();
$categorias = $obj->cantones();
?>
<select  name="canton" id="txt-canton" class="form-control"  >
<option value="0">Seleccionar</option>
<?php foreach($categorias as $datos): ?>
<option value="<?php echo $datos['id_mas'] ?>"><?php echo $datos['descripcion'] ?></option>
<?php endforeach ?>
</select>