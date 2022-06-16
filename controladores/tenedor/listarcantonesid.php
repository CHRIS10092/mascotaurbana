<?php
require_once "../../clases/tenedor.php";
$obj = new tenedor();

if (isset($_POST['idprovincia'])) {

    $listarpro = $obj->listarcantones($_POST['idprovincia']);

//$_POST['$idprovincia'];

    ?>

 <select  name="canton" id="txt-canton" class="form-control" onchange="listarparroquias();" >
<option value="0">Seleccionar</option>
<?php foreach ($listarpro as $datos): ?>
<option value="<?php echo $datos['ID_CANTON'] ?>"><?php echo $datos['CANTON'] ?></option>
<?php endforeach?>
</select>
<?php } else {?>


<select  name="canton" id="txt-canton" class="form-control" >
<option value="0">Seleccionar</option>

</select>

  <?php }?>

