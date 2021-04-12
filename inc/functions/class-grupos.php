<?php
/**
 * Grupos class
 */
class Grupos {
    
    public $id_subrubro;
    public $id_rubro;
    public $id_grupo;
    public $nombre;
    public $no_borra;
    protected $obj;

    public function __construct($id=0) {

        if ($id != 0) {
            
            $this->obj = new sQuery();
            $result = $this->obj->executeQuery("SELECT * FROM grupos WHERE Id_Grupo='$id' ORDER BY Nombre");
            $row = mysqli_fetch_assoc($result);
    
            $this->id_grupo = $row['Id_Grupo'];
            $this->id_rubro = $row['Id_Rubro'];
            $this->id_subrubro = $row['Id_SubRubro'];
            $this->nombre   = $row['Nombre'];
            $this->no_borra = $row['NoBorra'];
        }
    }

    public function closeConnection(){
        $this->obj->Clean();
		$this->obj->Close();
	} 

}