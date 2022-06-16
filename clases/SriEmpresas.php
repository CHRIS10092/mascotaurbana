<?php
//session_start();
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

        $sql = 'SELECT  idcliente,ven_numero, ven_fecha,ven_total,estado,xml,ven_numero_emision
       FROM tbl_ventas
       WHERE ven_numero =:numero AND idempresa = :idempresa';
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
        $sql = "SELECT idcliente,ven_numero, ven_fecha,ven_total,estado
               FROM tbl_ventas
               WHERE ven_fecha BETWEEN :inicio AND :fin AND idempresa = :idempresa";
        $ps = $this->db->prepare($sql);
        $ps->execute([
            "inicio"    => $inicio,
            "fin"       => $fin,
            "idempresa" => $idempresa,
        ]);

        print_r(json_encode($ps->fetchAll(PDO::FETCH_ASSOC)));

    }

    public function insertarResRecepcion($codfactura, $mensaje, $xml)
    {

        $sql = "INSERT INTO `tbl_respuestas`(`codfactura`, `mensaje`, `xml`) VALUES (:codfactura,:mensaje,:xml)";
        $rs  = $this->db->prepare($sql);
        $rs->execute([
            "codfactura" => $codfactura,
            "mensaje"    => $mensaje,
            "xml"        => $xml,

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
