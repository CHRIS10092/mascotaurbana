<?php
session_start();

if (isset($_SESSION['usuario'])) {

    require_once 'contenido/head.php';

    require_once '../clases/VentasModel.php';
    $obj = new VentasModel;
    $data = $obj->GetById($_GET['id']);
    //print_r($data);
    ?>
	<form id="frmProceso" enctype="multipart/form-data">
		<input type="hidden" id="idv" value='<?php echo $_GET['id']?>'>
		<input type="hidden" id="detalleChips" value='<?php echo $data->detalle?>'>
				<h3 style="text-align: center;" class="red"><strong id="numero-mascotas"></strong> Mascotas para Registrar</h3>
				<div class="row">
					<div class="col-md-12">
						<div id="accordion" class="accordion-style1 panel-group">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
											<i class="ace-icon fa fa-angle-down bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
											&nbsp;Tenedor
										</a>
									</h4>
								</div>

								<div class="panel-collapse collapse in" id="collapseOne">
									<div class="panel-body">
										<h2 class="blue" style="text-align: center;">Tenedor <i class="ice-icon fa fa-user blue"></i></h2>
										<h4 class="blue">Datos Personales</h4>
										<hr style="margin-top: 0;margin-bottom: 13px;">
										<div class="row">
											<div class="col-md-8">
												<div class="row">
													<label class="col-md-2">Cedula:</label>
													<div class="col-md-4">
														<input type="number" maxlength="13"  id="txtCedulaTenedor" class="form-control" value="<?php echo $data->ruc?>">
													</div>
													<label class="col-md-2">Fech.Nacimiento:</label>
													<div class="col-md-4">
														<input type="date"  id="txtFechaTenedor" class="form-control">
													</div>
												</div><br>
												<div class="row">
													<label class="col-md-2">Primer.Nombre:</label>
													<div class="col-md-4">
														<input type="text"  id="txtPrimerNombre" class="form-control" value="<?php echo $data->nombre?>">
													</div>
													<label class="col-md-2">Segundo.Nombre:</label>
													<div class="col-md-4">
														<input type="text"  id="txtSegundoNombre" class="form-control">
													</div>
												</div><br>
												<div class="row">
													<label class="col-md-2">Apellido.Paterno:</label>
													<div class="col-md-4">
														<input type="text"  id="txtApellidoPaterno" class="form-control" value="<?php echo $data->apellido?>">
													</div>
													<label class="col-md-2">Apellido.Materno:</label>
													<div class="col-md-4">
														<input type="text"  id="txtApellidoMaterno" class="form-control">
													</div>
												</div>
											</div>
											<div class="col-md-2">
												<h3 class="blue" style="text-align: center;margin-top: 0px;margin-bottom: 0px">Foto <i class="ice-icon glyphicon glyphicon-picture blue"></i></h3>
												<input type="file" name="imagen-tenedor" id="txtImgenTenedor">
												<br>
												<div id="previewTenedor"></div>
											</div>
										</div>
										<br>
										<h4 class="blue">Datos de Informacion</h4>
										<hr>
										<div class="row">
											<label class="col-md-1">Correo:</label>
											<div class="col-md-3">
												<input type="text"  id="txtCorreoTenedor" class="form-control" value="<?php echo $data->correo?>">
											</div>
											<label class="col-md-1">Celular:</label>
											<div class="col-md-3">
												<input type="text"  id="txtCelularTenedor" class="form-control" value="<?php echo $data->celular?>">
											</div>
											<label class="col-md-1">Provincia:</label>
											<div class="col-md-3">
												<select class="form-control" id="cmbProvinciaTenedor">
													<option value="0">-seleccionar--</option>
												</select>
											</div>
										</div><br>
										<div class="row">

											<label class="col-md-1">Canton:</label>
											<div class="col-md-3">
												<select class="form-control" id="cmbCantonTenedor">
													<option value="0">-seleccionar--</option>
												</select>
											</div>
											<label class="col-md-1">Parroquia:</label>
											<div class="col-md-3">
												<select class="form-control" id="cmbParroquiaTenedor">
													<option value="0">-seleccionar--</option>
												</select>
											</div>
											<label class="col-md-1">Barrio:</label>
											<div class="col-md-3">
												<input type="text"  id="txtBarrioTenedor" class="form-control">
											</div>
										</div><br>
										<div class="row">

													<label class="col-md-1">Calle.Princip:</label>
													<div class="col-md-3">
														<input type="text"  id="txtCallePrincipal" class="form-control">
													</div>
													<label class="col-md-1">Calle.Secund:</label>
													<div class="col-md-3">
														<input type="text"  id="txtCalleSecundaria" class="form-control">
													</div>
													<label class="col-md-1">N#.Casa:</label>
													<div class="col-md-3">
														<input type="text"  id="txtNumeroCasa" class="form-control">
													</div>

										</div><br>
										<div class="row">
											<label class="col-md-2">Referencia de la Casa:</label>
												<div class="col-md-6">
													<input type="text"  id="txtReferenciaCasa" class="form-control">
												</div>
										</div>
									</div>
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
											<i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
											&nbsp;Mascota
										</a>
									</h4>

								</div>

								<div class="panel-collapse collapse" id="collapseTwo">
									<div class="panel-body">
										<h2 class="blue" style="text-align: center;">Mascota <i class="ice-icon fa fa-paw blue"></i></h2>
										<div class="row">
											<div class="col-md-4">
												<label>Chips</label>
												<select id="cmbChips" class="form-control input-sm" onchange="traerchips()"></select>
											</div>
										</div>
										
										<hr>
										<div class="row">
											<div class="col-md-8">
												<div class="row">
													<label class="col-md-1">Codigo:</label>
													<div class="col-md-3">
														<input type="text" readonly onkeypress="return solo_numeros(event);" maxlength="15" id="txtCodigoMascota" class="form-control">
													</div>
													<label class="col-md-3">Fecha de Nacimiento:</label>
													<div class="col-md-4">
														<input type="date"  id="txtFechaMascota" class="form-control">
													</div>
												</div><br>
												<div class="row">
													<label class="col-md-1">Nombre:</label>
													<div class="col-md-3">
														<input type="text"  id="txtNombreMascota" class="form-control">
													</div>
													<label class="col-md-3">Color Uno:</label>
													<div class="col-md-4">
														<input type="text"  id="txtColor1Mascota" class="form-control">
													</div>
												</div><br>
												<div class="row">
													<label class="col-md-1">Color Dos:</label>
													<div class="col-md-3">
														<input type="text"  id="txtColor2Mascota" class="form-control">
													</div>
													<label class="col-md-3">Sexo:</label>
													<div class="col-md-4">
														<select  id="cmbSexoMascota" class="form-control">
															<option value="0">--seleccionar--</option>
															<option value="Macho">Macho</option>
															<option value="Hembra">Hembra</option>
														</select>
													</div>

												</div><br>
												<div class="row">
													<label class="col-md-2">Esterilizado ?:</label>
													<div class="col-md-2">
														<select  id="cmbEsterilizadoMascota" class="form-control">
															<option value="0">seleccion</option>
															<option value="Si">Si</option>
															<option value="No">No</option>
														</select>
													</div>
													<label class="col-md-3">Tipo de Mascota:</label>
													<div class="col-md-4">
														<select  id="cmbTipoMascota" class="form-control">
															<option value="0">--seleccionar--</option>
														</select>
													</div>
												</div><br>
												<div class="row">
													<div class="col-md-4"></div>
													<label class="col-md-3">Razas:</label>
													<div class="col-md-4">
														<select  id="cmbRazaMascota" class="form-control">
															<option value="0">--seleccionar--</option>
														</select>
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<h3 class="blue">Foto Mascota</h3>
												<hr>
												<input type="file" id="txtImagenMascota" name="imagen-mascota">
												<br>
												<div id="preview-mascota"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-8"></div>
					<div class="col-md-2">
						<button class="btn btn-primary" id="btnRegistrarProceso">
							Registrar
						</button>
					</div>
				</div>

			</div>
		
	</form>


	<?php require_once 'contenido/foot.php';?>

	<script src="../js/procesar1.js"></script>

	<?php

} else {

    header("location: ../");
}

?>