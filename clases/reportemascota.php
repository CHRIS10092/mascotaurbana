<?php

/**
 *
 */
require_once "config.php";
class reportemascota extends config
{
    private $inv_dbh;
    public function __construct()
    {
        $this->inv_dbh = config::abrir();
    }

    public function BuscarTenedor($buscar)
    {
//buscar por cedula

        $inv_sql = "SELECT  ten_cedula,ten_primer_nombre,ten_segundo_nombre,ten_apellido_paterno,ten_apellido_materno,ten_fecha,ten_correo,ten_celular,(p.PROVINCIA) as ten_provincia,ca.CANTON as ten_canton , pr.PARROQUIA as ten_parroquia ,ten_barrio,ten_calle_principal,ten_numero_casa,ten_calle_secundaria,ten_referencia_casa,ten_foto FROM tbl_tenedores t, tab_provincias p, tab_parroquias pr , tab_cantones ca WHERE  ten_cedula=? AND
p.ID_PROVINCIA=t.ten_provincia AND ca.ID_CANTON=t.ten_canton AND pr.ID_PARROQUIA=t.ten_parroquia ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $buscar);
        $inv_stmt->execute();

        $rs = $inv_stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;

    }
    public function BuscarMascota($buscar)
    {
//buscar por cedula

        $inv_sql = "SELECT `mas_codigo`,`mas_nombre`,`mas_sexo`,`mas_fecha`,`mas_color`,`mas_color_secundario`,`e`.`descripcion` as `mas_tipo`,`rz`.`descripcion` as `idraza`,`mas_esterilizado`,`mas_imagen` FROM tbl_mascotas m, tipo_razas rz, tbl_especies e where idtenedor=? AND e.id_especie=m.mas_tipo
AND m.idraza=rz.id_mas ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $buscar);
        $inv_stmt->execute();

        $rs = $inv_stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;

    }

    public function BuscarIDMascota($buscar)
    {
//buscar por id mascota

        $inv_sql = "SELECT mas_codigo,mas_nombre,mas_sexo,mas_fecha,mas_color,mas_color_secundario,e.descripcion as mas_tipo,rz.descripcion as idraza,mas_esterilizado,mas_imagen ,usu.usu_primernombre,usu.usu_apellidopaterno FROM tbl_mascotas m, tipo_razas rz, tbl_especies e,tbl_empresas em,tbl_usuarios usu where mas_codigo=? AND e.id_especie=m.mas_tipo
AND m.idraza=rz.id_mas
AND em.emp_id=m.idempresa
AND usu.idempresa=m.idempresa";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $buscar);
        $inv_stmt->execute();

        $rs = $inv_stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;

    }

    public function BuscarIDTenedor($buscar)
    {
//buscar por id tenedor

        $inv_sql = "SELECT ten_cedula,ten_primer_nombre,ten_segundo_nombre,ten_apellido_paterno,ten_apellido_materno,ten_fecha,ten_correo,ten_celular,(p.PROVINCIA) as ten_provincia,ca.CANTON as ten_canton , pr.PARROQUIA as ten_parroquia ,ten_barrio,ten_calle_principal,ten_numero_casa,ten_calle_secundaria,ten_referencia_casa,ten_foto FROM tbl_tenedores t, tab_provincias p, tab_parroquias pr , tab_cantones ca WHERE  ten_cedula=? AND
p.ID_PROVINCIA=t.ten_provincia AND ca.ID_CANTON=t.ten_canton AND pr.ID_PARROQUIA=t.ten_parroquia  ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $buscar);
        $inv_stmt->execute();

        $rs = $inv_stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;

    }

    public function BuscarMascotaVac($buscar)
    {
//buscar por cedula

        $inv_sql  = "SELECT h.his_descripcion,h.fecha_vacuna, DATE_ADD(h.fecha_vacuna,INTERVAL 21 DAY)as his_fecha_proxima ,h.idmascota, h.his_tipo,inv.* FROM tbl_historial_vacunas h,tbl_mascotas m,tbl_inventarios inv WHERE h.idmascota=m.mas_codigo AND m.mas_codigo=? AND inv.inv_codigo=h.his_tipo ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $buscar);
        $inv_stmt->execute();

        $rs = $inv_stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;

    }

    public function BuscarMascotaDes($buscar)
    {
//buscar por cedula

        $inv_sql  = "SELECT des.*,m.* ,inv.* FROM tbl_desparacitacion des,tbl_mascotas m,tbl_inventarios inv WHERE des.idmascota=m.mas_codigo AND des.idmascota=?  AND inv.inv_codigo=des.des_idarticulo";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $buscar);
        $inv_stmt->execute();

        $rs = $inv_stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;

    }
    public function BuscarMascotaSeg($buscar)
    {
//buscar por cedula

        $inv_sql  = "SELECT des.*,m.* ,inv.* , DATE_ADD(des.seg_fecha_proxima,INTERVAL 365 DAY)as seg_fecha_proxima FROM tbl_seguros_medicos des,tbl_mascotas m,tbl_inventarios inv WHERE des.idmascota=m.mas_codigo AND des.idmascota=? AND inv.inv_codigo=des.seg_idarticulo ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $buscar);
        $inv_stmt->execute();

        $rs = $inv_stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;

    }
    public function BuscarMascotaExz($buscar)
    {
//buscar por cedula

        $inv_sql  = "SELECT des.*,m.*,inv.*, DATE_ADD(des.exe_fecha_proxima,INTERVAL 365 DAY)as seg_fecha_proxima FROM tbl_exequiales des,tbl_mascotas m,tbl_inventarios inv WHERE des.idmascota=m.mas_codigo AND des.idmascota=? AND inv.inv_codigo=des.exe_idarticulo";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $buscar);
        $inv_stmt->execute();

        $rs = $inv_stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;

    }

}
