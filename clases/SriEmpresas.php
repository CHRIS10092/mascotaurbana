<?php
//no iniciar sesion por que ya esta 
require_once "config.php";

class SriEmpresas extends config
{
    private $db;
    public function __construct()
    {
        $this->db = config::abrir();
    }

    public function ConsultarNumeroFactura($numero, $idempresa)
    
    {

        $sql = "SELECT  v.ven_id,c.cli_correo,v.ven_numero, v.ven_fecha,v.ven_total,v.estado,v.xml,v.ven_numero_emision
        FROM tbl_ventas v,tbl_clientes c
        WHERE v.ven_numero =:numero 
        AND c.idcliente=v.idcliente
        AND v.idempresa = :idempresa";
        $ps = $this->db->prepare($sql);
        $ps->execute([
            "numero"    => $numero,
            "idempresa" => $idempresa,
        ]);

        print_r(json_encode($ps->fetchAll(PDO::FETCH_ASSOC)));

    }

    public function ConsultarIdentificacionCliente($identificacion, $idempresa)
    {

        $sql = "SELECT * FROM tbl_ventas  WHERE idcliente=:identificacion  AND idempresa = :idempresa";
        $ps  = $this->db->prepare($sql);
        $ps->execute([
            "identificacion" => $identificacion,
            "idempresa"      => $idempresa,
        ]);

        print_r(json_encode($ps->fetchAll(PDO::FETCH_ASSOC)));
    }

    public function ConsultarRangoFechas($inicio, $fin, $idempresa)
    {
        $sql = "SELECT  v.ven_id as ven_id,v.idcliente as idcliente,c.cli_correo as correo,v.ven_numero as ven_numero, v.ven_fecha as ven_fecha,v.ven_total as ven_total,v.estado as estado,v.xml as xml,v.ven_numero_emision as ven_numero_emision
        FROM tbl_ventas v,tbl_clientes c
               WHERE  c.idcliente=v.idcliente AND v.ven_fecha BETWEEN :inicio AND :fin AND v.idempresa = :idempresa";
        $ps = $this->db->prepare($sql);
        $ps->execute([
            "inicio"    => $inicio,
            "fin"       => $fin,
            "idempresa" => $idempresa,
        ]);

        print_r(json_encode($ps->fetchAll(PDO::FETCH_ASSOC)));

    }

    public function insertarResRecepcion($codfactura, $mensaje, $xml,$idempresa,$idsucursal)
    {

        $sql = "INSERT INTO `tbl_respuestas`(`codfactura`, `mensaje`, `xml`,`idempresa`,`idsucursal`) VALUES (:codfactura,:mensaje,:xml,:idempresa,:idsucursal)";
        $rs  = $this->db->prepare($sql);
        $rs->execute([
            "codfactura" => $codfactura,
            "mensaje"    => $mensaje,
            "xml"        => $xml,
            "idempresa"  => $_SESSION['empresa']['idempresa'],
            "idsucursal" => $_SESSION['sucursal']['codigo'],
        ]);

    }

    public function insertarResAutorizacion($datos)
    {

        $sql = "INSERT INTO `tbl_respuestas`(`codfactura`, `mensaje`, `xml`) VALUES (:codfactura,:mensaje,:xml)";
        $rs  = $this->db->prepare($sql);
        $rs->execute([
            "codfactura" => $datos['codfactura'],
            "mensaje"    => $datos['mensaje'],
            "xml"        => $datos['xml'],

        ]);

    }

}
