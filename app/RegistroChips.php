<?php
session_start();
if (isset($_SESSION['usuario'])) {
    ?>
    <?php include 'contenido/head.php'; ?>
    <h2 class="blue"><b>REGISTRAR CHIPS A MASCOTAS</b></h2>
    <hr>
    <div class="row">
        <div class="col-md-12">
           
        </div>
    </div>

    <?php include 'contenido/foot.php'; ?>
    <script src=""></script>
<?php } else {
	header("location: ../");
}
?>