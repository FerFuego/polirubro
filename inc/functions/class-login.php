<?php
/**
 * Login class
 */
class Login{
	
	private $user;
	private $pass;

	public function __construct( $username, $password ) {
		$this->user = $username;
		$this->pass = $password;
    }
    
	public function loginProcess() {

		$obj = new sQuery();
		$result = $obj->executeQuery("SELECT * FROM clientes WHERE Usuario = '$this->user' AND Password = '$this->pass' LIMIT 1");

		return $result;
	}
}
?>