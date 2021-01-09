<?php
session_start();

header("Content-Type: text/html;charset=utf-8");
	
require ("cnn.php");

// Recupero variables pasadas por la URL.
$Id_Rubro = (isset($_GET["Id_Rubro"]) ? $_GET["Id_Rubro"] : "");
$Rubro = (isset($_GET["Rubro"]) ? $_GET["Rubro"] : "");
$Id_SubRubro = (isset($_GET["Id_SubRubro"]) ? $_GET["Id_SubRubro"] : "");
$SubRubro = (isset($_GET["SubRubro"]) ? $_GET["SubRubro"] : "");
$Id_Grupo = (isset($_GET["Id_Grupo"]) ? $_GET["Id_Grupo"] : "");
$Grupo = (isset($_GET["Grupo"]) ? $_GET["Grupo"] : "");
$filtro = "&Id_Rubro=".$Id_Rubro."&Rubro=".$Rubro."&Id_SubRubro=".$Id_SubRubro."&SubRubro=".$SubRubro."&Id_Grupo=".$Id_Grupo."&Grupo=".$Grupo."&Pagina="."productos_carro.php";

if (isset ($_SESSION["Id_Cliente"]) && $_SESSION["Id_Cliente"] > 0)
{
    // Primero verifico si el cliente tiene un pedido activo:
	$_SESSION["Id_Pedido"] = ConsultarID_Pedido($_SESSION["Id_Cliente"]);
    if ($_SESSION["Id_Pedido"] != 0)
    {
		// Luego si corresponde, recupero el array con el detalle de los productos del pedido en curso.
		$detalle = ArrayDetallePedido($_SESSION["Id_Pedido"]);
	}
}

if ($Id_Rubro == "")
{
	$rub = "";
}
else
{
	$rub = " AND Id_Rubro = ".$Id_Rubro;
}

if ($Id_SubRubro == "")
{
	$srub = "";
}
else
{
	$srub = " AND Id_SubRubro = ".$Id_SubRubro;
}

if ($Id_Grupo == "")
{
	$gru = "";
}
else
{
	$gru = " AND Id_Grupo = ".$Id_Grupo;
}

$sql = "SELECT * FROM productos WHERE Id_Producto > 0".$rub.$srub.$gru." ORDER BY Nombre";
$rsProductos = mysqli_query($cnn, $sql);
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
                        echo "<p>Tiene un pedido en curso. N&uacute;mero: <strong>".$_SESSION["Id_Pedido"]."</strong>.</p>";
                    }
                    if ($_SESSION["ErrMsg"] != "")
                    {
                        echo "<p>".$_SESSION["ErrMsg"]."</p>";
                    }
                }
                ?>
            </div>
        </div>

        <div class="row">
            <div align="center" class="col-md-12">
                <h2>PRODUCTOS en <?php echo $Rubro." | ".$SubRubro." | ".$Grupo ?></h2>
            </div>
        </div>

        <?php
        $cantidad = mysqli_num_rows($rsProductos);
        if ($cantidad == 0)
        {
            echo "<p align='center'><b>No se encontraron registros...</b></p>";
        }
        else
        {
            $col = 1;
            while ($dato = mysqli_fetch_array ($rsProductos))
            {
                if ($col == 1)
                {
                    echo "<div class='row'>";
                }
                echo "<div align='center' class='col-xs-12 col-sm-6 col-md-3' style='padding-top: 15px; padding-bottom: 15px;'>";
                
                if (file_exists("../fotos/".$dato["CodProducto"].".JPG"))
                {
                    $img = "../fotos/".$dato["CodProducto"].".JPG";
                }
                elseif (file_exists("../fotos/".$dato["CodProducto"].".jpg"))
                {
                    $img = "../fotos/".$dato["CodProducto"].".jpg";
                }
                else
                {
                    $img = "noimg_150.png";
                }

                echo "<div class='thumbnail'>";
                echo "<a name='".$dato["Id_Producto"]."'></a>";
                echo "<a href='".$img."' data-lightbox='image-1' data-title='C&oacute;d.: ".
                    $dato["CodProducto"]." - ".$dato["Nombre"]."'>";
                echo "<img src='".$img."' class='img-responsive'>";
                echo "</a>";
                echo "<div class='caption'>";
                echo "<h3>".$dato["CodProducto"]."</h3>";
                echo "<p>".$dato["Nombre"]."</p>";

                if (isset ($_SESSION["Id_Cliente"]) && $_SESSION["Id_Cliente"] > 0)
                {
                    echo "<p><font color='#0000FF'>Precio Lista: $ ".number_format($dato["PreVtaFinal1"], 2, '.', ',')."</font></p>";
                }
                if ($dato["Observaciones"] != "")
                {
                    echo "<p>".$dato["Observaciones"]."</p>";
                }
                            
                // Si el cliente es mayor a 1 muestro los botones para agregar y quitar del carrito.
                // El cliente 1 se usa solo para ver precios.						
                if (isset ($_SESSION["Id_Cliente"]) && $_SESSION["Id_Cliente"] > 1)
                {
                    error_reporting(0);
                    if (in_array($dato['Id_Producto'], $detalle))
                    {
                    error_reporting(-1);
                    ?>
                    <p>
                    <a href="carro_borracar.php?<?php echo SID ?>&amp;id=<?php echo $dato['Id_Producto'].$filtro.$Param ?>">
                    <button name='cmdQuitar' type='button' class='btn btn-danger' value='Quitar'>Quitar</button></a>
                    </p>
                    <?php
                    }
                    else
                    {
                        echo "<form name='".$dato['Id_Producto']."' method='post' action='carro_agregacar.php?id=".$dato['Id_Producto'].$filtro.$Param."'>";
                        echo "<p>Si es necesario, ingrese talle, color, etc.:<br>";
                        echo "<textarea name='notas' cols='15' rows='3' id='notas'></textarea>";
                        echo "</p>";
                        echo "<p>Cantidad:<br>";
                        echo "<input name='cantidad' type='number' min='1' max='99999' style='text-align: right' class='form1' id='cantidad' value='1' required>";
                        echo "</p>";
                    ?>
                    <p>
                    <input name="cmdAgregar" type="submit" class="btn btn-primary" id="cmdAgregar" value="Agregar">
                    </p>
                    <?php
                    echo "</form>";
                    }
                }
                echo "</div>";
                echo "</div>";
                echo "</div>";

                if ($col == 4)
                {
                    $col = 1;
                    echo "</div>";
                }
                elseif ($col == 3)
                {
                    $col = 4;
                }
                elseif ($col == 2)
                {
                    $col = 3;
                }
                elseif ($col == 1)
                {
                    $col = 2;
                }
            }
        }
        mysqli_free_result($rsProductos);
        mysqli_close($cnn);
        ?>
        
        <div class="row">
            <div align="center" class="col-md-12">
                <hr>
            </div>
        </div>

        <div class="row">
            <div align="center" class="col-md-12">
                <p>
                <a href="rubros.php">
                <button name="cmdRubros" type="button" class="btn btn-success" value="Rubros">Volver a Rubros</button>
                </a>
                <a href="subrubros.php<?php echo "?Id_Rubro=".$Id_Rubro."&Rubro=".$Rubro."&Id_SubRubro=".$Id_SubRubro."&SubRubro=".$SubRubro ?>">
                <button name="cmdSubRubros" type="button" class="btn btn-success" value="SubRubros">Volver a SubRubros</button>
                </a>
                <a href="grupos.php<?php echo "?Id_Rubro=".$Id_Rubro."&Rubro=".$Rubro."&Id_SubRubro="."&Id_SubRubro=".$Id_SubRubro."&SubRubro=".$SubRubro."&Id_Grupo=".$Id_Grupo."&Grupo=".$Grupo ?>">
                <button name="cmdGrupos" type="button" class="btn btn-success" value="Grupos">Volver a Grupos</button>
                </a>
                </p>
            </div>
        </div>

        <?php require("footer.php"); ?>
    </div>
</body>
</html>