<?php
session_start();
require_once 'config.php';
class Login extends config
{
    private $db;
    public function __construct()
    {
        $this->db = config::Abrir();
    }

    public function verify_user($datos)
    {
        $res  = false;
        $sql  = "SELECT * FROM tbl_usuarios WHERE usu_usuario=:usuario AND usu_contrasenia=:clave";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            "usuario" => $datos['usuario'],
            "clave"   => $datos['clave'],
        ]);
        $confirmation = $stmt->rowCount();
        if ($confirmation > 0) {
            $res = true;
        }

        return $res;
    }

    public function verify_tenedor($datos)
    {
        $res  = false;
        $sql  = "SELECT * FROM tbl_tenedores WHERE ten_correo=:usuario AND ten_cedula=:clave";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            "usuario" => $datos['usuario'],
            "clave"   => $datos['clave'],
        ]);
        $confirmation = $stmt->rowCount();
        if ($confirmation > 0) {
            $res = true;
        }

        return $res;
    }

    public function get_user($datos)
    {
        $sql = "SELECT usu_id,CONCAT(usu_apellidopaterno,' ',usu_apellidomaterno,' ',usu_primernombre,' '    ,usu_segundonombre) AS usuario,
                usu_usuario,usu_direccion, usu_celular, usu_correo
                FROM tbl_usuarios
                WHERE usu_usuario=:usuario
                AND usu_contrasenia=:clave";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            "usuario" => $datos['usuario'],
            "clave"   => $datos['clave'],
        ]);

        $rows = $stmt->fetchAll();

        foreach ($rows as $usuario) {

            $_SESSION['usuario'] = [
                "codigo"         => $usuario['usu_id'],
                "nombreCompleto" => $usuario['usuario'],
                "usuario"        => $usuario['usu_usuario'],
                "direccion"      => $usuario['usu_direccion'],
                "celular"        => $usuario['usu_celular'],
                "correo"         => $usuario['usu_correo'],
            ];
        }
    }

    public function get_company($datos)
    {
        $sql = "SELECT e.idtiposervicio as tiposervicio,e.emp_nombre,
                e.emp_id AS codigo,emp_correo,
                emp_telefono,emp_logo,emp_tipo_ambiente,
                emp_ruc,CONCAT('-',emp_direccion,'-',emp_calle_principal,'-',emp_calle_secundaria,'-',emp_numero_oficina,'-',emp_referencia_oficina )as direccion,e.emp_certificado_digital,e.emp_contrasenia_certificado
             FROM tbl_empresas e,tbl_usuarios u
             WHERE u.idempresa=e.emp_id
             AND usu_usuario=:usuario
             AND usu_contrasenia=:clave";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            "usuario" => $datos['usuario'],
            "clave"   => $datos['clave'],
        ]);
        $rows = $stmt->fetchAll();

        foreach ($rows as $empresa) {

            $_SESSION['empresa'] = [

                "tiposervicio" => $empresa['tiposervicio'],
                "nombre"       => $empresa['emp_nombre'],
                "idempresa"    => $empresa['codigo'],
                "correo"       => $empresa['emp_correo'],
                "telefono"     => $empresa['emp_telefono'],
                "logo"         => $empresa['emp_logo'],
                "ambiente"     => $empresa['emp_tipo_ambiente'],
                "ruc"          => $empresa['emp_ruc'],
                "direccion"    => $empresa['direccion'],
                "certificado"  => $empresa['emp_certificado_digital'],
                "contrasenia"  => $empresa['emp_contrasenia_certificado'],

            ];
        }
    }

    public function get_sucursal($dato)
    {
        $sql = "SELECT codigo_suc,numest_suc,numfact_suc
        FROM tbl_sucursal
        WHERE  codigo_suc=:codigo ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            "codigo" => $dato['sucursal'],

        ]);

        while ($rs = $stmt->fetch()) {
            $_SESSION['sucursal'] = [

                "codigo"  => $rs['codigo_suc'],
                "numest"  => $rs['numest_suc'],
                "numfact" => $rs['numfact_suc'],
            ];
        }
    }

    public function list_sucursalaes($codigoempresa)
    {
        $sql = "SELECT codigo_suc AS codigo,nombre_suc AS nombre FROM tbl_sucursal
                 WHERE idempresa=:codigoempresa";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["codigoempresa" => $codigoempresa]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function get_tenedor($datos)
    {

        $sql = "SELECT ten_cedula, ten_primer_nombre, ten_segundo_nombre,ten_apellido_paterno,ten_apellido_materno, ten_fecha, ten_correo, ten_celular,p.PROVINCIA AS provincia,c.CANTON AS canton,pa.PARROQUIA AS parroquia,
    ten_barrio,ten_calle_principal,ten_calle_secundaria,ten_numero_casa,ten_referencia_casa,ten_foto
    FROM tbl_tenedores t,tab_provincias p,tab_cantones c,tab_parroquias pa
    WHERE t.ten_provincia = p.ID_PROVINCIA
    AND t.ten_canton = c.ID_CANTON
    AND t.ten_parroquia = pa.ID_PARROQUIA
    AND ten_correo = :correo
    AND ten_cedula = :cedula";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            "correo" => $datos['usuario'],
            "cedula" => $datos['clave'],
        ]);

        $tenedor = new stdClass();

        while ($rs = $stmt->fetch()) {
            $tenedor->cedula           = $rs['ten_cedula'];
            $tenedor->primer_nombre    = $rs['ten_primer_nombre'];
            $tenedor->segundo_nombre   = $rs['ten_segundo_nombre'];
            $tenedor->apellido_paterno = $rs['ten_apellido_paterno'];
            $tenedor->apellido_materno = $rs['ten_apellido_materno'];
            $tenedor->fecha            = $rs['ten_fecha'];
            $tenedor->correo           = $rs['ten_correo'];
            $tenedor->celular          = $rs['ten_celular'];
            $tenedor->provincia        = $rs['provincia'];
            $tenedor->canton           = $rs['canton'];
            $tenedor->parroquia        = $rs['parroquia'];
            $tenedor->barrio           = $rs['ten_barrio'];
            $tenedor->calle_principal  = $rs['ten_calle_principal'];
            $tenedor->calle_secundaria = $rs['ten_calle_secundaria'];
            $tenedor->numero_casa      = $rs['ten_numero_casa'];
            $tenedor->referencia_casa  = $rs['ten_referencia_casa'];
            $tenedor->foto             = $rs['ten_foto'];
        }

        $_SESSION['tenedor'] = [
            "datos" => $tenedor,
        ];
    }

    public function get_mascotas($tenedor)
    {

        $sql = "SELECT mas_codigo,mas_nombre,mas_sexo,mas_fecha,mas_color,mas_color_secundario,mas_esterilizado, mas_imagen,mas_codigo_qr,e.descripcion AS tipo,t.descripcion AS raza
                FROM tbl_mascotas m,tbl_especies e,tipo_razas t
                WHERE m.mas_tipo = e.id_especie
                AND m.idraza = t.id_mas
                AND idtenedor = :tenedor";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            "tenedor" => $tenedor,
        ]);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $_SESSION['mascotas'] = [
            "listado" => $rows,
        ];
    }

}
