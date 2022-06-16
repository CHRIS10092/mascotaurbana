<?php
require_once "../../clases/tenedor.php";
$obj = new tenedor();

if (isset($_POST['idprovinciau'])) {

    $listarpro = $obj->listarcantonesu($_POST['idprovinciau']);

//$_POST['$idprovincia'];

    ?>

 <select  name="cantonu" id="txt-cantonu" class="form-control" onchange="listarparroquiasu();" >
<option value="0">Seleccionar</option>
<?php foreach ($listarpro as $datos): ?>
<option value="<?php echo $datos['ID_CANTON'] ?>"><?php echo $datos['CANTON'] ?></option>
<?php endforeach?>
</select>
<?php } else {?>


<select  name="cantonu" id="txt-cantonu" class="form-control" >
<option value="0">Seleccionar</option>

</select>

  <?php }?>

