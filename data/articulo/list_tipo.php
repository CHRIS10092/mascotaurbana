<?php
require_once"../../clases/articulo.php";
$obj = new articulo();
$categorias = $obj->listartipo();
?>
<select  name="tipoarticulo" id="cmb-tipoarticulo" class="form-control" >
<option value="0">Seleccionar</option>
<?php foreach($categorias as $datos): ?>
<option value="<?php echo $datos['id_tipo'] ?>"><?php echo $datos['descripcion'] ?></option>
<?php endforeach ?>
</select>