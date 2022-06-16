<?php
//session_start();
require_once 'config.php';
class ClientesModel extends config
{

    private $dbh;
    public function __construct()
    {
        $this->dbh = config::Abrir();
    }

    public function GetClientes(){
        $sql = "SELECT * FROM tbl_clientes";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function AddCliente($obj){
        $sql = "INSERT INTO `tbl_clientes`( `cli_rucci`, 
                                          `cli_nombre`, 
                                          `cli_apellido`,
                                           `cli_direccion`, 
                                           `cli_correo`,
                                           `cli_celular`, 
                                           `idempresa`) 
                VALUES (:ruc,:nombre,
                        :apellido,:direccion,
                        :correo,:celular,
                        :empresa)";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            "ruc"=>$obj["ruc"],
            "nombre"=>$obj["nombre"],
            "apellido"=>$obj["apellido"],
            "direccion"=>$obj["direccion"],
            "correo"=>$obj["correo"],
            "celular"=>$obj["celular"],
            "empresa"=>$obj["empresa"]
        ]);
        
    }

    public function UpdateCliente($obj){
        $sql = "UPDATE `tbl_clientes` SET `cli_rucci`=:ruc,`cli_nombre`=:nombre,`cli_apellido`=:apellido,`cli_direccion`=:direccion,`cli_correo`=:correo,`cli_celular`=:celular WHERE `idcliente`=:id";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            "ruc"=>$obj["ruc"],
            "nombre"=>$obj["nombre"],
            "apellido"=>$obj["apellido"],
            "direccion"=>$obj["direccion"],
            "correo"=>$obj["correo"],
            "celular"=>$obj["celular"],
            "id"=>$obj["id"]
        ]);
        
    }

    public function UltimateCliente(){
        $row = 0;
        $sql = "SELECT COUNT(*) AS row FROM `tbl_clientes`";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();
        while($rs = $stmt->fetch()){
            $row = $rs['row'];
        }
        return $row; 
    }

    

}
