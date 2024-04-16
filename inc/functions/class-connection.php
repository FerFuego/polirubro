<?php
/**
 * Connection class
 * crea la conexion a la base de datos
 */
class Connection {

    var $conn;
    
	function __construct() {

		$con['server'] = getenv('SERVER');
		$con['base'] = getenv('BASE');
		$con['user'] = getenv('USER');
		$con['pass'] = getenv('PASS');

		$result = new mysqli($con['server'], $con['user'], $con['pass'], $con['base']);
        
        if ($result) {	
			$result->query("SET NAMES 'utf8'");		
			$this->conn = $result;
		}
	}

    // devuelve la conexion
    function getConnection() {
		return $this->conn;
    }
    
    // cierra la conexion
    function Close() {
		mysqli_close($this->conn);
	}	
}
?>