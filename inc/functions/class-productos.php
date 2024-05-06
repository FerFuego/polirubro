<?php
/**
 * Productos class
 */
class Productos {

    public $id_producto;
    public $cod_producto;
    public $nombre;
    public $id_marca;
    public $marca;
    public $id_rubro;
    public $rubro;
    public $id_subrubro;
    public $subrubro;
    public $id_grupo;
    public $grupo;
    public $precio_venta_neto_1;
    public $precio_venta_final_1;
    public $precio_venta_neto_2;
    public $precio_venta_final_2;
    public $precio_venta_neto_3;
    public $precio_venta_final_3;
    public $fecha_alta;
    public $fecha_alta_web;
    public $novedad;
    public $oferta;
    public $observaciones;
    protected $obj;

    public function __construct($id=0) {

        if ($id != 0) {
            
            $this->obj = new sQuery();
            $result = $this->obj->executeQuery("SELECT * FROM productos WHERE CodProducto='$id'");
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
    public function getCode(){ return $this->cod_producto; }
    public function getRubroID(){ return $this->id_rubro; }
    public function getSubRubroID(){ return $this->id_subrubro; }
    public function getGrupoID(){ return $this->id_grupo; }
    public function getNombre(){ return $this->nombre; }
    
    public static function PreVtaFinal($precio){ 
        $config  = new Configuracion();
        $aumento = $config->getAumento();
        
        
        // Usuario logueado
        if (isset($_SESSION["user"])) {
            return $precio;
        } 
        
        // Usuario no logueado o tipo 2
        if ($aumento) {
            // aumento %
            return $precio + ($precio * ($aumento / 100));
        }

        return $precio; 
    }
    public function PreVtaFinal1(){ 
        $precio  = 0;
        $config  = new Configuracion();
        $aumento = $config->getAumento();
        
        // Usuario logueado
        if (isset($_SESSION["user"])) {
            return $this->precio_venta_final_1;
        } 
        
        // Usuario no logueado o tipo 2
        if ($aumento) {
            // aumento %
            return $this->precio_venta_final_1 + ($this->precio_venta_final_1 * ($aumento / 100));
        }

        return $precio; 
    }

    public function getProducts($opcion, $id_rubro, $id_subrubro, $id_grupo, $minamount, $maxamount, $order){

        $where = '1=1';
        $where .= ( $id_rubro ) ? ' AND Id_Rubro='. $id_rubro : '';
        $where .= ( $id_subrubro ) ? ' AND Id_SubRubro='. $id_subrubro : '';
        $where .= ( $id_grupo ) ? ' AND Id_Grupo='. $id_grupo : '';
        $where .= ( $minamount && $maxamount ) ? ' AND PreVtaFinal1 BETWEEN '.$minamount.' AND '.$maxamount : '';
        $orderBy = ( $order ) ? ' ORDER BY PreVtaFinal1 '.$order : ' ORDER BY Nombre';

        $query = "SELECT * FROM productos WHERE $where $orderBy";

        $this->obj = new sQuery();
        $this->obj->executeQuery($query);

        $result = [
            'total' => $this->obj->getResultados(),
            'query' => $query,
            'params' => ($opcion ? 'opcion='. $opcion .'&' : null).'id_rubro='.$id_rubro.'&id_subrubro='.$id_subrubro.'&id_grupo='.$id_grupo. (($minamount && $maxamount) ? '&minamount='.$minamount.'&maxamount='.$maxamount : '') . (($order) ? '&order='.$order : '')
        ];

        return $result;
    }

    public function getCountProducts(){
        $this->obj = new sQuery();
        $this->obj->executeQuery("SELECT * FROM productos");
        return $this->obj->getResultados();
    }

    public static function getImage($CodProducto) {

        if (file_exists("./fotos/".$CodProducto.".JPG")) {
            $img = "./fotos/".$CodProducto.".JPG";
        } elseif (file_exists("./fotos/".$CodProducto.".jpg")) {
            $img = "./fotos/".$CodProducto.".jpg";
        } else {
            $img = "img/sin-imagen.jpg";
        }
        
        return $img;
    }

    public function getProductSearch($opcion, $search) {

        $query = "SELECT * FROM productos WHERE Nombre LIKE '%$search%' OR CodProducto LIKE '%$search%'";

        $this->obj = new sQuery();
        $result = $this->obj->executeQuery($query);

        $result = [
            'total' => $this->obj->getResultados(),
            'query' => $query,
            'params' => ($opcion ? 'opcion='. $opcion .'&' : null).'s='.$search
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

    public function getProductsOffertNews(){

        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("SELECT * FROM productos WHERE Oferta = 1 OR Novedad = 1 ORDER BY RAND() LIMIT 8");

        return $result;
    }

    public function getRelatedProducts($id_rubro, $id_subrubro, $id_grupo, $id_producto){

        $where = '1=1';
        $where .= ( $id_rubro ) ? ' AND Id_Rubro='. $id_rubro : '';
        $where .= ( $id_subrubro ) ? ' AND Id_SubRubro='. $id_subrubro : '';
        $where .= ( $id_grupo ) ? ' AND Id_Grupo='. $id_grupo : '';

        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("SELECT * FROM productos WHERE $where AND Id_Producto NOT IN ($id_producto) ORDER BY Nombre Limit 4");

        return $result;
    }

    public function getResultados() {
        $this->obj->getResults();
    }

    public function importProducts($sql) {
        try {
            $this->obj = new sQuery();
            //$this->obj->executeQuery("TRUNCATE TABLE productos");
            $this->obj->executeQuery("DELETE FROM `productos` WHERE 1;");
            $this->obj->executeQuery($sql);
            return $this->obj->getResultados();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update() {
        $this->obj = new sQuery();
        $this->obj->executeQuery("UPDATE productos SET Nombre = '$this->nombre', Novedad = '$this->novedad', Oferta = '$this->oferta', Observaciones = '$this->observaciones' WHERE (CodProducto = '$this->cod_producto')");
    }

    public function delete() {
        $this->obj = new sQuery();
        $this->obj->executeQuery("DELETE FROM productos WHERE (CodProducto = '$this->cod_producto')");
    }

    public function closeConnection(){
        @$this->obj->Clean();
		$this->obj->Close();
	} 

}