<?php 
session_start();
if (isset($_SESSION['usuario'])) {
 ?>
<?php include 'contenido/head.php';?>

    <form id="frmEnviar">
        <div id="list-categorias"></div>
        <button class="btn btn-primary" type="submit">Buscar</button>
    </form>
    <hr>
    <div id=carga-report></div>
    




<?php include 'contenido/foot.php';?>
<script src="../js/reporte.js"></script>
<?php } else {
    header("location: ../");
}
?>

