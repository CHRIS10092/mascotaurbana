<?php
require_once 'config.php';
class PdfSri extends config{
private $dbh;
    function __construct(){
        $this->dbh=config::Abrir();
    }

public function obtener_mail($numero,$correo){
    $sql="SELECT c.cli_correo as correo FROM tbl_clientes c, tbl_ventas ve
    WHERE ve.idcliente=c.cli_rucci
    AND ve.ven_id=:numero
    AND c.cli_correo=:correo";
    $stmt=$this->dbh->prepare($sql);
    $stmt->execute([
        "numero"=>$numero,
        "correo"=>$correo
    ]);
    $obj = new StdClass();
    while($datos =$stmt->fetch()){
        $obj->correo=$datos['correo'];
    };
    return $obj;
    
}
public function datos_factura($idventa,$idempresa,$idsucursal){
    $sql="SELECT * from tbl_ventas WHERE ven_id=:idventa AND idempresa=:idempresa AND  idsucursal=:idsucursal";
    $stmt=$this->dbh->prepare($sql);
    $stmt->execute([
        "idventa"=>$idventa,
        "idempresa"=>$idempresa,
        "idsucursal"=>$idsucursal
    ]);

      $obj = new StdClass();

     while($row = $stmt->fetch()){
        $obj->numero=$row['ven_id'];
        $obj->venta=$row['ven_numero'];
     }
     return $obj;
    

}




} 

?>