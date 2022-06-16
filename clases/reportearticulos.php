<?php
session_start();
require_once "config.php";

/**
 *
 */
class reporte_articulos extends config
{

    private $inv_dbh;
    public function __construct()
    {
        $this->inv_dbh = config::Abrir();
    }

    public function BuscarAticulos()
    {

        $inv_sql  = "SELECT * FROM tbl_articulos ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        //$inv_stmt->bindParam(1, $buscar);
        $inv_stmt->execute();
        $rs = $inv_stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function BuscarempresaArticulo($idempresa)
    {

        $inv_sql  = " SELECT `inv_id`, `inv_codigo`, `inv_nombre`, `inv_descripcion`, `inv_stock`, `inv_valor`, `inv_valorpvp`, `inv_imagen`, `idcategoria`, `idsubcategoria`, `fecha_expiracion`, `idempresa`, `idsucursal`, `lote` FROM `tbl_inventarios` 
                 WHERE idempresa=:idempresa GROUP BY inv_id ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->execute(["idempresa" => $idempresa]);
        $rs = $inv_stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }
}