<?php
/**
 * Login class
 */
class Login{
	
	private $user;
	private $pass;

	public function __construct( $username, $password ) {
		$obj = new Connection();
		$conn = $obj->getConnection();
		$this->user = mysqli_escape_string($conn, addslashes($username));
		$this->pass = mysqli_escape_string($conn, addslashes($password));
    }
    
	public function loginProcess() {

		$obj = new sQuery();
		$result = $obj->executeQuery("SELECT * FROM clientes WHERE Usuario = '$this->user' AND Password = md5('$this->pass') LIMIT 1");

		return $result;
	}
}
?>