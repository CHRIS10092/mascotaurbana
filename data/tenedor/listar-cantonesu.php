<?php
require_once "../../clases/tenedor.php";
$obj        = new tenedor();
$categorias = $obj->cantonesu($_POST['provincia']);
?>
<select  name="cantonu" id="txt-cantonu" class="form-control" onchange="listarparroquiasu();">
<?php foreach ($categorias as $datos): ?>
<option value="<?php echo $datos['ID_CANTON'] ?>"><?php echo $datos['CANTON'] ?></option>
<?php endforeach?>
</select>