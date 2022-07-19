<?php 

require_once 'config.php';

  class  NotasCredito extends config{
    private $dbh;
    public function __construct(){

        $this->dbh=config::Abrir();
    }

    public function repor($idempresa,$idsucursal)
    {
        $inv_sql = "SELECT * FROM  tbl_ventas v , tbl_clientes c
        WHERE v.idcliente=c.cli_rucci
        AND v.idempresa=:idempresa
        AND v.idsucursal=:idsucursal
        AND v.estado='AUTORIZADO'";
        $inv_stmt = $this->dbh->prepare($inv_sql);

        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        $inv_stmt->execute([
            "idempresa"=>$idempresa,
            "idsucursal"=>$idsucursal
        ]);

        $rs = $inv_stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;

    }
    public function detalles($numero,$idempresa,$idsucursal)
    {
        $inv_sql = "SELECT * FROM  tbl_detalle_ventas dt , tbl_ventas v 
        WHERE dt.idventa=v.ven_numero
        AND v.ven_numero=:numero
        AND v.idempresa=:idempresa
        AND v.idsucursal=:idsucursal
        AND v.estado='AUTORIZADO'";
        $inv_stmt = $this->dbh->prepare($inv_sql);

        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        $inv_stmt->execute([
            "numero"=>$numero,
            "idempresa"=>$idempresa,
            "idsucursal"=>$idsucursal
        ]);

        $rs = $inv_stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;

    }
  //admin
  public function DatosCabecera($numero,$idempresa,$idsucursal)
  {
      $inv_sql = "SELECT * FROM tbl_detalle_ventas_creditos d , tbl_ventas_creditos v , tbl_inventarios a,tbl_clientes c
      WHERE v.cre_numero=:numero
      AND v.cre_numero=d.idventa
      AND d.idarticulo=a.inv_id
      AND v.idempresa=:idempresa
      AND v.idsucursal=:sucursal
      AND v.idcliente=c.idcliente";
      $inv_stmt = $this->dbh->prepare($inv_sql);
      $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
      $inv_stmt->execute([
        "numero"=>$numero,
         "idempresa"=>$idempresa,
        "sucursal"=>$idsucursal,
      ]);
      while ($inv_row = $inv_stmt->fetch()) {
          echo '<div  style="width:100%">';
          echo '<br><label style="font-weight: bolder;font-size:15px">Ruc Cliente : </label>';
          echo $inv_row->cli_rucci;
          echo '<br><label style="font-weight: bolder;font-size:15px">Nombre Cliente : </label>';
          echo $inv_row->cli_nombre;
          echo '<br><label style="font-weight: bolder;font-size:15px">Celular Cliente : </label>';
          echo $inv_row->cli_celular;
          echo '<br><label style="font-weight: bolder;font-size:15px">Cantidad : </label>';
          echo $inv_row->cre_subtotal;
          echo '<br><label style="font-weight: bolder;font-size:15px">Precio : </label>';
          echo $inv_row->cre_iva;
          echo '<br><label style="font-weight: bolder;font-size:15px">Total : </label>';
          echo $inv_row->cre_total;

          echo '</div>';
      }
  }
  //admin
  public function DetalleVenta($numero)
  {
      $inv_sql = "SELECT * FROM tbl_detalle_ventas_creditos d , tbl_ventas_creditos v , tbl_inventarios a
      WHERE v.cre_numero=:numero
      AND v.cre_numero=d.idventa
      AND d.idarticulo=a.inv_id";
      $inv_stmt = $this->dbh->prepare($inv_sql);
      

      $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
      $inv_stmt->execute([
        "numero"=>$numero,
      ]);
      echo "<table class='table table-responsive'>";
      echo "<tr>";
      echo "<th>CODIGO</th>";
      echo "<th>NOMBRE</th>";
      echo "<th>DESCRIPCION</th>";
      echo "<th>FECHA</th>";
      echo "<th>CANTIDAD</th>";
      echo "<th>VALOR</th>";

      echo "<th>TOTAL</th>";

      echo "</tr>";

      while ($inv_row = $inv_stmt->fetch()) {

          echo "<tr>";
          echo '<td>' . $inv_row->inv_id . '</td>';
          echo '<td>' . $inv_row->inv_nombre . '</td>';
          echo '<td>' . $inv_row->inv_descripcion . '</td>';
          echo '<td>' . $inv_row->cre_fecha . '</td>';
          echo '<td>' . $inv_row->detcre_cantidad . '</td>';
          echo '<td>' . $inv_row->inv_valor . '</td>';
          echo '<td>' . $inv_row->detcre_cantidad * $inv_row->inv_valor . '</td>';

          echo "</tr>";
      }

      echo "</table>";
  }

  //reportes de venta esta en clases articulos repor()   //empresas


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