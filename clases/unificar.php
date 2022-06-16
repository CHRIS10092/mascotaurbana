<?php

require_once 'config.php';
class Unificar extends config
{
    private $db;
    public function __construct()
    {
        $this->db = config::Abrir();
    }

    public function list_products($empresa, $sucursal)
    {
        $sql = "SELECT inv_id,inv_codigo,inv_nombre,inv_stock,inv_valorpvp,inv_imagen
                FROM tbl_inventarios
                WHERE idempresa =:empresa
                AND idsucursal=:sucursal";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            "empresa"  => $empresa,
            "sucursal" => $sucursal,
        ]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

}
