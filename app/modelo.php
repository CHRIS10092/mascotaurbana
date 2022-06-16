<?php 
session_start();
if (isset($_SESSION['usuario'])) {
 ?>
<?php include 'contenido/head.php';?>


<ul class="nav nav-pills">
  <li class="active"><a data-toggle="pill" href="#home">PASO 1 REGISTRAR TENEDOR</a></li>
  <li><a data-toggle="pill" href="#menu1">PASO 2 REGISTRAR VENTA</a></li>
  <li><a data-toggle="pill" href="#menu2">PASO 3 REGISTRAR MASCOTAS</a></li>
</ul>

<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
  <label> REGISTRO DE TENEDOR</label><br>
   <input type="radio" name="" value="existe"> EXISTE<br>

    <input type="radio" name="" value="noexiste"> NO EXISTE<br>


    <div class="col-md-12 col-sm-12 widget-container-col ui-sortable" id="widget-container-col-4">
    <div class="widget-box ui-sortable-handle" id="widget-box-4">
        <div class="widget-header widget-header-large">
            <h4 class="widget-title">Listado de Tenedores</h4>
       
            <div class="widget-toolbar">
                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#m-tenedor">
                    <i class="glyphicon glyphicon-plus"></i> Nuevo
                </button>
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
<!-- MODAL PARA REGISTRAR TENEDOR -->
<div id="m-tenedor" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Registrar Tenedor</h4>
            </div>
            <div class="modal-body">
                <div class="widget-main">
                    <div class="row">
                        <div class="col-md-12" id="alertas"></div>
                        <div id="correcto"></div>
                    </div>

                <form id="frm-tenedor"  enctype="multipart/form-data">
                    <h4>Datos Personales </h4>
                    <div class="row">
                       
                        <div class="col-md-2">

                            <label for="">Cedula</label>
                            <input type="text"  id="" name="" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">Primer Nombre </label>
                            <input type="text" id="" name="" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">Segundo Nombre </label>
                            <input type="text" id="" name="" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">Primer Apellido</label>
                            <input type="text" id="" name="" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">Segundo Apellido</label>
                            <input type="text" id="" name="" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="">fecha nacimiento</label>
                            <input type="date" id="" name="" class="form-control">
                        </div>
                    </div>
                    <hr>
                                       
                    <h4>Datos de Información</h4>
                    <div class="row">
                        
                        <div class="col-md-4">
                            <label for="">Correo</label>
                            <input type="email" id="" name="" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">Celular</label>
                            <input type="text" id=""  name="" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">Provincia</label>
                            <div id="provincias"> </div>
                        </div>
                        
                         
                        <div class="col-md-2">
                            <label for="">Canton</label>
                             <div id="cantones"> 
                                    
                             </div>
                        </div>
                      
                    </div>
                            <h>
                              <br>  
                    <div class="row">

                              <div class="col-md-2">
                            <label for="">Parroquia</label>
                           <div id="parroquias"></div>
                        </div>
                            <div class="col-md-2">
                            <label for="">Barrio</label>
                            <input type="text" id="" name="" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">Calle Principal</label>
                            <input type="text" id="" name="" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for=""> Numero Casa</label>
                            <input type="text" id="" name="" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">Calle Secundaria</label>
                            <input type="text" id="" name="" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">Refencia Casa</label>
                            <input type="text" id="" name="" class="form-control">
                        </div>

                        <div class="col-md-4">
                                


                         <label for="">Foto</label>
                            <input type="file" id="" name="" class="form-control">
                            <div style="width: 50px  " id="preview">  </div>
                        </div>
                    </div>   
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button"  class="btn btn-primary" id="btn-registrar">Registrar</button>
            </div>
        </div>

    </div>

</div>
</div>
</div>
    
  
  <div id="menu1" class="tab-pane fade">
    <div class="col-md-12 col-sm-12 widget-container-col ui-sortable" id="widget-container-col-4">
<h2 class="blue">
    <i class="ace-icon fa fa-plus bigger-110"></i>
    Nueva venta
</h2>
<br>


<div class="form-group row">
	 <label class="col-md-1 control-label">Fecha</label>
         <div class="col-md-3">
         <input type="text" name="" class="form-control"
          value="<?php echo date('d-y-m')?>" readonly="">
          
		</div>
	 <label class="col-md-1 control-label">Venta</label>
         <div class="col-md-2">
         
         <div id="inp-numero"></div>
		</div>
	<label class="col-md-1 control-label">Agregar</label>
       <div class="col-md-3">
          <button class="btn btn-warning form-control" data-toggle="modal"
                                    onclick="recargar(event);" data-target="#n-medicamento">
                                    <i class="glyphicon glyphicon-search"></i> Buscar Articulo
           </button>
      </div>
	 </div>	

<div class="form-group row">
	 <label class="col-md-1 control-label">Ruc</label>
         <div class="col-md-3">
           <input type="text" name="" id="" onkeypress="return solo_numeros(event)" class="form-control input-sm">

		</div>
	 <label class="col-md-1 control-label">Nombre</label>
         <div class="col-md-2">
         <input type="text" name="" id=""  class="form-control input-sm"   onkeypress="return solo_letras(event)">
		</div>
	<label class="col-md-1 control-label">Apellido</label>
         <div class="col-md-3">
          <input type="text" name="" id="" class="form-control input-sm"
          onkeypress="return solo_letras(event)">
      </div>
	 </div>
	

		 
	  <div class="form-group row">
	 <label class="col-md-1 control-label">Direccion</label>
         <div class="col-md-3">
          <input type="text" name="" id="" class="form-control input-sm">
		</div>
	 <label class="col-md-1 control-label">Correo</label>
         <div class="col-md-2">
          <input type="text" name="" id="" class="form-control input-sm">
		</div>
	<label class="col-md-1 control-label">Celular</label>
         <div class="col-md-3">
         <input type="text" name="" id="" class="form-control input-sm" maxlength="10"  onkeypress="return solo_numeros(event)">
      </div>

	 </div>
	  <div class="form-group row">
	      <?php if(isset($_SESSION["usuario"])){?>
            <div class="col-md-2"  style="visibility: hidden">
             <label><strong>Tipo Empresa</strong></label>
              <select id="cmb-categoria" name="categoria">
                <option value="<?php  echo $_SESSION['usuario'][3] ;?>"> 
                     <?php  echo $_SESSION['usuario'][4] ;?>
                </option>
              </select>

            </div>
     <div class="col-md-2"  style="visibility: hidden">
      <label><strong>Nombre Empresa</strong></label>
        <select id="cmb-subcategoria" name="sub_categoria">
          <option value="<?php  echo $_SESSION['usuario'][5] ;?>">
             <?php  echo $_SESSION['usuario'][6] ;?> </option>
        </select>
     </div>
                 <?php }else{?>
     <div > 
    <label> vacio</label>
      </div>
        <?php }?>
       </div>
	 <div class="form-group row">
	 <div id="list-detalle" ></div>
	 </div>
 <div class="pull-right" >
  <button type="button" class="btn btn-primary" id="btn-guarda">Registrar</button>

</div>


</div>

  </div>
  <div id="menu2" class="tab-pane fade">
    <h3>Menu 2</h3>
    <div class="row">
  <div class="col-md-12">
    <div class="box box-success">
      <!-- /.box-header -->
      <div class="box-body">

        
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</div>

                <div id="correcto"></div>
                <div id="alertas"></div>

       
<form id="frm-mascotas"  enctype="multipart/form-data" >
<div class="box box-primary">
           
            <div class="box-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="box box-info">
                    <div class="box-header with-border">
                      <center><h3 class="box-title">Datos Tenedor</h3></center>
                    </div>
                    <div class="box-body">
                     <br>
                       
                      <div class="row">
                        <div class="col-md-12">
                          
                          <input type="hidden" name="" id="">
                          <label>Num. Identificacion</label>
                          <input type="text"  id=""  class="form-control input-sm">
                          <label>Nombre</label>
                          <input type="text"   id="" class="form-control input-sm">
                          <label>Apellido</label>
                          <input type="text"   id="" class="form-control input-sm">
                          <hr>
                          <h3>Numero de Venta</h3>
                          <input type="text"  name="" id="" class="form-control"><br>
                          <center><button id="btn-buscar-detalle" class="btn btn-success">Buscar</button></center>
                          <br>
                          <div id="datos-registros"></div>
                        </div>
                      </div>
                    </form>
                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="box box-info">
                    <div class="box-header with-border">
                      <center><h3 class="box-title">Informacion Mascota</h3></center>
                    </div>
                    <div class="box-body">
                      
                        <div class="col-md-4">

                          <label>Codigo Principal</label>
                          <input type="text" name="" onkeypress="return validar_numeros(event);" style="border-radius: 2px;" placeholder="INGRESAR 14 NUMEROS" class="form-control" id="" maxlength="14" class="form-control input-sm">
                          
                          <label>Nombre</label>
                          <input type="text" name="" onkeypress="return validar_letras(event);" id="" class="form-control">
                          <label for="txt-sexo">Sexo</label>
                          <br>
                          <select name="" id="" class="form-control ">
                            <option value="0">Seleccionar</option>
                            <option value="Macho">Macho</option>
                            <option value="Hembra">Hembra</option>
                          </select>
                           
                          <label >Fecha de Nac</label>
                          <input type="date" name="" id="" class="form-control "><br>
                          
                        </div>
                        <div class="row">
                        <div class="col-md-3">
                          
                          
                          <label >Color</label>
                          <input type="text" name="" onkeypress="return validar_letras(event);"  id="" class="form-control ">
                          
                          <!--<label >Tipo de Mascota</label>
                          <select name="cmb-tipo-mascota" id="cmb-tipo-mascota" class="form-control">
                            <option value="0">Seleccionar</option>
                            <option value="Canino">Canino</option>
                            <option value="Felino">Felino</option>
                          </select>
                          
                          <label>Raza</label>
                           <select name="cmb-raza" id="cmb-raza" class="form-control">
                            <option value="0">Seleccionar</option>
                            <option value="Siberiano">Siberiano</option>
                            <option value="Szhnauzer">Szhnauzer</option>
                          </select>
                          --><br>
                          <label >Tipo Mascota</label>
                          <div id="especies"></div>
                          <br>
                          <label >Tipo Razas</label>
                          <div id="razas"></div>
                          <br>
                          <button  class="btn btn-primary btn-group-lg form-control" disabled  id="btn-registrar">Guardar
                           <i class="glyphicon glyphicon-floppy-disk"></i></button>
                        </div>
                        <div class="col-md-4">
                          <label >Color 1</label>
                          <input type="text" name="" onkeypress="return validar_letras(event);" id="" class="form-control ">
                          <label>Esterilizado</label>
                          <select name="" id="" class="form-control">
                            <option value="0">Seleccionar</option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                          </select>
                        <!--  <label>Edad</label>-->
                          <input type="hidden" name="" readonly id="" class="form-control input-sm">
                          <label>Foto</label>
                          <input type="file" name=""  id="" class="form-control ">
                          <div style="width: 50px  " id="preview">  </div>
                          <br>
                          
                        </div>
                      </div>
                        

                    </div>


                    <!-- /.box-body -->
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
</form>
  </div>
</div>



<?php include 'contenido/foot.php';?>
<script src="../js/nueva_venta.js"></script>
<script src="../js/tenedor.js"></script>

<script type="text/javascript" src="../js/mascotas.js"></script>
<?php } else {
    header("location: ../");
}
?>
