<?php
session_start();
require_once 'config.php';
/**
 *
 *
 */

class inventario extends config
{
    private $inv_dbh;
    public function __construct()
    {
        $this->inv_dbh = config::Abrir();
    }

    public function ListarArticulos($idempresa)
    {
        $inv_sql  = "SELECT inv.inv_id,inv.inv_codigo,inv.inv_nombre,inv.inv_descripcion,inv.inv_stock, inv.inv_valor,inv.inv_valorpvp,inv.inv_imagen,cat.categoria as categoria, sub.subcategoria as subcategoria,inv.idcategoria,inv.idsubcategoria FROM tbl_inventarios inv, inv_tblcategoria cat, inv_tblsubcategoria sub where inv.idempresa=? AND inv.idsubcategoria=sub.id GROUP BY inv_codigo";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $idempresa);
        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);

        $inv_stmt->execute();
        while ($inv_row = $inv_stmt->fetch()) {
            $data = $inv_row->inv_id . "||" . $inv_row->inv_codigo . "||" . $inv_row->inv_nombre . "||" . $inv_row->inv_descripcion . "||" . $inv_row->inv_stock . "||" . $inv_row->inv_valor . "||" . $inv_row->inv_valorpvp . "||" . $inv_row->inv_imagen . "||" . $inv_row->idcategoria . "||" . $inv_row->idsubcategoria;
            echo '<tr>';
            echo '<td>' . $inv_row->inv_id . '</td>';
            echo '<td>' . $inv_row->inv_codigo . '</td>';
            echo '<td>' . $inv_row->inv_nombre . '</td>';
            echo '<td>' . $inv_row->inv_descripcion . '</td>';
            echo '<td>' . $inv_row->inv_stock . '</td>';
            echo '<td>' . $inv_row->inv_valor . '</td>';
            echo '<td>' . $inv_row->inv_valorpvp . '</td>';

            echo '<td>' . $inv_row->categoria . '</td>';
            echo '<td>' . $inv_row->subcategoria . '</td>';

            echo '<td><img width="70px" height="70px" src="../' . $inv_row->inv_imagen . '"></td>';
            echo '<td>
                     <div class="btn-group pull-left">
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-espanded="false">
                            <i class="fa fa-cog"></i> Acciones <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a data-toggle="modal" data-target="#m-articulo" onclick="capturar(\'' . $data . '\')">Editar <i class="fa fa-edit"></i></a>
                            </li>
                              <li>
                    <button class="btn btn-success" data-toggle="modal" data-target="#mVer" onclick="detallar1(\'' . $inv_row->inv_codigo . '\')">
                        Ver <i class="glyphicon glyphicon-eye-open"></i>
                    </button>
                        </li>
                        </ul>
                     </div>
                  </td>';
            echo '</tr>';
        }
    }

    public function DatosClientes($inv_documento)
    {
        $inv_sql  = "SELECT inv.inv_id,inv.inv_codigo,inv.inv_nombre,inv.inv_descripcion,inv.inv_stock, inv.inv_valor,inv.inv_valorpvp,inv.inv_imagen,cat.categoria as categoria, sub.subcategoria as subcategoria ,inv.idempresa FROM tbl_inventarios inv, inv_tblcategoria cat, inv_tblsubcategoria sub  WHERE  inv_codigo=? AND cat.id=inv.idcategoria AND sub.id=inv.idsubcategoria ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $inv_documento);
        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        $inv_stmt->execute();
        while ($inv_row = $inv_stmt->fetch()) {
            echo '<div  style="width:50%">';
            echo '<label style="font-weight: bolder;font-size:15px">Codigo Producto: </label>';
            echo $inv_row->inv_codigo;
            echo '<br><label style="font-weight: bolder;font-size:15px">Nombre Producto: </label>';
            echo $inv_row->inv_nombre;
            echo '<br><label style="font-weight: bolder;font-size:15px">Descipcion Producto: </label>';
            echo $inv_row->inv_descripcion;
            echo '<br><label style="font-weight: bolder;font-size:15px">Cantidad: </label>';
            echo $inv_row->inv_stock;
            echo '<br><label style="font-weight: bolder;font-size:15px">Precio Compra: </label>';
            echo $inv_row->inv_valor;

            echo "</div>";
            echo '<div  style="width:30%">';

            echo '<br><label style="font-weight: bolder;font-size:15px">Precio Venta: </label>';
            echo $inv_row->inv_valorpvp;
            echo '<br><label style="font-weight: bolder;font-size:15px"> Categoria : </label>';
            echo $inv_row->categoria;
            echo '<br><label style="font-weight: bolder;font-size:15px">Subcategoria : </label>';
            echo $inv_row->subcategoria;

            echo "</div>";

            echo '<div  style="width:20%">';

            echo '<br><label style="font-weight: bolder;font-size:15px">Imagen : </label>';
            echo '<img width=120px;height=170px src="../' . $inv_row->inv_imagen . '">';
            echo "</div>";
        }
    }
}