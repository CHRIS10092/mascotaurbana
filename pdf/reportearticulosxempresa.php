<?php

require_once "../clases/reportearticulos.php";
$obj        = new reporte_articulos();
$buscarnart = $obj->BuscarempresaArticulo($_GET['idempresa']);



?>
<style>
.img2 {


    height: 30px;
    width: 30px;
    border-radius: 100px;
    margin-top: 10;

}


.h3 {
    margin-top: 0px;
}

table {
    width: 100%;
    border: 1px solid #000;
}

th,
td {
    width: 25%;
    text-align: left;
    vertical-align: top;
    border: 1px solid #000;
    border-collapse: collapse;
    padding: 0.3em;
    caption-side: bottom;
}

caption {
    padding: 0.3em;
    color: #fff;
    background: #000;
}

th {
    background: #eee;
}
</style>

<img width="200" height="50" src="../imagenes/logocomprasegura.jpg">
<h3>LISTADO DE TODOS LOS ARTICULOS DE EMPRESAS</h3>


<table>
    <tr>
        <th>Codigo</th>
        <th>CodigoUnico</th>
        <th>Nombre</th>
        <th>Stock</th>
        <th>Valor Compra</th>
        <th>Valor Pvp</th>



    </tr>

    <?php foreach ($buscarnart as $datos) { ?>





    <tr>
        <th><?php echo $datos['inv_id'] ?></th>
        <th><?php echo $datos['inv_codigo'] ?></th>
        <th> <?php echo $datos['inv_descripcion']; ?></th>
        <th> <?php echo $datos['inv_stock']; ?></th>
        <th> <?php echo $datos['inv_valor']; ?></th>
        <th> <?php echo $datos['inv_valorpvp']; ?></th>


    </tr>




    <?php } ?>

</table>