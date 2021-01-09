<?php
session_start();

header("Content-Type: text/html;charset=utf-8");

if (isset($_SESSION["Id_Cliente"]))
{
    if ($_SESSION["Id_Cliente"] <= 1)
    {
		header("Location:rubros.php");
	}
}
else
{
	header("Location:rubros.php");
}

require ("cnn.php");

// Recupero variables pasadas por la URL (con isset controlo que estén definidas).
if (isset($_GET["Id_Rubro"]))
	$Id_Rubro = $_GET["Id_Rubro"];
else
	$Id_Rubro = "";
	
if (isset($_GET["Rubro"]))
	$Rubro = $_GET["Rubro"];
else
	$Rubro = "";

if (isset($_GET["Id_SubRubro"]))
	$Id_SubRubro = $_GET["Id_SubRubro"];
else
	$Id_SubRubro = "";

if (isset($_GET["SubRubro"]))
	$SubRubro = $_GET["SubRubro"];
else
	$SubRubro = "";

if (isset($_GET["Id_Grupo"]))
	$Id_Grupo = $_GET["Id_Grupo"];
else
	$Id_Grupo = "";

if (isset($_GET["Grupo"]))
	$Grupo = $_GET["Grupo"];
else
	$Grupo = "";
	
if (isset($_GET["Pagina"]))
	$Pagina = $_GET["Pagina"];
else
	$Pagina = "";

if (isset($_GET["pagina"])) { $pagina = $_GET["pagina"]; } else { $pagina = ""; }
if (isset($_GET["cant_reg"])) { $cant_reg = $_GET["cant_reg"]; } else { $cant_reg = ""; }
if (isset($_GET["cant_pag"])) { $cant_pag = $_GET["cant_pag"]; } else { $cant_pag = ""; }
	
$Param = "&pagina=".$pagina."&cant_reg=".$cant_reg."&cant_pag=".$cant_pag;

// ----- Consulto cabecera del pedido -----
$sql = "SELECT * FROM PEDIDOS_CABE WHERE (Id_Cliente = ".$_SESSION["Id_Cliente"].") AND (Cerrado = 0)";
if (!$rsPedCab = mysqli_query($cnn, $sql))
{
	$_SESSION["Id_Pedido"] = 0;
	$_SESSION["ErrMsg"] = "<h3>El cliente no tiene ningún pedido abierto.</h3>";
}
else
{
	$cantiPedCab = mysqli_num_rows($rsPedCab);
	// Si el cliente tiene al menos un pedido abierto, tomo los datos.
    if ($cantiPedCab > 0)
    {
        while ($datoPedCab = mysqli_fetch_array($rsPedCab))
        {
			$_SESSION["Id_Pedido"] = $datoPedCab["Id_Pedido"];
		}
	}
    else
    {
		$_SESSION["Id_Pedido"] = 0;
	}
}
mysqli_free_result($rsPedCab);
// ---------------
?>
<!DOCTYPE html><html lang="es">
<head>
	<title>Polirrubros Garro - Ayuda</title>
    <?php require("head.php"); ?>
</head>
<body>
    <div class="container" style="background-color: #FFF;">
        <?php require("header.php"); ?>
        <?php require("navbar.php"); ?>
    
        <div class="row">
            <div align="right" class="col-md-12">
                <?php
                if (isset ($_SESSION["Id_Cliente"]) && $_SESSION["Id_Cliente"] > 0)
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
                <h1>Carrito de Compras</h1>
            </div>
        </div>

        <div class="row">
            <div align="center" class="col-md-12">
                <?php
                if (isset ($_SESSION["Id_Cliente"]) && $_SESSION["Id_Cliente"] > 0)
                {
                    echo "<p><strong>ATENCIÓN</strong>: para cambiar las cantidades de los productos a pedir, indique el valor 
                    correspondiente en el cuadro &quot;Cambiar Cantidad&quot; y luego haga clic en el ícono  de la columna 
                    &quot;Actualizar&quot;. Esto debe hacerse producto por producto. Lo mismo vale para indicar alguna 
                    observación particular sobre algún producto, ingresando talle, color, etc.</p>";
                    echo "<p>".$_SESSION["ErrMsg"]."</p>";
                }
                else
                {
                    echo "<p align='center'>Para poder comprar on line, debe antes <a href='../clientes.php'><strong>identificarse</strong></a> 
                    como cliente.</p>";
                }
                ?> 
            </div>
        </div>

        <div class="row">
            <div align="center" class="col-md-12">
                <?php
                if ($_SESSION["Id_Pedido"] != 0)
                {
                ?>
                <div class="table-responsive">
                <table class='table table-hover'>
                    <tr>
                    <th width="15%" style="text-align:center"><h3>Imagen</h3></th>
                    <th width="20%"><h3>Producto</h3></th>
                    <th width="15%"><h3>Si es necesario, ingrese talle, color, etc.</h3></th>
                    <th width="10%" style="text-align:right"><h3>Pre. Uni.</h3></th>
                    <th width="10%" style="text-align:right"><h3>Cantidad</h3></th>
                    <th width="10%" style="text-align:right"><h3>Total</h3></th>
                    <th width="10%" style="text-align:right"><h3>Cambiar Cantidad</h3></th>
                    <th width="5%" style="text-align:center"><h3>Act.</h3></th>
                    <th width="5%" style="text-align:center"><h3>Borrar</h3></th>
                    </tr>
                    <?php
                    // ----- DETALLE DEL PEDIDO -----
                    $sql = "SELECT * FROM PEDIDOS_DETA WHERE (Id_Pedido = ".$_SESSION["Id_Pedido"].")";
                    if (!$rsPedDet = mysqli_query($cnn, $sql))
                    {
                        $detalle = 0;
                        $_SESSION["ErrMsg"] = "<h3>Error al consultar el detalle del pedido.</h3>";
                    }
                    else
                    {
                        $cantiPedDet = mysqli_num_rows($rsPedDet);
                        if ($cantiPedDet > 0)
                        {
                            $color = array("#ffffff","#C4B49D");
                            $contador = 0;
                            $suma = 0;
                            while ($datoPedDet = mysqli_fetch_array($rsPedDet))
                            {
                                $subto = $datoPedDet["Cantidad"] * $datoPedDet['PreVtaFinal1'];
                                $suma = $suma + $subto;
                                $contador ++;
                                ?>
                                <form name="<?php echo $datoPedDet['Id_Producto'] ?>" method="post" action="carro_agregacar.php?<?php echo SID."&Id_Rubro=".$Id_Rubro."&Rubro=".$Rubro."&Id_SubRubro=".$Id_SubRubro."&SubRubro=".$SubRubro."&Id_Grupo=".$Id_Grupo."&Grupo=".$Grupo."&Pagina=carro_vercarrito.php" ?>" id="a<?php echo $datoPedDet['Id_Producto'] ?>">
                                <tr>
                                    <td width="15%">
                                    <?php
                                    if (file_exists("../fotos/".$datoPedDet['CodProducto'].".JPG"))
                                    {
                                        $img = "../fotos/".$datoPedDet['CodProducto'].".JPG";
                                    }
                                    elseif (file_exists("../fotos/".$datoPedDet['CodProducto'].".jpg"))
                                    {
                                        $img = "../fotos/".$datoPedDet['CodProducto'].".jpg";
                                    }
                                    else
                                    {
                                        $img = "noimg_150.png";
                                    }
                                    echo "<img src='$img' class='img-responsive'>";
                                    ?>
                                    </td>
                                    <td width="20%"><?php echo $datoPedDet['Nombre'] ?></td>
                                    <td width="15%">
                                    <input name="notas" type="text" class="form1" id="notas" value="<?php echo $datoPedDet['Notas'] ?>" size="20" maxlength="80">
                                    </td>
                                    <td width="10%" style="text-align:right"><?php echo number_format($datoPedDet['PreVtaFinal1'], 2) ?></td>
                                    <td width="10%" style="text-align:right"><?php echo $datoPedDet['Cantidad'] ?></td>
                                    <td width="10%" style="text-align:right"><?php echo number_format($subto, 2, '.', ','); ?></td>
                                    <td width="10%" style="text-align:right">
                                    <input name="cantidad" type="number" class="form1" id="cantidad" value="<?php echo $datoPedDet['Cantidad'] ?>" min="1" max="99999" style="text-align: right">
                                    <input name="id" type="hidden" id="id" value="<?php echo $datoPedDet['Id_Producto'] ?>">
                                    </td>
                                    <td width="10%" style="text-align:center">
                                    <input name="imageField" type="image" src="images/ico_actualizar_48.png" border="0" title="Actualizar cantidad">
                                    </td>
                                    <td width="10%" style="text-align:center">
                                    <a href="carro_borracar.php?<?php echo SID ?>&amp;id=<?php echo $datoPedDet['Id_Producto']."&Id_Rubro=".$Id_Rubro."&Rubro=".$Rubro."&Id_SubRubro=".$Id_SubRubro."&SubRubro=".$SubRubro."&Id_Grupo=".$Id_Grupo."&Grupo=".$Grupo."&Pagina=carro_vercarrito.php" ?>">
                                    <img src="images/ico_borrar_48.png" border="0" title="Quitar producto">
                                    </a>
                                    </td>
                                </tr>
                                </form>
                        <?php
                            }
                        }
                        else
                        {
                            $detalle = 0;
                        }
                    }
                    mysqli_free_result($rsPedDet);
                    // ---------------
                    ?>
                    <tr>
                    <td height="20" colspan="3" align="right" valign="middle">
                    <h3>Importe Total: $</h3></td>
                    <td height="20" align="right" valign="middle">
                    <h3><?php echo number_format($suma, 2, '.', ','); ?></h3></td>
                    <td height="20" colspan="5" align="right" valign="middle">&nbsp;</td>
                    </td>
                    </tr>
                    <tr>
                    <td height="20" colspan="3" align="right" valign="middle">
                    <h3>Cantidad de c&oacute;digos:</h3></td>
                    <td height="20" align="right" valign="middle">
                    <h3><?php echo $cantiPedDet; ?></h3></td>
                    <td height="20" colspan="5" align="right" valign="middle">&nbsp;</td>
                    </tr>
                </table>
                </div>
                <?php if ($Pagina == "carro_vercarrito.php" or $Pagina == "") { $Pagina = "rubros.php"; } ?>
                <p>
                <a href="rubros.php" class="btn btn-info btn-lg active" role="button" aria-pressed="true">Continuar comprando</a>
                </p>
                <p>
                <a href="carro_actualizar.php?<?php echo "Id_Pedido=".$_SESSION["Id_Pedido"] ?>" class="btn btn-warning btn-lg active" role="button" aria-pressed="true">Revisi&oacute;n final del pedido</a>
                </p>
                <?php
                }
                else {
                ?>
                <h2>No hay productos seleccionados.</h2>
                <p>
                <a href="rubros.php"><img src="images/ico_continuar_48.png" width="48" height="48" border="0" title="Continuar la selecci&oacute;n de productos" /></a></p>
                <?php
                }
                ?>
            </div>
        </div>

        <?php require("footer.php"); ?>
    </div>
</body>
</html>