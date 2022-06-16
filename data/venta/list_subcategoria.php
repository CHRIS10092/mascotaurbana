<?php

require_once("../../clases/nueva_venta.php");
$obj=new nueva_venta();

//guardarle la varible a un array la consulta 
$subcategorias=($obj->Traer_subcategoria($_GET['id']));




  ?>
  <select id="cmb-subcategoria" name="sub_categoria"> 
  
<?php foreach ($subcategorias as  $datos): ?>
<!-- llamar al combo box los dts de la consulta -->
<option value="<?php echo $datos['emp_id'] ?>">
<?php echo $datos['emp_nombre'] ?>

	</option>	
<?php endforeach ?>
  </select>	