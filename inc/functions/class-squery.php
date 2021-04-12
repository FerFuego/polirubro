<?php 
/**
 * sQuery class
 * procesa las consultas a la base de datos
 */
class sQuery {
	
	protected $pconnection;
	protected $pquery;
	protected $results;

	// constructor, solo crea una conexion usando la clase "Conexion"
	function __construct() {
		$this->pconnection = new Connection();
	}

	// metodo que ejecuta una consulta y la guarda en el atributo $pquery
	function executeQuery($query) {
		
		$this->pquery = mysqli_query($this->pconnection->getConnection(), $query);

		if($this->pquery) return $this->pquery;

		return false;
	}

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