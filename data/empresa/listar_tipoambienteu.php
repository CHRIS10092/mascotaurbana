<?php

require_once "../../clases/empresas.php";
//instancio la clase
$obj = new empresa();
//llamo al metodo de la clase empresa tipo ambiente
$tipoambiente = $obj->tipoambienteu();
//genero un foreach para recorrer los campos del ambiente
?>

 <select name="tipoambienteu" id="cmb-tipoambienteu" class="form-control">

 <?php foreach ($tipoambiente as $datos) {?>
<option value=" <?php echo $datos['amb_id'] ?> "> <?php echo $datos['amb_descripcion'] ?></option>
 	<?php }?>
 </select>
