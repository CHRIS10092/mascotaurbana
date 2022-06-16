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

    public function consultar_general(){
        $sql="SELECT categoria,subcategoria,SUM(a.cantidad_entregados)AS entregada,Sum(cantidad)AS vendida,Sum(a.cantidad_entregados)- SUM(cantidad) AS stock,Now() AS fecha
        FROM inv_tblcategoria c,inv_tblsubcategoria s ,ventas v,detalle_venta d,articulos a
        WHERE c.id=v.id_cate AND s.id_s= v.id_sub AND d.id_venta=v.numero AND d.id_a = a.id_a GROUP BY subcategoria";
        $stmt=$this->dbh->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function consultar($categoria){
        $sql="SELECT categoria,subcategoria,SUM(a.cantidad_entregados)AS entregada,Sum(cantidad)AS vendida,Sum(a.cantidad_entregados)- SUM(cantidad) AS stock,Now() AS fecha
        FROM inv_tblcategoria c,inv_tblsubcategoria s ,ventas v,detalle_venta d,articulos a
        WHERE c.id=v.id_cate 
        AND s.id_s= v.id_sub 
        AND d.id_venta=v.numero 
        AND d.id_a = a.id_a 
        AND c.id=:zona
        GROUP BY subcategoria ";
        $stmt=$this->dbh->prepare($sql);
        $stmt->execute(["zona"=>$categoria]);
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }
}

?>