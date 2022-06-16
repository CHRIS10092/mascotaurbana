<?php

require_once("../../clases/nueva_venta.php");
$obj=new nueva_venta();

//guardarle la varible a un array la consulta 
$categorias=($obj->Traer_Categoria());




  ?>
  <select  id="cmb-categoria"  name="categoria" onchange="Traersubcategorias();"> 
  <option value="0">Seleccionar</option>
<?php foreach ($categorias as  $datos): ?>
<!-- llamar al combo box los dts de la consulta -->
<option value="<?php echo $datos['id'] ?>">
<?php echo $datos['rol'] ?>

	</option>	
<?php endforeach ?>
  </select>	