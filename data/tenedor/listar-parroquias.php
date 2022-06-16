<?php
require_once"../../clases/tenedor.php";
$obj = new tenedor();
$categorias = $obj->parroquias();
?>
<select  name="parroquia" id="txt-parroquia" class="form-control" >
<option value="0" >Seleccionar</option>
<?php foreach($categorias as $datos): ?>
<option value="<?php echo $datos['ID_PARROQUIA'] ?>"><?php echo $datos['PARROQUIA'] ?></option>
<?php endforeach ?>
</select>