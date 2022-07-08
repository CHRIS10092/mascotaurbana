<ul class="nav nav-list " style="color: yellow;">


    <?php if ($_SESSION['empresa']['tiposervicio'] == '6'): ?>


    <?php endif?>

    <?php if ($_SESSION['empresa']['tiposervicio'] == '5'): ?>


    <?php endif?>

    <?php if ($_SESSION['empresa']['tiposervicio'] == '4'): ?>


    <?php endif?>

    <?php if ($_SESSION['empresa']['tiposervicio'] == '3'): ?>

    <li class="">
        <a href="inicio.php">
            <i class="menu-icon fa fa-home black"></i>
            <span class="menu-text"> Inicio </span>
        </a>

        <b class="arrow"></b>
    </li>
    <li class="">
        <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-money  yellow"></i>
            <span class="menu-text">Facturacion</span>

            <b class="arrow fa fa-angle-down"></b>
        </a>

        <b class="arrow"></b>

        <ul class="submenu">
            <li class="">
                <a href="procesar.php">

                    <i class="menu-icon fa fa-caret-right"></i>
                    Vender
                </a>

                <b class="arrow"></b>
            </li>

        </ul>
    </li>
    <li class="">
        <a href="tenedor.php" class="dropdown-toggle">
            <i class="menu-icon fa fa-user green"></i>
            <span class="menu-text">Tenedor</span>

            <b class="arrow fa fa-angle-down"></b>
        </a>

        <b class="arrow"></b>

        <ul class="submenu">

            <li class="">
                <a href="tenedor.php">

                    <i class="menu-icon fa fa-angle-down"></i>
                    Registrar
                </a>

                <b class="arrow"></b>
            </li>

        </ul>
    </li>
    <li class="">
        <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-paw red"></i>
            <span class="menu-text">Mascotas</span>

            <b class="arrow fa fa-angle-down"></b>
        </a>

        <b class="arrow"></b>

        <ul class="submenu">

            <li class="">
                <a href="mascotas.php">

                    <i class="menu-icon fa fa-caret-right"></i>
                    Registrar
                </a>

                <b class="arrow"></b>
            </li>
            <li class="">
                <a href="listar-mascotas.php">

                    <i class="menu-icon fa fa-caret-right"></i>
                    Listar
                </a>

                <b class="arrow"></b>
            </li>
        </ul>
    </li>


    <li class="">
        <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-bar-chart green"></i>
            <span class="menu-text">Reporte</span>

            <b class="arrow fa fa-angle-down"></b>
        </a>

        <b class="arrow"></b>

        <ul class="submenu">


            <li class="">
                <a href="reportemascota.php">

                    <i class="menu-icon fa fa-caret-right"></i>
                    Carnet Mascota
                </a>

                <b class="arrow"></b>
            </li>


        </ul>
    </li>

    <li class="">
        <a href="salir.php">

            <i class="fa fa-exit"></i>
            <span class="sr-only"></span>

            Salir
        </a>

        <b class="arrow"></b>
    </li>
    <?php endif?>

    <?php if ($_SESSION['empresa']['tiposervicio'] == '2'): ?>

    <li class="">
        <a href="inicio.php">
        <img src="../imagenes/icons8-casa-48.png" width="20px" height="20px">

            <span class="menu-text"> Inicio </span>
        </a>

        <b class="arrow"></b>
    </li>

    <li class="">
        <a href="#" class="dropdown-toggle">
        <img src="../imagenes/icons8-stock-64.png" width="20px" height="20px">
            <span class="menu-text">Inventarios</span>

            <b class="arrow fa fa-angle-down"></b>
        </a>

        <b class="arrow"></b>

        <ul class="submenu">
            <li class="">
                <a href="categoria.php">

                <img src="../imagenes/icons8-category-58.png" width="20px" height="20px">
                

                    Categorias
                </a>

                <b class="arrow"></b>
            </li>
            <li class="">
                <a href="subcategoria.php">

                <img src="../imagenes/icons8-clasificación-de-respuestas-48.png" width="20px" height="20px">

                    Subcategorias
                </a>

                <b class="arrow"></b>
            </li>
         

            <li class="">
                <a href="inventarioempresas.php">

                
                <img src="../imagenes/icons8-cliente-de-empresa-48.png" width="20px" height="20px">

               
                    Empresa
                </a>

                <b class="arrow"></b>
            </li>



        </ul>
    </li>
    <li class="">
        <a href="#" class="dropdown-toggle">
        <img src="../imagenes/icons8-returns-64.png" width="20px" height="20px">
            <span class="menu-text">Notas de Crédito</span>

            <b class="arrow fa fa-angle-down"></b>
        </a>

        <b class="arrow"></b>

        <ul class="submenu">
            <li class="">
                <a href="notascredito.php">

                <img src="../imagenes/icons8-factura-48.png" width="20px" height="20px">

                    Generar 
                </a>

                <b class="arrow"></b>
            </li>
            <li class="">
                <a href="Listado.php">

                <img src="../imagenes/icons8-artículos-similares-48.png" width="20px" height="20px">
                    Listado
                </a>

                <b class="arrow"></b>
            </li>
         

          

        </ul>
    </li>
    <li class="">
    <a href="venta.php">

    <img src="../imagenes/icons8-shop-64.png" width="20px" height="20px">

    Ventas
    </a>
        <b class="arrow"></b>
    </li>
   
    <li class="">
        <a href="EntregaChips.php">
        <img src="../imagenes/icons8-perro-48.png" width="20px" height="20px">
            <span class="menu-text"> Registrar Mascota </span>
        </a>

        <b class="arrow"></b>
    </li>
    <li class="">
        <a href="listar-mascotas.php">
        <img src="../imagenes/icons8-huella-de-perro-16.png" width="20px" height="20px">
            <span class="menu-text"> Listar Mascota </span>
        </a>
        

        <b class="arrow"></b>
    </li>
    <li class="">
        <a href="carnet_vacunas.php">
        <img src="../imagenes/icons8-tarjetas-macbook-48.png" width="20px" height="20px">

            <span class="menu-text"> Carnet Vacunas </span>
        </a>

        <b class="arrow"></b>
    </li>



    <li class="">
        <a href="#" class="dropdown-toggle">
        <img src="../imagenes/icons8-health-report-64.png" width="20px" height="20px">
            <span class="menu-text">Reporte</span>

            <b class="arrow fa fa-angle-down"></b>
        </a>

        <b class="arrow"></b>

        <ul class="submenu">


            <li class="">
                <a href="reportemascota.php">
                
                <img src="../imagenes/icons8-tarjetas-macbook-100.png" width="20px" height="20px">

                    Carnet Mascota
                </a>

                <b class="arrow"></b>
            </li>

        </ul>
    </li>
    <li class="">
        <a href="#" class="dropdown-toggle">
        <img src="../imagenes/icons8-planificador-48.png" width="20px" height="20px">
        
            <span class="menu-text">Agendamiento</span>

            <b class="arrow fa fa-angle-down"></b>
        </a>

        <b class="arrow"></b>

        <ul class="submenu">


            <li class="">
                <a href="fullcalendar.php">

                <img src="../imagenes/icons8-calendario-16.png" width="20px" height="20px">

                   Crear Citas
                </a>

                <b class="arrow"></b>
            </li>

        </ul>
    </li>
    <li class="">
        <a href="#" class="dropdown-toggle">
        <img src="../imagenes/icons8-ventas-totales-48.png" width="20px" height="20px">
            
            <span class="menu-text">Ventas</span>

            <b class="arrow fa fa-angle-down"></b>
        </a>

        <b class="arrow"></b>

        <ul class="submenu">



            <li class="">
                <a href="reporteempresas.php">

                <img src="../imagenes/icons8-historial-de-pedidos-48.png" width="20px" height="20px">

                    
                    Historial Ventas
                </a>

                <b class="arrow"></b>
            </li>



        </ul>
    </li>
    <li class="">
        <a href="#" class="dropdown-toggle">
        <img src="../imagenes/icons8-comercio-electrónico-100.png" width="20px" height="20px">
            

            <span class="menu-text">Facturas Electronicas</span>

            <b class="arrow fa fa-angle-down"></b>
        </a>

        <b class="arrow"></b>

        <ul class="submenu">



            <li class="">
                <a href="enviosriempresas.php">

                <img src="../imagenes/icons8-enviado-48.png" width="20px" height="20px">
        

                    Enviar Sri
                </a>

                <b class="arrow"></b>
            </li>
            <li class="">
                <a href="respuestas.php">

                <img src="../imagenes/icons8-enviado-48.png" width="20px" height="20px">
        

                    Respuestas Sri
                </a>

                <b class="arrow"></b>
            </li>


        </ul>
    </li>
    <li class="">
        <a href="salir.php">

        <img src="../imagenes/icons8-exit-60.png" width="20px" height="20px">
        
            <span class="sr-only"></span>

            Salir
        </a>

        <b class="arrow"></b>
    </li>

    <?php endif?>


    <?php if ($_SESSION['empresa']['tiposervicio'] == '1'): ?>

    <li class="">
        <a href="inicio.php">
            <i class="menu-icon fa fa-home black"></i>
            <span class="menu-text"> Inicio </span>
        </a>

        <b class="arrow"></b>
    </li>
    <li class="">
        <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-file-text blue"></i>
            <span class="menu-text">Articulos</span>

            <b class="arrow fa fa-angle-down"></b>
        </a>

        <b class="arrow"></b>

        <ul class="submenu">

            <li class="">
                <a href="categoria.php">

                    <i class="menu-icon fa fa-caret-right"></i>
                    Categorias
                </a>

                <b class="arrow"></b>
            </li>
            <li class="">
                <a href="subcategoria.php">

                    <i class="menu-icon fa fa-caret-right"></i>
                    Subcategorias
                </a>

                <b class="arrow"></b>
            </li>
            <li class="">
                <a href="inventarioempresas.php">

                    <i class="menu-icon fa fa-caret-right"></i>
                    Ver Articulos
                </a>

                <b class="arrow"></b>
            </li>
            <li class="">
                <a href="nueva_venta_admin.php">

                    <i class="menu-icon fa fa-caret-right"></i>
                    Vender
                </a>

                <b class="arrow"></b>
            </li>

        </ul>
    </li>
    <li class="">
        <a href="crear-empresas.php">
            <i class="menu-icon fa fa-building green"></i>
            <span class="menu-text"> Empresas </span>
        </a>

        <b class="arrow"></b>
    </li>
    <li class="">
        <a href="crear-sucursales.php">
            <i class="menu-icon fa fa-building glyphicon-record"></i>
            <span class="menu-text"> Sucursales </span>
        </a>

        <b class="arrow"></b>
    </li>
    <li class="">
        <a href="tenedoradmin.php">
            <i class="menu-icon fa fa-user blue"></i>
            <span class="menu-text"> Tenedores </span>
        </a>

        <b class="arrow"></b>
    </li>

    <li class="">
        <a href="mascotasadmin.php">
            <i class="menu-icon fa fa-paw red"></i>
            <span class="menu-text"> Mascotas </span>
        </a>

        <b class="arrow"></b>
    </li>

    <li class="">
        <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-bar-chart green"></i>
            <span class="menu-text">Reporte</span>

            <b class="arrow fa fa-angle-down"></b>
        </a>

        <b class="arrow"></b>

        <ul class="submenu">


            <li class="">
                <a href="reportemascota.php">

                    <i class="menu-icon fa fa-caret-right"></i>
                    PDF Mascota
                </a>

                <b class="arrow"></b>
            </li>



        </ul>
    </li>
    <li class="">
        <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-file-archive-o" aria-hidden="true"></i>

            <span class="menu-text">Agendamiento</span>

            <b class="arrow fa fa-angle-down"></b>
        </a>

        <b class="arrow"></b>

        <ul class="submenu">


            <li class="">
                <a href="fullcalendar.php">

                    <i class="fa fa-hourglass-half" aria-hidden="true"></i>


                    Citas
                </a>

                <b class="arrow"></b>
            </li>

        </ul>
    </li>

    <li class="">
        <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-shopping-bag"></i>
            <span class="menu-text">Ventas</span>

            <b class="arrow fa fa-angle-down"></b>
        </a>

        <b class="arrow"></b>

        <ul class="submenu">



            <li class="">
                <a href="reporteempresas.php">

                    <i class="menu-icon fa fa-bar-chart green "></i>
                    Ver Ventas
                </a>

                <b class="arrow"></b>
            </li>


        </ul>
    </li>
    <li class="">
        <a href="#" class="dropdown-toggle">
            <i class="fa fa-foursquare" aria-hidden="true"></i>

            <span class="menu-text">Facturas Electronicas</span>

            <b class="arrow fa fa-angle-down"></b>
        </a>

        <b class="arrow"></b>

        <ul class="submenu">



            <li class="">
                <a href="enviosriempresas.php">

                    <i class="fa fa-paper-plane-o" aria-hidden="true"></i>


                    Enviar Sri
                </a>

                <b class="arrow"></b>
            </li>



        </ul>
    </li>
    <li class="">
        <a href="salir.php">

            <i class="fa fa-close"></i>

            Salir
        </a>

        <b class="arrow"></b>
    </li>




</ul>


<?php endif?>