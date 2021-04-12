<?php
/**
 * Rubros class
 */
class Rubros {
    
    public $id_rubro;
    public $nombre;
    public $no_borra;
    protected $obj;

    public function __construct($id=0) {

        if ($id != 0) {
            
            $this->obj = new sQuery();
            $result = $this->obj->executeQuery("SELECT * FROM rubros WHERE Id_Rubro = '$id' ORDER BY Nombre");
            $row = mysqli_fetch_assoc($result);
    
            $this->id_rubro = $row['Id_Rubro'];
            $this->nombre   = $row['Nombre'];
            $this->no_borra = $row['NoBorra'];
        }
    }

    public function getID(){ return $this->id_rubro; }
    public function getNombre(){ return $this->nombre; }
    public function getBorra(){ return $this->no_borra; }

    public function getRubros(){
        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("SELECT * FROM rubros ORDER BY Nombre");
        return $result;
    }

    public function getGrupos($id_subrubro){
        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("SELECT * FROM grupos Id_SubRubro = '$id_subrubro' ORDER BY Nombre");
        return $result;
    }

    public function closeConnection(){
        $this->obj->Clean();
		$this->obj->Close();
	} 

}