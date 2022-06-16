<?php
require_once "../../clases/inventario_empresas.php";
$obj = new inventario();

?>

<table id="tablaempresa" class="table table-responsive" style="width: 100%">

    <thead>

        <th>ID</th>
        <th>CODIGO</th>
        <th>NOMBRE</th>
        <th>DESCRIPCION</th>
        <th>STOCK</th>
        <th>VALOR COMPRA</th>
        <th>VALOR PVP</th>
        <th>CATEGORIA</th>
        <th>SUBCATEGORIA</th>

        <th>IMAGEN</th>
        <TH>ACCIONES</TH>

    </thead>

    <tbody>
        <?php echo $obj->ListarArticulos($_SESSION['empresa']['idempresa']); ?>
    </tbody>



</table>

<script type="text/javascript">
$('#tablaempresa').DataTable({

});
</script>