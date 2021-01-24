<?php
/**
 * Global class of frontend
 */
Class Polirubro {

    public function __construct() {
        $this->get_items_session();
    }

    public static function normalize_title() {
        $base = explode( '?', $_SERVER['REQUEST_URI'] );
        return ucfirst( str_replace( ['/','nuevo','.php'], ['','',''], $base[0] ) );
    }

    public static function get_items_session() {

        $html = '';

        if (isset ($_SESSION["Id_Cliente"]) && $_SESSION["Id_Cliente"] != 0) {

            $html .= '<div class="header__top__right__auth">'.
                        'Conectado como: <strong>'. $_SESSION["Id_Cliente"].' | '.$_SESSION["NombreCliente"].'</strong>&nbsp;|&nbsp;'.
                        '<a href="clientes_logout.php"><img src="images/cerrar_sesion_16.png" title="Cerrar Sesi&oacute;n"></a>&nbsp;'.
                        '<a href="clientes_logout.php">Cerrar Sesi&oacute;n</a>'.
                    '</div>';
            if ($_SESSION["Id_Pedido"] != 0) {
                $html .= "<h3>Tiene un pedido abierto. N&uacute;mero: <strong>".$_SESSION["Id_Pedido"]."</strong>.</h3>";
            }

        } else {

            $html .= '<div class="header__top__right__auth">
                <a href="#"><i class="fa fa-user"></i> Ingresar</a>
            </div>';
        }

        return $html;
    }

    public static function ConsultarID_Pedido($Id_Cliente) {

        global $cnn;
        $sql = "SELECT * FROM PEDIDOS_CABE WHERE (Id_Cliente = $Id_Cliente) AND (Cerrado = 0)";
        if (!$rsPedCab = mysqli_query($cnn, $sql)) {
            $Id_Pedido = 0;
            $_SESSION["ErrMsg"] = "<h3>Error al consultar la cabecera del pedido. Reintente o contacte a la empresa.</h3>";
        } else {
            $cantiPedCab = mysqli_num_rows($rsPedCab);
            // Si el cliente tiene al menos un pedido abierto, tomo los datos.
            if ($cantiPedCab > 0) {
                while ($datoPedCab = mysqli_fetch_array($rsPedCab)) {
                    $Id_Pedido = $datoPedCab["Id_Pedido"];
                }
            } else {
                $Id_Pedido = 0;
            }
        }
        mysqli_free_result($rsPedCab);
        return $Id_Pedido;
    }
    
    public static function ConsultarCodExistente($Id_Pedido, $CodProducto) {
        global $cnn;
        $sql = "SELECT * FROM PEDIDOS_DETA WHERE (Id_Pedido = $Id_Pedido) AND (CodProducto = '$CodProducto')";
        if (!$rsPedDet = mysqli_query($cnn, $sql)) {
            return 0;
            $_SESSION["ErrMsg"] = "<h3>Error al consultar el detalle del pedido. Reintente o contacte a la empresa.</h3>";
        } else {
            $cantiPedDet = mysqli_num_rows($rsPedDet);
            mysqli_free_result($rsPedDet);
            if ($cantiPedDet > 0) {
                return 1;
            } else {
                return 0;
            }
        }
    }
    
    public static function ArrayDetallePedido($Id_Pedido) {
        global $cnn;
        
        $sql = "SELECT * FROM PEDIDOS_DETA WHERE (Id_Pedido = $Id_Pedido)";

        if (!$rsPedDet = mysqli_query($cnn, $sql)) {
            $detalle = 0;
            $_SESSION["ErrMsg"] = "<h3>Error al consultar el detalle del pedido. Reintente o contacte a la empresa.</h3>";
        } else {
            $cantiPedDet = mysqli_num_rows($rsPedDet);
            // Si el cliente tiene al menos un pedido abierto, tomo los datos.
            if ($cantiPedDet > 0) {
                $detalle = array(); // Defino el array.
                while ($datoPedDet = mysqli_fetch_array($rsPedDet)) {
                    array_push($detalle, $datoPedDet["Id_Producto"]);
                }
            } else {
                $detalle = 0;
            }
        }
        mysqli_free_result($rsPedDet);
        return $detalle;
    }
    
    public static function BorrarProductoDetallePedido($Id_Pedido, $Id_Producto) {
        global $cnn;
        $sql = "DELETE FROM PEDIDOS_DETA WHERE (Id_Pedido = $Id_Pedido) AND (Id_Producto = $Id_Producto)";

        if (!@mysqli_query ($cnn, $sql)) {
            $_SESSION["ErrMsg"] = "<h3>Error al borrar el producto del carrito. Reintente o contacte a la empresa.</h3>";
            return 0;
        } else {
            return 1;
        }
    }
    
    public static function CerrarPedido($Id_Pedido) {
        global $cnn;
        $FechaFin = date ("Y-m-d");
        $sql = "UPDATE PEDIDOS_CABE SET FechaFin = '$FechaFin', Cerrado = 1 WHERE (Id_Pedido = $Id_Pedido)";

        if (!@mysqli_query ($cnn, $sql)) {
            $_SESSION["ErrMsg"] = "<h3>Error al cerrar el pedido $Id_Pedido. Reintente o contacte a la empresa.</h3>";
            return 0;
        } else {
            return 1;
        }
    }
    
    public static function ActualizarPedido($Id_Pedido) {
        global $cnn;
        $_SESSION["ErrMsg"] = "";
        $msgErr = "";
        $msgAct = "";
        $msgDel = "";
        
        // Primero consulto el detalle del pedido.
        $sql = "SELECT CodProducto, Nombre, PreVtaFinal1, ImpTotal FROM PEDIDOS_DETA WHERE (Id_Pedido = $Id_Pedido)";

        if (!$rsPedDet = mysqli_query($cnn, $sql)) {
            // Si hay un error en el SQL.
            $msgErr = "<h3>Error al consultar el detalle del pedido $Id_Pedido.</h3>";
        } else {
            
            $cantiPedDet = mysqli_num_rows($rsPedDet);
            
            if ($cantiPedDet > 0) {
                // Si el producto existe, verifico el precio.
                while ($datoPedDet = mysqli_fetch_array($rsPedDet)) {
                    // Verifico que el producto existe en la tabla productos.
                    $sql = "SELECT PreVtaFinal1 FROM productos WHERE CodProducto = '".$datoPedDet["CodProducto"]."'";
                    if (!$rsProd = mysqli_query($cnn, $sql)) {
                        // Si hay un error en el SQL.
                        $msgErr = $msgErr."<h3>Problema al consultar el producto ".$datoPedDet["CodProducto"].".</h3>";
                    } else {
                        $cantiProd = mysqli_num_rows($rsProd);
                        
                        if ($cantiProd > 0) {
                            while ($datoProd = mysqli_fetch_array($rsProd)) {
                                if ($datoPedDet["PreVtaFinal1"] != $datoProd["PreVtaFinal1"]) {
                                    // Si el precio es diferente, lo actualizo en el detalle del pedido.
                                    $sql = "UPDATE PEDIDOS_DETA SET 
                                            PreVtaFinal1 = ".$datoProd["PreVtaFinal1"].", 
                                            ImpTotal = (Cantidad * ".$datoProd["PreVtaFinal1"].") 
                                            WHERE (Id_Pedido = $Id_Pedido) AND (CodProducto = '".$datoPedDet["CodProducto"]."')";
                                    
                                    if (!@mysqli_query ($cnn, $sql)) {
                                        $msgErr = $msgErr."<h3>Error al actualizar detalle del pedido $Id_Pedido.</h3>";
                                    } else  {
                                        $msgAct = $msgAct."<h3>Se actualiz&oacute; el precio del producto ".$datoPedDet["CodProducto"]." | ".$datoPedDet["Nombre"]."</h3>";
                                    }
                                }
                            }
                        } else {
                            $sql = "DELETE FROM PEDIDOS_DETA 
                                    WHERE (Id_Pedido = $Id_Pedido) AND (CodProducto = '".$datoPedDet["CodProducto"]."')";
                            if (!@mysqli_query ($cnn, $sql)) {
                                $msgErr = $msgErr."<h3>Error al borrar el producto del detalle del pedido $Id_Pedido.</h3>";
                            } else {
                                $msgDel = $msgDel."<h3>No se encontr&oacute; el producto: ".$datoPedDet["CodProducto"]." y fue borrado del pedido.</h3>";
                            }
                        }
                    }
                }
            } else {
                // Si el pedido no tiene ningún ítem.
                $msgErr = "<h3>El pedido $Id_Pedido no tiene &iacute;tems.</h3>";
            }
        }
        
        mysqli_free_result($rsProd);
        $_SESSION["ErrMsg"] = $msgErr.$msgAct.$msgDel;
        return 1;
    }
}

new Polirubro;
?>