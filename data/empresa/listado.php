<?php
require_once '../../clases/empresas.php';
$obj = new empresa();
?>
<table id="tbl-usuario" class="table table-striped table-hover">
    <thead>
        <tr class="info">
            <th>RUC</th>
            <th>NOMBRE</th>
            <th>CORREO</th>
            <th>DIRECCION</th>
            <th>TELEFONO</th>
            <th>LOGO</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php echo $obj->Listar(); ?>
    </tbody>
</table>
<script type="text/javascript">
$('#tbl-usuario').DataTable({});
</script>