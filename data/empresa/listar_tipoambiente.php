<?php

require_once "../../clases/empresas.php";
//instancio la clase
$obj = new empresa();
//llamo al metodo de la clase empresa tipo ambiente
$tipoambiente = $obj->tipoambiente();
//genero un foreach para recorrer los campos del ambiente
?>

 <select name="tipoambiente" id="cmb-tipoambiente" class="form-control">
 	<option value="0">Seleccionar</option>
 <?php foreach ($tipoambiente as $datos) {?>
<option value=" <?php echo $datos['amb_id'] ?> "> <?php echo $datos['amb_descripcion'] ?></option>
 	<?php }?>
 </select>