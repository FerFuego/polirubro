<?php
/**
 * Usuarios class
 */
class Usuarios {

    public $Id_Cliente;
    public $Nombre;
    public $Localidad;
    public $Mail;
    public $Usuario;
    private $Password;
    public $ListaPrecioDef;
    protected $obj;

    public function __construct($id=0) {

        if ($id != 0) {
            
            $this->obj = new sQuery();
            $result = $this->obj->executeQuery("SELECT * FROM clientes WHERE Id_Cliente = '$id'");
            $row = mysqli_fetch_assoc($result);

            $this->Id_Cliente = $row['Id_Cliente'];
            $this->Nombre = $row['Nombre'];
            $this->Localidad = $row['Localidad'];
            $this->Mail = $row['Mail'];
            $this->Usuario = $row['Usuario'];
            $this->Password = $row['Password'];
            $this->ListaPrecioDef = $row['ListaPrecioDef'];
        }
    }

    public function getID(){ return $this->Id_Cliente; }
    public function getNombre(){ return $this->Nombre; }
    public function getLocalidad(){ return $this->Localidad; }
    public function getMail(){ return $this->Mail; }
    public function getUsuario(){ return $this->Usuario; }
    public function getPassword(){ return $this->Password; }
    public function getListaPrecioDef(){ return $this->ListaPrecioDef; }

    public function getUsuarios(){
        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("SELECT * FROM clientes ORDER BY Nombre");
        return $result;
    }

    public function closeConnection(){
        $this->obj->Clean();
		$this->obj->Close();
	} 

}