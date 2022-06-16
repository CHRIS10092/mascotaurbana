<?php 

require_once 'config.php';

class Correos extends config
{

    private $db;

    public function __construct()
    {

        $this->db = config::Abrir();

    }

    public function obtener_correos()
    {

        $sql = "SELECT usu_correo AS cuenta FROM tbl_usuarios";

        $ps = $this->db->prepare($sql);
        $ps->execute();

        $rs = $ps->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }


    public function obtener_id($correo)
    {

        $sql = "SELECT usu_id AS id FROM tbl_usuarios WHERE usu_correo = :correo";

        $ps = $this->db->prepare($sql);
        $ps->execute([
        	"correo" => $correo
        ]);

        $usuario = new stdClass();
        while ($rs = $ps->fetch()) {
        	$usuario->id =  $rs['id'];
        }

        return $usuario;
    }

    public function modificar_clave($id,$clave)
    {

        $res = false;

        try {

            $sql = "UPDATE tbl_usuarios SET usu_contrasenia = :clave WHERE usu_id = :id ";

            $ps = $this->db->prepare($sql);
            $ps->execute([
                "clave"=> $clave,
                "id" => $id
            ]);

            $res = true;
            
        } catch (PDOException $e) {
            //print $e->getMessage();
        }
        
        return $res;
    }


}


?>
