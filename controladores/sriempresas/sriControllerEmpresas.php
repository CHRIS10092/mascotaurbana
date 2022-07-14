<?php
session_start();
require_once "../../clases/SriEmpresas.php";
class SriControllerEmpresas
{

    public function SearchNumeroFactura($numero, $empresa)
    {
        $obj = new SriEmpresas;
        $obj->ConsultarNumeroFactura($numero, $empresa);

    }

    public function SearchIdentificacionCliente($identificacion, $empresa)
    {
        $obj = new SriEmpresas;
        $obj->ConsultarIdentificacionCliente($identificacion, $empresa);
    }

    public function SearchRangoFechas($inicio, $fin, $empresa)
    {
        $obj = new SriEmpresas;
        $obj->ConsultarRangoFechas($inicio, $fin, $empresa);
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

$obj1 = new SriControllerEmpresas;

if (isset($_POST["criterio"])) {

    if ($_POST["criterio"] == 1) {
        $obj1->SearchNumeroFactura($_POST["numero"], $_SESSION['empresa']['idempresa']);

    } else if ($_POST["criterio"] == 2) {
        $obj1->SearchIdentificacionCliente($_POST["identificacion"], $_SESSION['empresa']['idempresa']);
    } else if ($_POST["criterio"] == 3) {
        $obj1->SearchRangoFechas($_POST["inicio"], $_POST["fin"], $_SESSION['empresa']['idempresa']);
        
    }
    
} else if (isset($_POST["xml"])) {
    $obj1->RecepcionXml($_POST["xml"], $_POST['id']);

} else if (isset($_POST["ven_numero_emision"])) {
    $obj1->AutorizacionXml($_POST["ven_numero_emision"], $_POST['id']);

}



