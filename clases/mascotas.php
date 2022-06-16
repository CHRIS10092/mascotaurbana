<?php
session_start();
/**
 *
 */
require_once 'config.php';
class mascotas extends config
{
    private $inv_dbh;
    public function __construct()
    {
        $this->inv_dbh = config::Abrir();
    }

    public function listadotenedor()
    {

        //ejecuto la sentencia sql
        $inv_sql = "SELECT `ten_cedula`,`ten_primer_nombre`,`ten_apellido_paterno`,`ten_fecha`,`ten_correo`,`ten_celular`,`ten_barrio`,`ten_foto` from tbl_tenedores   ";
        //preparo la consulto
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        //le trasnformo a obj

        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        //ejecuto
        $inv_stmt->execute();
        //comparo si estan las mismas columnas en la base de datos
        while ($inv_row = $inv_stmt->fetch()) {
            # code...
            $data = $inv_row->ten_cedula . "||" . $inv_row->ten_primer_nombre . "||" . $inv_row->ten_apellido_paterno . "||" . $inv_row->ten_correo . "||" . $inv_row->ten_celular . "||" . $inv_row->ten_barrio;
            echo '<tr>';

            echo '<td>' . $inv_row->ten_cedula . '</td>';
            echo '<td>' . $inv_row->ten_primer_nombre . '</td>';
            echo '<td>' . $inv_row->ten_apellido_paterno . '</td>';

            echo '<td>

                <button class="btn btn-success"  onclick="capturar(\'' . $data . '\')">
                    <i class="glyphicon glyphicon-edit"></i>
                </button>


                  </td>';
            echo '</tr>';
        }
    }

    public function listar_clientes()
    {
        $sql = "SELECT * FROM tbl_tenedores  ";
        $ps  = $this->inv_dbh->prepare($sql);
        $ps->execute();
        $rs = $ps->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function registrarmascota($datos)
    {
        try {
            $inv_sql  = "INSERT INTO `tbl_mascotas`( `mas_codigo`, `mas_nombre`, `mas_sexo`, `mas_fecha`, `mas_color`, `mas_color_secundario`, `mas_tipo`, `idraza`, `mas_esterilizado`, `mas_imagen`, `idtenedor`, `mas_codigo_qr`, `idempresa`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
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
            $inv_stmt->execute();
            echo 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function VerificarDuplicadoMascota($codigo)
    {

        $sql      = "SELECT mas_codigo from tbl_mascotas where mas_codigo=?";
        $inv_stmt = $this->inv_dbh->prepare($sql);
        $inv_stmt->bindParam(1, $codigo);
        $inv_stmt->execute();

        if ($inv_stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //generar qr
    public function empresas()
    {
        $sql = "SELECT * FROM tbl_empresas  ";
        $ps  = $this->inv_dbh->prepare($sql);
        $ps->execute();
        $rs = $ps->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function ReporteQr()
    {
        $inv_sql = "SELECT a.mas_codigo, a.mas_nombre as mascota, a.mas_sexo, a.mas_fecha, a.mas_color,a.mas_color_secundario, a.mas_esterilizado ,a.mas_tipo, a.mas_imagen,a.mas_codigo_qr,r.descripcion as idraza, a.idtenedor,t.ten_primer_nombre as tenedor,a.mas_codigo_qr
FROM tbl_mascotas a, tbl_tenedores t, tipo_razas r
WHERE a.idtenedor=t.ten_cedula
AND a.idraza=r.id_mas
AND t.idempresa=00001";

        $ps = $this->inv_dbh->prepare($inv_sql);
        $ps->execute();
        $rs = $ps->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function listadomascotas()
    {
        //ejecuto la sentencia sql
        $inv_sql = " SELECT  a.mas_codigo as mas_codigo, a.mas_nombre as mascota, a.mas_sexo as mas_sexo , a.mas_fecha as mas_fecha, a.mas_color as mas_color,a.mas_color_secundario ,(e.id_especie) as id_especie,(e.descripcion) as  mas_tipo, (rz.id_mas) as idmas,(rz.descripcion) as idraza, a.mas_esterilizado as mas_esterilizado, a.mas_imagen as mas_imagen, a.idtenedor,t.ten_primer_nombre as tenedor
FROM tbl_mascotas a, tbl_tenedores t, tbl_especies e, tipo_razas rz
WHERE t.ten_cedula=a.idtenedor

and rz.id_mas=a.idraza
AND a.idempresa='" . $_SESSION['empresa']['idempresa'] . "' GROUP BY `mas_codigo` ";
        //preparo la consulto
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        //le trasnformo a obj

        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        //ejecuto
        $inv_stmt->execute();
        //comparo si estan las mismas columnas en la base de datos
        while ($inv_row = $inv_stmt->fetch()) {
            # code...
            $data = $inv_row->mas_codigo . "||" . $inv_row->mascota . "||" . $inv_row->mas_sexo . "||" . $inv_row->mas_fecha . "||" . $inv_row->mas_color . "||" . $inv_row->mas_color_secundario . "||" . $inv_row->mas_tipo . "||" . $inv_row->idraza . "||" . $inv_row->mas_esterilizado . "||" . $inv_row->mas_imagen . "||" . $inv_row->idtenedor . "||" . $inv_row->tenedor . "||" . $inv_row->idmas . "||" . $inv_row->id_especie;
            echo '<tr>';
            //    echo '<td>'.$inv_row->id_m.'</td>';
            echo '<td>' . $inv_row->mas_codigo . '</td>';
            echo '<td>' . $inv_row->mascota . '</td>';
            echo '<td>' . $inv_row->mas_sexo . '</td>';
            echo '<td>' . $inv_row->mas_fecha . '</td>';
            echo '<td>' . $inv_row->mas_color . '</td>';
            echo '<td>' . $inv_row->mas_color_secundario . '</td>';
            echo '<td>' . $inv_row->mas_tipo . '</td>';
            echo '<td>' . $inv_row->idraza . '</td>';
            echo '<td>' . $inv_row->mas_esterilizado . '</td>';
            echo '<td> <img width=20px;height=20px; src="../' . $inv_row->mas_imagen . '"></td>';

            echo '<td>' . $inv_row->tenedor . '</td>';

            echo '<td>
            <div class="hidden-sm hidden-md action-buttons">
                        
                        
                    <a data-toggle="modal" data-target="#m-mascotasu" onclick="mascotacap(\'' . $data . '\')"><i class="ace-icon fa fa-pencil bigger-130"></i> </a>
                      
                    <a class="green" data-toggle="modal" data-target="#mVerm" onclick="detallar(\'' . $inv_row->mas_codigo . '\')">
                    <i class="ace-icon fa fa-eye bigger-130"></i></a>
                    
                        
                     </div>
                  </td>';
            echo '</tr>';
        }
    }

    //para listar el admin

    public function listadomascotasadmin()
    {
        //ejecuto la sentencia sql
        $inv_sql = " SELECT  a.mas_codigo as mas_codigo, a.mas_nombre as mascota, a.mas_sexo as mas_sexo , a.mas_fecha as mas_fecha, a.mas_color as mas_color,a.mas_color_secundario ,(e.id_especie) as  mas_tipo, (rz.id_mas) as idraza, a.mas_esterilizado as mas_esterilizado, a.mas_imagen as mas_imagen, a.idtenedor,t.ten_primer_nombre as tenedor, em.emp_nombre
FROM tbl_mascotas a, tbl_tenedores t, tbl_especies e, tipo_razas rz , tbl_empresas em

WHERE t.ten_cedula=a.idtenedor
AND em.emp_id=a.idempresa
and rz.id_mas=a.idraza GROUP BY `mas_codigo` ";
        //preparo la consulto
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        //le trasnformo a obj

        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        //ejecuto
        $inv_stmt->execute();
        //comparo si estan las mismas columnas en la base de datos
        while ($inv_row = $inv_stmt->fetch()) {
            # code...
            $data = $inv_row->mas_codigo . "||" . $inv_row->mascota . "||" . $inv_row->mas_sexo . "||" . $inv_row->mas_fecha . "||" . $inv_row->mas_color . "||" . $inv_row->mas_color_secundario . "||" . $inv_row->mas_tipo . "||" . $inv_row->idraza . "||" . $inv_row->mas_esterilizado . "||" . $inv_row->mas_imagen . "||" . $inv_row->idtenedor . "||" . $inv_row->tenedor;
            echo '<tr>';
            //    echo '<td>'.$inv_row->id_m.'</td>';
            echo '<td>' . $inv_row->mas_codigo . '</td>';
            echo '<td>' . $inv_row->mascota . '</td>';
            echo '<td>' . $inv_row->mas_sexo . '</td>';
            echo '<td>' . $inv_row->mas_fecha . '</td>';
            echo '<td>' . $inv_row->mas_color . '</td>';
            echo '<td>' . $inv_row->mas_color_secundario . '</td>';
            echo '<td>' . $inv_row->mas_tipo . '</td>';
            echo '<td>' . $inv_row->idraza . '</td>';
            echo '<td>' . $inv_row->mas_esterilizado . '</td>';
            echo '<td> <img width=20px;height=20px; src="../' . $inv_row->mas_imagen . '"></td>';

            echo '<td>' . $inv_row->tenedor . '</td>';
            echo '<td>' . $inv_row->emp_nombre . '</td>';

            echo '<td>
            <div class="hidden-sm hidden-md action-buttons">
                        
                        
                    <a data-toggle="modal" data-target="#m-mascotasu" onclick="mascotacap(\'' . $data . '\')"><i class="ace-icon fa fa-pencil bigger-130"></i> </a>
                      
                    <a class="green" data-toggle="modal" data-target="#mVerm" onclick="detallar(\'' . $inv_row->mas_codigo . '\')">
                    <i class="ace-icon fa fa-eye bigger-130"></i></a>
                    
                        
                     </div>
                  </td>';
            echo '</tr>';
        }
    }

    public function DatosClientes($inv_documento)
    {
        $inv_sql = "SELECT m.mas_codigo,m.mas_nombre,m.mas_fecha,m.mas_color,m.mas_color_secundario,m.mas_sexo,e.descripcion as mas_tipo ,rz.descripcion as idraza,m.mas_esterilizado,m.mas_codigo_qr, m.mas_imagen,t.ten_cedula,t.ten_primer_nombre, t.ten_segundo_nombre, t.ten_apellido_paterno, t.ten_apellido_materno, t.ten_fecha, t.ten_correo, t.ten_celular, pro.PROVINCIA as ten_provincia, can.CANTON as ten_canton, parro.PARROQUIA ten_parroquia, t.ten_barrio, t.ten_calle_principal, t.ten_calle_secundaria, t.ten_numero_casa, t.ten_referencia_casa, t.ten_foto FROM tbl_mascotas m, tbl_tenedores t, tbl_especies e, tipo_razas rz,tab_provincias pro,tab_cantones can, tab_parroquias parro
        WHERE m.idtenedor=t.ten_cedula
        AND e.id_especie=m.mas_tipo
        AND rz.id_mas=m.idraza
        AND pro.ID_PROVINCIA=t.ten_provincia
        and parro.ID_PARROQUIA=t.ten_parroquia
        and can.ID_CANTON=t.ten_canton
        AND mas_codigo=?";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $inv_documento);
        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        $inv_stmt->execute();
        while ($inv_row = $inv_stmt->fetch()) {
            echo '<div  style="width:50%">';
            echo '<label style="font-weight: bolder;font-size:15px">Cedula Mascota: </label>';
            echo $inv_row->mas_codigo;
            echo '<br><label style="font-weight: bolder;font-size:15px">Nombre Mascota: </label>';
            echo $inv_row->mas_nombre;
            echo '<br><label style="font-weight: bolder;font-size:15px">Fecha de nacimiento: </label>';
            echo $inv_row->mas_fecha;
            echo '<br><label style="font-weight: bolder;font-size:15px">Sexo: </label>';
            echo $inv_row->mas_sexo;
            echo '<br><label style="font-weight: bolder;font-size:15px">Color : </label>';
            echo $inv_row->mas_color;
            echo '<br><label style="font-weight: bolder;font-size:15px">Color Secundario : </label>';
            echo $inv_row->mas_color_secundario;

            echo "</div>";
            echo '<div  style="width:45%">';
            echo '<label style="font-weight: bolder;font-size:15px">Especie: </label>';
            echo $inv_row->mas_tipo;
            echo '<br><label style="font-weight: bolder;font-size:15px">Raza: </label>';
            echo $inv_row->idraza;
            echo '<br><label style="font-weight: bolder;font-size:15px">Esterilizado: </label>';
            echo $inv_row->mas_esterilizado;

            echo '<br><label style="font-weight: bolder;font-size:15px">Codigo Qr: </label>';
            echo '<br>';
            echo '<img src="../' . $inv_row->mas_codigo_qr . '">';

            echo "</div>";
            echo '<div  style="width:55%"> ';

            echo '<img  width=250px height=190px"  src="../' . $inv_row->mas_imagen . '">';
            echo "</div>";
        }
    }

    public function DatosTenedor($inv_documento)
    {
        $inv_sql = "SELECT m.mas_codigo,m.mas_nombre,m.mas_fecha,m.mas_color,m.mas_color_secundario,m.mas_sexo,e.descripcion as mas_tipo ,rz.descripcion as idraza,m.mas_esterilizado,m.mas_codigo_qr, m.mas_imagen,t.ten_cedula,t.ten_primer_nombre, t.ten_segundo_nombre, t.ten_apellido_paterno, t.ten_apellido_materno, t.ten_fecha, t.ten_correo, t.ten_celular, pro.PROVINCIA as ten_provincia, can.CANTON as ten_canton, parro.PARROQUIA ten_parroquia, t.ten_barrio, t.ten_calle_principal, t.ten_calle_secundaria, t.ten_numero_casa, t.ten_referencia_casa, t.ten_foto FROM tbl_mascotas m, tbl_tenedores t, tbl_especies e, tipo_razas rz,tab_provincias pro,tab_cantones can, tab_parroquias parro
        WHERE m.idtenedor=t.ten_cedula
        AND e.id_especie=m.mas_tipo
        AND rz.id_mas=m.idraza
        AND pro.ID_PROVINCIA=t.ten_provincia
        and parro.ID_PARROQUIA=t.ten_parroquia
        and can.ID_CANTON=t.ten_canton
        AND mas_codigo=?";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $inv_documento);
        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        $inv_stmt->execute();
        while ($inv_row = $inv_stmt->fetch()) {

            //para generar los datos del tenedor
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

            echo '<div  style="width:45%">';

            echo '<br><label style="font-weight: bolder;font-size:15px">Parroquia: </label>';
            echo $inv_row->ten_parroquia;
            echo '<br><label style="font-weight: bolder;font-size:15px">Barrio: </label>';
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
            echo '<div  style="width:45%">';

            echo '<img  width=250px height=250px" src="../' . $inv_row->ten_foto . '">';
            echo "</div>";
        }
    }

    public function provincias()
    {
        $sql  = "SELECT * FROM tbl_especies ";
        $stmt = $this->inv_dbh->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function listarcantones($idprovincia)
    {
        $sql  = "SELECT * FROM tipo_razas where tipo_especie=? ";
        $stmt = $this->inv_dbh->prepare($sql);
        $stmt->bindParam(1, $idprovincia);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function listarespecies()
    {
        $inv_sql  = " SELECT * FROM tbl_especies ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->execute();
        $rs = $inv_stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }
    public function listartiporaza($idraza)
    {

        $inv_sql  = "SELECT * FROM tipo_razas where tipo_especie=? ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $idraza);
        $inv_stmt->execute();
        //traer la descripcion como objeto
        $rs = $inv_stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function EditarMascota($datos)
    {
        try {
            $inv_sql  = "UPDATE  tbl_mascotas SET  mas_nombre=?, mas_sexo=?,mas_fecha=?, mas_color=?, mas_color_secundario=?,mas_tipo=?,idraza=?,mas_esterilizado=?, mas_imagen=?,idtenedor=?  WHERE mas_codigo=?";
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

            $inv_stmt->execute();
            //echo 1;
        } catch (PDOException $e) {
            //echo $e->getMessage();
        }
    }

    public function encontrar_numero_venta($numero)
    {
        $res = false;
        $sql = "SELECT numero FROM ventas WHERE numero = :numero";
        $ps  = $this->inv_dbh->prepare($sql);
        $ps->execute(["numero" => $numero]);

        if ($ps->rowCount() > 0) {
            $res = true;
        }

        return $res;
    }

    public function mostrar_detalle($numero)
    {

        $sql = "SELECT a.nombre AS nombre, cantidad
                FROM detalle_venta d, articulos a
                WHERE d.id_a = a.id_a
                AND id_venta = :numero";
        $ps = $this->inv_dbh->prepare($sql);
        $ps->execute(["numero" => $numero]);
        $articulo = new stdClass();
        while ($rs = $ps->fetch()) {

            $articulo->nombre   = $rs["nombre"];
            $articulo->cantidad = $rs["cantidad"];
        }

        return $articulo;
    }

    public function verificar_mascota_registrada($tenedor)
    {

        $sql = "SELECT COUNT(*)AS numero FROM mascotas WHERE id_tenedor = :tenedor";
        $ps  = $this->inv_dbh->prepare($sql);
        $ps->execute(["tenedor" => $tenedor]);
        $mascota = new stdClass();
        while ($rs = $ps->fetch()) {

            $mascota->cantidad = $rs["numero"];
        }

        return $mascota;
    }
}