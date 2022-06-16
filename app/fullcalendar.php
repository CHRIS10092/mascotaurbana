<?php 
session_start();
if(isset($_SESSION['usuario'])){

?>

<?php require_once "contenido/head.php";?>

 
    <div class="row">
      <div class="col"></div>
      <div class=col-md-11>
        <br><br>
        <div id="CalendarioWeb"></div>
      </div>
      <div class="col"></div>
    </div>
  


    <?php require_once "contenido/foot.php";?> 

<style>
  .fc th {
    padding: 10px 0px;
    vertical-align: middle;
    background: #f2f2f2;

  }
</style>


<script>
  $(document).ready(function () {
    $('#CalendarioWeb').fullCalendar({
      header: {
        
        left: 'today,prev,next',
        center: 'title',
        right: 'month,basicWeek,basicDay,agendaWeek,agendaDay'
      }
      /*
            customButtons: {
              Miboton: {
                text: "boton 1",
                click: function () {
                  alert("sd");
                }
              }
            },*/
      ,
      dayClick: function (date, jsEvent, view) {

        $('#btn-guardar').prop("disabled", false);
        $('#btn-modificar').prop("disabled", true);
        $('#btn-eliminar').prop("disabled", true);

        limpiarformulario();
        $('#txtFecha').val(date.format());
        $('#ModalEvento').modal();
      },
      events: 'calendario/eventos.php',

      eventClick: function (calEvent, jsEvent, view) {

        $('#btn-guardar').prop("disabled", true);
        $('#btn-modificar').prop("disabled", false);
        $('#btn-eliminar').prop("disabled", false);

        //h2
        $('#tituloEvento').html(calEvent.title);
        //mostrar info en los textos
        $('#txtDescripcion').val(calEvent.descripcion);
        $('#txtId').val(calEvent.id);
        $('#txtTitulo').val(calEvent.title);
        $('#txtColor').val(calEvent.color);

        FechaHora = calEvent.start._i.split(" ");

        $('#txtFecha').val(FechaHora[0]);
        $('#txtHora').val(FechaHora[1]);
        //console.log(FechaHora);

        $('#ModalEvento').modal();
      },
      editable: true,
      eventDrop: function (calEvent) {
        $('#txtId').val(calEvent.id);
        $('#txtTitulo').val(calEvent.title);
        $('#txtColor').val(calEvent.color);
        $('#txtDescripcion').val(calEvent.descripcion);
        var fechaHora = calEvent.start.format().split("T");
        $('#txtFecha').val(fechaHora[0]);
        $('#txtHora').val(fechaHora[1]);
        RecolectarDatos();
        EnviarInformacion('modificar', NuevoEvento, true);


      }

    });
  });
</script>


<!-- Modal CRDU-->
<div class="modal fade" id="ModalEvento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloEvento">Agregar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" id="frm-guardar">
          <input type="hidden" id="txtId" name="txtId"><br>
          <input type="hidden" id="txtFecha" class="form-control" name="txtFecha"><br>
          <div class="form-row">
            <div class="form-group col-md-8">
              <label for="">Titulo</label>
              <input type="text" id="txtTitulo" name="txtTitulo" class="form-control"><br>
            </div>


            <div class="form-group col-md-4">
              <label for="">hora</label>

              <div class="input-group clockpicker" data-autoclose="true">
                <input type="text" id="txtHora" class="form-control" name="txtHora" value="10:30"><br>
              </div>


            </div>
          </div>

          <div class="form-group ">
            <label for="">descripcion:</label>
            <textarea id="txtDescripcion" name="txtDescripcion" rows="3" class="form-control"></textarea>
          </div>
          <div class="form-group ">
            <label for="">color:</label>

            <input type="color" value="#ff0000" id="txtColor" name="txtColor" class="form-control"><br>
          </div>
        </form>

      </div>
      <div class="modal-footer">

        <button type="button" id="btn-guardar" class="btn btn-primary">Crear</button>
        <button type="button" id="btn-modificar" class="btn btn-success">Actualizar</button>
        <button type="button" id="btn-eliminar" class="btn btn-warning">Eliminar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>


<script>
  var NuevoEvento;

  $('#btn-guardar').click(function () {
    RecolectarDatos();
    EnviarInformacion('agregar', NuevoEvento);
  });
  //eliminar


  $('#btn-eliminar').click(function () {
    RecolectarDatos();
    EnviarInformacion('eliminar', NuevoEvento);
    //console.log(EnviarInformacion('eliminar', NuevoEvento));
  });

  $('#btn-modificar').click(function () {
    RecolectarDatos();
    EnviarInformacion('modificar', NuevoEvento);

  });

  function RecolectarDatos(NuevoEvento) {
    NuevoEvento = {
      id: $('#txtId').val(),
      title: $('#txtTitulo').val(),
      start: $('#txtFecha').val() + " " + $('#txtHora').val(),
      color: $('#txtColor').val(),
      descripcion: $('#txtDescripcion').val(),
      textColor: $('#FFFFFF'),
      end: $('#txtFecha').val() + " " + $('#txtHora').val(),

    };
    return NuevoEvento;
  }

  function EnviarInformacion(accion, objEvento, modal) {

    objEvento = $('#frm-guardar').serialize();
    $.ajax({
      type: 'POST',
      url: 'calendario/eventos.php?accion=' + accion,
      data: objEvento,
      success: function (msg) {
        //console.log(msg);
        if (msg) {
          $('#CalendarioWeb').fullCalendar('refetchEvents');
          if (!modal) {

            $("#ModalEvento").modal('toggle');
          }

        }

      },
      error: function () {
        alert("no se puede ingresar el mismo titulo ni la misma hora en el dia ");
      }

    });

  }

  $('.clockpicker').clockpicker();

  function limpiarformulario() {

    $('#txtId').val("");
    $('#txtTitulo').val("");
    $('#txtColor').val("");
    $('#txtDescripcion').val("");
  }
</script>
<?php } else {
    header("location: ../");
}
?>


