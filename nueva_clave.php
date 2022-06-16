<?php
if (isset($_GET['xir2sde9890d45sdebWES1Q'])) {

    require_once 'controladores/recuperar/verificar.php';
    $obj = new Verificar;

    if ($obj->comprobar_correo($_GET['xir2sde9890d45sdebWES1Q'])) {
        ?>
		<!DOCTYPE html>
		<html>
		<head>
			<title></title>
			<link rel="stylesheet" href="app/contenido/assets/css/bootstrap.min.css" />
			<link rel="stylesheet" href="app/contenido/assets/font-awesome/4.5.0/css/font-awesome.min.css" />
			<link rel="stylesheet" href="app/contenido/librerias/alertifyjs/css/alertify.css">
	        <link rel="stylesheet" href="app/contenido/librerias/alertifyjs/css/themes/semantic.css">
		</head>
		<body>
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" >MASCOTA URBANA</a>
					</div>
				</div>
			</nav>
			<div class="container">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<div id="alertas"></div>
					<br><br>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3>Nueva Clave de Acceso</h3>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12">
									<form id="frmCambiar"><br><br>
										<div class="row">
											<label class="col-md-5">Nueva Clave de Usuario</label>
											<div class="col-md-7">
												<input type="password" name="clave" id="txtClave" class="form-control input-lg">
											</div>
										</div><br>
										<div class="row">
											<label class="col-md-5">Repita la Nueva Clave de Usuario</label>
											<div class="col-md-7">
												<input type="password" id="txtRepitaClave" class="form-control input-lg">
											</div>
										</div>
										<br><br>
										<div class="row">
											<div class="col-md-5"></div>
											<div class="col-md-7">
												<button id="btn-cambiar" class="btn btn-primary btn-block btn-lg">Cambiar</button>
											</div>
										</div>

									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</body>
		<script src="app/contenido/assets/js/jquery-2.1.4.min.js"></script>
		<script src="app/contenido/assets/js/bootstrap.min.js"></script>
		<script src="app/contenido/librerias/alertifyjs/alertify.js"></script>
		<script src="js/nueva_clave.js"></script>
		</html>
		<?php
} else {
        header("location: /mascotaurbana/login1.php");
    }
} else {
    header("location: /mascotaurbana/login1.php");
}
?>


