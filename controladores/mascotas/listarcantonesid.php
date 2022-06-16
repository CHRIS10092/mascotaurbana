<?php 
require_once("../../clases/mascotas.php");
$obj  = new mascotas();

if(isset($_POST['idprovincia'])){


$listarpro=$obj->listarcantones($_POST['idprovincia']);


//$_POST['$idprovincia'];


 ?>

 <select  name="canton" id="txt-canton" class="form-control" >
<option value="0">Seleccionar</option>
<?php foreach($listarpro as $datos): ?>
<option value="<?php echo $datos['id_mas'] ?>"><?php echo $datos['descripcion'] ?></option>
<?php endforeach ?>
</select>
<?php } else { ?>


<select  name="canton" id="txt-canton" class="form-control" >
<option value="0">Seleccionar</option>

</select>

  <?php } ?>

