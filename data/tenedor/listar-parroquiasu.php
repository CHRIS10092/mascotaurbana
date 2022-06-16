<?php
require_once"../../clases/tenedor.php";
$obj = new tenedor();
$categorias = $obj->parroquiasu($_POST['canton']);
?>
<select  name="parroquiau" id="txt-parroquiau" class="form-control" >
<?php foreach($categorias as $datos): ?>
<option value="<?php echo $datos['ID_PARROQUIA'] ?>"><?php echo $datos['PARROQUIA'] ?></option>
<?php endforeach ?>
</select>