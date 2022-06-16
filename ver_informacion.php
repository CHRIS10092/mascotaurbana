<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <title>Mascota Urbana</title>
    <link rel="stylesheet" href="app/contenido/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="app/contenido/assets/font-awesome/4.5.0/css/font-awesome.min.css" />
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <img class="img-thumbnail" src="<?php print_r($_SESSION['tenedor']['datos']->foto) ?>">
                <hr>

            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p class="text-center">TENEDOR</p>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6"><br><br>
                                <h4 class="text-info">Identificacion: <span
                                        class="text-muted"><?php print_r($_SESSION['tenedor']['datos']->cedula) ?></span>
                                </h4>
                                <h4 class="text-info">Nombres y Apellidos: <span
                                        class="text-muted"><?php print_r($_SESSION['tenedor']['datos']->primer_nombre . ' ' . $_SESSION['tenedor']['datos']->segundo_nombre . ' ' . $_SESSION['tenedor']['datos']->apellido_paterno . ' ' . $_SESSION['tenedor']['datos']->apellido_materno) ?></span>
                                </h4>
                                <h4 class="text-info">Fecha de Nacimiento: <span
                                        class="text-muted"><?php print_r($_SESSION['tenedor']['datos']->fecha) ?></span>
                                </h4>
                                <h4 class="text-info">Correo Electronico: <span
                                        class="text-muted"><?php print_r($_SESSION['tenedor']['datos']->correo) ?></span>
                                </h4>
                                <h4 class="text-info">Numero de Celular: <span
                                        class="text-muted"><?php print_r($_SESSION['tenedor']['datos']->celular) ?></span>
                                </h4>
                            </div>
                            <div class="col-md-6">
                                <h4 class="text-info">Provincia: <span
                                        class="text-muted"><?php print_r($_SESSION['tenedor']['datos']->provincia) ?></span>
                                </h4>
                                <h4 class="text-info">Canton: <span
                                        class="text-muted"><?php print_r($_SESSION['tenedor']['datos']->canton) ?></span>
                                </h4>
                                <h4 class="text-info">Parroquia: <span
                                        class="text-muted"><?php print_r($_SESSION['tenedor']['datos']->parroquia) ?></span>
                                </h4>
                                <h4 class="text-info">Barrio: <span
                                        class="text-muted"><?php print_r($_SESSION['tenedor']['datos']->barrio) ?></span>
                                </h4>
                                <h4 class="text-info">Calle Principal: <span
                                        class="text-muted"><?php print_r($_SESSION['tenedor']['datos']->calle_principal) ?></span>
                                </h4>
                                <h4 class="text-info">Calle Secundaria: <span
                                        class="text-muted"><?php print_r($_SESSION['tenedor']['datos']->calle_secundaria) ?></span>
                                </h4>
                                <h4 class="text-info">Numero de Casa: <span
                                        class="text-muted"><?php print_r($_SESSION['tenedor']['datos']->numero_casa) ?></span>
                                </h4>
                                <h4 class="text-info">Referencia Casa: <span
                                        class="text-muted"><?php print_r($_SESSION['tenedor']['datos']->referencia_casa) ?></span>
                                </h4>
                            </div>
                            <left><a href="procesarpdf/procesar_informacion.php?p1=<?php print_r($_SESSION['tenedor']['datos']->correo) ?>&p2=<?php print_r($_SESSION['tenedor']['datos']->cedula) ?>"
                                    target="_blank" class="btn btn-danger btn-lg">Ver Pdf</a></left>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">MASCOTAS</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped">
                                    <thead>
                                        <tr class="info">
                                            <th>Codigo</th>
                                            <th>Nombre</th>
                                            <th>Sexo</th>
                                            <th>Fecha de Nacimiento</th>
                                            <th>Colores</th>
                                            <th>Esterilizado?</th>
                                            <th>Tipo</th>
                                            <th>Raza</th>
                                            <th>Imagen</th>
                                            <th>Codigo Qr</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($_SESSION['mascotas']['listado'] as $datos) : ?>
                                        <tr>
                                            <td>
                                                <a data-toggle="modal" data-target="#myModal"
                                                    onclick="capturar('<?php echo $datos['mas_codigo']; ?>')">
                                                    <?php echo $datos['mas_codigo'] ?></a>
                                            </td>
                                            <td><?php echo $datos['mas_nombre']; ?></td>
                                            <td><?php echo $datos['mas_sexo']; ?></td>
                                            <td><?php echo $datos['mas_fecha']; ?></td>
                                            <td>
                                                <p><?php echo $datos['mas_color']; ?></p>
                                                <p><?php echo $datos['mas_color_secundario']; ?></p>
                                            </td>
                                            <td><?php echo $datos['mas_esterilizado']; ?></td>
                                            <td><?php echo $datos['tipo']; ?></td>
                                            <td><?php echo $datos['raza']; ?></td>
                                            <td> <img width=30px;height=30px; src="
                                                    <?php echo $datos['mas_imagen'] ?>">
                                            </td>
                                            <td> <img width=30px;height=30px;
                                                    src="<?php echo $datos['mas_codigo_qr'] ?>"></td>

                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                                <a href="index.php">Regresar Atras</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">

                    INFORMACIÓN DE MASCOTAS
                </div>

                <div id="ver-orden"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>

        </div>
    </div>
</body>

</html>

<script src="app/contenido/assets/js/jquery-2.1.4.min.js"></script>
<script src="app/contenido/assets/js/bootstrap.min.js"></script>
<script src="js/ver_informacion.js"></script>