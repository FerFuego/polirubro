<?php
/**
 * Pedidos class
 */
class Pedidos {
    
    var $Id_Pedido;
    var $Id_Cliente;
    var $Nombre;
    var $Localidad;
    var $Mail;
    var $Usuario;
    var $FechaIni;
    var $FechaFin;
    var $ImpTotal;
    var $Cerrado;
    var $IP;
    var $obj;

    public function __construct($id=0) {

        if ($id != 0) {
            
            $this->obj = new sQuery();
            $result = $this->obj->executeQuery("SELECT * FROM pedidos_cabe WHERE Id_Pedido = '$id'");
            $row = mysqli_fetch_assoc($result);

            $this->Id_Pedido = $row['Id_Pedido'];
            $this->Id_Cliente = $row['Id_Cliente'];
            $this->Nombre = $row['Nombre'];
            $this->Localidad = $row['Localidad'];
            $this->Mail = $row['Mail'];
            $this->Usuario = $row['Usuario'];
            $this->FechaIni = $row['FechaIni'];
            $this->FechaFin = $row['FechaFin'];
            $this->ImpTotal = $row['ImpTotal'];
            $this->Cerrado = $row['Cerrado'];
            $this->IP = $row['IP'];
        }
    }

    public function getID(){ return $this->Id_Pedido; }
    public function getIDCliente(){ return $this->Id_Cliente; }
    public function getNombre(){ return $this->Nombre; }
    public function getLocalidad(){ return $this->Localidad; }
    public function getMail(){ return $this->Mail; }
    public function getUsuario(){ return $this->Usuario; }
    public function getFechaIni(){ return $this->FechaIni; }
    public function getFechaFin(){ return $this->FechaFin; }
    public function getImpTotal(){ return $this->ImpTotal; }
    public function getCerrado(){ return $this->Cerrado; }
    public function getIP(){ return $this->IP; }

    public function closeConnection(){
        $this->obj->Clean();
		$this->obj->Close();
	} 

}