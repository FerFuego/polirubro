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
    public $Usuario;
    public $FechaIni;
    public $FechaFin;
    public $ImpTotal;
    public $Cerrado;
    public $IP;
    public $totalFinal = 0;
    protected $obj;

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
    public function getTotalFinal(){ return $this->totalFinal; }

    public function getPedidoAbierto($Id_Cliente) {

        $data = [
            'num_rows' => 0,
            'Id_Pedido' => null,
        ];

        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("SELECT * FROM pedidos_cabe WHERE (Id_Cliente = $Id_Cliente) AND (Cerrado = 0)");

        if ($result) {   
            $row = $result->fetch_object();
            
            $data = [
                'num_rows' => $result->num_rows,
                'Id_Pedido' => ($row) ? $row->Id_Pedido : null,
            ];
        }

        return $data;
    }

    public function getCountOpenPedidos(){
        $this->obj = new sQuery();
        $this->obj->executeQuery("SELECT * FROM pedidos_cabe WHERE Cerrado = 0");
        return $this->obj->getResultados();
    }

    public function getTotalOrderByMonth() {
        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("SELECT MONTH(FechaIni) mes, YEAR(FechaIni) ano, COUNT(*) total FROM pedidos_cabe WHERE YEAR(FechaIni) = YEAR(CURDATE()) AND Cerrado = 1 GROUP BY MONTH(FechaIni), YEAR(FechaIni) ORDER BY YEAR(FechaIni), MONTH(FechaIni) DESC");
        return $result;
    }

    public function sumTotalCart($totalParcial) {
        $this->totalFinal = $this->totalFinal + $totalParcial;
    }

    public function insertPedido(Usuarios $user) {

        $this->obj = new sQuery();
        $this->obj->executeQuery("INSERT INTO pedidos_cabe (Id_Cliente, Nombre, Localidad, Mail, Usuario, FechaIni, ImpTotal, Cerrado, IP) VALUES ('$user->Id_Cliente','$user->Nombre','$user->Localidad','$user->Mail','$user->Usuario','$this->FechaIni',0,0,'$this->IP')");

        $data = [
            'Id_Pedido' => $this->obj->getIDAffect(),
        ];

        return $data;
    }

    public function finalizarPedido() {

        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("UPDATE pedidos_cabe SET FechaFin = '$this->FechaFin', Cerrado = '$this->Cerrado' WHERE (Id_Cliente = $this->Id_Cliente) AND (Id_Pedido = $this->Id_Pedido) AND (Cerrado = 0)");
    }

    public function closeConnection(){
        @$this->obj->Clean();
		$this->obj->Close();
	}

}