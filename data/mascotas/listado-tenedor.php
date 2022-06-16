<?php
require_once("../../clases/mascotas.php");
$obj = new mascotas();

?>
<div class="table-responsive">
    <table id="tbl-tenedorm" class="table table-responsive table-hover dataTable no-footer"
        style="height: 100%; width: 90%;">

        <thead>
            <tr>

                <th>CEDULA</th>
                <th>NOMBRE</th>
                <th>APELLIDO</th>
                <th>ACCION</th>

            </tr>
        </thead>

        <tbody>

            <?php echo $obj->listadotenedor(); ?>
        </tbody>

    </table>
</div>
<script type="text/javascript">
$('#tbl-tenedorm').DataTable({});
</script>