<style type="text/css">
.panel {
    border-radius: 8px 8px 8px 8px;
    border: 1px solid #c6c6c6;
    border-collapse: collapse;
    padding: 20px;
    width: 95%;
}
</style>
<?php
require_once '../../clases/empresas.php';
$adchb_data = new empresa();
?>
<div id="codigo">
    <div style="border-radius:8px 8px 8px 8px ;
		border: 1px solid #c6c6c6;
		border-collapse: collapse;
		padding: 20px;display: inline-flex;width: 95%;">
        <?php echo $adchb_data->DatosMascota($_POST['emp_ruc']); ?>
    </div><br><br>



</div><br><br>
<center>
    <button class="btn btn-primary" onclick="imprimir_documento()">
        <i class="fa fa-print"></i> Imprimir
    </button>

</center>