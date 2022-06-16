<?php
require_once "../../clases/mascotas.php";
$obj        = new mascotas();
$categorias = $obj->provincias();
?>
<select  name="provincia" id="txt-provincia" class="form-control" onchange="listar_cantones();" >

<?php foreach ($categorias as $datos): ?>
<option value="<?php echo $datos['id_especie'] ?>"><?php echo $datos['descripcion'] ?></option>
<?php endforeach?>
</select>