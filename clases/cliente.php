<?php
require_once 'config.php';
class cliente extends config
{

    private $inv_dbh;
    public function __construct()
    {
        $this->inv_dbh = config::Abrir();
    }

    public function search_cliente($cedula)
    {
        $res  = false;
        $sql  = "SELECT * FROM tbl_clientes WHERE cli_rucci = :cedula";
        $stmt = $this->inv_dbh->prepare($sql);
        $stmt->execute(["cedula" => $cedula]);
        if ($stmt->rowCount() > 0) {
            $res = true;
        }

        return $res;

    }

    public function get_cliente($cedula)
    {
        $sql  = "SELECT * FROM tbl_clientes WHERE cli_rucci = :cedula";
        $stmt = $this->inv_dbh->prepare($sql);
        $stmt->execute(["cedula" => $cedula]);
        $cliente = new stdClass();
        while ($row = $stmt->fetch()) {
            $cliente->razon     = $row['cli_nombre'] . " " . $row['cli_apellido'];
            $cliente->telefono  = $row['cli_celular'];
            $cliente->correo    = $row['cli_correo'];
            $cliente->direccion = $row['cli_direccion'];
        }

        return $cliente;

    }

    public function Listar()
    {
        $inv_sql = "SELECT cedulac , nombre,apellidos, correo,celular
		            FROM cliente";
        $inv_stmt = $this->inv_dbh->prepare($inv_sql);
        $inv_stmt->setFetchMode(PDO::FETCH_OBJ);
        $inv_stmt->execute();
        while ($inv_row = $inv_stmt->fetch()) {
            $data = $inv_row->cedulac . "||" . $inv_row->nombre . "||" . $inv_row->apellidos . "||" . $inv_row->correo . "||" . $inv_row->celular;
            echo '<tr>';
            echo '<td>' . $inv_row->cedulac . '</td>';
            echo '<td>' . $inv_row->nombre . '</td>';
            echo '<td>' . $inv_row->apellidos . '</td>';
            echo '<td>' . $inv_row->correo . '</td>';
            echo '<td>' . $inv_row->celular . '</td>';
            echo '<td>
			         <div class="btn-group pull-left">
		    		    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-espanded="false">
		    		        <i class="fa fa-cog"></i> Acciones <span class="caret"></span>
		    	        </button>
		    	        <ul class="dropdown-menu">
		    		        <li>
		    			        <a data-toggle="modal" data-target="#m-articulo" onclick="capturar(\'' . $data . '\')">Editar <i class="fa fa-edit"></i></a>
		    		        </li>
		    	        </ul>
		             </div>
			      </td>';
            echo '</tr>';

        }

    }

    public function Editar($datos)
    {
        $sql = "UPDATE cliente SET nombre=?,apellidos=?,correo=?,celular=?
		WHERE cedulac=?";
        $ps = $this->inv_dbh->prepare($sql);
        $ps->bindParam(1, $datos[0]);
        $ps->bindParam(2, $datos[1]);
        $ps->bindParam(3, $datos[2]);
        $ps->bindParam(4, $datos[3]);
        $ps->bindParam(5, $datos[4]);
        $ps->execute();
    }

}
