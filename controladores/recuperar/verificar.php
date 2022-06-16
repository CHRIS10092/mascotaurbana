<?php 
require_once 'clases/correos.php';
class Verificar{

	
	public function comprobar_correo($cuenta_correo){
        $obj = new Correos;
		$res = false;
		$email = "";
        $correos = $obj->obtener_correos();
        foreach($correos as $correo){
            if (password_verify($correo["cuenta"],$cuenta_correo)){
                $res = true;
                $email = $correo["cuenta"];
            } 
        }

        if($res){

        	self::obtener_usuario($email);

        }

        return $res;

	}

	private function obtener_usuario($cuenta_correo){

		$obj = new Correos;

		$usuario = $obj->obtener_id($cuenta_correo);

		session_start();
		$_SESSION['iduser'] = $usuario->id;
	}

}

?>