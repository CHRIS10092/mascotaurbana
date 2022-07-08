<?php
//session_set_cookie_params(60 * 60 * 24 * 1) //para un dia
session_start();

if (isset($_SESSION['empresa'])) {

?>
<?php include 'contenido/head.php'; ?>
<center>
    <h2 class="green">
        <i class="ace-icon fa fa-home bigger-110"></i>

        <span> <?php echo $_SESSION['empresa']['nombre']; ?> </span>
    </h2>
</center>
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-9">
        <div class="widget-box">
            <div class="widget-header widget-header-flat widget-header-small">
                <h5 class="widget-title">
                    <i class="ace-icon fa fa-user"></i>
                    BIENVENIDO
                </h5>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <div class="row">
                        <div class="col-md-6">
                            <strong> <img width="300" height="300"
                                    src="../<?php echo $_SESSION['empresa']['logo']; ?>"></a></strong>


                        </div>
                        <div class="col-md-6">

                            <br>
                            <br>

                            <strong>Nombre Empresa: <?php echo $_SESSION['empresa']['nombre']; ?></strong>
                            <div class="hr hr8 hr-double"></div>
                            <!--<strong>Tipo de Empresa: <?php echo $_SESSION['empresa']['tiposervicio']; ?></strong>-->
                            <!--<div class="hr hr8 hr-double">
							</div>-->
                            <strong>Nombre de Usuario: <?php echo $_SESSION['usuario']['nombreCompleto']; ?></strong>
                            <div class="hr hr8 hr-double"></div>
                            <strong>Telefono Responsable: <?php echo $_SESSION['empresa']['telefono']; ?></strong>
                            <div class="hr hr8 hr-double"></div>
                            <strong>Direccion Responsable: <?php echo $_SESSION['empresa']['direccion']; ?></strong>
                            <div class="hr hr8 hr-double"></div>
                            <strong>Correo Responsable: <?php echo $_SESSION['empresa']['correo']; ?></strong>
                            <div class="hr hr8 hr-double"></div>

                        </div>
                    </div>

                </div><!-- /.widget-main -->
            </div><!-- /.widget-body -->
        </div><!-- /.widget-box -->
    </div>
</div>

<div class="row">
  <div class="col-md-5">
    <form action="" method="POST" enctype="multipart/form-data">
      <div class="form-group" id="opciones">
        <label for="">Opciones:</label>
        <input type="radio" name="opc" value="1" onchange="mostrar(this.value);"> Dolares
        <input type="radio" name="opc" value="2" onchange="mostrar(this.value);"> Porcetajes
        
      </div>
      <div class="form-group" id="nombre" style="display:none;">
        <label for="">Dolares:</label>
        <input type="text" class="form-control" name="nombre">
      </div>
      <div class="form-group" id="apellidos" style="display:none;">
        <label for="">Porcentajes:</label>
        <input type="text" class="form-control" name="apellidos">
      </div>
      <div class="form-group" id="calculos" style="display:block;">
        <label for="">Calculoss:</label>
        <input type="text" class="form-control" name="calculos">
      </div>
      
    </form>
  </div>
</div>

    
<script type="text/javascript">

function mostrar(dato) {
  if (dato == "1") {
    document.getElementById("nombre").style.display = "block";
    document.getElementById("apellidos").style.display = "none";
    
  }
  if (dato == "2") {
    document.getElementById("nombre").style.display = "none";
    document.getElementById("apellidos").style.display = "block";
    
  }
  
}

</script>

<?php include 'contenido/foot.php'; ?>
<?php } else {
	header("location: ../");
}
?>