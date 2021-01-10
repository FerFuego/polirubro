<?php
/**
 * Subrubros class
 */
class Subrubros {
    var $id_subrubro;
    var $id_rubro;
    var $nombre;
    var $no_borra;
    var $obj;

    function __construct($id=0) {

        if ($id != 0) {
            
            $this->obj = new sQuery();
            $result = $this->obj->executeQuery("SELECT * FROM subrubros WHERE Id_SubRubro='$id' ORDER BY Nombre");
            $row = mysqli_fetch_assoc($result);
    
            $this->id_subrubro = $row['Id_SubRubro'];
            $this->id_rubro = $row['Id_Rubro'];
            $this->nombre   = $row['Nombre'];
            $this->no_borra = $row['NoBorra'];
        }
    }

    function getID(){ return $this->id_subrubro; }
    function getRubroID(){ return $this->id_rubro; }
    function getNombre(){ return $this->nombre; }
    function getBorra(){ return $this->no_borra; }

    function getSubRubros(){
        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("SELECT * FROM subrubros ORDER BY Nombre");
        return $result;
    }

    function closeConnection(){
        $this->obj->Clean();
		$this->obj->Close();
	} 

} 