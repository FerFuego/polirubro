<?php
/**
 * Detalles class
 */
class Detalles {
    	
    public $Auto;
    public $Id_Pedido;
    public $Id_Producto;
    public $CodProducto;
    public $Nombre;
    public $PreVtaFinal1;
    public $Cantidad;
    public $ImpTotal;
    public $Notas;
    public $totalFinal = 0;
    protected $obj;

    public function __construct($id=0) {

        if ($id != 0) {
            
            $this->obj = new sQuery();
            $result = $this->obj->executeQuery("SELECT * FROM PEDIDOS_DETA WHERE Id_Pedido = '$id'");
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
    public function getTotalFinal(){ return $this->totalFinal; }
    public function getNotas(){ return $this->Notas; }


    public function getDetallesPedido($Id_Pedido) {
        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("SELECT * FROM PEDIDOS_DETA WHERE (Id_Pedido = $Id_Pedido)");

        return $result;
    }

    public function getPedidoResumen($Id_Pedido) {
        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("SELECT * FROM PEDIDOS_DETA WHERE (Id_Pedido = $Id_Pedido)");

        if ( $result->num_rows > 0 ) :
            $pedido = new Pedidos();
            while ( $product = $result->fetch_object() ) :
                $pedido->sumTotalCart($product->ImpTotal);
            endwhile;
        endif;

        return $result->num_rows;
    }

    public function verifyDetalle($Id_Pedido, $CodProducto) {
        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("SELECT * FROM PEDIDOS_DETA WHERE (Id_Pedido='$Id_Pedido') AND (CodProducto='$CodProducto')");
        return $result;
    }

    public function insertDetalle() {
        $this->obj = new sQuery();
        $this->obj->executeQuery("INSERT INTO PEDIDOS_DETA ( Id_Pedido, Id_Producto, CodProducto, Nombre, PreVtaFinal1, Cantidad, ImpTotal, Notas) VALUES ('$this->Id_Pedido','$this->Id_Producto','$this->CodProducto','$this->Nombre','$this->PreVtaFinal1','$this->Cantidad','$this->ImpTotal','$this->Notas')");
    }

    public function updateDetalle() {
        $this->obj = new sQuery();
        $this->obj->executeQuery("UPDATE PEDIDOS_DETA SET Cantidad='$this->Cantidad', ImpTotal='$this->ImpTotal', Notas='$this->Notas' WHERE Auto='$this->Auto'");
    }

    public function deleteDetalle() {
        $this->obj = new sQuery();
        $this->obj->executeQuery("DELETE FROM PEDIDOS_DETA WHERE Auto = '$this->Auto'");
    }

    public function closeConnection(){
        @$this->obj->Clean();
		$this->obj->Close();
	} 

}