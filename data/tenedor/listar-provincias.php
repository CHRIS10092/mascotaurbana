<?php
require_once"../../clases/tenedor.php";
$obj = new tenedor();
$categorias = $obj->provincias();
?>
<select  name="provincia" id="txt-provincia" class="form-control" onchange="listar_cantones();" >
<option value="0">Seleccionar</option>
<?php foreach($categorias as $datos): ?>
<option value="<?php echo $datos['ID_PROVINCIA'] ?>"><?php echo $datos['PROVINCIA'] ?></option>
<?php endforeach ?>
</select>