<?php
session_start();

require_once 'config.php';
class tenedor extends config
{
    private $inv_dbh;
    public function __construct()
    {
        $this->inv_dbh = config::Abrir();
    }

    public function listadotenedor()
    {

        //ejecuto la sentencia sql

        $inv_sql = "SELECT  t.ten_cedula, t.ten_primer_nombre, t.ten_segundo_nombre, t.ten_apellido_paterno, t.ten_apellido_materno, t.ten_fecha, t.ten_correo, t.ten_celular, t.ten_provincia as provincia, can.ID_CANTON as canton, pa.ID_PARROQUIA as parroquia, t.ten_barrio, t.ten_calle_principal, t.ten_numero_casa, t.ten_calle_secundaria, t.ten_referencia_casa, t.ten_foto FROM tbl_tenedores  t , tab_provincias pro, tab_cantones can, tab_parroquias pa where pro.ID_PROVINCIA=t.ten_provincia and pa.ID_PARROQUIA=t.ten_parroquia and can.ID_CANTON=t.ten_canton AND  idempresa='" . $_SESSION['empresa']['idempresa'] . "' ";
        //preparo la consulto
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        //le trasnformo a obj

        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        //ejecuto
        $inv_stmt->execute();
        //comparo si estan las mismas columnas en la base de datos
        while ($inv_row = $inv_stmt->fetch()) {
            # code...
            $data = $inv_row->ten_cedula . "||" . $inv_row->ten_primer_nombre . "||" . $inv_row->ten_segundo_nombre . "||" . $inv_row->ten_apellido_paterno . "||" . $inv_row->ten_apellido_materno . "||" . $inv_row->ten_fecha . "||" . $inv_row->ten_correo . "||" . $inv_row->ten_celular . "||" . $inv_row->provincia . "||" . $inv_row->canton . "||" . $inv_row->parroquia . "||" . $inv_row->ten_barrio . "||" . $inv_row->ten_calle_principal . "||" . $inv_row->ten_numero_casa . "||" . $inv_row->ten_calle_secundaria . "||" . $inv_row->ten_referencia_casa . "||" . $inv_row->ten_foto;
            echo '<tr>';

            echo '<td>' . $inv_row->ten_cedula . '</td>';
            echo '<td>' . $inv_row->ten_primer_nombre . '</td>';
            echo '<td>' . $inv_row->ten_segundo_nombre . '</td>';
            echo '<td>' . $inv_row->ten_apellido_paterno . '</td>';
            echo '<td>' . $inv_row->ten_apellido_materno . '</td>';
            echo '<td>' . $inv_row->ten_celular . '</td>';
            echo '<td> <img width=20px;height=20px; src="../' . $inv_row->ten_foto . '"></td>';

            echo '<td>
            <div class="hidden-sm hidden-md action-buttons">
                        
                        
                    <a data-toggle="modal" data-target="#m-tenedoru" onclick="capturar(\'' . $data . '\')"><i class="ace-icon fa fa-pencil bigger-130"></i> </a>
                      
                    <a class="green" data-toggle="modal" data-target="#mVer" onclick="detallar(\'' . $inv_row->ten_cedula . '\')">
                    <i class="ace-icon fa fa-eye bigger-130"></i></a>
                    
                        
                     </div>
                  </td>';
            echo '</tr>';
        }
    }

    //para el admin
    public function listadotenedoradmin()
    {

        $inv_sql = "SELECT  t.ten_cedula, t.ten_primer_nombre, t.ten_segundo_nombre, t.ten_apellido_paterno, t.ten_apellido_materno, t.ten_fecha, t.ten_correo, t.ten_celular, t.ten_provincia as provincia, can.ID_CANTON as canton, pa.ID_PARROQUIA as parroquia, t.ten_barrio, t.ten_calle_principal, t.ten_numero_casa, t.ten_calle_secundaria, t.ten_referencia_casa, t.ten_foto , e.emp_nombre FROM tbl_empresas e,tbl_tenedores  t , tab_provincias pro, tab_cantones can, tab_parroquias pa where pro.ID_PROVINCIA=t.ten_provincia and pa.ID_PARROQUIA=t.ten_parroquia and can.ID_CANTON=t.ten_canton AND e.emp_id=t.idempresa";
        //preparo la consulto
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        //le trasnformo a obj

        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        //ejecuto
        $inv_stmt->execute();
        //comparo si estan las mismas columnas en la base de datos
        while ($inv_row = $inv_stmt->fetch()) {
            # code...
            $data = $inv_row->ten_cedula . "||" . $inv_row->ten_primer_nombre . "||" . $inv_row->ten_segundo_nombre . "||" . $inv_row->ten_apellido_paterno . "||" . $inv_row->ten_apellido_materno . "||" . $inv_row->ten_fecha . "||" . $inv_row->ten_correo . "||" . $inv_row->ten_celular . "||" . $inv_row->provincia . "||" . $inv_row->canton . "||" . $inv_row->parroquia . "||" . $inv_row->ten_barrio . "||" . $inv_row->ten_calle_principal . "||" . $inv_row->ten_numero_casa . "||" . $inv_row->ten_calle_secundaria . "||" . $inv_row->ten_referencia_casa . "||" . $inv_row->ten_foto;
            echo '<tr>';

            echo '<td>' . $inv_row->ten_cedula . '</td>';
            echo '<td>' . $inv_row->ten_primer_nombre . '</td>';
            echo '<td>' . $inv_row->ten_segundo_nombre . '</td>';
            echo '<td>' . $inv_row->ten_apellido_paterno . '</td>';
            echo '<td>' . $inv_row->ten_apellido_materno . '</td>';
            echo '<td>' . $inv_row->ten_celular . '</td>';
            echo '<td> <img width=20px;height=20px; src="../' . $inv_row->ten_foto . '"></td>';
            echo '<td>' . $inv_row->emp_nombre . '</td>';
            echo '<td>
            <div class="hidden-sm hidden-md action-buttons">
                        
                        
                    <a data-toggle="modal" data-target="#m-tenedoru" onclick="capturar(\'' . $data . '\')"><i class="ace-icon fa fa-pencil bigger-130"></i> </a>
                      
                    <a class="green" data-toggle="modal" data-target="#mVer" onclick="detallar(\'' . $inv_row->ten_cedula . '\')">
                    <i class="ace-icon fa fa-eye bigger-130"></i></a>
                    
                        
                     </div>
                  </td>';
            echo '</tr>';
        }
    }

    public function DatosClientes($inv_documento)
    {
        $inv_sql = "SELECT ten_cedula, ten_primer_nombre, ten_segundo_nombre, ten_apellido_paterno, ten_apellido_materno, ten_fecha, ten_correo, ten_celular, pro.PROVINCIA as ten_provincia, can.CANTON as ten_canton, parro.PARROQUIA ten_parroquia, ten_barrio, ten_calle_principal, ten_calle_secundaria, ten_numero_casa, ten_referencia_casa, ten_foto, t.idempresa FROM tbl_mascotas m, tbl_tenedores t, tab_provincias pro,tab_cantones can, tab_parroquias parro
        WHERE  pro.ID_PROVINCIA=t.ten_provincia
        and parro.ID_PARROQUIA=t.ten_parroquia
        and can.ID_CANTON=t.ten_canton
        AND t.ten_cedula=? GROUP BY t.ten_cedula";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $inv_documento);
        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        $inv_stmt->execute();
        while ($inv_row = $inv_stmt->fetch()) {
            echo '<div  style="width:50%">';

            echo '<label style="font-weight: bolder;font-size:15px">Primer Nombre: </label>';
            echo $inv_row->ten_primer_nombre;
            echo '<br><label style="font-weight: bolder;font-size:15px">Segundo Nombre: </label>';
            echo $inv_row->ten_segundo_nombre;
            echo '<br><label style="font-weight: bolder;font-size:15px">Apellido Paterno: </label>';
            echo $inv_row->ten_apellido_materno;
            echo '<br><label style="font-weight: bolder;font-size:15px">Apellido Materno: </label>';
            echo $inv_row->ten_apellido_paterno;
            echo '<br><label style="font-weight: bolder;font-size:15px">Fecha de Nacimiento: </label>';
            echo $inv_row->ten_fecha;
            echo '<br><label style="font-weight: bolder;font-size:15px">Correo: </label>';
            echo $inv_row->ten_correo;
            echo '<br><label style="font-weight: bolder;font-size:15px">Celular: </label>';
            echo $inv_row->ten_celular;
            echo '<br><label style="font-weight: bolder;font-size:15px">Provincia: </label>';
            echo $inv_row->ten_provincia;
            echo '<br><label style="font-weight: bolder;font-size:15px">Canton: </label>';
            echo $inv_row->ten_canton;
            echo "</div>";

            echo '<div  style="width:25%">';

            echo '<br><label style="font-weight: bolder;font-size:15px">Parroquia: </label>';
            echo $inv_row->ten_parroquia;
            echo '<label style="font-weight: bolder;font-size:15px">Barrio: </label>';
            echo $inv_row->ten_barrio;
            echo '<br><label style="font-weight: bolder;font-size:15px">Calle Principal: </label>';
            echo $inv_row->ten_calle_principal;
            echo '<br><label style="font-weight: bolder;font-size:15px">Calle Secundaria: </label>';
            echo $inv_row->ten_calle_secundaria;
            echo '<br><label style="font-weight: bolder;font-size:15px">Numero de Casa: </label>';
            echo $inv_row->ten_numero_casa;
            echo '<br><label style="font-weight: bolder;font-size:15px">Referencia Casa: </label>';
            echo $inv_row->ten_referencia_casa;

            echo "</div>";

            echo '<div  style="width:25%">';

            echo '<img width=100px;height=200px; src="../' . $inv_row->ten_foto . '">';
            echo "</div>";
        }
    }

    public function DatosMascotasadmin($inv_documento)
    {
        $inv_sql = "SELECT ten_cedula,m.mas_color_secundario, m.mas_codigo ,m.mas_nombre,m.mas_sexo,m.mas_color,m.mas_esterilizado,e.descripcion as mas_tipo , rz.descripcion as mas_raza , pro.PROVINCIA as ten_provincia, can.CANTON as ten_canton, parro.PARROQUIA ten_parroquia FROM tbl_mascotas m, tbl_tenedores t, tab_provincias pro,tab_cantones can, tab_parroquias parro, tbl_especies e, tipo_razas rz
        WHERE  t.ten_cedula=?
        AND pro.ID_PROVINCIA=t.ten_provincia
        and parro.ID_PARROQUIA=t.ten_parroquia
        and can.ID_CANTON=t.ten_canton
        and t.ten_cedula=m.idtenedor
        AND rz.id_mas=m.mas_tipo
        and e.id_especie=m.mas_tipo";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $inv_documento);
        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        $inv_stmt->execute();
        echo "<table class='table table-responsive'>";
        echo "<tr>";

        echo "<td>CODIGO MASCOTA</td>";
        echo "<td>NOMBRE</td>";
        echo "<td>ESPECIE</td>";
        echo "<td>RAZA</td>";
        echo "<td>ESTERELIZADO</td>";
        echo "<td>COLOR</td>";
        echo "<td>COLOR SECUNDARIO</td>";

        echo "</tr>";
        while ($inv_row = $inv_stmt->fetch()) {

            echo "<tr>";

            echo '<td>' . $inv_row->mas_codigo . '</td>';
            echo '<td>' . $inv_row->mas_nombre . '</td>';
            echo '<td>' . $inv_row->mas_tipo . '</td>';
            echo '<td>' . $inv_row->mas_raza . '</td>';

            echo '<td>' . $inv_row->mas_esterilizado . '</td>';
            echo '<td>' . $inv_row->mas_color . '</td>';
            echo '<td>' . $inv_row->mas_color_secundario . '</td>';

            echo "</tr>";
        }

        echo "</table>";
    }

    public function VerificarDuplicadoTenedor($cedula, $idempresa)
    {

        $sql      = "SELECT ten_cedula from tbl_tenedores where ten_cedula=? AND idempresa=?";
        $inv_stmt = $this->inv_dbh->prepare($sql);
        $inv_stmt->bindParam(1, $cedula);
        $inv_stmt->bindParam(2, $idempresa);
        $inv_stmt->execute();

        if ($inv_stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function RegistrarTenedor($datos)
    {
        try {
            $inv_sql  = "INSERT INTO `tbl_tenedores`(`ten_cedula`, `ten_primer_nombre`, `ten_segundo_nombre`, `ten_apellido_paterno`, `ten_apellido_materno`, `ten_fecha`, `ten_correo`, `ten_celular`, `ten_provincia`, `ten_canton`, `ten_parroquia`, `ten_barrio`, `ten_calle_principal`, `ten_numero_casa`, `ten_calle_secundaria`, `ten_referencia_casa`, `ten_foto`, `idempresa`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $inv_stmt = $this->inv_dbh->prepare($inv_sql);
            $inv_stmt->bindParam(1, $datos[0]);
            $inv_stmt->bindParam(2, $datos[1]);
            $inv_stmt->bindParam(3, $datos[2]);
            $inv_stmt->bindParam(4, $datos[3]);
            $inv_stmt->bindParam(5, $datos[4]);
            $inv_stmt->bindParam(6, $datos[5]);
            $inv_stmt->bindParam(7, $datos[6]);
            $inv_stmt->bindParam(8, $datos[7]);
            $inv_stmt->bindParam(9, $datos[8]);
            $inv_stmt->bindParam(10, $datos[9]);
            $inv_stmt->bindParam(11, $datos[10]);
            $inv_stmt->bindParam(12, $datos[11]);
            $inv_stmt->bindParam(13, $datos[12]);
            $inv_stmt->bindParam(14, $datos[13]);
            $inv_stmt->bindParam(15, $datos[14]);
            $inv_stmt->bindParam(16, $datos[15]);
            $inv_stmt->bindParam(17, $datos[16]);
            $inv_stmt->bindParam(18, $datos[17]);

            $inv_stmt->execute();
            echo 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function EditarTenedor($datos)
    {
        try {
            $inv_sql  = "UPDATE `tbl_tenedores` SET `ten_primer_nombre`=?,`ten_segundo_nombre`=?,`ten_apellido_paterno`=?,`ten_apellido_materno`=?,`ten_fecha`=?,`ten_correo`=?,`ten_celular`=?,`ten_provincia`=?,`ten_canton`=?,`ten_parroquia`=?,`ten_barrio`=?,`ten_calle_principal`=?,`ten_numero_casa`=?,`ten_calle_secundaria`=?,`ten_referencia_casa`=?,`ten_foto`=?,`idempresa`=? WHERE `ten_cedula`=?";
            $inv_stmt = $this->inv_dbh->prepare($inv_sql);
            $inv_stmt->bindParam(1, $datos[0]);
            $inv_stmt->bindParam(2, $datos[1]);
            $inv_stmt->bindParam(3, $datos[2]);
            $inv_stmt->bindParam(4, $datos[3]);
            $inv_stmt->bindParam(5, $datos[4]);
            $inv_stmt->bindParam(6, $datos[5]);
            $inv_stmt->bindParam(7, $datos[6]);
            $inv_stmt->bindParam(8, $datos[7]);
            $inv_stmt->bindParam(9, $datos[8]);
            $inv_stmt->bindParam(10, $datos[9]);
            $inv_stmt->bindParam(11, $datos[10]);
            $inv_stmt->bindParam(12, $datos[11]);
            $inv_stmt->bindParam(13, $datos[12]);
            $inv_stmt->bindParam(14, $datos[13]);
            $inv_stmt->bindParam(15, $datos[14]);
            $inv_stmt->bindParam(16, $datos[15]);
            $inv_stmt->bindParam(17, $datos[16]);
            $inv_stmt->bindParam(18, $datos[17]);

            $inv_stmt->execute();
            echo 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function provincias()
    {
        $sql  = "SELECT * FROM tab_provincias";
        $stmt = $this->inv_dbh->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function listarcantones($idprovincia)
    {
        $sql  = "SELECT * FROM tab_cantones where ID_PROVINCIA=?";
        $stmt = $this->inv_dbh->prepare($sql);
        $stmt->bindParam(1, $idprovincia);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function listarcantonesu($idprovinciau)
    {
        $sql  = "SELECT * FROM tab_cantones where ID_PROVINCIA=?";
        $stmt = $this->inv_dbh->prepare($sql);
        $stmt->bindParam(1, $idprovinciau);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function listarparroquias($idcanton)
    {
        $sql  = "SELECT * FROM tab_parroquias where ID_CANTON=? ";
        $stmt = $this->inv_dbh->prepare($sql);
        $stmt->bindParam(1, $idcanton);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }
    public function listarparroquiasu($idcantonu)
    {
        $sql  = "SELECT * FROM tab_parroquias where ID_CANTON=? ";
        $stmt = $this->inv_dbh->prepare($sql);
        $stmt->bindParam(1, $idcantonu);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function cantonesu($idprovincia)
    {
        $sql  = "SELECT * FROM tab_cantones where ID_PROVINCIA=?";
        $stmt = $this->inv_dbh->prepare($sql);
        $stmt->bindParam(1, $idprovincia);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function parroquiasu($idcanton)
    {
        $sql  = "SELECT * FROM tab_parroquias where ID_CANTON=? ";
        $stmt = $this->inv_dbh->prepare($sql);
        $stmt->bindParam(1, $idcanton);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }
}