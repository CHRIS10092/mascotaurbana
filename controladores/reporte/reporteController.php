<?php 
error_reporting();

require_once"../../clases/reporteModel.php";
$obj = new ReporteModel();
$cod = $_POST["categorias"];
?>
<?php if($cod == 0){?>
<?php $datos=$obj->consultar_general();?>
<?php 
$entregados=0;
$vendidos=0;
$stock=0;
?>
<!--<a href="../../controladores/reporte/procesarGeneral.php">-->
<a href="../controladores/reporte/procesarGeneral.php?cod=<?php echo $cod?>" target="_blank">Reporte PDF</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ZONA</th>
            <th>SUBZONA</th>
            <th>CANT ENTREGADA</th>
            <th>VENDIDOS</th>
            <th>STOCK</th>
            <th>FECHA DE ACTUALIZACION</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($datos as $data): ?>
        <?php
    $entregados = $entregados + $data["entregada"];
    $vendidos = $vendidos +   $data["vendida"];
    $stock = $stock + $data["stock"];
        
    ?>
        <tr>
            <td><?php echo $data["categoria"]?></td>
            <td><?php echo $data["subcategoria"]?></td>
            <td><?php echo $data["entregada"]?></td>
            <td><?php echo $data["vendida"]?></td>
            <td><?php echo $data["stock"]?></td>
            <td><?php echo $data["fecha"]?></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table >
<br>
<table >
    <tr>
        <td>Vehiculos Entregados</td>
        <td><?php echo $entregados?></td>
    </tr>
    <tr>
        <td>Vehiculos Vendidos</td>
        <td><?php echo $vendidos?></td>
    </tr>
    <tr>
        <td>Total Vehiculos Stock</td>
        <td><?php echo $stock?></td>
    </tr>
</table>

<?php }else{?>
<?php 
$entregados=0;
$vendidos=0;
$stock=0;
?>
<?php $datos=$obj->consultar($cod);?>
<a href="../controladores/reporte/procesarGeneral.php?cod=<?php echo $cod?>" target="_blank">Reporte PDF</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ZONA</th>
            <th>SUBZONA</th>
            <th>CANT ENTREGADA</th>
            <th>VENDIDOS</th>
            <th>STOCK</th>
            <th>FECHA DE ACTUALIZACION</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($datos as $data): ?>
            <?php
    $entregados = $entregados + $data["entregada"];
    $vendidos = $vendidos +   $data["vendida"];
    $stock = $stock + $data["stock"];
        
    ?>
        <tr>
            <td><?php echo $data["categoria"]?></td>
            <td><?php echo $data["subcategoria"]?></td>
            <td><?php echo $data["entregada"]?></td>
            <td><?php echo $data["vendida"]?></td>
            <td><?php echo $data["stock"]?></td>
            <td><?php echo $data["fecha"]?></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<br>
<table>
    <tr>
        <td>Vehiculos Entregados</td>
        <td><?php echo $entregados?></td>
    </tr>
    <tr>
        <td>Vehiculos Vendidos</td>
        <td><?php echo $vendidos?></td>
    </tr>
    <tr>
        <td>Total Vehiculos Stock</td>
        <td><?php echo $stock?></td>
    </tr>
</table>
<?php }?>