<?php 
require_once"../clases/reporteModel.php";
$obj = new ReporteModel();
$cod = $_GET["cod"];
?>
<?php if($cod == 0){?>
<?php 
$entregados=0;
$vendidos=0;
$stock=0;
?>
<?php $datos=$obj->consultar_general();?>
<h2>REPORTE GENERAL</h2>
<table style="width:100%">
    <thead style="background:#ABEBC6">
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
<table style="width:40%">
    <tr style="background:#E6B0AA">
        <td>Vehiculos Entregados</td>
        <td><?php echo $entregados?></td>
    </tr>
    <tr style="background:#85C1E9">
        <td>Vehiculos Vendidos</td>
        <td><?php echo $vendidos?></td>
    </tr>
    <tr style="background:#F9E79F">
        <td>Total Vehiculos Stock</td>
        <td><?php echo $stock?></td>
    </tr>
</table>
<?php }else{?>
    <?php $datos=$obj->consultar($cod);?>
    <?php 
$entregados=0;
$vendidos=0;
$stock=0;
?>
    <h2>REPORTE POR ZONA</h2>
<table style="width:100%">
    <thead style="background:#ABEBC6">
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
<table style="width:40%">
    <tr style="background:#E6B0AA">
        <td>Vehiculos Entregados</td>
        <td><?php echo $entregados?></td>
    </tr>
    <tr style="background:#85C1E9">
        <td>Vehiculos Vendidos</td>
        <td><?php echo $vendidos?></td>
    </tr>
    <tr style="background:#F9E79F">
        <td>Total Vehiculos Stock</td>
        <td><?php echo $stock?></td>
    </tr>
</table>
<?php }?>