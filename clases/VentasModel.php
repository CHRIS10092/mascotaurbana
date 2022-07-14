<?php
//session_start();
require_once 'config.php';
class VentasModel extends config
{

    private $dbh;
    public function __construct()
    {
        $this->dbh = config::Abrir();
    }  
    public function Registrar_Cliente($datos)
    {

        $sql  = "INSERT INTO `tbl_clientes`(`cli_rucci`, `cli_nombre`, `cli_apellido`, `cli_direccion`, `cli_correo`, `cli_celular`, `idempresa`) VALUES (:rucci,:nombre,:apellido,:direccion,:correo,:celular,:idempresa)";
        $stmt = $this->dbh->prepare($sql);

        $stmt->execute([
            "rucci"     => $datos["ruc"],
            "nombre"    => $datos["nombre"],
            "apellido"  => $datos["apellido"],
            "direccion" => $datos["direccion"],
            "correo"    => $datos["correo"],
            "celular"   => $datos["celular"],
            "idempresa" => $_SESSION['empresa']['idempresa'],
        ]);
    }
    public function AddVenta($obj){
        $sql = "INSERT INTO `tbl_ventas`(`ven_numero`, `ven_fecha`, 
                                         `ven_subtotal`, `ven_iva`, 
                                         `ven_total`, `idcliente`, 
                                         `idempresa`, `ven_numero_emision`,
                                          `idsucursal`, `estado`, 
                                          `xml`,`chipsDetails`,`estadoChips`,`descuento`) 
    VALUES (:numero,:fecha,:subtotal,:iva,:total,:cliente,:empresa,:emision,:sucursal,:estado,:xml,:detalleChips,:estadoChips,:descuento)";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            "numero"=>$obj["numero"],
            "fecha"=>$obj["fecha"],
            "subtotal"=>$obj["subtotal"],
            "iva"=>$obj["iva"],
            "total"=>$obj["total"],
            "cliente"=>$obj["cliente"],
            "empresa"=>$obj["empresa"],
            "emision"=>$obj["emision"],
            "sucursal"=>$obj["sucursal"],
            "estado"=>$obj["estado"],
            "xml"=>$obj["xml"],
            "detalleChips"=>$obj["detalleChips"],
            "estadoChips"=>$obj["estadoChips"],
            "descuento"=>$obj["descuento"],
        ]);
        
        
    }

    public function VerificarDuplicadoCliente($cedulac)
    {

        $sql      = "SELECT cli_rucci from tbl_clientes where cli_rucci=?";
        $inv_stmt = $this->dbh->prepare($sql);
        $inv_stmt->bindParam(1, $cedulac);
        $inv_stmt->execute();

        if ($inv_stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function GetNumero($id_empresa)
    {

        $numero_venta = '000000000';

        $sql = "SELECT MAX(ven_numero) AS numero FROM tbl_ventas WHERE idempresa = :id_empresa";
        $ps  = $this->dbh->prepare($sql);
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
    public function GetNumeroDetalle($id_empresa)
    {

        $numero_venta = '000000000';

        $sql = "SELECT MAX(idventa) AS numero FROM tbl_detalle_ventas WHERE idempresa = :id_empresa";
        $ps  = $this->dbh->prepare($sql);
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
    public function UltimateVenta(){
        $row = 0;
        $sql = "SELECT COUNT(*) AS row FROM `tbl_ventas`";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();
        while($rs = $stmt->fetch()){
            $row = $rs['row'];
        }
        return $row; 
    }

    public function AddDetalle($obj){
        $sql = "INSERT INTO `tbl_detalle_ventas`(`detven_cantidad`, `detven_precio`, `detven_total`, `idventa`, `idarticulo`, `idempresa`,`descuento`) 
           VALUES (
           :cantidad,:precio,:total,
           :venta,:articulo,:empresa,:descuento)";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            "cantidad"=>$obj["cantidad"],
            "precio"=>$obj["precio"],
            "total"=>$obj["total"],
            "venta"=>$obj["venta"],
            "articulo"=>$obj["articulo"],
            "empresa"=>$obj["empresa"],
            "descuento"=>$obj["descuento"],
        ]);
        
    }

    public function FacturasChips($empresa,$sucursal)
    {
        $estado = 'P';
        $sql = "SELECT ven_numero,ven_fecha,concat(c.cli_nombre,' ',c.cli_apellido)as cliente ,
        ven_id
        FROM tbl_ventas v
        INNER JOIN tbl_clientes c ON v.idcliente = c.idcliente
        WHERE v.idempresa = ?
        AND v.idsucursal = ?
        AND v.estadoChips = ?";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(1, $empresa);
        $stmt->bindParam(2, $sucursal);
        $stmt->bindParam(3, $estado);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function GetById($id)
    {
        
        $sql = "SELECT c.cli_nombre as nombre,
                       c.cli_apellido as apellido,
                    ven_id as id,
                    chipsDetails as detalle,
                    c.cli_rucci as ruc,
                    c.cli_celular as celular,
                    c.cli_correo as correo
        FROM tbl_ventas v
        INNER JOIN tbl_clientes c ON v.idcliente = c.idcliente
        WHERE v.ven_id = ?";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $obj = new stdClass();
        while ($rs = $stmt->fetch()) {
            $obj->id = $rs['id'];
            $obj->nombre = $rs['nombre'];
            $obj->apellido = $rs['apellido'];
            $obj->detalle = $rs['detalle'];
            $obj->ruc = $rs['ruc'];
            $obj->celular = $rs['celular'];
            $obj->correo = $rs['correo'];
        }
        return $obj;
    }

    public function UpdateVenta($estado,$detalle,$id){
        $sql = "UPDATE tbl_ventas SET chipsDetails=:detalle,estadoChips=:estado 
                where ven_id=:id";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            "id"=>$id,
            "detalle"=>$detalle,
            "estado"=>$estado
        ]);
        
    }

    public function traerCodigos($empresa,$sucursal){
        $row = 0;
        $sql = "SELECT numero FROM chips WHERE estado = 1 AND idempresa=:empresa  AND idsucursal=:sucursal  ORDER BY RAND()  LIMIT 1";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            "empresa"=>$empresa,
            "sucursal"=>$sucursal
            ]);
        while($rs = $stmt->fetch()){
            $row = $rs['numero'];
        }
        return $row; 
    }

    public function StockAnteriorInventario($inv_medicamento)
    {
        try {
            $inv_sql  = "SELECT SUM(inv_stock) as inv_stock FROM tbl_inventarios WHERE inv_id=?";
            $inv_stmt = $this->dbh->prepare($inv_sql);
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

    public function ActualizarStockInventario($inv_stock, $inv_medicamento)
    {
        try {

            $inv_sql  = "UPDATE tbl_inventarios SET inv_stock=? WHERE inv_id=? ";
            $inv_stmt = $this->dbh->prepare($inv_sql);
            $inv_stmt->bindParam(1, $inv_stock);
            $inv_stmt->bindParam(2, $inv_medicamento);
            $inv_stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function XmlFirmado($id,$xml,$estado,$idempresa,$idsucursal){
    
            $sql="UPDATE tbl_ventas SET xml=:xml , estado=:estado 
            WHERE  ven_id=:ven_id 
            AND idempresa=:idempresa 
            AND idsucursal=:idsucursal";
            $stmt=$this->dbh->prepare($sql);
            $stmt->execute([
                "ven_id"=>$id,
                "xml"=>$xml,
                "estado"=>$estado,
                "idempresa"=>$idempresa,
                "idsucursal"=>$idsucursal,
            ]);
}

public function XmlAutorizado($id,$estado,$idempresa,$idsucursal){
    
    $sql="UPDATE tbl_ventas SET  estado=:estado 
    WHERE  ven_id=:ven_id 
    AND idempresa=:idempresa 
    AND idsucursal=:idsucursal";
    $stmt=$this->dbh->prepare($sql);
    $stmt->execute([
        "ven_id"=>$id,
         "estado"=>$estado,
        "idempresa"=>$idempresa,
        "idsucursal"=>$idsucursal,
    ]);
}

}
