<?php
session_start();
require_once 'config.php';
class sucursal extends config
{

    private $inv_dbh;
    public function __construct()
    {
        $this->inv_dbh = config::Abrir();
    }

    public function Listar()
    {
        $inv_sql  = "SELECT `codigo_suc`, `nombre_suc`, `direcc_suc`, `telefo_suc`, `numest_suc`, `numfact_suc`, `estado_suc`, `idempresa` FROM `tbl_sucursal`  ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        $inv_stmt->execute();
        while ($inv_row = $inv_stmt->fetch()) {
            $data = $inv_row->codigo_suc . '||' . $inv_row->nombre_suc . '||' . $inv_row->direcc_suc . '||' . $inv_row->telefo_suc . '||' . $inv_row->numest_suc . '||' . $inv_row->numfact_suc . '||' . $inv_row->estado_suc . '||' . $inv_row->idempresa;
            echo '<tr>';
            echo '<td>' . $inv_row->codigo_suc . '</td>';
            echo '<td>' . $inv_row->nombre_suc . '</td>';
            echo '<td>' . $inv_row->direcc_suc . '</td>';
            echo '<td>' . $inv_row->telefo_suc . '</td>';
            echo '<td>' . $inv_row->numest_suc . '</td>';
            echo '<td>' . $inv_row->numfact_suc . '</td>';
            echo '<td>' . $inv_row->estado_suc . '</td>';
            echo '<td>' . $inv_row->idempresa . '</td>';

            echo '<td>
            <div class="hidden-sm hidden-md action-buttons">
                             
            <a data-toggle="modal" data-target="#n-usuariou" onclick="capturaremp(\'' . $data . '\')">
            <i class="ace-icon fa fa-pencil bigger-130"></i> </a>
              
            <a class="green" data-toggle="modal" data-target="#mVerEmpresa" onclick="detallar(\'' . $inv_row->codigo_suc . '\')">
            <i class="ace-icon fa fa-print bigger-130"></i></a>
                
             </div>	
                  </td>';
            echo '</tr>';
        }
    }

    public function NuevoNumero()
    {
        $inv_cod  = '00000';
        $inv_sql  = "SELECT COUNT(*) FROM tbl_sucursal";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->execute();
        if ($inv_stmt->rowCount() > 0) {
            while ($inv_row = $inv_stmt->fetch()) {
                $inv_contrato = $inv_row[0];
            }
            //$inv_numero=substr($inv_contrato, 4,1);
            $inv_numero          = $inv_contrato + 1;
            $inv_numero_contrato = $inv_cod . $inv_numero;
        } else {

            $inv_numero_contrato = $inv_cod . '1';
        }
        return $inv_numero_contrato;
    }

    public function listadoempresas()
    {
        $inv_sql  = "SELECT * from tbl_empresas ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->execute();
        $rs = $inv_stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function listadoempresasu()
    {
        $inv_sql  = "SELECT * from tbl_empresas ";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->execute();
        $rs = $inv_stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function InsertarSucursal($datos)
    {

        try {

            $inv_sql  = "INSERT INTO `tbl_sucursal`(`codigo_suc`, `nombre_suc`, `direcc_suc`, `telefo_suc`, `numest_suc`, `numfact_suc`, `estado_suc`, `idempresa`) VALUES (?,?,?,?,?,?,?,?)";
            $inv_stmt = $this->inv_dbh->prepare($inv_sql);
            $inv_stmt->bindParam(1, $datos[0]);
            $inv_stmt->bindParam(2, $datos[1]);
            $inv_stmt->bindParam(3, $datos[2]);
            $inv_stmt->bindParam(4, $datos[3]);
            $inv_stmt->bindParam(5, $datos[4]);
            $inv_stmt->bindParam(6, $datos[5]);
            $inv_stmt->bindParam(7, $datos[6]);
            $inv_stmt->bindParam(8, $datos[7]);

            $inv_stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function ActualizarSucursal($datos)
    {

        try {

            $inv_sql  = "UPDATE `tbl_sucursal` SET `nombre_suc`=?,`direcc_suc`=?,`telefo_suc`=?,`numest_suc`=?,`numfact_suc`=?,`estado_suc`=?,`idempresa`=? WHERE codigo_suc=?";
            $inv_stmt = $this->inv_dbh->prepare($inv_sql);
            $inv_stmt->bindParam(1, $datos[0]);
            $inv_stmt->bindParam(2, $datos[1]);
            $inv_stmt->bindParam(3, $datos[2]);
            $inv_stmt->bindParam(4, $datos[3]);
            $inv_stmt->bindParam(5, $datos[4]);
            $inv_stmt->bindParam(6, $datos[5]);
            $inv_stmt->bindParam(7, $datos[6]);
            $inv_stmt->bindParam(8, $datos[7]);

            $inv_stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
} //fin de clase