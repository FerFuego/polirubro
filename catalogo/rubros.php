<?php
session_start();

require ("cnn.php");

header("Content-Type: text/html;charset=utf-8");

$sql = "SELECT * FROM rubros ORDER BY Nombre";
$rsRubros = mysqli_query($cnn, $sql);

if (isset($_SESSION["Id_Cliente"]) != 0)
{
	// Primero verifico si el cliente tiene un pedido activo:
	$_SESSION["Id_Pedido"] = ConsultarID_Pedido($_SESSION["Id_Cliente"]);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Polirrubros Garro - Productos</title>
    <?php require("head.php"); ?>
</head>
<body>
    <div class="container" style="background-color: #FFF;">
        <?php require("header.php"); ?>
        <?php require("navbar.php"); ?>
	    
        <div class="row">
            <div align="center" class="col-md-12">
                <br>
                <!-- Modal -->
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">URGENTE: leer con atenci&oacute;n</button>    
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Cambios en el sistema de pedidos on line</h4>
                            </div>
                            <div class="modal-body" style="text-align:left">
                                Se han implementado cambios en el sistema de pedidos on line.<br>
                                Los mismos permitir&aacute;n que un pedido pueda comenzarse un d&iacute;a y confirmarse al siguiente.<br>
                                La interrupci&oacute;n del servicio de internet para el cliente, no ser&aacute; motivo de anulaci&oacute;n del pedido. Podr&aacute; continuarlo iniciando sesi&oacute;n nuevamente.
                                <h3>Tenga en cuenta que al dejar un pedido de un día para el otro, los precios pueden variar.</h3>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div align="right" class="col-md-12">
                <?php
                if (isset ($_SESSION["Id_Cliente"]) && $_SESSION["Id_Cliente"] != 0)
                {
                    echo "<br><p>Conectado como: <strong>"
                    .$_SESSION["Id_Cliente"]." | ".$_SESSION["NombreCliente"]."</strong>&nbsp;|&nbsp;
                    <a href='../clientes_logout.php'><img src='../images/cerrar_sesion_16.png' title='Cerrar Sesi&oacute;n'></a>
                    &nbsp;<a href='../clientes_logout.php'>Cerrar Sesi&oacute;n</a></p>";
                    if ($_SESSION["Id_Pedido"] != 0)
                    {
                        echo "<h3>Tiene un pedido abierto. N&uacute;mero: <strong>".$_SESSION["Id_Pedido"]."</strong>.</h3>";
                    }
                }
                ?>
            </div>
        </div>

        <div class="row">
            <div align="center" class="col-md-12">
                <h1>Rubros</h1>
            </div>
        </div>

        <?php
        $cantidad = mysqli_num_rows($rsRubros);
        if ($cantidad > 0)
        {
            $col = 1;
            while ($dato = mysqli_fetch_array ($rsRubros))
            {
                if ($col == 1)
                {
                    echo "<div class='row'>";
                }
                echo "<div align='center' class='col-xs-12 col-md-6'>";
                echo "<div class='thumbnail'>";
                if (file_exists('img-rubros/'.$dato["Id_Rubro"].'.png'))
                {
                    echo "<p><a href='subrubros.php?Id_Rubro=".$dato["Id_Rubro"]."&Rubro=".$dato["Nombre"]."'><img src='img-rubros/".$dato["Id_Rubro"].".png'></a></p>";
                }
                else
                {
                    echo "<p><a href='subrubros.php?Id_Rubro=".$dato["Id_Rubro"]."&Rubro=".$dato["Nombre"]."'><img src='../images/carrito_40.png'></a></p>";
                }
                echo "<p><a href='subrubros.php?Id_Rubro=".$dato["Id_Rubro"]."&Rubro=".$dato["Nombre"]."'><h3>".$dato["Nombre"]."</h3></a>
                <br><img src='images/tilde_24.png'>
                <a href='productos_rubros_carro.php?Id_Rubro=".$dato["Id_Rubro"]."&Rubro=".$dato["Nombre"]."'>
                Ver rubro completo</a>
                <br><img src='images/tilde_24.png'>
                <a href='productos_nov-ofe_carro.php?Id_Rubro=".$dato["Id_Rubro"]."&Rubro=".$dato["Nombre"]."&Novedad=1'>
                Ver novedades del rubro</a>
                <br><img src='images/tilde_24.png'>
                <a href='productos_nov-ofe_carro.php?Id_Rubro=".$dato["Id_Rubro"]."&Rubro=".$dato["Nombre"]."&Oferta=1'>
                Ver ofertas del rubro</a>												
                </p></div>";
                echo "</div>";
                if ($col == 2)
                {
                    $col = 1;
                    echo "</div>";
                }
                else
                {
                    $col = 2;
                }
            }
        }
        mysqli_free_result($rsRubros);
        mysqli_close($cnn);
        ?>
    
        <?php require("footer.php"); ?>
    </div>
</body>
</html>