<?php
session_start();
require_once 'config.php';

class vacu extends config
{

    private $db;

    public function __construct()
    {

        $this->db = config::Abrir();

    }

    public function obtener_numero_venta($id_empresa)
    {

        $numero_venta = '00000000';

        $sql = "SELECT MAX(ven_numero) AS numero FROM tbl_ventas WHERE idempresa = :id_empresa";
        $ps  = $this->db->prepare($sql);
        $ps->execute([
            "id_empresa" => $id_empresa,
        ]);

        while ($rs = $ps->fetch()) {

            if ($rs['numero'] != null) {

                $numero_venta = $rs['numero'];
            }

        }

        return $numero_venta;

    }

    public function buscar_cliente($rucci, $id_empresa)
    {

        $res     = false;
        $cliente = null;

        $sql = "SELECT * FROM tbl_clientes WHERE cli_rucci = :rucci AND idempresa = :id_empresa";
        $ps  = $this->db->prepare($sql);
        $ps->execute([
            "rucci"      => $rucci,
            "id_empresa" => $id_empresa,
        ]);

        if ($ps->rowCount() > 0) {

            $cliente = new stdClass();
            while ($rs = $ps->fetch()) {
                $cliente->nombre    = $rs['cli_nombre'];
                $cliente->apellido  = $rs['cli_apellido'];
                $cliente->direccion = $rs['cli_direccion'];
                $cliente->correo    = $rs['cli_correo'];
                $cliente->celular   = $rs['cli_celular'];
            }

            $res = true;

        }

        $respuesta = [
            "res"     => $res,
            "cliente" => $cliente,
        ];

        return $respuesta;

    }

    public function listar_articulos($id_empresa)
    {

        $sql = " SELECT inv_codigo as id, inv_codigo AS codigo , inv_nombre AS nombre, inv_descripcion AS descripcion ,inv_valorpvp AS valor,
       SUM(DISTINCT inv_stock) AS stock from tbl_inventarios inv ,tbl_empresas e , inv_tblsubcategoria c WHERE idempresa=:id_empresa

         AND e.emp_id=inv.idempresa AND inv_valorpvp > 0 AND inv_stock> 0   AND c.id=inv.idsubcategoria
         AND c.subcategoria='Vacunas' GROUP by inv_id";

        $ps = $this->db->prepare($sql);
        $ps->execute([

            "id_empresa" => $id_empresa,
        ]);

        $rs = $ps->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function verificar_cliente($rucci, $id_empresa)
    {
        $res = false;
        $sql = "SELECT * FROM tbl_clientes WHERE cli_rucci= :rucci AND idempresa= :id_empresa";

        $ps = $this->db->prepare($sql);
        $ps->execute([
            "rucci"      => $rucci,
            "id_empresa" => $id_empresa,
        ]);
        if ($ps->rowCount() > 0) {
            $res = true;
        }

        return $res;

    }

    public function registrar_cliente($datos)
    {
        $sql = "INSERT INTO tbl_clientes(cli_rucci,cli_nombre,cli_apellido,cli_direccion,cli_correo,cli_celular,idempresa)
                VALUES(:rucci,:nombre,:apellido,:direccion,:correo,:celular,:empresa)";

        $ps = $this->db->prepare($sql);
        $ps->execute([
            "rucci"     => $datos['rucci'],
            "nombre"    => $datos['nombre'],
            "apellido"  => $datos['apellido'],
            "direccion" => $datos['direccion'],
            "correo"    => $datos['correo'],
            "celular"   => $datos['celular'],
            "empresa"   => $datos['empresa'],
        ]);
    }

    public function actualizar_cliente($datos)
    {
        $sql = "UPDATE tbl_clientes SET cli_nombre =:nombre,cli_apellido =:apellido,cli_direccion = :direccion,cli_correo =:correo,cli_celular = :celular
               WHERE cli_rucci= :rucci AND  idempresa = :empresa";

        $ps = $this->db->prepare($sql);
        $ps->execute([
            "rucci"     => $datos['rucci'],
            "nombre"    => $datos['nombre'],
            "apellido"  => $datos['apellido'],
            "direccion" => $datos['direccion'],
            "correo"    => $datos['correo'],
            "celular"   => $datos['celular'],
            "empresa"   => $datos['empresa'],
        ]);
    }

    public function registrar_venta($datos)
    {
        $sql = "INSERT INTO tbl_ventas(ven_numero,ven_fecha,ven_subtotal,ven_iva,ven_total,ven_tipo_venta,idcliente,idempresa)
                VALUES(:numero,:fecha,:subtotal,:iva,:total,:tipo,:cliente,:empresa)";

        $ps = $this->db->prepare($sql);
        $ps->execute([
            "numero"   => $datos['numero'],
            "fecha"    => $datos['fecha'],
            "subtotal" => $datos['subtotal'],
            "iva"      => $datos['iva'],
            "total"    => $datos['total'],
            "tipo"     => $datos['tipo'],
            "cliente"  => $datos['cliente'],
            "empresa"  => $datos['empresa'],
        ]);
    }

    public function registrar_detalle($datos)
    {
        $sql = "INSERT INTO tbl_detalle_ventas(detven_cantidad,detven_precio,detven_total,idventa,idarticulo)
                VALUES(:cantidad,:precio,:total,:venta,:articulo)";

        $ps = $this->db->prepare($sql);
        $ps->execute([
            "cantidad" => $datos['cantidad'],
            "precio"   => $datos['precio'],
            "total"    => $datos['total'],
            "venta"    => $datos['venta'],
            "articulo" => $datos['articulo'],

        ]);
    }

    //insertar tbl_hisotail

    public function insertar($datos)
    {

        $inv_sql  = "INSERT INTO tbl_historial_vacunas(his_descripcion,idmascota,fecha_vacuna,his_fecha_proxima,his_tipo) VALUES (?,?,?,?,?)";
        $inv_stmt = $this->db->prepare($inv_sql);
        $inv_stmt->bindParam(1, $datos[4]);
        $inv_stmt->bindParam(2, $datos[2]);
        $inv_stmt->bindParam(3, $datos[0]);
        $inv_stmt->bindParam(4, $datos[0]);
        $inv_stmt->bindParam(5, $datos[1]);
        $inv_stmt->execute();
    }

    public function listar_provincias()
    {

        $sql = "SELECT ID_PROVINCIA AS id,PROVINCIA AS nombre FROM tab_provincias";

        $ps = $this->db->prepare($sql);
        $ps->execute();

        $rs = $ps->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function listar_cantones($id_provincia)
    {

        $sql = "SELECT ID_CANTON AS id,CANTON AS nombre FROM tab_cantones
                WHERE ID_PROVINCIA = :id_provincia ";

        $ps = $this->db->prepare($sql);
        $ps->execute([

            "id_provincia" => $id_provincia,
        ]);

        $rs = $ps->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function listar_parroquias($id_canton)
    {

        $sql = "SELECT ID_PARROQUIA AS id,PARROQUIA AS nombre FROM tab_parroquias
                WHERE ID_CANTON = :id_canton ";

        $ps = $this->db->prepare($sql);
        $ps->execute([

            "id_canton" => $id_canton,
        ]);

        $rs = $ps->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function listar_razas($especie)
    {

        $sql = "SELECT id_mas AS id,descripcion AS nombre FROM tipo_razas WHERE tipo_especie = :especie";

        $ps = $this->db->prepare($sql);
        $ps->execute(["especie" => $especie]);

        $rs = $ps->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function listar_tipos()
    {

        $sql = "SELECT id_especie AS id,descripcion AS nombre FROM tbl_especies ";

        $ps = $this->db->prepare($sql);
        $ps->execute();

        $rs = $ps->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    //funjciones para qr
    public function listarprovinciades($id_provincia)
    {

        $sql = "SELECT PROVINCIA FROM `tab_provincias` WHERE `ID_PROVINCIA`=? ";
        $ps  = $this->db->prepare($sql);
        $ps->bindParam(1, $id_provincia);
        $ps->execute();
        $rs = $ps->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function listarcantondes($id_canton)
    {

        $sql = "SELECT CANTON FROM `tab_cantones` WHERE `ID_CANTON`=? ";
        $ps  = $this->db->prepare($sql);
        $ps->bindParam(1, $id_canton);
        $ps->execute();
        $rs = $ps->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function listarparroquiades($id_parroquia)
    {

        $sql = "SELECT PARROQUIA FROM `tab_parroquias` WHERE `ID_PARROQUIA`=? ";
        $ps  = $this->db->prepare($sql);
        $ps->bindParam(1, $id_parroquia);
        $ps->execute();
        $rs = $ps->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function listarrazades($id_raza)
    {

        $sql = "SELECT descripcion FROM `tipo_razas` WHERE `id_mas`=? ";
        $ps  = $this->db->prepare($sql);
        $ps->bindParam(1, $id_raza);
        $ps->execute();
        $rs = $ps->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function listartipodes($id_tipo)
    {

        $sql = "SELECT descripcion FROM `tbl_especies` WHERE `id_especie`=? ";
        $ps  = $this->db->prepare($sql);
        $ps->bindParam(1, $id_tipo);
        $ps->execute();
        $rs = $ps->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function buscar_tenedor($cedula, $id_empresa)
    {

        $res        = false;
        $tenedor    = null;
        $cantones   = null;
        $parroquias = null;

        $sql = "SELECT * FROM tbl_tenedores WHERE ten_cedula = :cedula AND idempresa = :id_empresa";
        $ps  = $this->db->prepare($sql);
        $ps->execute([
            "cedula"     => $cedula,
            "id_empresa" => $id_empresa,
        ]);

        if ($ps->rowCount() > 0) {

            $tenedor = new stdClass();
            while ($rs = $ps->fetch()) {
                $tenedor->primer_nombre    = $rs['ten_primer_nombre'];
                $tenedor->segundo_nombre   = $rs['ten_segundo_nombre'];
                $tenedor->apellido_paterno = $rs['ten_apellido_paterno'];
                $tenedor->apellido_materno = $rs['ten_apellido_materno'];
                $tenedor->fecha            = $rs['ten_fecha'];
                $tenedor->correo           = $rs['ten_correo'];
                $tenedor->celular          = $rs['ten_celular'];

                $tenedor->provincia = $rs['ten_provincia'];
                $tenedor->canton    = $rs['ten_canton'];
                $tenedor->parroquia = $rs['ten_parroquia'];

                $tenedor->barrio           = $rs['ten_barrio'];
                $tenedor->calle_principal  = $rs['ten_calle_principal'];
                $tenedor->calle_secundaria = $rs['ten_calle_secundaria'];

                $tenedor->numero_casa     = $rs['ten_numero_casa'];
                $tenedor->referencia_casa = $rs['ten_referencia_casa'];
            }

            $cantones   = self::listar_cantones($tenedor->provincia);
            $parroquias = self::listar_parroquias($tenedor->canton);

            $res = true;

        }

        $respuesta = [
            "res"        => $res,
            "tenedor"    => $tenedor,
            "cantones"   => $cantones,
            "parroquias" => $parroquias,
        ];

        return $respuesta;

    }

    public function verificar_tenedor($cedula, $id_empresa)
    {
        $res = false;
        $sql = "SELECT * FROM tbl_tenedores WHERE ten_cedula= :cedula AND idempresa= :id_empresa";

        $ps = $this->db->prepare($sql);
        $ps->execute([
            "cedula"     => $cedula,
            "id_empresa" => $id_empresa,
        ]);
        if ($ps->rowCount() > 0) {
            $res = true;
        }

        return $res;
    }

    public function registrar_tenedor($datos)
    {
        $sql = "INSERT INTO tbl_tenedores(ten_cedula,ten_primer_nombre,ten_segundo_nombre,ten_apellido_paterno,
        ten_apellido_materno,ten_fecha,ten_correo,ten_celular,ten_provincia,ten_canton,ten_parroquia,
        ten_barrio,ten_calle_principal,ten_calle_secundaria,ten_numero_casa,ten_referencia_casa,ten_foto,idempresa)
                VALUES(:cedula,:primer_nombre,:segundo_nombre,:paterno,:materno,:fecha,:correo,:celular,
                :provincia,:canton,:parroquia,:barrio,:calle_principal,:calle_secundaria,:numero,:referencia,
                :foto,:empresa)";

        $ps = $this->db->prepare($sql);
        $ps->execute([
            "cedula"           => $datos['cedula'],
            "primer_nombre"    => $datos['primer_nombre'],
            "segundo_nombre"   => $datos['segundo_nombre'],
            "paterno"          => $datos['apellido_paterno'],
            "materno"          => $datos['apellido_materno'],
            "fecha"            => $datos['fecha'],
            "correo"           => $datos['correo'],
            "celular"          => $datos['celular'],
            "provincia"        => $datos['provincia'],
            "canton"           => $datos['canton'],
            "parroquia"        => $datos['parroquia'],
            "barrio"           => $datos['barrio'],
            "calle_principal"  => $datos['calle_principal'],
            "calle_secundaria" => $datos['calle_secundaria'],
            "numero"           => $datos['numero'],
            "referencia"       => $datos['referencia'],
            "foto"             => $datos['foto'],
            "empresa"          => $datos['empresa'],

        ]);
    }

    public function actualizar_tenedor($datos)
    {
        $sql = "UPDATE tbl_tenedores SET  ten_primer_nombre=:primer_nombre,ten_segundo_nombre=:segundo_nombre,ten_apellido_paterno=:paterno,
                                          ten_apellido_materno=:materno,ten_fecha=:fecha,ten_correo=:correo,
                                          ten_celular=:celular,
                ten_provincia=:provincia,ten_canton=:canton,ten_parroquia=:parroquia,
                ten_barrio=:barrio,ten_calle_principal=:calle_principal,
                ten_calle_secundaria=:calle_secundaria,ten_numero_casa=:numero,
                ten_referencia_casa=:referencia
               WHERE ten_cedula =:cedula AND idempresa =:empresa";

        $ps = $this->db->prepare($sql);
        $ps->execute([
            "cedula"           => $datos['cedula'],
            "primer_nombre"    => $datos['primer_nombre'],
            "segundo_nombre"   => $datos['segundo_nombre'],
            "paterno"          => $datos['apellido_paterno'],
            "materno"          => $datos['apellido_materno'],
            "fecha"            => $datos['fecha'],
            "correo"           => $datos['correo'],
            "celular"          => $datos['celular'],
            "provincia"        => $datos['provincia'],
            "canton"           => $datos['canton'],
            "parroquia"        => $datos['parroquia'],
            "barrio"           => $datos['barrio'],
            "calle_principal"  => $datos['calle_principal'],
            "calle_secundaria" => $datos['calle_secundaria'],
            "numero"           => $datos['numero'],
            "referencia"       => $datos['referencia'],
            "empresa"          => $datos['empresa'],
        ]);
    }

    public function verificar_mascota($mascota_codigo)
    {
        $res = false;
        $sql = "SELECT * FROM tbl_mascotas WHERE mas_codigo= :mascota_codigo ";

        $ps = $this->db->prepare($sql);
        $ps->execute([
            "mascota_codigo" => $mascota_codigo,
        ]);
        if ($ps->rowCount() > 0) {
            $res = true;
        }

        return $res;
    }

    public function registrar_mascota($datos)
    {
        $sql = "INSERT INTO tbl_mascotas(mas_codigo, mas_nombre, mas_sexo, mas_fecha, mas_color, mas_color_secundario, mas_esterilizado, mas_tipo, mas_imagen, mas_codigo_qr, idraza, idtenedor, idempresa)
                VALUES(:codigo,:nombre,:sexo,:fecha,:color,:color_secundario,:esterilizado,:tipo,
                :imagen,:qr,:raza,:tenedor,:empresa)";

        $ps = $this->db->prepare($sql);
        $ps->execute([
            "codigo"           => $datos['codigo'],
            "nombre"           => $datos['nombre'],
            "sexo"             => $datos['sexo'],
            "fecha"            => $datos['fecha'],
            "color"            => $datos['color'],
            "color_secundario" => $datos['color_secundario'],
            "esterilizado"     => $datos['esterilizado'],
            "tipo"             => $datos['tipo'],
            "imagen"           => $datos['imagen'],
            "qr"               => $datos['qr'],
            "raza"             => $datos['raza'],
            "tenedor"          => $datos['tenedor'],
            "empresa"          => $datos['empresa'],

        ]);
    }

    public function stock_actual($articulo, $empresa)
    {
        $sql = "SELECT inv_stock AS cantidad FROM tbl_inventarios  WHERE inv_id= :articulo
                AND idempresa =:empresa";

        $ps = $this->db->prepare($sql);
        $ps->execute([
            "articulo" => $articulo,
            "empresa"  => $empresa,
        ]);

        $art = new stdClass();
        while ($rs = $ps->fetch()) {
            $art->cantidad = $rs['cantidad'];
        }

        return $art->cantidad;
    }

    public function actualizar_stock($cantidad, $articulo, $empresa)
    {
        $sql = "UPDATE tbl_inventarios SET  inv_stock=:cantidad WHERE inv_id = :articulo
                AND idempresa =:empresa";

        $ps = $this->db->prepare($sql);
        $ps->execute([
            "articulo" => $articulo,
            "empresa"  => $empresa,
            "cantidad" => $cantidad,
        ]);

    }

}
