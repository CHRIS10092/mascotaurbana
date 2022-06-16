<?php
//session_start();
require_once("../../clases/mascotas.php");
$obj = new mascotas();

?>
<div class="table-responsive">

    <table id="tbl-listadom" class="table table-responsive">
        <thead>

            <tr>

                <th>Cédula</th>
                <th>Nombre</th>
                <th>Sexo </th>
                <th>Fecha</th>
                <th>Color</th>
                <th>Coloru</th>
                <th>Tipo</th>
                <th>Raza</th>
                <th>Descripción</th>
                <th>Imagen</th>
                <th>Tenedor</th>

                <th>Acciones</th>
            </tr>

        </thead>
        <tbody>
            <?php echo $obj->listadomascotas() ?>
        </tbody>


    </table>
</div>
<script type="text/javascript">
$('#tbl-listadom').DataTable({});
</script>