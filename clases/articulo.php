
<?php
session_start();
require_once 'config.php';
class articulo extends config
{

    private $inv_dbh;
    public function __construct()
    {
        $this->inv_dbh = config::Abrir();
    }

    public function Registrar($inv_datos)
    {
        if (self::VerificarCodigo($inv_datos) > 0) {
            echo 2;
        } else {
            echo self::VerificarRegistro($inv_datos);
        }
    }

    public function VerificarRegistro($inv_datos)
    {
        try {

            $inv_sql  = "INSERT INTO tbl_articulos(art_codigo,art_nombre,art_descripcion,art_stock,art_valor,art_valorpvp,art_imagen,art_cantidad_entregados,idcategoria,idsubcategoria)VALUES(?,?,?,?,?,?,?,?,?,?)";
            $inv_stmt = $this->inv_dbh->prepare($inv_sql);
            $inv_stmt->bindParam(1, $inv_datos[0]);
            $inv_stmt->bindParam(2, $inv_datos[1]);
            $inv_stmt->bindParam(3, $inv_datos[2]);
            $inv_stmt->bindParam(4, $inv_datos[3]);
            $inv_stmt->bindParam(5, $inv_datos[4]);
            $inv_stmt->bindParam(6, $inv_datos[5]);
            $inv_stmt->bindParam(7, $inv_datos[6]);
            $inv_stmt->bindParam(8, $inv_datos[3]);
            $inv_stmt->bindParam(9, $inv_datos[7]);
            $inv_stmt->bindParam(10, $inv_datos[8]);

            $inv_stmt->execute();
            echo 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    private function VerificarCodigo($inv_datos)
    {

        $inv_sql  = "SELECT art_codigo FROM tbl_articulos WHERE art_codigo=? ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $inv_datos[0]);
        $inv_stmt->execute();
        $inv_datos = $inv_stmt->rowCount();
        return $inv_datos;
    }

    public function Listar()
    {
        $inv_sql = "SELECT (art_id) AS id , art_codigo, art_nombre, art_descripcion, art_stock,art_valor,art_valorpvp,art_imagen,idcategoria,idsubcategoria
                    FROM tbl_articulos";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        //$inv_stmt->bindParam(1, $idempresa);
        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        $inv_stmt->execute();
        while ($inv_row = $inv_stmt->fetch()) {
            $data = $inv_row->id . "||" . $inv_row->art_codigo . "||" . $inv_row->art_nombre . "||" . $inv_row->art_descripcion . "||" . $inv_row->art_stock . "||" . $inv_row->art_valor . "||" . $inv_row->art_valorpvp . "||" . $inv_row->art_imagen . "||" . $inv_row->idcategoria . "||" . $inv_row->idsubcategoria;
            echo '<tr>';
            echo '<td>' . $inv_row->id . '</td>';
            echo '<td>' . $inv_row->art_nombre . '</td>';
            echo '<td>' . $inv_row->art_descripcion . '</td>';
            echo '<td>' . $inv_row->art_stock . '</td>';
            echo '<td>' . $inv_row->art_valor . '</td>';
            echo '<td>' . $inv_row->art_valorpvp . '</td>';
            echo '<td>' . $inv_row->idcategoria . '</td>';
            echo '<td>' . $inv_row->idsubcategoria . '</td>';
            echo '<td><img width="200px" height="150px" src="../' . $inv_row->art_imagen . '"></td>';
            echo '<td>
                     <div class="btn-group pull-left">
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-espanded="false">
                            <i class="fa fa-cog"></i> Acciones <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a data-toggle="modal" data-target="#m-articulo" onclick="capturar(\'' . $data . '\')">Editar <i class="fa fa-edit"></i></a>
                            </li> <li>
                                <a data-toggle="modal" data-target="#m-ver" onclick="detallar(\'' . $data . '\')">Ver <i class="fa fa-edit"></i></a>
                            </li>
                        </ul>
                     </div>
                  </td>';
            echo '</tr>';

        }

    }

    public function ListarStock($empresa)
    {
        $inv_sql = " SELECT art.art_codigo,art.art_nombre,art.art_descripcion, art.art_valorpvp, SUM( DISTINCT dis_cantidad) as dis_cantidad,dis_valor, art.art_imagen FROM  tbl_articulos art ,tbl_distribucion dis WHERE dis.idarticulo=art.art_id
AND dis.idempresa=? GROUP BY art.art_id ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $empresa);
        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        $inv_stmt->execute();
        while ($inv_row = $inv_stmt->fetch()) {
            $data = $inv_row->art_codigo . "||" . $inv_row->art_nombre . "||" . $inv_row->art_descripcion . "||" . $inv_row->art_valorpvp . "||" . $inv_row->dis_cantidad . "||" . $inv_row->dis_valor . "||" . $inv_row->art_imagen;
            echo '<tr>';
            echo '<td>' . $inv_row->art_codigo . '</td>';
            echo '<td>' . $inv_row->art_nombre . '</td>';
            echo '<td>' . $inv_row->art_descripcion . '</td>';
            echo '<td>' . $inv_row->art_valorpvp . '</td>';
            echo '<td>' . $inv_row->dis_cantidad . '</td>';
            echo '<td>' . $inv_row->dis_valor . '</td>';

            echo '<td><img width="200px" height="150px" src="../' . $inv_row->art_imagen . '"></td>';
            echo '<td>
                     <div class="btn-group pull-left">
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-espanded="false">
                            <i class="fa fa-cog"></i> Acciones <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a data-toggle="modal" data-target="#m-stock" onclick="capturar(\'' . $data . '\')">Editar <i class="fa fa-edit"></i></a>
                            </li>
                              <li>
                <button class="btn btn-success" data-toggle="modal" data-target="#mVer" onclick="detallar1(\'' . $inv_row->art_codigo . '\')">
                        Ver <i class="glyphicon glyphicon-eye-open"></i>
                    </button>
                        </li>
                        </ul>
                     </div>
                  </td>';
            echo '</tr>';

        }

    }
//reporte de venta de empresas
    public function repor()
    {
        $inv_sql = " SELECT c.cli_rucci,c.cli_nombre,c.cli_apellido,v.ven_numero, v.ven_fecha, v.ven_subtotal, v.ven_iva, v.ven_total, v.idcliente, v.idempresa FROM tbl_ventas v, tbl_clientes c
        WHERE  v.idcliente=c.cli_rucci  AND v.idempresa='" . $_SESSION['empresa']['idempresa'] . "' ORDER by v.ven_numero DESC";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);

        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        $inv_stmt->execute();
        while ($inv_row = $inv_stmt->fetch()) {
            $data = $inv_row->cli_rucci . '||' . $inv_row->cli_nombre . '||' . $inv_row->cli_apellido . '||' . $inv_row->ven_numero . '||' . $inv_row->ven_fecha;
            echo '<tr>';

            echo '<td>' . $inv_row->cli_rucci . '</td>';
            echo '<td>' . $inv_row->cli_nombre . '</td>';
            echo '<td>' . $inv_row->cli_apellido . '</td>';
            echo '<td>' . $inv_row->ven_numero . '</td>';
            echo '<td>' . $inv_row->ven_fecha . '</td>';

            echo '<td>' . $inv_row->ven_total . '</td>';

            echo '<td>
                     <div class="btn-group pull-left">
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-espanded="false">
                            <i class="fa fa-cog"></i> Acciones <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                               <button class="btn btn-success" data-toggle="modal" data-target="#mVer" onclick="detallarempresa(\'' . $inv_row->ven_numero . '\')">
                        Ver <i class="glyphicon glyphicon-eye-open"></i>

                       </li>
                        </ul>
                     </div>
                  </td>';
            echo '</tr>';

        }

    }

    public function DatosClientes($inv_documento)
    {
        $inv_sql = "SELECT art.art_codigo,art.art_nombre,art.art_descripcion, art.art_valorpvp, SUM( DISTINCT dis_cantidad) as dis_cantidad,dis_valor, art.art_imagen FROM  tbl_articulos art ,tbl_distribucion dis WHERE dis.idarticulo=art.art_id
AND art.art_codigo=? ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $inv_documento);
        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        $inv_stmt->execute();
        while ($inv_row = $inv_stmt->fetch()) {
            echo '<div  style="width:50%">';
            echo '<label style="font-weight: bolder;font-size:15px">Nombre Mascota: </label>';
            echo $inv_row->art_codigo;
            echo '<br><label style="font-weight: bolder;font-size:15px">Fecha de nacimiento: </label>';
            echo $inv_row->art_nombre;
            echo '<br><label style="font-weight: bolder;font-size:15px">Sexo: </label>';
            echo $inv_row->art_descripcion;
            echo '<br><label style="font-weight: bolder;font-size:15px">Color : </label>';
            echo $inv_row->art_valorpvp;
            echo '<br><label style="font-weight: bolder;font-size:15px">Color Secundario : </label>';
            echo '<img width=120px;height=170px src="../' . $inv_row->art_imagen . '">';

            echo "</div>";

        }

    }

    public function Editar($datos)
    {
        $sql = "UPDATE tbl_articulos SET art_codigo=?,art_nombre=?,art_descripcion=?,art_stock=?,art_valor=?,art_valorpvp=?
        ,art_imagen=?,idcategoria=?,idsubcategoria=? WHERE art_id=?";
        $ps = $this->inv_dbh->prepare($sql);
        $ps->bindParam(1, $datos[0]);
        $ps->bindParam(2, $datos[1]);
        $ps->bindParam(3, $datos[2]);
        $ps->bindParam(4, $datos[3]);
        $ps->bindParam(5, $datos[4]);
        $ps->bindParam(6, $datos[5]);
        $ps->bindParam(7, $datos[6]);
        $ps->bindParam(8, $datos[7]);
        $ps->bindParam(9, $datos[8]);
        $ps->bindParam(10, $datos[10]);
        $ps->execute();
    }

    public function RegistrarEmpresa($inv_datos)
    {
        if (self::VerificarCodigoEmpresa($inv_datos) > 0) {
            echo 2;
        } else {
            echo self::InsertarArticulo($inv_datos);
        }
    }
    //verificar el id articulo

    private function VerificarCodigoEmpresa($inv_datos)
    {

        $inv_sql  = "SELECT inv_codigo FROM tbl_inventarios WHERE inv_codigo=? ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $inv_datos[0]);
        $inv_stmt->execute();
        $inv_datos = $inv_stmt->rowCount();
        return $inv_datos;
    }

//para el inventario de cada empresa
    public function InsertarArticulo($inv_datos)
    {
        try {

            $inv_sql  = "INSERT INTO tbl_inventarios(inv_codigo,inv_nombre,inv_descripcion,inv_stock,inv_valor,inv_valorpvp,inv_imagen,idcategoria,idsubcategoria,fecha_expiracion,idempresa,lote,idsucursal)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $inv_stmt = $this->inv_dbh->prepare($inv_sql);
            $inv_stmt->bindParam(1, $inv_datos[0]);
            $inv_stmt->bindParam(2, $inv_datos[1]);
            $inv_stmt->bindParam(3, $inv_datos[2]);
            $inv_stmt->bindParam(4, $inv_datos[3]);
            $inv_stmt->bindParam(5, $inv_datos[4]);
            $inv_stmt->bindParam(6, $inv_datos[5]);
            $inv_stmt->bindParam(7, $inv_datos[6]);
            $inv_stmt->bindParam(8, $inv_datos[7]);
            $inv_stmt->bindParam(9, $inv_datos[8]);
            $inv_stmt->bindParam(10, $inv_datos[9]);
            $inv_stmt->bindParam(11, $inv_datos[10]);
            $inv_stmt->bindParam(12, $inv_datos[11]);
            $inv_stmt->bindParam(13, $inv_datos[12]);

            $inv_stmt->execute();
            echo 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    public function EditarEmp($datos)
    {
        $sql = "UPDATE tbl_inventarios SET inv_codigo=?,inv_nombre=?,inv_descripcion=?,inv_stock=?,inv_valor=?,inv_valorpvp=?
        ,inv_imagen=?,idcategoria=?,idsubcategoria=? , idempresa=? WHERE inv_id=?";
        $ps = $this->inv_dbh->prepare($sql);
        $ps->bindParam(1, $datos[0]);
        $ps->bindParam(2, $datos[1]);
        $ps->bindParam(3, $datos[2]);
        $ps->bindParam(4, $datos[3]);
        $ps->bindParam(5, $datos[4]);
        $ps->bindParam(6, $datos[5]);
        $ps->bindParam(7, $datos[6]);
        $ps->bindParam(8, $datos[7]);
        $ps->bindParam(9, $datos[8]);
        $ps->bindParam(10, $datos[9]);
        $ps->bindParam(11, $datos[10]);
        $ps->execute();
    }

    public function EditarDistribucion($datos)
    {
        $sql = "UPDATE tbl_distribucion SET dis_valor=?   WHERE idarticulo=? ";
        $ps  = $this->inv_dbh->prepare($sql);
        $ps->bindParam(1, $datos[0]);
        $ps->bindParam(2, $datos[1]);

        $ps->execute();
    }

    public function listartipo()
    {
        $sql  = "SELECT * FROM tipo_articulo";
        $stmt = $this->inv_dbh->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function ListarCategoria()
    {
        $inv_sql  = "SELECT * FROM inv_tblcategoria";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        $inv_stmt->execute();
        while ($inv_row = $inv_stmt->fetch()) {
            echo '<option value="' . $inv_row->id . '" >' . $inv_row->categoria . '</option>';
        }
    }

    public function ListarSubcategoria($inv_id)
    {
        $inv_sql  = "SELECT * FROM inv_tblsubcategoria WHERE idcategoria=?";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $inv_id);
        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        $inv_stmt->execute();
        while ($inv_row = $inv_stmt->fetch()) {
            echo '<option value="' . $inv_row->id . '" >' . $inv_row->subcategoria . '</option>';
        }
    }

}
