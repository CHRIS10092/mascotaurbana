<?php 
session_start();
if (isset($_SESSION['usuario'])) {
 ?>
<?php include 'contenido/head.php';?>




    
              <?php
             $ec="hola mundo" ;
    $mensaje1= "<br>
    <div class='row'>
    <div class='col-md-4' style='margin-left:200px'>
    <img src='../imagenes/logocomprasegura.jpg' width='220px' height='90px'>
    </div>
    </div>
    <div class='row'>
    <br>
    <div class='col-md-4'>DATOS DE FACTURA
    <br>
    <p>Cédula <span style='color: #16BC2A'>$ec</span></p>
    <br> 
    <p>Cédula <span style='color: #16BC2A'>$ec</span></p>
    <br>
    <p>Cédula <span style='color: #16BC2A'>$ec</span></p>
    <br>
    <p>Cédula <span style='color: #d9cc00'>$ec</span></p>
    <br>
    <p>Cédula <span style='color: #d9cc00'>$ec</span></p>
    <br>
    </div>
    

    <div class='col-md-4'>DATOS DE MASCOTA
    <br>
    <p>Cédula <span style='color: #d9cc00'>$ec</span></p>
    <br> 
    <p>Cédula <span style='color: #d9cc00'>$ec</span></p>
    <br>
    <p>Cédula <span style='color: #d9cc00'>$ec</span></p>
    <br>
    <p>Cédula <span style='color: #d9cc00'>$ec</span></p>
    <br>
    <p>Cédula <span style='color: #d9cc00'>$ec</span></p>
    <br>
    </div>

    </div>";

    print_r ($mensaje1);
    ?>
     


<?php include 'contenido/foot.php';?>
<?php } else {
    header("location: ../");
}
?>
