  <?php

require_once "../../clases/mascotas.php";
$obj       = new mascotas();
$listarpro = $obj->listarcantones($_POST['idprovincia']);
?>
<select  name="canton" id="txt-canton" class="form-control" >

<?php foreach ($listarpro as $datos): ?>
<option value="<?php echo $datos['id_mas'] ?>"><?php echo $datos['descripcion'] ?></option>
<?php endforeach?>
</select>
