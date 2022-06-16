<?php
require_once "../../clases/Sri.php";
class SriController
{

    public function SearchNumeroFactura($numero)
    {
        $obj = new Sri;
        $obj->ConsultarNumeroFactura($numero);

    }

    public function SearchIdentificacionCliente($identificacion)
    {
        $obj = new Sri;
        $obj->ConsultarIdentificacionCliente($identificacion);
    }

    public function SearchRangoFechas($inicio, $fin)
    {
        $obj = new Sri;
        $obj->ConsultarRangoFechas($inicio, $fin);
    }

    public function RecepcionXml($xml, $id)
    {
        $res = [
            "res" => false,
            "sms" => "",
            "id"  => "",
        ];
        require_once '../venta/web_service_sri.php';
        $obj        = new WebServiceController;
        $tipo       = gettype($obj->WebServiceRecepcion($xml));
        $res["sms"] = $obj->WebServiceRecepcion($xml);
        $res["id"]  = $id;

        if ($tipo != "string") {
            $res["res"] = true;
        }

        print_r(json_encode($res));

    }

    public function AutorizacionXml($claveAcceso, $id)
    {
        $res = [
            "res" => false,
            "sms" => "",
            "id"  => "",

        ];
        require_once '../venta/web_service_sri.php';
        $obj        = new WebServiceController;
        $tipo       = gettype($obj->WebServiceAutorizacion($claveAcceso));
        $res["sms"] = $obj->WebServiceAutorizacion($claveAcceso);
        $res["id"]  = $id;
        if ($tipo != "string") {
            $res["res"] = true;

        }
        print_r(json_encode($res));
    }

} //fin de clase

$obj = new SriController;

if (isset($_POST["criterio"])) {

    if ($_POST["criterio"] == 1) {
        $obj->SearchNumeroFactura($_POST["numero"]);
    } else if ($_POST["criterio"] == 2) {
        $obj->SearchIdentificacionCliente($_POST["identificacion"]);
    } else if ($_POST["criterio"] == 3) {
        $obj->SearchRangoFechas($_POST["inicio"], $_POST["fin"]);

    }
} else if (isset($_POST["xml"])) {
    $obj->RecepcionXml($_POST["xml"], $_POST['id']);

} else if (isset($_POST["numero_emision"])) {
    $obj->AutorizacionXml($_POST["numero_emision"], $_POST['id']);

}
