<?php
require_once "config.php";

class ReporteModel extends config{
    private $dbh;
    function __construct(){
        $this->dbh = config::Abrir();
    }

    public function categorias(){
        $sql="SELECT * FROM inv_tblcategoria";
        $stmt=$this->dbh->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function ConsultarFactu($num){
        $sql="SELECT * FROM tbl_ventas WHERE ven_id=? ";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindParam(1,$num);
        $stmt->execute();
        $obj=new StdClass();

        while($row = $stmt->fetch())
        
        {
            $obj->id=$row['ven_id'];
            $obj->numero=$row['ven_numero'];
            $obj->fecha=$row['ven_fecha'];
            $obj->total=$row['ven_total'];
            $obj->subtotal=$row['ven_subtotal'];
            $obj->iva= $row['ven_iva'];
            
        }

        return $obj;
    }

    public function detalle_factura($idventa){
    $sql="SELECT v.*,de.*,i.*,c.*,e.*,s.* FROM tbl_ventas v,tbl_detalle_ventas de,tbl_inventarios i,tbl_clientes c,tbl_empresas e,tbl_sucursal s
    WHERE v.ven_numero=de.idventa
    AND v.ven_id=:idventa
    AND i.inv_id=de.idarticulo
    AND v.idcliente=c.cli_rucci
    AND v.idempresa=e.emp_id
    AND v.idsucursal=s.codigo_suc";
    $stmt=$this->dbh->prepare($sql);
    $stmt->execute([
        "idventa"=>$idventa
    ]);
    //$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $obj= new StdClass();
    while($row=$stmt->fetch()) {
        $obj->numero_venta=$row['ven_numero'];
        $obj->numero_emision=$row['ven_numero_emision'];
        $obj->id=$row['ven_id'];
        $obj->nombre_ruc=$row['emp_nombre'];
        $obj->direccion=$row['emp_direccion'];
        $obj->ruc=$row['emp_ruc'];
        $obj->fecha=$row['ven_fecha'];
        $obj->ruc_cliente=$row['cli_rucci'];
        $obj->nombre_cliente=$row['cli_nombre'];
        $obj->direccion_cliente=$row['cli_direccion'];
        $obj->id_articulo=$row['idarticulo'];
        $obj->nombre_articulo=$row['inv_nombre'];
        $obj->detalle_articulo=$row['inv_descripcion'];
        $obj->descuento_articulo=$row['descuento'];
        $obj->cantidad_articulo=$row['detven_cantidad'];
        $obj->precio=$row['inv_valor'];
        $obj->subtotal=$row['ven_subtotal'];
        $obj->iva=$row['ven_iva'];
        $obj->descuento_total=$row['descuento'];
        $obj->total=$row['ven_total'];
        
    }
    
    return $obj;
    

    }

    public function Correo($num){
        $sql="SELECT * FROM tbl_clientes WHERE cli_rucci=? ";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindParam(1,$num);
        $stmt->execute();
        $obj=new StdClass();

        while($row = $stmt->fetch())
        
        {
            $obj->correo=$row['cli_correo'];
                        
        }

        return $obj;
    }
}
   
?>