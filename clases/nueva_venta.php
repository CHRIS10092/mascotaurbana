<?php
error_reporting(0);
session_start();
require_once 'config.php';
class nueva_venta extends config
{

    private $inv_dbh;
    public function __construct()
    {
        $this->inv_dbh = config::Abrir();
    }

    public function Traer_subcategoria($id)
    {

        $sql      = "SELECT *FROM tbl_empresas where emp_id=:id ";
        $preparar = $this->inv_dbh->prepare($sql);
        $preparar->bindParam(":id", $id);
        $preparar->execute();
        $rs = $preparar->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function listarempresas()
    {
        $sql  = "SELECT * FROM tbl_empresas";
        $stmt = $this->inv_dbh->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function listadoempresasventas()
    {

        //ejecuto la sentencia sql
        $inv_sql = "SELECT emp_ruc,emp_nombre,emp_direccion,emp_correo,emp_telefono,emp_id from tbl_empresas  ";
        //preparo la consulto
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        //le trasnformo a obj

        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        //ejecuto
        $inv_stmt->execute();
        //comparo si estan las mismas columnas en la base de datos
        while ($inv_row = $inv_stmt->fetch()) {
            # code...
            $data = $inv_row->emp_ruc . "||" . $inv_row->emp_nombre . "||" . $inv_row->emp_direccion . "||" . $inv_row->emp_correo . "||" . $inv_row->emp_telefono . "||" . $inv_row->emp_id;
            echo '<tr>';

            echo '<td>' . $inv_row->emp_ruc . '</td>';
            echo '<td>' . $inv_row->emp_nombre . '</td>';
            echo '<td>' . $inv_row->emp_telefono . '</td>';

            echo '<td>

            <button class="btn btn-success"  onclick="capturarempresa(\'' . $data . '\')">
            <i class="glyphicon glyphicon-edit"></i>
            </button>


            </td>';
            echo '</tr>';
        }
    }

    private function VerificarRuc($inv_datos)
    {

        $inv_sql  = "SELECT idcliente FROM tbl_ventas WHERE ruc=? ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $inv_datos[0]);
        $inv_stmt->execute();
        $inv_datos = $inv_stmt->rowCount();
        return $inv_datos;
    }

    public function NuevoNumero($id_empresa)
    {
        $numero_venta = '000000000';

        $sql = "SELECT MAX(numero) AS numero FROM tbl_empresas_venta WHERE idempresa = :id_empresa";
        $ps  = $this->inv_dbh->prepare($sql);
        $ps->execute([
            "id_empresa" => $id_empresa,
        ]);

        while ($rs = $ps->fetch()) {

            if ($rs['numero'] != null) {

                $numero_venta = $rs['numero'];
            }
        }

        return $numero_venta;
    }

    //para empresas nuevo numero
    public function NuevoNumeroEMP($id_empresa)
    {
        $numero_venta = '000000000';

        $sql = "SELECT MAX(ven_numero) AS numero FROM tbl_ventas WHERE idempresa = :id_empresa";
        $ps  = $this->inv_dbh->prepare($sql);
        $ps->execute([
            "id_empresa" => $id_empresa,
        ]);

        while ($rs = $ps->fetch()) {

            if ($rs['numero'] != null) {

                $numero_venta = $rs['numero'];
            }
        }

        return $numero_venta;
    }

    public function ListarArticulosAdmin($idempresa)
    {
        $inv_sql = "SELECT a.art_codigo AS codigo , a.art_nombre AS nombre, a.art_descripcion AS descripcion ,a.art_valor AS valor,
        a.art_stock  AS stock, a.art_id AS art_id from tbl_articulos a where idempresa=:idempresa ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);

        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        $inv_stmt->execute([
            "idempresa" => $idempresa,
        ]);
        while ($inv_row = $inv_stmt->fetch()) {
            $data = $inv_row->codigo . '||' . $inv_row->nombre . '||' . $inv_row->art_id . '||' . $inv_row->descripcion . '||' . $inv_row->stock . '||' . $inv_row->valor;
            echo '<tr>';
            echo '<td>' . $inv_row->codigo . '</td>';
            echo '<td>' . $inv_row->nombre . ' </td>';
            echo '<td>' . $inv_row->descripcion . '</td>';
            echo '<td>
            <div class="pull-right">
            <input type="number" class="form-control" style="text-align:right" id="txt-cantidad' . $inv_row->art_id . '" value="1">
            </div>
            </td>';
            echo '<td>
            <div class="input-group pull-right">

            <input type="number" class="form-control" style="text-align:right;color:red" readOnly value="' . $inv_row->valor . '" id="txt-precio' . $inv_row->art_id . '">
            </div>
            </td>';
            echo '<td>
            <div class="pull-right">
            <input type="number" class="form-control" style="text-align:right;color:red" readOnly id="txt-existencia' . $inv_row->art_id . '" value="' . $inv_row->stock . '">
            </div>
            </td>';
            echo '<td>
            <a href="#" onclick="agregar(\'' . $data . '\')"><i class="glyphicon glyphicon-shopping-cart " style="font-size:24px;color: #5CB85C;"></i></a>
            </td>';
            echo '</tr>';
        }
    }

    public function ListarArticulos($idempresa)
    {
        $inv_sql  = "SELECT * FROM tbl_articulos where idempresa=?";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $idempresa);
        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);

        $inv_stmt->execute();

        while ($inv_row = $inv_stmt->fetch()) {
            $data = $inv_row->art_codigo . "||" . $inv_row->art_nombre . "||" . $inv_row->art_id . "||" . $inv_row->art_descripcion . "||" . $inv_row->art_stock . "||" . $inv_row->art_valor;
            echo '<tr>';
            echo '<td>' . $inv_row->art_codigo . '</td>';
            echo '<td>' . $inv_row->art_nombre . ' </td>';
            echo '<td>' . $inv_row->art_descripcion . '</td>';
            echo '<td>
            <div class="pull-right">
            <input type="number" class="form-control" style="text-align:right" id="txt-cantidad' . $inv_row->art_id . '" value="1">
            </div>
            </td>';
            echo '<td>
            <div class="input-group pull-right">

            <input type="number" class="form-control" style="text-align:right;color:red" readOnly value="' . $inv_row->art_valor . '" id="txt-precio' . $inv_row->art_id . '">
            </div>
            </td>';
            echo '<td>
            <div class="pull-right">
            <input type="number" class="form-control" style="text-align:right;color:red" readOnly id="txt-existencia' . $inv_row->art_id . '" value="' . $inv_row->art_stock . '">
            </div>
            </td>';
            echo '<td>
            <a href="#" onclick="agregar(\'' . $data . '\')"><i class="glyphicon glyphicon-shopping-cart " style="font-size:24px;color: #5CB85C;"></i></a>
            </td>';
            echo '</tr>';
        }
    }

    public function Registrar_VentaAdmin($datos)
    {

        $sql = "INSERT INTO `tbl_empresas_venta`(`numero`, `fecha`, `subtotal`, `iva`, `total`,
        `idcliente`,`idempresa`,`idsucursal`,numero_emision,`estado`,`xml`)
                VALUES (:numero,:fecha,:subtotal,:iva,:total,:idcliente,:idempresa,:idsucursal,:numeroEmision,:estado,:xml)";
        $stmt = $this->inv_dbh->prepare($sql);
        $stmt->execute([
            "numero"        => $datos["numero"],
            "fecha"         => $datos["fecha"],
            "subtotal"      => $datos["subtotal"],
            "iva"           => $datos["iva"],
            "total"         => $datos["total"],
            "idcliente"     => $datos["rucci"],
            "idempresa"     => $datos["idempresa"],
            "idsucursal"    => $datos["idsucursal"],
            "numeroEmision" => $datos["numeroEmision"],
            "estado"        => $datos["estado"],
            "xml"           => $datos["xml"],
        ]);
    }

    public function Registrar_Cliente($datos)
    {

        $sql  = "INSERT INTO `tbl_clientes`(`cli_rucci`, `cli_nombre`, `cli_apellido`, `cli_direccion`, `cli_correo`, `cli_celular`, `idempresa`) VALUES (:rucci,:nombre,:apellido,:direccion,:correo,:celular,:idempresa)";
        $stmt = $this->inv_dbh->prepare($sql);

        $stmt->execute([
            "rucci"     => $datos["rucci"],
            "nombre"    => $datos["nombre"],
            "apellido"  => $datos["apellido"],
            "direccion" => $datos["direccion"],
            "correo"    => $datos["correo"],
            "celular"   => $datos["celular"],
            "idempresa" => $datos["idempresa"],
        ]);
    }

    public function ActualizarStockInventario($inv_stock, $inv_medicamento)
    {
        try {

            $inv_sql  = "UPDATE tbl_articulos SET art_stock=? WHERE art_id=? ";
            $inv_stmt = $this->inv_dbh->prepare($inv_sql);
            $inv_stmt->bindParam(1, $inv_stock);
            $inv_stmt->bindParam(2, $inv_medicamento);
            $inv_stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function StockAnteriorInventario($inv_medicamento)
    {
        try {
            $inv_sql  = "SELECT SUM(art_stock) as inv_stock FROM tbl_articulos WHERE art_id=?";
            $inv_stmt = $this->inv_dbh->prepare($inv_sql);
            $inv_stmt->bindParam(1, $inv_medicamento);
            $inv_stmt->execute();
            $inv_row = $inv_stmt->fetchAll();
            foreach ($inv_row as $inv_key) {
                $inv_cantidad = $inv_key[0];
            }
            return $inv_cantidad;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //admin

    public function Registrar_Detalle($cantidad, $precio, $total, $id_venta, $id_a, $idempresa)
    {
        $sql = "INSERT INTO tbl_detalle_venta_empresa(`cantidad`,`precio`,`total`,`idventa`,`idarticulo`,`idempresa`) VALUES(?,?,?,?,?,?)";

        $inv_stmt = $this->inv_dbh->prepare($sql);
        $inv_stmt->bindParam(1, $cantidad);
        $inv_stmt->bindParam(2, $precio);
        $inv_stmt->bindParam(3, $total);
        $inv_stmt->bindParam(4, $id_venta);
        $inv_stmt->bindParam(5, $id_a);
        $inv_stmt->bindParam(6, $idempresa);
        $inv_stmt->execute();
    }

    public function Registrar_Venta($datos)
    {
        $sql  = "INSERT INTO `tbl_ventas`( `ven_numero`, `ven_fecha`, `ven_subtotal`, `ven_iva`, `ven_total`, `idcliente`, `idempresa`,`idsucursal`,`ven_numero_emision`, `estado`, `xml`) VALUES(:numero,:fecha,:subtotal,:iva,:total,:idcliente,:idempresa,:idsucursal,:numeroEmision,:estado,:xml)";
        $stmt = $this->inv_dbh->prepare($sql);
        $stmt->execute([
            "numero"        => $datos["numero"],
            "fecha"         => $datos["fecha"],
            "subtotal"      => $datos["subtotal"],
            "iva"           => $datos["iva"],
            "total"         => $datos["total"],
            "idcliente"     => $datos["rucci"],
            "idempresa"     => $datos["idempresa"],
            "idsucursal"    => $datos["idsucursal"],
            "numeroEmision" => $datos["numeroEmision"],
            "estado"        => $datos["estado"],
            "xml"           => $datos["xml"],
        ]);
    }

    public function Registrar_DetalleEmp($cantidad, $precio, $total, $id_venta, $id_a, $idempresa)
    {
        $sql = "INSERT INTO tbl_detalle_ventas(`detven_cantidad`,`detven_precio`,`detven_total`,`idventa`,`idarticulo`,`idempresa`) VALUES(?,?,?,?,?,?)";

        $inv_stmt = $this->inv_dbh->prepare($sql);
        $inv_stmt->bindParam(1, $cantidad);
        $inv_stmt->bindParam(2, $precio);
        $inv_stmt->bindParam(3, $total);
        $inv_stmt->bindParam(4, $id_venta);
        $inv_stmt->bindParam(5, $id_a);
        $inv_stmt->bindParam(6, $idempresa);
        $inv_stmt->execute();
    }


    public function VerificarDuplicadoCliente($cedulac)
    {

        $sql      = "SELECT cli_rucci from tbl_clientes where cli_rucci=?";
        $inv_stmt = $this->inv_dbh->prepare($sql);
        $inv_stmt->bindParam(1, $cedulac);
        $inv_stmt->execute();

        if ($inv_stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function TraerCedulasV($cedula)
    {
        $sql      = "SELECT cli_nombre,cli_apellido,cli_direccion,cli_correo,cli_celular FROM tbl_clientes where cli_rucci=?";
        $inv_stmt = $this->inv_dbh->prepare($sql);

        $inv_stmt->bindParam(1, $cedula);
        $inv_stmt->execute();
        $datos = new stdClass();

        //traer un reg
        while ($rs = $inv_stmt->fetch()) {
            $datos->nombre    = $rs[0];
            $datos->apellidos = $rs[1];
            $datos->direccion = $rs[2];
            $datos->correo    = $rs[3];
            $datos->celular   = $rs[4];
        }

        return $datos;
    }

    public function TraerRuc($cedula)
    {
        $sql      = "SELECT emp_id,emp_nombre,emp_direccion,emp_correo,emp_telefono FROM tbl_empresas where emp_ruc=?";
        $inv_stmt = $this->inv_dbh->prepare($sql);

        $inv_stmt->bindParam(1, $cedula);
        $inv_stmt->execute();
        $datos = new stdClass();

        //traer un reg
        while ($rs = $inv_stmt->fetch()) {
            $datos->emp_id        = $rs[0];
            $datos->emp_nombre    = $rs[1];
            $datos->emp_direccion = $rs[2];
            $datos->emp_correo    = $rs[3];
            $datos->emp_telefono  = $rs[4];
        }

        return $datos;
    }

    public function ListarHistorial()
    {
        $sql = "SELECT numero,fecha,CONCAT(c.cedulac,' ',c.nombre,' ',c.apellidos)AS client,z.categoria AS zona,s.subcategoria AS subzona
        FROM ventas v,cliente c, inv_tblcategoria z,inv_tblsubcategoria s
        WHERE v.cedulac=c.cedulac
        AND v.id_cate=z.id
        AND v.id_sub = s.id_s";
        $inv_stmt = $this->inv_dbh->prepare($sql);
        $inv_stmt->execute();
        $rs = $inv_stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function VerDetalle($id)
    {
        $sql = "SELECT img,nombre,descripcion,cantidad,precio,total
        FROM detalle_venta x,tbl_articulos a
        WHERE a.id_a=x.id_a
        AND id_venta =?";
        $inv_stmt = $this->inv_dbh->prepare($sql);
        $inv_stmt->bindParam(1, $id);
        $inv_stmt->execute();
        $rs = $inv_stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function detalle_art($empresa, $sucursal, $secuencial)
    {
        $sql = "SELECT art_codigo,art_nombre,detven_precio,detven_cantidad,detven_total FROM tbl_detalle_ventas x,tbl_articulos a,tbl_distribucion d,tbl_ventas v ,tbl_sucursal s
    WHERE x.idarticulo=d.dis_id
    AND a.art_id = d.idarticulo
    AND v.idsucursal = s.codigo_suc
    AND x.idempresa = :empresa
    AND s.codigo_suc = :sucursal
    AND v.ven_numero = :secuencial";
        $stmt = $this->inv_dbh->prepare($sql);
        $stmt->execute(["empresa" => $empresa, "sucursal" => $sucursal, "secuencial" => $secuencial]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
} //fin