<?php
require_once "../../clases/tenedor.php";
$obj = new tenedor();

if (isset($_POST['idcanton'])) {

    $listarparro = $obj->listarparroquias($_POST['idcanton']);

//$_POST['$idprovincia'];

    ?>

<select  name="parroquia" id="txt-parroquia" class="form-control" >
<option value="0">Seleccionar</option>
<?php foreach ($listarparro as $datos): ?>
<option value="<?php echo $datos['ID_PARROQUIA'] ?>"><?php echo $datos['PARROQUIA'] ?></option>
<?php endforeach?>
</select>


<?php } else {?>


<select  name="parroquia" id="txt-parroquia" class="form-control" >
<option value="0">Seleccionar</option>

</select>

  <?php }?>

