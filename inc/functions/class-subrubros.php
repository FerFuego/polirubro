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

    public function __construct($id=0) {

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

    public function getID(){ return $this->id_subrubro; }
    public function getRubroID(){ return $this->id_rubro; }
    public function getNombre(){ return $this->nombre; }
    public function getBorra(){ return $this->no_borra; }

    public function getSubRubros(){
        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("SELECT * FROM subrubros ORDER BY Nombre");
        return $result;
    }

    public function getSubRubroByIdRubro($id_rubro){
        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("SELECT * FROM subrubros WHERE Id_Rubro = '$id_rubro' ORDER BY Nombre");
        return $result;
    }

    public function getSubRubroByIdGrupo($id_grupo){
        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("SELECT * FROM subrubros WHERE Id_Grupo = '$id_grupo' ORDER BY Nombre");
        return $result;
    }

    public function closeConnection(){
        $this->obj->Clean();
		$this->obj->Close();
	} 

}