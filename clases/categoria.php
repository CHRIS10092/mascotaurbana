<?php
require_once 'config.php';
class categoria extends config
{

	private $inv_dbh;
	function __construct()
	{
		$this->inv_dbh = config::Abrir();
	}


	public function Registrar($inv_datos)
	{
		if (self::VerificarCategoria($inv_datos) > 0) {
			echo 2;
		} else {
			echo self::VerificarRegistro($inv_datos);
		}
	}


	public  function VerificarRegistro($inv_datos)
	{
		try {

			$inv_sql = "INSERT INTO inv_tblcategoria(categoria)VALUES(?)";
			$inv_stmt = $this->inv_dbh->prepare($inv_sql);
			$inv_stmt->bindParam(1, $inv_datos[0]);
			$inv_stmt->execute();
			echo 1;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	private  function VerificarCategoria($inv_datos)
	{

		$inv_sql = "SELECT categoria FROM inv_tblcategoria WHERE categoria=? ";
		$inv_stmt = $this->inv_dbh->prepare($inv_sql);
		$inv_stmt->bindParam(1, $inv_datos[0]);
		$inv_stmt->execute();
		$inv_datos = $inv_stmt->rowCount();
		return $inv_datos;
	}

	public function Listar()
	{
		$inv_sql = "SELECT * FROM inv_tblcategoria";
		$inv_stmt = $this->inv_dbh->prepare($inv_sql);
		$inv_stmt->setFetchMode(PDO::FETCH_OBJ);
		$inv_stmt->execute();
		while ($inv_row = $inv_stmt->fetch()) {
			$data = $inv_row->id . '||' . $inv_row->categoria;
			echo '<tr>';
			echo '<td>' . $inv_row->categoria . '</td>';
			echo '<td>
			         <div class="btn-group pull-left">
		    		    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-espanded="false">   
		    		        <i class="fa fa-cog"></i> Acciones <span class="caret"></span>
		    	        </button>
		    	        <ul class="dropdown-menu">
		    		        <li>
		    			        <a data-toggle="modal" data-target="#n-categoriau" onclick="capturar(\'' . $data . '\')">Editar <i class="fa fa-edit"></i></a>
		    		        </li>
		    		        <li>
		    			        <a onclick="preguntar(' . $inv_row->id . ')">Eliminar <i class="fa fa-trash"></i></a>
		    		        </li>
		    	        </ul>
		             </div>
			      </td>';
			echo '</tr>';
		}
	}

	public function Editar($inv_datos)
	{
		if(self::DatosrepetidosU($inv_datos)>0){
			echo 2;
		}else{
			echo self::EditarRegistro($inv_datos);
		}
	}
	public function EditarRegistro($inv_datos){
		try {

			$inv_sql = "UPDATE inv_tblcategoria SET categoria=? WHERE id=?";
			$inv_stmt = $this->inv_dbh->prepare($inv_sql);
			$inv_stmt->bindParam(1, $inv_datos[0]);
			$inv_stmt->bindParam(2, $inv_datos[1]);
			$inv_stmt->execute();
			echo 1;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	
	}

	public function	DatosrepetidosU($inv_datos){
		$sql="SELECT categoria FROM inv_tblcategoria where categoria=? ";
		$stml=$this->inv_dbh->prepare($sql);
		$stml->bindParam(1,$inv_datos[0]);
		$stml->execute();
		$inv_datos=$stml->rowCount();
		return $inv_datos;
	}

	public function Eliminar($inv_id)
	{
		try {

			$inv_sql = "DELETE FROM inv_tblcategoria  WHERE id=?";
			$inv_stmt = $this->inv_dbh->prepare($inv_sql);
			$inv_stmt->bindParam(1, $inv_id);
			$inv_stmt->execute();
			echo 1;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
}
