<?php 
session_start();
require_once "../../clases/guia.php";
$dat= new Guia();
$datos=$dat->Listar_Cedulas();
//print_r($datos);

foreach($datos as $row){             ?>
<select name="cedula" id="txt-cedula" onchange=listar_lotes();>
<option value="0">Selecionar</option>
<option value="<?php echo $row['tra_cedula']?>"> <?php echo $row["tra_cedula"] ?></option>
</select>

<?php } ?>