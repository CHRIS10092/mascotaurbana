
<?php
session_start();
require_once 'config.php';
class chips extends config
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

            $inv_sql  = "INSERT INTO `chips`(`numero`, `estado`, `idempresa`, `idsucursal`) VALUES (?,?,?,?)";
            $inv_stmt = $this->inv_dbh->prepare($inv_sql);
            $inv_stmt->bindParam(1, $inv_datos[0]);
            $inv_stmt->bindParam(2, $inv_datos[1]);
            $inv_stmt->bindParam(3, $inv_datos[2]);
            $inv_stmt->bindParam(4, $inv_datos[3]);
            

            $inv_stmt->execute();
            echo 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    private function VerificarCodigo($inv_datos)
    
    {

        $inv_sql  = "SELECT numero FROM chips WHERE numero=? ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $inv_datos[0]);
        $inv_stmt->execute();
        $inv_datos = $inv_stmt->rowCount();
        return $inv_datos;
    }

    public function Listar()
    {
        $inv_sql = "SELECT id , numero,estado,idempresa,idsucursal  FROM chips";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        //$inv_stmt->bindParam(1, $idempresa);
        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        $inv_stmt->execute();
        while ($inv_row = $inv_stmt->fetch()) {
            $data = $inv_row->id . "||" . $inv_row->numero . "||" . $inv_row->estado . "||" . $inv_row->idempresa . "||" . $inv_row->idsucursal;
            echo '<tr>';
            echo '<td>' . $inv_row->id . '</td>';
            echo '<td>' . $inv_row->numero . '</td>';
            echo '<td>' . $inv_row->estado . '</td>';
            echo '<td>' . $inv_row->idempresa . '</td>';
            echo '<td>' . $inv_row->idsucursal . '</td>';

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
        $sql = " UPDATE chips SET numero=?,idempresa=?,idsucursal=? WHERE codigo=?";
        $ps = $this->inv_dbh->prepare($sql);
        $ps->bindParam(1, $datos[0]);
        $ps->bindParam(2, $datos[1]);
        $ps->bindParam(3, $datos[2]);
        $ps->bindParam(4, $datos[3]);
        $ps->bindParam(4, $datos[4]);
        
        $ps->execute();
    }

        
}
