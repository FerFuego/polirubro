<?php
/**
 * Detalles class
 */
class Detalles {
    	
    var $Auto;
    var $Id_Pedido;
    var $Id_Producto;
    var $CodProducto;
    var $Nombre;
    var $PreVtaFinal1;
    var $Cantidad;
    var $ImpTotal;
    var $Notas;
    var $obj;

    public function __construct($id=0) {

        if ($id != 0) {
            
            $this->obj = new sQuery();
            $result = $this->obj->executeQuery("SELECT * FROM detalles WHERE Id_Pedido = '$id'");
            $row = mysqli_fetch_assoc($result);
    
            $this->Auto = $row['Auto'];
            $this->Id_Pedido = $row['Id_Pedido'];
            $this->Id_Producto = $row['Id_Producto'];
            $this->CodProducto = $row['CodProducto'];
            $this->Nombre = $row['Nombre'];
            $this->PreVtaFinal1 = $row['PreVtaFinal1'];
            $this->Cantidad = $row['Cantidad'];
            $this->ImpTotal = $row['ImpTotal'];
            $this->Notas = $row['Notas'];
        }
    }

    public function getAuto(){ return $this->Auto; }
    public function getId_Pedido(){ return $this->Id_Pedido; }
    public function getId_Producto(){ return $this->Id_Producto; }
    public function getCodProducto(){ return $this->CodProducto; }
    public function getNombre(){ return $this->Nombre; }
    public function getPreVtaFinal1(){ return $this->PreVtaFinal1; }
    public function getCantidad(){ return $this->Cantidad; }
    public function getImpTotal(){ return $this->ImpTotal; }
    public function getNotas(){ return $this->Notas; }

    public function closeConnection(){
        $this->obj->Clean();
		$this->obj->Close();
	} 

}