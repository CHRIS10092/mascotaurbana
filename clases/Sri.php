<?php
require_once "config.php";

class Sri extends config
{
    private $db;
    public function __construct()
    {
        $this->db = config::abrir();
    }

    public function ConsultarNumeroFactura($numero)
    {

        $sql = 'SELECT idcliente, numero, fecha,total,estado,xml,numero_emision
       FROM tbl_empresas_venta
       WHERE numero =:numero';
        $ps = $this->db->prepare($sql);
        $ps->execute([
            "numero" => $numero,
        ]);
        //$resul=$ps->Rowcount();

        print_r(json_encode($ps->fetchAll(PDO::FETCH_ASSOC)));

    }

    public function ConsultarIdentificacionCliente($identificacion)
    {

        $sql = "SELECT * FROM tbl_empresas_venta  WHERE idcliente=:identificacion ";
        $ps  = $this->db->prepare($sql);
        $ps->execute([
            "identificacion" => $identificacion,
        ]);

        print_r(json_encode($ps->fetchAll(PDO::FETCH_ASSOC)));
    }

    public function ConsultarRangoFechas($inicio, $fin)
    {
        $sql = "SELECT idcliente, numero, fecha,total,estado
               FROM tbl_empresas_venta
               WHERE fecha BETWEEN :inicio AND :fin";
        $ps = $this->db->prepare($sql);
        $ps->execute([
            "inicio" => $inicio,
            "fin"    => $fin,
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
