<?php 

require_once 'config.php';

  class  NotasCredito extends config{
    private $dbh;
    public function __construct(){

        $this->dbh=config::Abrir();
    }

    public function GetClient($idempresa,$idsucursal){
        $sql="SELECT v.*,c.*  FROM tbl_ventas v ,tbl_clientes c WHERE v.estado='3' 
        AND c.idcliente=v.idcliente
        AND v.idempresa=:idempresa AND v.idsucursal=:idsucursal";
        $stmt=$this->dbh->prepare($sql);
        $stmt->execute([
            "idempresa"=>$idempresa,
            "idsucursal"=>$idsucursal,
        ]);
        $row=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }


  
    public function AddVenta($obj){
        $sql = "INSERT INTO `tbl_ventas_creditos`(`cre_numero`, `cre_fecha`, `cre_subtotal`, `cre_iva`, `cre_total`, `idcliente`, `idempresa`, `cre_numero_emision`, `idsucursal`, `estado`, `xml`, `cre_descuento`) VALUES (:numero,:fecha,:subtotal,:iva,:total,:cliente,:empresa,:emision,:sucursal,:estado,:xml,:descuento)";
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

        $sql = "SELECT MAX(cre_numero) AS numero FROM tbl_ventas_creditos WHERE idempresa = :id_empresa";
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

        $sql = "SELECT MAX(idventa) AS numero FROM tbl_detalle_ventas_creditos WHERE idempresa = :id_empresa";
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
        $sql = "SELECT COUNT(*) AS row FROM `tbl_ventas_creditos`";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();
        while($rs = $stmt->fetch()){
            $row = $rs['row'];
        }
        return $row; 
    }

    public function AddDetalle($obj){
        $sql = "INSERT INTO `tbl_detalle_ventas_creditos`(`detcre_cantidad`, `detcre_precio`, `detcre_total`, `idventa`, `idarticulo`, `idempresa`) 
           VALUES (
           :cantidad,:precio,:total,
           :venta,:articulo,:empresa)";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            "cantidad"=>$obj["cantidad"],
            "precio"=>$obj["precio"],
            "total"=>$obj["total"],
            "venta"=>$obj["venta"],
            "articulo"=>$obj["articulo"],
            "empresa"=>$obj["empresa"]
        ]);
        
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
    

 

}

?>