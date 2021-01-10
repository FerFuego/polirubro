<?php 
/**
 * sQuery class
 * procesa las consultas a la base de datos
 */
class sQuery { 
	var $pconnection;
	var $pquery;
	var $results;

	// constructor, solo crea una conexion usando la clase "Conexion"
	function __construct() {
		$this->pconnection = new Connection();
	}

	// metodo que ejecuta una consulta y la guarda en el atributo $pquery
	function executeQuery($consulta) {
		
		$this->pquery = mysqli_query($this->pconnection->getConnection(), $consulta);

		if($this->pquery){
			return $this->pquery;
		}else{
			return false;
		}
	}	

	// metodo que ejecuta una consulta y la guarda en el atributo $pquery
	function executeQueryArray($consulta) {

		$this->pquery = mysqli_query($this->pconnection->getConnection(),$consulta);

		if(stristr(substr($consulta,0,6),"SELECT")){
			if($this->pquery->num_rows > 0) {
				while ($row =$this->pquery->fetch_assoc()) {
					foreach($row as $k => $v) $row[$k]=str_replace("´","'",mb_detect_encoding($v,'UTF-8', true)?$v:utf8_encode($v));
					$array_result[]=$row;
				}
				return $array_result;
			}else{
				return false;
			}
		}

		if($this->pquery){
			return $this->pquery;
		}else{
			return false;
		}	
	}

	// retorna la consulta en forma de result.
	function getResults() {
		return $this->pquery;
	}	

	// cierra la conexion
	function Close() {
		$this->pconnection->Close();
	}	

	// libera la consulta
	function Clean() {
		mysqli_free_result($this->pquery);
	}

	// debuelve la cantidad de registros encontrados
	function getResultados() {
		return mysqli_affected_rows($this->pconnection->getConnection()) ;
	}

	// devuelve las cantidad de filas afectadas
	function getAffect() {
		return mysqli_affected_rows($this->pconnection->getConnection()) ;
	}

	// devuelve el id de la fila afectada
	function getIDAffect() {
	   return $this->pconnection->getConnection()->insert_id;
	}
}
?>