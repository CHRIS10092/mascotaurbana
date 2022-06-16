<!DOCTYPE html>
<html>
<head><meta charset="euc-jp">
	<title></title>
	    <link rel="stylesheet" href="app/contenido/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="app/contenido/assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="app/contenido/assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="app/contenido/assets/css/ace.min.css" />
</head>
<style type="text/css">
	
	img{
		border-radius: 31px;
	}
</style>
<body class="login-layout light-login">
	<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container" style="margin-left: 11px;">
							<div class="center">
								<h1 style="margin-top: 66px;">
									<!--<i class="ace-icon fa fa-paw green"></i>
									<span style="color:blue">MASCOTA </span>
									<span class="black" id="id-text2">  URBANA</span>-->
									<span><img src="imagenes/logocomprasegura.jpg" width="350px" height="150px"></span>
								</h1>
								
								<h2 style="font-size: 18px" class="yellow" id="id-company-text">
									<i class="fa-solid fa-hand-sparkles"></i>
								</h2>
							</div>

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<div id="alertas"></div>
											<h4 class="header blue lighter bigger">
												<i class="ace-icon fa fa-coffee green"></i>
												Ingrese Sus Credenciales
											</h4>

											<div class="space-6"></div>

											<form id="frm">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input id="usuario" name="usuario" type="text" class="form-control" placeholder="Usuario" />
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input id="clave" name="clave" type="password" autocomplete="off" class="form-control" placeholder="Contrasenia" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<select id="sucursal"  name="sucursal" onchange="entryCompany(this)"
                                class="form-control bg-white border-left-0 border-md"></select>
                          				</span>

													</label>

													<div class="space"></div>

													<div class="clearfix">

														<button class="width-35 pull-right btn btn-sm btn-primary">
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110">Entrar</span>
														</button>
														  <p class="text-muted font-weight-bold"><a href="recuperacion_clave.php"
                                    class="text-primary ml-2">Olvidaste tu contraseña ?</a></p>
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
		</div>
</body>
</html>
<script src="app/contenido/assets/js/jquery-2.1.4.min.js"></script>
<script src="app/contenido/assets/js/bootstrap.min.js"></script>

<script type="text/javascript">
  const frm = document.getElementById('frm')
const usuario = document.getElementById('usuario')
const clave = document.getElementById('clave')
const sucursal = document.getElementById('sucursal')

const login = e =>{
  e.preventDefault()
  if(usuario.value == "" || usuario.value === null || clave.value == "" || clave.value === null ){
    alert("Las credenciales son obligatorias")
  }else{
    data = new FormData(frm)
    fetch("controladores/login/index.php",{
      method:"POST",
      body:data
    }).then(res => res.json())
      .then(res =>{
        if(res.res){
          if(res.tipo == 1){
            sucursal.innerHTML=`<option value="0">Seleccione</option>`
              res.data.map(el => {
                sucursal.innerHTML+=`<option value="${el.codigo}">${el.nombre}</option>`
              })
          }else{
            window.location ="ver_informacion.php"
          }
          
           
        }else{
          alert(res.sms)
        }
        
      })
  }

}

const entryCompany = el =>{
  if(el.value !="0"){
    data = new FormData()
    data.append("sucursal",el.value)
    fetch("controladores/login/get_sucursal.php",{
      method:"POST",
      body:data
    }).then(res => window.location = "app/inicio.php")
  }
  

}

frm.addEventListener("submit",login)

</script>