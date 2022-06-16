<?php
session_start();
if (isset($_SESSION['usuario'])) {
    ?>
    <?php include 'contenido/head.php'; ?>
    <h2 class="blue"><b>FACTURAS</b></h2>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Numero factura</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody id="tbldetalle"></tbody>
            </table>
        </div>
    </div>

    <?php include 'contenido/foot.php'; ?>
    <script src="../js/entregachips.js"></script>
<?php } else {
	header("location: ../");
}
?>