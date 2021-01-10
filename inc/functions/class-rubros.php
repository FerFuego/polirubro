<?php
/**
 * Rubros class
 */
class Rubros {
    var $id_rubro;
    var $nombre;
    var $no_borra;
    var $obj;

    function __construct($id=0) {

        if ($id != 0) {
            
            $this->obj = new sQuery();
            $result = $this->obj->executeQuery("SELECT * FROM rubros WHERE Id_Rubro='$id' ORDER BY Nombre");
            $row = mysqli_fetch_assoc($result);
    
            $this->id_rubro = $row['Id_Rubro'];
            $this->nombre   = $row['Nombre'];
            $this->no_borra = $row['NoBorra'];
        }
    }

    function getID(){ return $this->id_rubro; }
    function getNombre(){ return $this->nombre; }
    function getBorra(){ return $this->no_borra; }

    function getRubros(){
        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("SELECT * FROM rubros ORDER BY Nombre");
        return $result;
    }

    function getTreeRubros(){

        $rubros = [];
        $subrubros = [];

        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("SELECT r.Id_Rubro, r.Nombre as 'Rubro', r.NoBorra, Id_SubRubro, s.Nombre as 'SubRubro', s.NoBorra FROM `rubros` as r, `subrubros` as s WHERE r.Id_Rubro = s.Id_Rubro ORDER BY r.Nombre");

        while( $row = mysqli_fetch_array($result) ) :

            $rubros[] = [ 
                'id' => $row['Id_Rubro'], 
                'rubro' => $row['Rubro'] 
            ];

            $subrubros[] = [ 
                'id' => $row['Id_SubRubro'],
                'rubro' => $row['Id_Rubro'],
                'subrubro' => $row['SubRubro'] 
            ];

        endwhile; 

        $result = [
            'rubros'    => @array_unique( $rubros, SORT_REGULAR),
            'subrubros' => @array_unique( $subrubros, SORT_REGULAR),
        ];

        return $result;
    }

    function closeConnection(){
        $this->obj->Clean();
		$this->obj->Close();
	} 

} 