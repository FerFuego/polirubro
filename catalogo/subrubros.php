<?php
session_start();

require ("cnn.php");

header("Content-Type: text/html;charset=utf-8");

$Id_Rubro = (isset($_GET["Id_Rubro"]) ? $_GET["Id_Rubro"] : "");
$Rubro = (isset($_GET["Rubro"]) ? $_GET["Rubro"] : "");

$sql = "SELECT * FROM subrubros WHERE Id_Rubro = $Id_Rubro ORDER BY Nombre";
$rsSubRubros = mysqli_query($cnn, $sql);

if (isset ($_SESSION["Id_Cliente"]) && $_SESSION["Id_Cliente"] > 0)
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
                <h2><?php echo $Rubro ?></h2>
            </div>
        </div>

        <?php
        $cantidad = mysqli_num_rows($rsSubRubros);
        if ($cantidad > 0)
        {
            $col = 1;
            while ($dato = mysqli_fetch_array ($rsSubRubros))
            {
                if ($col == 1)
                {
                    echo "<div class='row'>";
                }
                echo "<div align='center' class='col-xs-12 col-md-6'>";
                echo "<div class='thumbnail'>";
                echo "<p><a href='grupos.php?Id_Rubro=".$dato["Id_Rubro"]."&Rubro=".$Rubro."&Id_SubRubro=".$dato["Id_SubRubro"]."&SubRubro=".$dato["Nombre"]."'><img src='../images/carrito_40.png'></a></p>";
                echo "<p><a href='grupos.php?Id_Rubro=".$dato["Id_Rubro"]."&Rubro=".$Rubro."&Id_SubRubro=".$dato["Id_SubRubro"]."&SubRubro=".$dato["Nombre"]."'>
                <strong>".$dato["Nombre"]."</strong></a></p>
                <p><a href='productos_subrubros_carro.php?Id_Rubro=".$dato["Id_Rubro"]."&Rubro=".$Rubro."&Id_SubRubro=".$dato["Id_SubRubro"]."&SubRubro=".$dato["Nombre"]."'>
                Ver subrubro completo</a></p></div>";
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
        mysqli_free_result($rsSubRubros);
        mysqli_close($cnn);
        ?>

        <div class="row">
            <div align="center" class="col-md-12">
                <hr>
            </div>
        </div>

        <div class="row">
            <div align="center" class="col-md-12">
                <p><a href="rubros.php"><button name="cmdRubros" type="button" class="btn btn-success" value="Rubros">Volver a Rubros</button></a></p>
            </div>
        </div>

        <?php require("footer.php"); ?>
    </div>
</body>
</html>