<?php
session_start();
require_once 'config.php';
class usuario extends config
{

    private $inv_dbh;
    public function __construct()
    {
        $this->inv_dbh = config::Abrir();
    }

    //para manejar los permisos

    public function ListarUsuario()
    {
        $inv_sql  = "SELECT * FROM usuario";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        $inv_stmt->execute();
        while ($inv_row = $inv_stmt->fetch()) {
            echo '<option value="' . $inv_row->id . '" >' . $inv_row->nombre . '</option>';
        }
    }

    public function ListarEmpresas($id_usuario)
    {

        $inv_sql  = "SELECT * FROM tbl_permisos WHERE id_usuario=?";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        $inv_stmt->execute();
        while ($inv_row = $inv_stmt->fetch()) {
            echo '<option value="' . $inv_row->emp_id . '" >' . $inv_row->emp_nombre . '</option>';
        }
    }

    public function verificarusuarios($id_usuario)
    {

        $inv_sql  = "SELECT * FROM tbl_permisos WHERE id_usuario=?";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $id_usuario);
        $inv_stmt->execute();
        if ($inv_stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function verificarper()
    {

        $inv_sql  = "SELECT * from tbl_empresas ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->execute();
        $verificar = $inv_stmt->FetchAll(PDO::FETCH_ASSOC);

        return $verificar;
    }

    public function listarempresa($id_usuario)
    {

        $inv_sql = "SELECT p.id_empresa  FROM tbl_permisos p
        WHERE p.id_usuario=?";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $id_usuario);
        $inv_stmt->execute();
        //retornar el id_empresa separarndo desde la base
        $empresa = new stdClass();
        while ($inv_row = $inv_stmt->fetch()) {
            $empresa->id_empresa = $inv_row['id_empresa'];
        }
        return $empresa->id_empresa;
    }

    public function listarempresaordenada($idempresa)
    {
        $inv_sql = "SELECT *  FROM tbl_empresas e ORDER BY
        emp_id!=?";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $idempresa);
        $inv_stmt->execute();
        $inv_row = $inv_stmt->fetchAll(PDO::FETCH_ASSOC);
        return $inv_row;
    }

    //actualizar permiso para empresas
    public function ActualizarPer($datos)
    {
        $inv_sql  = "UPDATE tbl_permisos set  id_empresa=? WHERE id_usuario=?";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $datos[0]);
        $inv_stmt->bindParam(2, $datos[1]);

        $rs = $inv_stmt->execute();
        if ($rs) {
            return true;
        } else {
            return false;
        }
    }

    public function GuardarPer($datos)
    {
        $inv_sql = "INSERT INTO tbl_permisos (id_usuario,id_empresa)
        VALUES (?,?)";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $datos[0]);
        $inv_stmt->bindParam(2, $datos[1]);
        $rs = $inv_stmt->execute();
        if ($rs) {
            return true;
        } else {
            return false;
        }
    }

    public function VerificarLogin($inv_datos)
    {

        $inv_sql  = "SELECT * FROM tbl_usuarios WHERE usu_usuario=? AND usu_contrasenia=? ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $inv_datos[0]);
        $inv_stmt->bindParam(2, $inv_datos[1]);
        $inv_stmt->execute();
        $inv_result = $inv_stmt->rowCount();
        if ($inv_result > 0) {

            return true;
        } else {
            return false;
        }
    }

    public function buscaridemp($usuario, $clave)
    {
        $inv_sql  = "SELECT us.idempresa AS id from tbl_empresas emp, tbl_usuarios us  WHERE us.usu_usuario=? AND us.usu_contrasenia=?  AND  emp.emp_id=us.idempresa";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $usuario);
        $inv_stmt->bindParam(2, $clave);
        $inv_stmt->execute();
        $empresa = new stdClass();
        while ($rs = $inv_stmt->fetch()) {
            $empresa->id = $rs['id'];
        }
        return $empresa;
    }

    public function sucursales($idempresa)
    {
        $inv_sql  = "SELECT su.codigo_suc, su.nombre_suc from  tbl_sucursal su WHERE su.idempresa=?";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);

        $inv_stmt->bindParam(1, $idempresa);
        $inv_stmt->execute();
        $rs = $inv_stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function obtener_perfil($usuario)
    {
        $inv_sql = "SELECT r.id AS id_rol ,rol,em.emp_id AS empresa ,emp_nombre
        FROM tbl_permisos p,tbl_empresas em,rol r
        WHERE p.id_empresa = em.emp_id
        AND r.id=em.emp_id
        AND p.id_usuario=?";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $usuario);
        $inv_stmt->execute();
        $inv_row = $inv_stmt->fetchAll();
        session_start();
        foreach ($inv_row as $perfil) {
            $_SESSION['perfil'] = [
                $perfil[0],
                $perfil[1],
                $perfil[2],
                $perfil[3],
            ];
        }
    }

    public function TraerEmpresaLogin($usuario, $contrasenia)
    {

        $inv_sql = "SELECT   e.idtiposervicio as tiposervicio,e.emp_nombre,
         e.emp_id,emp_correo,
         emp_telefono,emp_logo,emp_tipo_ambiente,
         emp_ruc,CONCAT('-',emp_direccion,'-',emp_calle_principal,'-',emp_calle_secundaria,'-',emp_numero_oficina,'-',emp_referencia_oficina )as direccion,e.emp_certificado_digital,e.emp_contrasenia_certificado

 FROM tbl_empresas e,tbl_usuarios u
 WHERE u.idempresa=e.emp_id AND usu_usuario=:usuario AND usu_contrasenia=:contrasenia ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->execute([
            "usuario"     => $usuario,
            "contrasenia" => $contrasenia,
        ]);
        $inv_row = $inv_stmt->fetchAll();

        foreach ($inv_row as $empresa) {

            $_SESSION['empresa'] = [

                "tiposervicio" => $empresa['tiposervicio'],
                "nombre"       => $empresa['emp_nombre'],
                "idempresa"    => $empresa['emp_id'],
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
    public function TraerUsuarioLogin($usuario, $contrasenia)
    {
        $inv_sql = "SELECT  u.usu_id,usu_primernombre ,usu_apellidopaterno,usu_usuario,usu_contrasenia
        FROM tbl_usuarios u
        WHERE  usu_usuario=:usuario AND usu_contrasenia=:contrasenia ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->execute([
            "usuario"     => $usuario,
            "contrasenia" => $contrasenia,
        ]);
        $inv_row = $inv_stmt->fetchAll();

        foreach ($inv_row as $usuario) {

            $_SESSION['usuario'] = [
                "nombre"      => $usuario['usu_primernombre'],
                "apellido"    => $usuario['usu_apellidopaterno'],
                "usuario"     => $usuario['usu_usuario'],
                "contrasenia" => $usuario['usu_contrasenia'],
            ];
        }
    }

    public function TraerSucursalLogin($usuario, $contrasenia)
    {
        $inv_sql = "SELECT  suc.codigo_suc,suc.numest_suc,suc.numfact_suc
        FROM tbl_empresas e,tbl_usuarios u,tbl_sucursal suc
        WHERE  usu_usuario=:usuario AND usu_contrasenia=:contrasenia AND suc.idempresa=e.emp_id";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->execute([
            "usuario"     => $usuario,
            "contrasenia" => $contrasenia,
        ]);
        $inv_row = $inv_stmt->fetchAll();

        foreach ($inv_row as $sucursal) {

            $_SESSION['sucursal'] = [

                "codigo_suc"  => $sucursal['codigo_suc'],
                "numest_suc"  => $sucursal['numest_suc'],
                "numfact_suc" => $sucursal['numfact_suc'],
            ];
        }
    }

    public function Listar()
    {
        $inv_sql = "SELECT u.id,nombre,usuario,correo,direccion,celular,registro,descripcion
        FROM usuario u,tbl_perfiles r
        WHERE r.id_perfil=u.id_perfil";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        $inv_stmt->execute();
        while ($inv_row = $inv_stmt->fetch()) {
            $data = $inv_row->id . '||' . $inv_row->nombre . '||' . $inv_row->usuario . '||' . $inv_row->correo . '||' . $inv_row->direccion . '||' . $inv_row->celular . '||' . $inv_row->descripcion;
            echo '<tr>';
            echo '<td>' . $inv_row->nombre . '</td>';
            echo '<td>' . $inv_row->usuario . '</td>';
            echo '<td>' . $inv_row->correo . '</td>';
            echo '<td>' . $inv_row->direccion . '</td>';
            echo '<td>' . $inv_row->celular . '</td>';
            echo '<td>' . $inv_row->descripcion . '</td>';
            echo '<td>' . $inv_row->registro . '</td>';
            echo '<td>
            <div class="btn-group pull-left">
            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-espanded="false">
            <i class="fa fa-cog"></i> Acciones <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
            <li>
            <a data-toggle="modal" data-target="#n-usuariou" onclick="capturar(\'' . $data . '\')">Editar <i class="fa fa-edit"></i></a>
            </li>
            <li>
            <a onclick="preguntar(' . $inv_row->id . ')">Eliminar <i class="fa fa-trash"></i></a>
            </li>';
            /*if($inv_row->id_perfil != 1){
            echo '<li>
            <a data-toggle="modal" data-target="#n-perfil" onclick="obtenerusuario(\''.$data.'\')">Permisos <i class="fa fa-edit"></i></a>
            </li>';
            }*/
            echo '</ul>
        </div>
        </td>';
            echo '</tr>';
        }
    }

    public function Registrar($inv_datos)
    {
        if (self::VerificarUsuario($inv_datos) > 0) {
            echo 2;
        } else if (self::VerificarCorreo($inv_datos) > 0) {
            echo 3;
        } else {
            echo self::VerificarRegistro($inv_datos);
        }
    }

    public function VerificarRegistro($inv_datos)
    {
        try {

            $inv_sql  = "INSERT INTO usuario(nombre,usuario,correo,direccion,celular,id_perfil,password)VALUES(?,?,?,?,?,?,?)";
            $inv_stmt = $this->inv_dbh->prepare($inv_sql);
            $inv_stmt->bindParam(1, $inv_datos[0]);
            $inv_stmt->bindParam(2, $inv_datos[1]);
            $inv_stmt->bindParam(3, $inv_datos[2]);
            $inv_stmt->bindParam(4, $inv_datos[3]);
            $inv_stmt->bindParam(5, $inv_datos[4]);
            $inv_stmt->bindParam(6, $inv_datos[5]);
            $inv_stmt->bindParam(7, $inv_datos[1]);
            $inv_stmt->execute();
            echo 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function Editar($inv_datos)
    {
        try {

            $inv_sql  = "UPDATE usuario SET nombre=?,usuario=?,correo=?,direccion=?,celular=?,id_perfil=? WHERE id=?";
            $inv_stmt = $this->inv_dbh->prepare($inv_sql);
            $inv_stmt->bindParam(1, $inv_datos[0]);
            $inv_stmt->bindParam(2, $inv_datos[1]);
            $inv_stmt->bindParam(3, $inv_datos[2]);
            $inv_stmt->bindParam(4, $inv_datos[3]);
            $inv_stmt->bindParam(5, $inv_datos[4]);
            $inv_stmt->bindParam(6, $inv_datos[5]);
            $inv_stmt->bindParam(7, $inv_datos[6]);
            $inv_stmt->execute();
            echo 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function Eliminar($inv_id)
    {
        try {

            $inv_sql  = "DELETE FROM usuario WHERE id=? ";
            $inv_stmt = $this->inv_dbh->prepare($inv_sql);
            $inv_stmt->bindParam(1, $inv_id);
            $inv_stmt->execute();
            echo 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    private function VerificarUsuario($inv_datos)
    {

        $inv_sql  = "SELECT usu_usuario FROM tbl_usuarios WHERE usu_usuario=? ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $inv_datos[0]);
        $inv_stmt->execute();
        $inv_datos = $inv_stmt->rowCount();
        return $inv_datos;
    }

    private function VerificarCorreo($inv_datos)
    {

        $inv_sql  = "SELECT correo FROM usuario WHERE correo=? ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $inv_datos[0]);
        $inv_stmt->execute();
        $inv_datos = $inv_stmt->rowCount();
        return $inv_datos;
    }

    public function ListarRoles()
    {
        $inv_sql  = "SELECT * FROM tbl_perfiles";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        $inv_stmt->execute();
        while ($inv_row = $inv_stmt->fetch()) {
            echo '<option value="' . $inv_row->id . '" >' . $inv_row->descripcion . '</option>';
        }
    }
    //verificar login con permiso de usuario
    public function verificar_permisos($cuenta_usuario, $password)
    {

        $inv_sql = "SELECT * from tbl_empresas p, tbl_usuarios u WHERE p.emp_id=u.idempresa AND u.usu_usuario=?
    AND u.usu_contrasenia=?  AND p.emp_estado='1' ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $cuenta_usuario);
        $inv_stmt->bindParam(2, $password);
        $inv_stmt->execute();
        if ($inv_stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function verificar_tenedor($correo, $cedula)
    {

        $res = false;

        $sql = "SELECT * FROM tbl_tenedores WHERE ten_correo = :correo AND ten_cedula = :cedula";
        $ps  = $this->inv_dbh->prepare($sql);
        $ps->execute([
            "correo" => $correo,
            "cedula" => $cedula,
        ]);

        if ($ps->rowCount() > 0) {
            $res = true;
        }

        return $res;
    }

    public function obtener_tenedor($correo, $cedula)
    {

        $sql = "SELECT ten_cedula, ten_primer_nombre, ten_segundo_nombre,ten_apellido_paterno,ten_apellido_materno, ten_fecha, ten_correo, ten_celular,p.PROVINCIA AS provincia,c.CANTON AS canton,pa.PARROQUIA AS parroquia,
    ten_barrio,ten_calle_principal,ten_calle_secundaria,ten_numero_casa,ten_referencia_casa,ten_foto
    FROM tbl_tenedores t,tab_provincias p,tab_cantones c,tab_parroquias pa
    WHERE t.ten_provincia = p.ID_PROVINCIA
    AND t.ten_canton = c.ID_CANTON
    AND t.ten_parroquia = pa.ID_PARROQUIA
    AND ten_correo = :correo
    AND ten_cedula = :cedula";
        $ps = $this->inv_dbh->prepare($sql);
        $ps->execute([
            "correo" => $correo,
            "cedula" => $cedula,
        ]);

        $tenedor = new stdClass();

        while ($rs = $ps->fetch()) {
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

        return $tenedor;
    }

    public function obtener_mascotas($tenedor)
    {

        $sql = "SELECT mas_codigo,mas_nombre,mas_sexo,mas_fecha,mas_color,mas_color_secundario,mas_esterilizado, mas_imagen,mas_codigo_qr,e.descripcion AS tipo,t.descripcion AS raza
    FROM tbl_mascotas m,tbl_especies e,tipo_razas t
    WHERE m.mas_tipo = e.id_especie
    AND m.idraza = t.id_mas
    AND idtenedor = :tenedor";
        $ps = $this->inv_dbh->prepare($sql);
        $ps->execute([
            "tenedor" => $tenedor,
        ]);

        $rs = $ps->fetchAll(PDO::FETCH_ASSOC);

        return $rs;
    }
}
