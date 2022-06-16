<?php
require_once "../../clases/tenedor.php";
$obj = new tenedor();

if (isset($_POST['idcantonu'])) {

    $listarparro = $obj->listarparroquiasu($_POST['idcantonu']);

//$_POST['$idprovincia'];

    ?>

<select  name="parroquiau" id="txt-parroquiau" class="form-control" >
<option value="0">Seleccionar</option>
<?php foreach ($listarparro as $datos): ?>
<option value="<?php echo $datos['ID_PARROQUIA'] ?>"><?php echo $datos['PARROQUIA'] ?></option>
<?php endforeach?>
</select>


<?php } else {?>


<select  name="parroquiau" id="txt-parroquiau" class="form-control" >
<option value="0">Seleccionar</option>

</select>

  <?php }?>

