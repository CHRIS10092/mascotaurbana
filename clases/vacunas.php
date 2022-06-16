<?php
require_once 'config.php';
session_start();

class vacunas extends config
{
    private $inv_dbh;
    public function __construct()
    {
        $this->inv_dbh = config::Abrir();
    }

    public function listarvacuna()
    {

        $inv_sql = "SELECT v.vac_id,v.vac_descripcion,e.descripcion as vac_tipo ,e.id_especie FROM tbl_vacunas v , tbl_especies e
        where v.vac_tipo=e.id_especie";

        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        $inv_stmt->execute();
        while ($inv_row = $inv_stmt->fetch()) {
            $data = $inv_row->vac_id . "||" . $inv_row->vac_descripcion . "||" . $inv_row->vac_tipo . "||" . $inv_row->id_especie;

            echo '<tr>';
            echo '<td>' . $inv_row->vac_id . '</td>';
            echo '<td>' . $inv_row->vac_descripcion . '</td>';
            echo '<td>' . $inv_row->vac_tipo . '</td>';

            echo '<td>
                     <div class="btn-group pull-left">
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-espanded="false">
                            <i class="fa fa-cog"></i> Acciones <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a data-toggle="modal" data-target="#n-vacunasu" onclick="capturar(\'' . $data . '\')">Editar <i class="fa fa-edit"></i></a>
                            </li> <li>
                                <a data-toggle="modal" data-target="#m-ver" onclick="detallar(\'' . $data . '\')">Ver <i class="fa fa-edit"></i></a>
                            </li>
                        </ul>
                     </div>
                  </td>';
            echo '</tr>';
        }
    }

    public function buscar_historial($buscar)
    {
        $inv_sql  = "SELECT * FROM tbl_historial_vacunas where idmascota=?";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $buscar);
        $inv_stmt->execute();
        $rs = $inv_stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }
    public function insertar($datos)
    {
        try {
            $inv_sql  = "INSERT INTO tbl_vacunas (vac_descripcion,vac_tipo) VALUES (?,?)";
            $inv_stmt = $this->inv_dbh->prepare($inv_sql);
            $inv_stmt->bindParam(1, $datos[0]);
            $inv_stmt->bindParam(2, $datos[1]);
            $inv_stmt->execute();
            echo 1;
        } catch (PODException $e) {
            echo $e->getMessage();
        }
    }
    public function editar($datos)
    {
        try {
            $inv_sql  = "UPDATE tbl_vacunas SET vac_descripcion=?,vac_tipo=? WHERE vac_id=?";
            $inv_stmt = $this->inv_dbh->prepare($inv_sql);
            $inv_stmt->bindParam(1, $datos[1]);
            $inv_stmt->bindParam(2, $datos[2]);
            $inv_stmt->bindParam(3, $datos[0]);
            $inv_stmt->execute();
            echo 1;
        } catch (PODException $e) {
            echo $e->getMessage();
        }
    }

    public function ListarTipo()
    {
        $inv_sql  = "SELECT * FROM tbl_especies ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        $inv_stmt->execute();
        while ($inv_row = $inv_stmt->fetch()) {
            echo '<option value="' . $inv_row->id_especie . '" >' . $inv_row->descripcion . '</option>';
        }
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

        $inv_sql = "SELECT `mas_codigo`,`mas_nombre`,`mas_sexo`,`mas_fecha`,`mas_color`,`mas_color_secundario`,`e`.`descripcion` as `mas_tipo`,`rz`.`descripcion` as `idraza`,`mas_esterilizado`,`mas_imagen` FROM tbl_mascotas m, tipo_razas rz, tbl_especies e where mas_codigo=? AND e.id_especie=m.mas_tipo
AND m.idraza=rz.id_mas ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $buscar);
        $inv_stmt->execute();

        $rs = $inv_stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }
}