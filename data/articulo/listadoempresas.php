<?php
require_once "../../clases/inventario_empresas.php";
$obj = new inventario();

?>

<table id="tablaempresa" class="table table-responsive" style="width: 100%">

    <thead>

        <th>Id</th>
        <th>Código</th>
        <th>Nombre</th>
        <th>descripción</th>
        <th>Stock</th>
        <th>Costo Compra</th>
        <th>Precio Unitario</th>
        <th>Categoria</th>
        <th>Ssubcategoria</th>
        <th>Imagen</th>
        <TH></TH>

    </thead>

    <tbody>
        <?php echo $obj->ListarArticulos($_SESSION['empresa']['idempresa']); ?>
    </tbody>



</table>

<script type="text/javascript">
$('#tablaempresa').DataTable({
     language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    },
});
</script>