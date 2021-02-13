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
    public $is_Admin;
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
            $this->is_Admin = $row['is_admin'];
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

    public function is_Admin() {
        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("SELECT * FROM clientes WHERE Id_Cliente = $this->Id_Cliente AND is_admin = 1 LIMIT 1");

        return $this->obj->getResultados();
    }

    public function getUsersCpanel($opcion) {

        $query = "SELECT * FROM clientes ORDER BY Nombre";

        $this->obj = new sQuery();
        $this->obj->executeQuery($query);

        $result = [
            'total' => $this->obj->getResultados(),
            'query' => $query,
            'params' => 'opcion=' . $opcion
        ];

        return $result;
    }

    public function getUsersSearch($search) {

        $query = "SELECT * FROM clientes WHERE Nombre LIKE '%$search%' OR Id_Cliente LIKE '%$search%'";

        $this->obj = new sQuery();
        $result = $this->obj->executeQuery($query);

        $result = [
            'total' => $this->obj->getResultados(),
            'query' => $query,
            'params' => 's='.$search
        ];

        return $result;
    }

    public function closeConnection(){
        $this->obj->Clean();
		$this->obj->Close();
	} 

}