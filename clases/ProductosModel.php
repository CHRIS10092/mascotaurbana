<?php
//session_start();
require_once 'config.php';
class ProductosModel extends config
{

    private $dbh;
    public function __construct()
    {
        $this->dbh = config::Abrir();
    }

    public function GetProductos($idempresa,$idsucursal){
        $sql = "SELECT  inv_id,inv_codigo,
        CONCAT(inv_nombre,' ',inv_descripcion) AS detalle ,
        inv_stock,
        inv_valor,
        inv_valorpvp,
        s.id as chip
        FROM tbl_inventarios i
        INNER JOIN inv_tblcategoria c ON c.id = i.idcategoria
        INNER JOIN inv_tblsubcategoria s ON s.id = i.idsubcategoria
        INNER JOIN tbl_empresas e ON e.emp_id = i.idempresa
        AND i.idempresa=:idempresa
        AND i.idsucursal=:idsucursal";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            "idempresa"=>$idempresa,
            "idsucursal"=>$idsucursal
        ]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    

}
