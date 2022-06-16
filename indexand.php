<!DOCTYPE html>
<html>
<head><meta charset="euc-jp">
	<title>Mascota Urbana</title>
	    <link rel="stylesheet" href="app/contenido/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="app/contenido/assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="app/contenido/assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="app/contenido/assets/css/ace.min.css" />
</head>
<style type="text/css">
	.ocultar{
	display: none;
	}

	.view-component{
		display: inline-block;
	}
</style>
<body >
	<div class="main-container"  style="background-image: url('imagenes/fondos.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center;"><br>
			<div class="main-content">
				<div class="row">
					<div class="col-sm-1 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>
									<br>
									<br>
									<!--<i class="ace-icon fa fa-paw green"></i>

									<span class="grey" id="id-text2">  MASCOTA URBANA</span>-->
									<img src="imagenes/logocomprasegura.jpg" width="370" height="150" alt="">
								</h1>

							</div>

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<div id="alertas"></div>
											<h4 class="header blue lighter bigger">
												<i class="ace-icon fa fa-globe green"></i>
												Ingrese Sus Credenciales
											</h4>

											<div class="space-6"></div>

											<form id="frm-login">
												<p>
														<label>Empresas:</label>
														<input type="radio" name="tipo" value="1" checked>
														<label>Clientes:</label>
														<input type="radio" name="tipo" value="2">
													</p>
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input id="txt-usuario" name="usuario" type="text" autocomplete="off" class="form-control" placeholder="Usuario" />
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input id="txt-clave" name="clave" type="password" autocomplete="off" class="form-control" placeholder="Contraseña" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>
													<label id="label-sucursal" class="ocultar" >Sucursales</label>
													<select class="form-control form-control-sm ocultar" id="cmb-sucursales"></select>


													<div class="space"></div>

													<div class="clearfix">

														<button id="btn-entrar" type="button" class="width-35 pull-right btn btn-sm btn-primary">
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110">Entrar</span>
														</button>
														<a href="recuperacion_clave.php">Olvidaste la Clave de Acceso ?</a>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>

											<div class="social-or-login center">
												<span class="bigger-110">BIENVENIDOS</span>
											</div>

											<div class="space-6"></div>
										</div><!-- /.widget-main -->

										<div class="toolbar clearfix">
											<div>
												<span>

												</span>
											</div>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
			<br>
			<br>
		</div>
</body>
</html>
<script src="app/contenido/assets/js/jquery-2.1.4.min.js"></script>
<script src="app/contenido/assets/js/bootstrap.min.js"></script>
<script src="js/login.js"></script>
