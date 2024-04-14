<?php
/**
 * Pedidos class
 */
class Pedidos {

    public $Id_Pedido;
    public $Id_Cliente;
    public $Nombre;
    public $Localidad;
    public $Mail;
    public $Telefono;
    public $Usuario;
    public $FechaIni;
    public $FechaFin;
    public $SubTotal;
    public $PctDescuento;
    public $Descuento;
    public $ImpTotal;
    public $Cerrado;
    public $IP;
    public $totalFinal = 0;
    protected $obj;

    public function __construct($id=0) {

        if ($id != 0) {
            $this->obj = new sQuery();
            $result = $this->obj->executeQuery("SELECT * FROM PEDIDOS_CABE WHERE Id_Pedido = '$id'");
            $row    = mysqli_fetch_assoc($result);

            $this->Id_Pedido = $row['Id_Pedido'];
            $this->Id_Cliente = $row['Id_Cliente'];
            $this->Nombre = $row['Nombre'];
            $this->Localidad = $row['Localidad'];
            $this->Mail = $row['Mail'];
            $this->Telefono = $row['Telefono'];
            $this->Usuario = $row['Usuario'];
            $this->FechaIni = $row['FechaIni'];
            $this->FechaFin = $row['FechaFin'];
            $this->SubTotal = $row['SubTotal'];
            $this->Descuento = $row['Descuento'];
            $this->PctDescuento = $row['PctDescuento'];
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
    public function getTelefono(){ return $this->Telefono; }
    public function getUsuario(){ return $this->Usuario; }
    public function getFechaIni(){ return $this->FechaIni; }
    public function getFechaFin(){ return $this->FechaFin; }
    public function getSubTotal(){ return $this->SubTotal; }
    public function getPctDescuento(){ return $this->PctDescuento; }
    public function getDescuento(){ return $this->Descuento; }
    public function getImpTotal(){ return $this->ImpTotal; }
    public function getCerrado(){ return $this->Cerrado; }
    public function getIP(){ return $this->IP; }
    public function getTotalFinal(){ return $this->totalFinal; }

    public function getPedidoAbierto($Id_Cliente) {

        $data = [
            'num_rows' => 0,
            'Id_Pedido' => null,
        ];

        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("SELECT * FROM PEDIDOS_CABE WHERE (Id_Cliente = $Id_Cliente) AND (Cerrado = 0)");

        if ($result) {   
            $row = $result->fetch_object();
            
            $data = [
                'num_rows' => $result->num_rows,
                'Id_Pedido' => ($row) ? $row->Id_Pedido : null,
            ];
        }

        return $data;
    }

    public function getOrders($opcion) {

        $query = "SELECT * FROM PEDIDOS_CABE ORDER BY Id_Pedido DESC";

        $this->obj = new sQuery();
        $this->obj->executeQuery($query);

        $result = [
            'total' => $this->obj->getResultados(),
            'query' => $query,
            'params' => 'opcion=' . $opcion
        ];

        return $result;
    }

    public function getOrdersSearch($opcion, $search) {

        $where = '1=1';
        $where .= ( $search == 'activos' ) ? ' AND Cerrado=0' : '';
        $where .= ( $search !== 'activos' ) ? ' AND Nombre LIKE "%'.$search.'%"' : '';
        $where .= ( $search !== 'activos' ) ? ' OR Id_Pedido LIKE "%'.$search.'%"' : '';

        $query = "SELECT * FROM PEDIDOS_CABE WHERE $where ORDER BY Id_Pedido DESC";

        $this->obj = new sQuery();
        $result = $this->obj->executeQuery($query);

        $result = [
            'total' => $this->obj->getResultados(),
            'query' => $query,
            'params' => ($opcion ? 'opcion='. $opcion .'&' : null).'s='.$search
        ];

        return $result;
    }

    public function getCountOpenPedidos(){
        $this->obj = new sQuery();
        $this->obj->executeQuery("SELECT * FROM PEDIDOS_CABE WHERE Cerrado = 0");
        return $this->obj->getResultados();
    }

    public function getTotalOrderByMonth() {
        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("SELECT MONTH(FechaIni) mes, YEAR(FechaIni) ano, COUNT(*) total FROM PEDIDOS_CABE WHERE YEAR(FechaIni) = YEAR(CURDATE()) AND Cerrado = 1 GROUP BY MONTH(FechaIni), YEAR(FechaIni) ORDER BY YEAR(FechaIni), MONTH(FechaIni) DESC");
        return $result;
    }

    public function getPedidoTotal($Id_Pedido) {
        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("SELECT PC.Id_Pedido, PC.Id_Cliente, PC.Nombre, PC.Localidad, PC.Mail, PC.Telefono, PC.Usuario, PC.FechaIni, PC.FechaFin, PC.SubTotal, PC.PctDescuento, PC.Descuento, PC.ImpTotal, PC.Cerrado, SUM(PD.ImpTotal) as Total FROM PEDIDOS_CABE as PC, PEDIDOS_DETA AS PD WHERE (PC.Id_Pedido = '$Id_Pedido') AND (PD.Id_Pedido = '$Id_Pedido')");
        return $result->fetch_object();
    }

    public function sumTotalCart($totalParcial) {
        $this->totalFinal += $totalParcial;
        return $this->totalFinal;
    }

    public function ActualizarPedido($Id_Pedido){
        
        $deleted = 0;
        $updated = 0;

        $items = new Detalles();
        $results = $items->getDetallesPedido($Id_Pedido);
        
        if ( $results->num_rows > 0 ) :
            while ( $detalle = $results->fetch_object() ) :
                $producto = new Productos($detalle->CodProducto);
                if ( null !== $producto->cod_producto ) {
                    if ( Productos::PreVtaFinal($producto->precio_venta_final_1) !== $detalle->PreVtaFinal1 ) :
                        $items->ActualizarPrecio($Id_Pedido, $detalle->CodProducto, Productos::PreVtaFinal($producto->precio_venta_final_1));
                        $updated++;
                    endif;
                } else {
                    $d = new Detalles();
                    $d->Auto = $detalle->Auto;
                    $d->deleteDetalle();
                    $deleted++;
                }
            endwhile;
        endif;

        $data = [
            'deleted' => $deleted,
            'updated' => $updated
        ];

        return $data;           
    }

    public function insertPedido(Usuarios $user) {

        $this->obj = new sQuery();
        $this->obj->executeQuery("INSERT INTO PEDIDOS_CABE (Id_Cliente, Nombre, Localidad, Mail, Telefono, Usuario, FechaIni, FechaFin, SubTotal, Descuento, PctDescuento, ImpTotal, Cerrado, IP) VALUES ('$user->Id_Cliente','$user->Nombre','$user->Localidad','$user->Mail','$this->Telefono','$user->Usuario','$this->FechaIni',null,0,0,0,0,0,'$this->IP')");

        $data = [
            'Id_Pedido' => $this->obj->getIDAffect(),
        ];

        return $data;
    }

    public function insertPedidoGuest() {

        $this->obj = new sQuery();
        $this->obj->executeQuery("INSERT INTO PEDIDOS_CABE (Id_Cliente, Nombre, Localidad, Mail, Telefono, Usuario, FechaIni, FechaFin, SubTotal, Descuento, PctDescuento, ImpTotal, Cerrado, IP) VALUES ('$this->Id_Cliente','$this->Nombre','$this->Localidad','$this->Mail','$this->Telefono','$this->Usuario','$this->FechaIni',null,0,0,0,0,0,'$this->IP')");

        $data = [
            'Id_Pedido' => $this->obj->getIDAffect(),
        ];

        return $data;
    }

    public function finalizarPedido() {
        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("UPDATE PEDIDOS_CABE SET Nombre = '$this->Nombre', Mail = '$this->Mail', Telefono = '$this->Telefono', Localidad = '$this->Localidad', FechaFin = '$this->FechaFin', SubTotal = $this->SubTotal, PctDescuento = $this->PctDescuento, Descuento = $this->Descuento, ImpTotal = $this->ImpTotal, Cerrado = '$this->Cerrado' WHERE (Id_Cliente = $this->Id_Cliente) AND (Id_Pedido = $this->Id_Pedido) AND (Cerrado = 0)");
    }

    public function delete () { 
        $this->obj = new sQuery();
        $this->obj->executeQuery("DELETE FROM PEDIDOS_CABE WHERE Id_Pedido = '$this->Id_Pedido'");
        $this->obj->executeQuery("DELETE FROM PEDIDOS_DETA WHERE Id_Pedido = '$this->Id_Pedido'");
    }

    public function closeConnection(){
        @$this->obj->Clean();
		$this->obj->Close();
	}

}