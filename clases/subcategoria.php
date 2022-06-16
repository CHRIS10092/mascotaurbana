<?php 
require_once'config.php';
class subcategoria extends config{

	private $inv_dbh;
	function __construct(){
		$this->inv_dbh=config::Abrir();
	}

	public function Registrar($inv_datos){
		if(self::VerificarSubcategoria($inv_datos)>0){
			echo 2;
		}else{
			echo self::VerificarRegistro($inv_datos);
		}
	}


	public function VerificarRegistro($inv_datos){
		try {

			$inv_sql="INSERT INTO inv_tblsubcategoria(subcategoria,idcategoria)VALUES(?,?)";
			$inv_stmt=$this->inv_dbh->prepare($inv_sql);
			$inv_stmt->bindParam(1,$inv_datos[0]);
			$inv_stmt->bindParam(2,$inv_datos[1]);
			$inv_stmt->execute();
			echo 1;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		
	}

	private function VerificarSubcategoria($inv_datos){

			$inv_sql="SELECT subcategoria FROM inv_tblsubcategoria WHERE subcategoria=? ";
			$inv_stmt=$this->inv_dbh->prepare($inv_sql);
			$inv_stmt->bindParam(1,$inv_datos[0]);
			$inv_stmt->execute();
			$inv_datos=$inv_stmt->rowCount();
			return $inv_datos;
	}

	public function ListarCategorias(){
		$inv_sql="SELECT * FROM inv_tblcategoria";
		$inv_stmt=$this->inv_dbh->prepare($inv_sql);
		$inv_stmt->setFetchMode(PDO::FETCH_OBJ);
		$inv_stmt->execute();
		while($inv_row=$inv_stmt->fetch()){
			echo '<option value="'.$inv_row->id.'" >'.$inv_row->categoria.'</option>';
		}
	}

	public function Listar(){
		$inv_sql="SELECT s.id,subcategoria,c.categoria AS categoria,idcategoria 
		            FROM inv_tblsubcategoria s,inv_tblcategoria c 
		            WHERE c.id=s.idcategoria";
		$inv_stmt=$this->inv_dbh->prepare($inv_sql);
		$inv_stmt->setFetchMode(PDO::FETCH_OBJ);
		$inv_stmt->execute();
		while($inv_row=$inv_stmt->fetch()){
			$data=$inv_row->id.'||'.$inv_row->idcategoria.'||'.$inv_row->subcategoria;
			echo '<tr>';
			echo '<td>'.$inv_row->subcategoria.'</td>';
			echo '<td>'.$inv_row->categoria.'</td>';
			echo '<td>
			         <div class="btn-group pull-left">
		    		    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-espanded="false">   
		    		        <i class="fa fa-cog"></i> Acciones <span class="caret"></span>
		    	        </button>
		    	        <ul class="dropdown-menu">
		    		        <li>
		    			        <a data-toggle="modal" data-target="#n-subcategoriau" onclick="capturar(\''.$data.'\')">Editar <i class="fa fa-edit"></i></a>
		    		        </li>
		    		        <li>
		    			        <a onclick="preguntar('.$inv_row->id.')">Eliminar <i class="fa fa-trash"></i></a>
		    		        </li>
		    	        </ul>
		             </div>
			      </td>';
			echo '</tr>';

		}

	}

	public function Editar($inv_datos){
		try {

			$inv_sql="UPDATE inv_tblsubcategoria SET subcategoria=?,idcategoria=? WHERE id=?";
			$inv_stmt=$this->inv_dbh->prepare($inv_sql);
			$inv_stmt->bindParam(1,$inv_datos[0]);
			$inv_stmt->bindParam(2,$inv_datos[1]);
			$inv_stmt->bindParam(3,$inv_datos[2]);
			$inv_stmt->execute();
			echo 1;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		
	}


	public function Eliminar($inv_id){
		try {

			$inv_sql="DELETE FROM inv_tblsubcategoria WHERE id=?";
			$inv_stmt=$this->inv_dbh->prepare($inv_sql);
			$inv_stmt->bindParam(1,$inv_id);
			$inv_stmt->execute();
			echo 1;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		
	}



}

?>