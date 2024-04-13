<?php
/**
 * Connection class
 * crea la conexion a la base de datos
 */
class Connection {

    var $conn;
    
	function __construct() {

		if (str_replace('"', '', getenv('ENVIRONMENT')) == 'production') {
			$con['server'] = str_replace('"', '', getenv('SERVER'));
			$con['base'] = str_replace('"', '', getenv('BASE'));
			$con['user'] = str_replace('"', '', getenv('USER'));
			$con['pass'] = str_replace('"', '', getenv('PASS'));
		} else {
			$con['server'] = str_replace('"', '', getenv('LOCAL_SERVER'));
			$con['base'] = str_replace('"', '', getenv('LOCAL_BASE'));
			$con['user'] = str_replace('"', '', getenv('LOCAL_USER'));
			$con['pass'] = str_replace('"', '', getenv('LOCAL_PASS'));
		}

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