<?php
/**
 * Productos class
 */
class Productos {

    var $id_producto;
    var $cod_producto;
    var $nombre;
    var $id_marca;
    var $marca;
    var $id_rubro;
    var $rubro;
    var $id_subrubro;
    var $subrubro;
    var $id_grupo;
    var $grupo;
    var $precio_venta_neto_1;
    var $precio_venta_final_1;
    var $precio_venta_neto_2;
    var $precio_venta_final_2;
    var $precio_venta_neto_3;
    var $precio_venta_final_3;
    var $fecha_alta;
    var $fecha_alta_web;
    var $novedad;
    var $oferta;
    var $observaciones;
    var $obj;

    public function __construct($id=0) {

        if ($id != 0) {
            
            $this->obj = new sQuery();
            $result = $this->obj->executeQuery("SELECT * FROM productos WHERE Id_Producto='$id' ORDER BY Nombre");
            $row = mysqli_fetch_assoc($result);

            $this->id_producto = $row['Id_Producto'];
            $this->cod_producto = $row['CodProducto'];
            $this->nombre = $row['Nombre'];
            $this->id_marca = $row['Id_Marca'];
            $this->marca = $row['Marca'];
            $this->id_rubro = $row['Id_Rubro'];
            $this->rubro = $row['Rubro'];
            $this->id_subrubro = $row['Id_SubRubro'];
            $this->subrubro = $row['SubRubro'];
            $this->id_grupo = $row['Id_Grupo'];
            $this->grupo = $row['Grupo'];
            $this->precio_venta_neto_1 = $row['PreVtaNeto1'];
            $this->precio_venta_final_1 = $row['PreVtaFinal1'];
            $this->precio_venta_neto_2 = $row['PreVtaNeto2'];
            $this->precio_venta_final_2 = $row['PreVtaFinal2'];
            $this->precio_venta_neto_3 = $row['PreVtaNeto3'];
            $this->precio_venta_final_3 = $row['PreVtaFinal3'];
            $this->fecha_alta = $row['FecAlta'];
            $this->fecha_alta_web = $row['FecAltaWeb'];
            $this->novedad = $row['Novedad'];
            $this->oferta = $row['Oferta'];
            $this->observaciones = $row['Observaciones'];

        }
    }

    public function getID(){ return $this->id_producto; }
    public function getRubroID(){ return $this->id_rubro; }
    public function getSubRubroID(){ return $this->id_subrubro; }
    public function getGrupoID(){ return $this->id_grupo; }
    public function getNombre(){ return $this->nombre; }

    public function getProducts($id_rubro, $id_subrubro, $id_grupo){

        $where = '1=1';
        $where .= ( $id_rubro ) ? ' AND Id_Rubro='. $id_rubro : '';
        $where .= ( $id_subrubro ) ? ' AND Id_SubRubro='. $id_subrubro : '';
        $where .= ( $id_grupo ) ? ' AND Id_Grupo='. $id_grupo : '';

        $query = "SELECT * FROM productos WHERE $where ORDER BY Nombre";

        $this->obj = new sQuery();
        $this->obj->executeQuery($query);

        $result = [
            'total' => $this->obj->getResultados(),
            'query' => $query,
            'params' => 'id_rubro='.$id_rubro.'&id_subrubro='.$id_subrubro.'&id_grupo='.$id_grupo
        ];

        return $result;
    }

    public function getProductsOffert($id_rubro, $id_subrubro, $id_grupo){

        $where = 'Oferta = 1';
        $where .= ( $id_rubro ) ? ' AND Id_Rubro='. $id_rubro : '';
        $where .= ( $id_subrubro ) ? ' AND Id_SubRubro='. $id_subrubro : '';
        $where .= ( $id_grupo ) ? ' AND Id_Grupo='. $id_grupo : '';

        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("SELECT * FROM productos WHERE $where ORDER BY Nombre");

        return $result;
    }

    public function getProductNews($limit=10){

        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("SELECT * FROM productos WHERE Novedad = 1 ORDER BY Id_Producto DESC LIMIT $limit");

        return $result;
    }

    public function getResultados() {
        $this->obj->getResults();
    }

    public function closeConnection(){
        $this->obj->Clean();
		$this->obj->Close();
	} 

}