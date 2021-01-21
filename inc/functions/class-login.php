<?php
/**
 * Login class
 */
class Login{
	
	var $user;
	var $pass;

	function __construct( $username, $password ) {
		$this->user = $username;
		$this->pass = $password;
    }
    
	function loginDB() {
		$obj = new sQuery();
		$result = $obj->executeQuery("SELECT * FROM clientes WHERE Usuario = '$this->user' AND Password = '$this->pass'");
		return $result;
	}
}
?>