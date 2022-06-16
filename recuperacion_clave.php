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
					<h3>Recuperar Clave de Acceso</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<form id="frmRecuperar"><br>
								<div class="row">
									<label class="col-md-4">Correo Registrado</label>
									<div class="col-md-8">
										<input type="text" id="txtCorreo" name="correo" class="form-control input-lg">
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-md-4"></div>
									<div class="col-md-8">
										<button id="btn-recuperar" class="btn btn-warning btn-block btn-lg">Recuperar Clave</button>
									</div>
								</div>
								<br>
								<br>
								<p class="text-right"><a href="/mascotaurbana/login1.php">Volver a Intentar el Acceso</a></p>
								<a href="login1.php">Regresar </a>

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
<script src="js/recuperacion_clave.js"></script>
</html>
