<?php
session_start();
require_once 'config.php';
class empresa extends config
{

    private $inv_dbh;
    public function __construct()
    {
        $this->inv_dbh = config::Abrir();
    }

    public function Listar()
    {
        $inv_sql  = "SELECT `emp_id`, `emp_ruc`, `emp_nombre`, `emp_direccion`, `emp_calle_principal`, `emp_calle_secundaria`, `emp_numero_oficina`, `emp_provincia`, `emp_canton`, `emp_parroquia`, `emp_referencia_oficina`, `emp_correo`, `emp_telefono`, `emp_logo`, `emp_estado`, `idtiposervicio` ,`emp_certificado_digital`,`emp_contrasenia_certificado`,`emp_tipo_ambiente` FROM tbl_empresas  ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        $inv_stmt->execute();
        while ($inv_row = $inv_stmt->fetch()) {
            $data = $inv_row->emp_id . '||' . $inv_row->emp_ruc . '||' . $inv_row->emp_nombre . '||' . $inv_row->emp_correo . '||' . $inv_row->emp_direccion . '||' . $inv_row->emp_telefono . '||' . $inv_row->emp_logo . '||' . $inv_row->idtiposervicio . '||' . $inv_row->emp_provincia . '||' . $inv_row->emp_canton . '||' . $inv_row->emp_parroquia . '||' . $inv_row->emp_calle_principal . '||' . $inv_row->emp_calle_secundaria . '||' . $inv_row->emp_numero_oficina . '||' . $inv_row->emp_referencia_oficina . '||' . $inv_row->emp_estado . '||' . $inv_row->emp_certificado_digital . '||' . $inv_row->emp_contrasenia_certificado . '||' . $inv_row->emp_tipo_ambiente;
            echo '<tr>';
            echo '<td>' . $inv_row->emp_ruc . '</td>';
            echo '<td>' . $inv_row->emp_nombre . '</td>';
            echo '<td>' . $inv_row->emp_correo . '</td>';
            echo '<td>' . $inv_row->emp_direccion . '</td>';
            echo '<td>' . $inv_row->emp_telefono . '</td>';
            echo '<td> <img width="70" height="70" src="../' . $inv_row->emp_logo . '"></td>';
            echo '<td>
            <div class="hidden-sm hidden-md action-buttons">
                             
            <a data-toggle="modal" data-target="#n-usuariou" onclick="capturaremp(\'' . $data . '\')">
            <i class="ace-icon fa fa-pencil bigger-130"></i> </a>
              
            <a class="green" data-toggle="modal" data-target="#mVerEmpresa" onclick="detallar(\'' . $inv_row->emp_ruc . '\')">
            <i class="ace-icon fa fa-print bigger-130"></i></a>
            
            <a class="green" data-toggle="modal" data-target="#n-habilitar" onclick="habilitar(\'' . $data . '\')">
            <i class="ace-icon fa fa-plus bigger-130"></i></a>
            
            <a class="green" data-toggle="modal" data-target="#mVerSucursal" onclick="versucursales(\'' . $inv_row->emp_id . '\')">
            <i class="ace-icon fa fa-eye bigger-130"></i></a>
                
             </div>	
                  </td>';
            echo '</tr>';
        }
    }

    //reportes de venta admin
    public function reportesventasadmin()
    {

        $inv_sql = "SELECT  e.emp_id,e.emp_ruc,e.emp_nombre,v.numero,v.fecha
        ,v.subtotal,v.iva,v.total
         FROM tbl_empresas e , tbl_empresas_venta v  WHERE e.emp_ruc=v.idcliente
         AND idempresa=00001";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $idventa);
        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        $inv_stmt->execute();
        while ($inv_row = $inv_stmt->fetch()) {
            $data = $inv_row->emp_id . '||' . $inv_row->emp_ruc . '||' . $inv_row->emp_nombre . '||' . $inv_row->numero . '||' . $inv_row->fecha;
            echo '<tr>';

            echo '<td>' . $inv_row->emp_id . '</td>';
            echo '<td>' . $inv_row->emp_nombre . '</td>';
            echo '<td>' . $inv_row->numero . '</td>';
            echo '<td>' . $inv_row->fecha . '</td>';

            echo '<td>' . $inv_row->total . '</td>';

            echo '<td>
                     <div class="btn-group pull-left">
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-espanded="false">
                            <i class="fa fa-cog"></i> Acciones <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">

                              <li>
                               <button class="btn btn-success" data-toggle="modal" data-target="#mVer" onclick="detallar(\'' . $inv_row->numero . '\')">
                        Ver <i class="glyphicon glyphicon-eye-open"></i>
                    </button>
                       </li>';

            echo '</ul>
                     </div>
                  </td>';
            echo '</tr>';
        }
    }
    //admin
    public function DatosCabecera($inv_documento)
    {
        $inv_sql = "SELECT * FROM  tbl_empresas_venta v , tbl_clientes c
WHERE  v.numero=?
AND v.idcliente=c.cli_rucci";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $inv_documento);

        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        $inv_stmt->execute();
        while ($inv_row = $inv_stmt->fetch()) {
            echo '<div  style="width:100%">';
            echo '<br><label style="font-weight: bolder;font-size:15px">Ruc Cliente : </label>';
            echo $inv_row->cli_rucci;
            echo '<br><label style="font-weight: bolder;font-size:15px">Nombre Cliente : </label>';
            echo $inv_row->cli_nombre;
            echo '<br><label style="font-weight: bolder;font-size:15px">Celular Cliente : </label>';
            echo $inv_row->cli_celular;
            echo '<br><label style="font-weight: bolder;font-size:15px">Cantidad : </label>';
            echo $inv_row->subtotal;
            echo '<br><label style="font-weight: bolder;font-size:15px">Precio : </label>';
            echo $inv_row->iva;
            echo '<br><label style="font-weight: bolder;font-size:15px">Total : </label>';
            echo $inv_row->total;

            echo '</div>';
        }
    }
    //admin
    public function DetalleVenta($inv_documento)
    {
        $inv_sql = "SELECT * FROM tbl_detalle_venta_empresa d , tbl_empresas_venta v , tbl_articulos a
        WHERE v.numero=?
        AND v.numero=d.idventa
        AND d.idarticulo=a.art_id";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $inv_documento);

        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        $inv_stmt->execute();

        echo "<table class='table table-responsive'>";
        echo "<tr>";
        echo "<th>CODIGO</th>";
        echo "<th>NOMBRE</th>";
        echo "<th>DESCRIPCION</th>";
        echo "<th>FECHA</th>";
        echo "<th>CANTIDAD</th>";
        echo "<th>VALOR</th>";

        echo "<th>TOTAL</th>";

        echo "</tr>";

        while ($inv_row = $inv_stmt->fetch()) {

            echo "<tr>";
            echo '<td>' . $inv_row->art_id . '</td>';
            echo '<td>' . $inv_row->art_nombre . '</td>';
            echo '<td>' . $inv_row->art_descripcion . '</td>';
            echo '<td>' . $inv_row->fecha . '</td>';
            echo '<td>' . $inv_row->cantidad . '</td>';
            echo '<td>' . $inv_row->precio . '</td>';
            echo '<td>' . $inv_row->cantidad * $inv_row->precio . '</td>';

            echo "</tr>";
        }

        echo "</table>";
    }

    //reportes de venta esta en clases articulos repor()   //empresas

    public function DatosCabeceraEmpresas($inv_documento)
    {
        $inv_sql = "SELECT * FROM  tbl_ventas v , tbl_clientes c
WHERE  v.ven_numero=?

AND v.idcliente=c.cli_rucci";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $inv_documento);

        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        $inv_stmt->execute();
        while ($inv_row = $inv_stmt->fetch()) {
            echo '<div  style="width:100%">';
            echo '<br><label style="font-weight: bolder;font-size:15px">Ruc Cliente : </label>';
            echo $inv_row->cli_rucci;
            echo '<br><label style="font-weight: bolder;font-size:15px">Nombre Cliente : </label>';
            echo $inv_row->cli_nombre;
            echo '<br><label style="font-weight: bolder;font-size:15px">Celular Cliente : </label>';
            echo $inv_row->cli_celular;
            echo '<br><label style="font-weight: bolder;font-size:15px">Sub total : </label>';
            echo $inv_row->ven_subtotal;
            echo '<br><label style="font-weight: bolder;font-size:15px">Iva  : </label>';
            echo $inv_row->ven_iva;
            echo '<br><label style="font-weight: bolder;font-size:15px">Total : </label>';
            echo $inv_row->ven_total;

            echo '</div>';
        }
    }
    //detalle de empresas
    public function DetalleVentaEmpresas($numero)
    {
        $inv_sql = "SELECT * FROM tbl_detalle_ventas d , tbl_ventas v ,tbl_articulos a

        WHERE v.ven_numero=?
        AND v.ven_numero=d.idventa
       AND a.art_id=d.idarticulo  ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $numero);

        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        $inv_stmt->execute();

        echo "<table class=table table-responsive>";
        echo "<tr>";
        echo "<th>CODIGO</th>";
        echo "<th>NOMBRE</th>";
        echo "<th>DESCRIPCION</th>";
        echo "<th>FECHA</th>";
        echo "<th>CANTIDAD</th>";
        echo "<th>VALOR</th>";

        echo "<th>TOTAL</th>";

        echo "</tr>";

        while ($inv_row = $inv_stmt->fetch()) {

            echo "<tr>";
            echo '<td>' . $inv_row->art_id . '</td>';
            echo '<td>' . $inv_row->art_nombre . '</td>';
            echo '<td>' . $inv_row->art_descripcion . '</td>';
            echo '<td>' . $inv_row->ven_fecha . '</td>';
            echo '<td>' . $inv_row->detven_cantidad . '</td>';
            echo '<td>' . $inv_row->detven_precio . '</td>';
            echo '<td>' . $inv_row->detven_cantidad * $inv_row->detven_precio . '</td>';

            echo "</tr>";
        }

        echo "</table>";
    }

    public function DatosClientes($inv_documento)
    {
        $inv_sql = "SELECT  `emp_ruc`, `emp_nombre`, `emp_direccion`, `emp_calle_principal`, `emp_calle_secundaria`, `emp_numero_oficina`, `emp_provincia`, `emp_canton`, `emp_parroquia`, `emp_referencia_oficina`, `emp_correo`, `emp_telefono`, `emp_logo`, `emp_estado`, `idtiposervicio` from tbl_empresas
            WHERE `emp_ruc`=? GROUP BY `emp_ruc`";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $inv_documento);
        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        $inv_stmt->execute();
        while ($inv_row = $inv_stmt->fetch()) {
            echo ' <div style = "width:50%" > ';

            echo ' <br>  <label style ="font-weight: bolder;font-size:15px"> Nombre de Empresa: </label> ';
            echo $inv_row->emp_nombre;
            echo ' <br>  <label style ="font-weight: bolder;font-size:15px"> Direccion: </label> ';
            echo $inv_row->emp_direccion;
            echo ' <br>  <label style ="font-weight: bolder;font-size:15px"> Calle Principal oficina: </label> ';
            echo $inv_row->emp_calle_principal;
            echo ' <br>  <label style ="font-weight: bolder;font-size:15px"> Calle Secuandaria oficina: </label> ';
            echo $inv_row->emp_calle_secundaria;
            echo ' <br>  <label style ="font-weight: bolder;font-size:15px"> Numero  oficina: </label> ';
            echo $inv_row->emp_numero_oficina;
            echo ' <br>  <label style ="font-weight: bolder;font-size:15px"> Provincia: </label> ';
            echo $inv_row->emp_provincia;

            echo "</div>";
            echo ' <div style   ="width:50%" > ';

            echo ' <br>  <label style ="font-weight: bolder;font-size:15px"> Canton: </label> ';
            echo $inv_row->emp_canton;
            echo ' <br>  <label style ="font-weight: bolder;font-size:15px"> Parroquia: </label> ';
            echo $inv_row->emp_parroquia;
            echo ' <br>  <label style ="font-weight: bolder;font-size:15px"> Referencia oficina: </label> ';
            echo $inv_row->emp_referencia_oficina;
            echo ' <br><label style ="font-weight: bolder;font-size:15px" > Correo: </label> ';
            echo $inv_row->emp_correo;
            echo ' <br>  <label style = "font-weight: bolder;font-size:15px"> Telefono: </label> ';
            echo $inv_row->emp_telefono;
            echo ' <br>  <label style ="font-weight: bolder;font-size:15px"> logo: </label> ';
            echo '<img width="70" height="70" src=../' . $inv_row->emp_logo . '>';

            echo "</div>";
        }
    }

    public function DatosSucursal($sucursal)
    {
        $inv_sql = "SELECT e.*,s.* FROM tbl_empresas e, tbl_sucursal s
WHERE e.emp_id=s.idempresa AND e.emp_id=? ORDER BY e.emp_id LIMIT 1";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $sucursal);
        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        $inv_stmt->execute();

        echo "<table class=table table-responsive>";
        echo "<tr>";
        echo "<th>CODIGO</th>";
        echo "<th>NOMBRE</th>";
        echo "<th>PROVINCIA</th>";
        echo "<th>DIRECCION</th>";
        echo "<th>CALLE</th>";
        echo "<th>CORREO</th>";
        echo "<th>TELEFONO</th>";


        echo "</tr>";

        while ($inv_row = $inv_stmt->fetch()) {

            echo "<tr>";
            echo '<td>' . $inv_row->emp_id . '</td>';
            echo '<td>' . $inv_row->emp_nombre . '</td>';
            echo '<td>' . $inv_row->emp_provincia . '</td>';
            echo '<td>' . $inv_row->emp_direccion . '</td>';
            echo '<td>' . $inv_row->emp_calle_principal . '</td>';
            echo '<td>' . $inv_row->emp_correo . '</td>';
            echo '<td>' . $inv_row->emp_telefono . '</td>';

            echo "</tr>";
        }

        echo "</table>";
    }



    public function DatosSucursalSecundaria($idempresa)
    {
        $sql = "SELECT emp.* ,suc.* from tbl_empresas emp,tbl_sucursal suc WHERE emp.emp_id=suc.idempresa AND emp.emp_id=? AND suc.numest_suc<>001 ";
        $stmt = $this->inv_dbh->prepare($sql);
        $stmt->bindParam(1, $idempresa);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        echo "<table class=table table-responsive>";
        echo "<tr>";
        echo "<th>CODIGO</th>";
        echo "<th>NOMBRE</th>";
        echo "<th>PROVINCIA</th>";
        echo "<th>DIRECCION</th>";
        echo "<th>CALLE</th>";
        echo "<th>CORREO</th>";
        echo "<th>TELEFONO</th>";

        echo "</tr>";

        while ($inv_row = $stmt->fetch()) {

            echo "<tr>";
            echo '<td>' . $inv_row->codigo_suc . '</td>';
            echo '<td>' . $inv_row->nombre_suc . '</td>';
            echo '<td>' . $inv_row->emp_provincia . '</td>';
            echo '<td>' . $inv_row->direcc_suc . '</td>';
            echo '<td>' . $inv_row->emp_calle_principal . '</td>';
            echo '<td>' . $inv_row->emp_correo . '</td>';
            echo '<td>' . $inv_row->telefo_suc . '</td>';

            echo "</tr>";
        }

        echo "</table>";
    }

    public function NuevoNumero()
    {
        $numero_venta = '0000';

        $sql = "SELECT MAX(emp_id) AS numero FROM tbl_empresas ";
        $ps  = $this->inv_dbh->prepare($sql);
        $ps->execute();

        while ($rs = $ps->fetch()) {

            if ($rs['numero'] != null) {

                $numero_venta = $rs['numero'];
            }
        }

        return $numero_venta;
    }

    public function Registrar($datos)
    {
        if (self::VerificarUsuario($datos) > 0) {
            echo 2;
        } else if (self::VerificarCorreo($datos) > 0) {
            echo 3;
        } else {
            echo self::VerificarRegistro($datos);
        }
    }

    public function VerificarUsuario($datos)
    {

        $inv_sql  = "SELECT emp_nombre FROM tbl_empresas WHERE emp_nombre=? ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $datos[0]);
        $inv_stmt->execute();
        $datos = $inv_stmt->rowCount();
        return $datos;
    }

    public function VerificarDuplicadoRuc($ruc)
    {

        $sql      = "SELECT emp_ruc from tbl_empresas where emp_ruc=?";
        $inv_stmt = $this->inv_dbh->prepare($sql);
        $inv_stmt->bindParam(1, $ruc);
        $inv_stmt->execute();

        if ($inv_stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function VerificarId($emp_id)
    {
        $inv_sql  = "SELECT emp_id from tbl_empresas WHERE emp_id=?";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $emp_id);
        $inv_stmt->execute();
        if ($inv_stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function VerificarRegistro($datos)
    {
        try {

            $inv_sql  = "INSERT INTO `tbl_empresas`(`emp_id`, `emp_ruc`, `emp_nombre`, `emp_direccion`, `emp_calle_principal`, `emp_calle_secundaria`, `emp_numero_oficina`, `emp_provincia`, `emp_canton`, `emp_parroquia`, `emp_referencia_oficina`, `emp_correo`, `emp_telefono`, `emp_logo`, `emp_estado`, `idtiposervicio`, `emp_certificado_digital`, `emp_contrasenia_certificado`, `emp_tipo_ambiente`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $inv_stmt = $this->inv_dbh->prepare($inv_sql);
            $inv_stmt->bindParam(1, $datos[0]);
            $inv_stmt->bindParam(2, $datos[1]);
            $inv_stmt->bindParam(3, $datos[2]);
            $inv_stmt->bindParam(4, $datos[3]);
            $inv_stmt->bindParam(5, $datos[10]);
            $inv_stmt->bindParam(6, $datos[11]);
            $inv_stmt->bindParam(7, $datos[12]);
            $inv_stmt->bindParam(8, $datos[7]);
            $inv_stmt->bindParam(9, $datos[8]);
            $inv_stmt->bindParam(10, $datos[9]);
            $inv_stmt->bindParam(11, $datos[13]);
            $inv_stmt->bindParam(12, $datos[4]);
            $inv_stmt->bindParam(13, $datos[5]);
            $inv_stmt->bindParam(14, $datos[6]);
            $inv_stmt->bindParam(15, $datos[14]);
            $inv_stmt->bindParam(16, $datos[15]);
            $inv_stmt->bindParam(17, $datos[25]);
            $inv_stmt->bindParam(18, $datos[26]);
            $inv_stmt->bindParam(19, $datos[27]);
            $inv_stmt->execute();
            echo 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function VerificarCorreo($datos)
    {

        $inv_sql  = "SELECT emp_correo FROM tbl_empresas WHERE emp_correo=? ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $datos[0]);
        $inv_stmt->execute();
        $datos = $inv_stmt->rowCount();
        return $datos;
    }

    public function Editar($datos)
    {
        try {

            $inv_sql  = "UPDATE `tbl_empresas` SET `emp_ruc`=?,`emp_nombre`=?,`emp_direccion`=?,`emp_calle_principal`=?,`emp_calle_secundaria`=?,`emp_numero_oficina`=?,`emp_provincia`=?,`emp_canton`=?,`emp_parroquia`=?,`emp_referencia_oficina`=?,`emp_correo`=?,`emp_telefono`=?,`emp_logo`=?,`idtiposervicio`=?,`emp_certificado_digital`=?,`emp_contrasenia_certificado`=?,`emp_tipo_ambiente`=? WHERE emp_id=?";
            $inv_stmt = $this->inv_dbh->prepare($inv_sql);

            $inv_stmt->bindParam(1, $datos[1]);
            $inv_stmt->bindParam(2, $datos[2]);
            $inv_stmt->bindParam(3, $datos[3]);
            $inv_stmt->bindParam(4, $datos[10]);
            $inv_stmt->bindParam(6, $datos[11]);
            $inv_stmt->bindParam(5, $datos[12]);
            $inv_stmt->bindParam(7, $datos[7]);
            $inv_stmt->bindParam(8, $datos[8]);
            $inv_stmt->bindParam(9, $datos[9]);
            $inv_stmt->bindParam(10, $datos[13]);
            $inv_stmt->bindParam(11, $datos[4]);
            $inv_stmt->bindParam(12, $datos[5]);
            $inv_stmt->bindParam(13, $datos[6]);
            $inv_stmt->bindParam(14, $datos[14]);
            $inv_stmt->bindParam(15, $datos[15]);
            $inv_stmt->bindParam(16, $datos[16]);
            $inv_stmt->bindParam(17, $datos[17]);
            $inv_stmt->bindParam(18, $datos[0]);

            $inv_stmt->execute();
            echo 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function Estadoempresa($inv_est, $inv_id)
    {
        try {

            $inv_sql  = "UPDATE `tbl_empresas` SET `emp_estado`=? where emp_id=? ";
            $inv_stmt = $this->inv_dbh->prepare($inv_sql);
            $inv_stmt->bindParam(1, $inv_est);
            $inv_stmt->bindParam(2, $inv_id);
            $inv_stmt->execute();
            echo 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function tipoempresa()
    {
        $sql  = "SELECT * FROM tbl_servicios   ";
        $stmt = $this->inv_dbh->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function tipoempresau()
    {
        $sql  = "SELECT * FROM tbl_servicios   ";
        $stmt = $this->inv_dbh->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function tipoambiente()
    {
        $inv_sql  = "SELECT * from tbl_tipoambiente";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->execute();
        $rs = $inv_stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }
    public function tipoambienteu()
    {
        $inv_sql  = "SELECT * from tbl_tipoambiente";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->execute();
        $rs = $inv_stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function Registrar_Usuario($datos)
    {

        $sql      = "INSERT INTO `tbl_usuarios`( `usu_primernombre`, `usu_segundonombre`, `usu_apellidopaterno`, `usu_apellidomaterno`, `usu_direccion`, `usu_celular`, `usu_correo`, `usu_usuario`, `usu_contrasenia`, `idempresa`) 
        VALUES(?,?,?,?,?,?,?,?,?,?)";
        $inv_stmt = $this->inv_dbh->prepare($sql);
        $inv_stmt->bindParam(1, $datos[16]);
        $inv_stmt->bindParam(2, $datos[17]);
        $inv_stmt->bindParam(3, $datos[18]);
        $inv_stmt->bindParam(4, $datos[19]);
        $inv_stmt->bindParam(5, $datos[20]);
        $inv_stmt->bindParam(6, $datos[21]);
        $inv_stmt->bindParam(7, $datos[22]);
        $inv_stmt->bindParam(8, $datos[23]);
        $inv_stmt->bindParam(9, $datos[24]);
        $inv_stmt->bindParam(10, $datos[0]);

        $inv_stmt->execute();
    }


    //ver informacion
    public function DatosMascota($inv_documento)
    {
        $inv_sql = "SELECT a.mas_codigo, a.mas_nombre as mascota, a.mas_sexo, a.mas_fecha, a.mas_color,a.mas_color_secundario, a.mas_esterilizado ,es.descripcion, a.mas_imagen,a.mas_codigo_qr,r.descripcion as idraza, a.idtenedor,t.ten_primer_nombre as tenedor,a.mas_codigo_qr
        FROM tbl_mascotas a, tbl_tenedores t, tipo_razas r,tbl_especies es
        WHERE a.idtenedor=t.ten_cedula
        AND a.idraza=r.id_mas
        AND es.id_especie=a.mas_tipo
        AND a.mas_codigo=? ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->bindParam(1, $inv_documento);
        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        $inv_stmt->execute();
        while ($inv_row = $inv_stmt->fetch()) {
            echo ' <div style = "width:50%" > ';

            echo ' <br>  <label style ="font-weight: bolder;font-size:15px"> Cédula Mascota: </label> ';
            echo $inv_row->mas_codigo;
            echo ' <br>  <label style ="font-weight: bolder;font-size:15px"> Nombre: </label> ';
            echo $inv_row->mascota;
            echo ' <br>  <label style ="font-weight: bolder;font-size:15px"> Sexo   </label> ';
            echo $inv_row->mas_sexo;
            echo ' <br>  <label style ="font-weight: bolder;font-size:15px"> Fecha Nacimiento: </label> ';
            echo $inv_row->mas_fecha;
            echo ' <br>  <label style ="font-weight: bolder;font-size:15px"> Color1: </label> ';
            echo $inv_row->mas_color;
            echo ' <br>  <label style ="font-weight: bolder;font-size:15px"> Color2: </label> ';
            echo $inv_row->mas_color_secundario;;

            echo "</div>";
            echo ' <div style   ="width:50%" > ';

            echo ' <br>  <label style ="font-weight: bolder;font-size:15px"> Esterelizado: </label> ';
            echo $inv_row->mas_esterilizado;
            echo ' <br>  <label style ="font-weight: bolder;font-size:15px"> Tipo </label> ';
            echo $inv_row->descripcion;
            echo ' <br>  <label style ="font-weight: bolder;font-size:15px"> Raza </label> ';
            echo $inv_row->idraza;
            echo ' <br>  <label style = "font-weight: bolder;font-size:15px"> Tenedor: </label> ';
            echo $inv_row->tenedor;
            echo ' <br>  <label style = "font-weight: bolder;font-size:15px"> Qr: </label> ';
            echo '<img width="70" height="70" src=' . $inv_row->mas_codigo_qr . '>';
            echo ' <br>  <label style ="font-weight: bolder;font-size:15px"> logo: </label> ';
            echo '<img width="70" height="70" src=' . $inv_row->mas_imagen . '>';

            echo "</div>";
        }
    }
}