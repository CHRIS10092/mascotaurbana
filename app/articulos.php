<?php
session_start();
if (isset($_SESSION['usuario'])) {
    ?>
<?php include 'contenido/head.php';?>
<div class="col-md-12 col-sm-12 widget-container-col ui-sortable" id="widget-container-col-4">
	<div class="widget-box ui-sortable-handle" id="widget-box-4">
		<div class="widget-header widget-header-large">
			<h4 class="widget-title">Catalogo de Articulos</h4>

			<div class="widget-toolbar">
				<a href="agregar_articulo.php" class="btn btn-primary btn-xs">
					<i class="glyphicon glyphicon-plus"></i> Nuevo
				</a>
			</div>
		</div>

		<div class="widget-body">
			<div class="widget-main">
        <div id="correcto"></div>
				<div id="listado"></div>
			</div>
		</div>
	</div>
</div>
<?php include 'contenido/foot.php';?>
<script src="../js/articulo.js"></script>
<?php } else {
    header("location: ../");
}
?>
