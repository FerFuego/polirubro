<?php
session_start();

header("Content-Type: text/html;charset=utf-8");

require ("cnn.php"); // En esta página hago la conexión.

// Recupero variables pasadas por la URL.
$Id_Rubro = $_GET["Id_Rubro"];
$Rubro = $_GET["Rubro"];
$Id_SubRubro = $_GET["Id_SubRubro"];
$SubRubro = $_GET["SubRubro"];

$sql = "SELECT * FROM grupos WHERE Id_Rubro = $Id_Rubro AND Id_SubRubro = $Id_SubRubro ORDER BY Nombre";
$rsGrupos = mysqli_query($cnn, $sql);
// Este control es por si el producto no tiene grupos (si rubro y subrubro), entonces voy directo a productos.
$canti = mysqli_num_rows($rsGrupos);

if ($canti <= 0)
{
	header("Location: productos_carro.php?Id_Rubro=".$Id_Rubro."&Rubro=".$Rubro."&Id_SubRubro=".$Id_SubRubro."&SubRubro=".$SubRubro);
}

if (isset ($_SESSION["Id_Cliente"]) && $_SESSION["Id_Cliente"] > 0)
{
	// Primero verifico si el cliente tiene un pedido activo:
	$_SESSION["Id_Pedido"] = ConsultarID_Pedido($_SESSION["Id_Cliente"]);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Polirrubros Garro - Clientes</title>
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
                <h2><?php echo $Rubro." | ".$SubRubro ?></h2>
            </div>
        </div>

        <?php
        $cantidad = mysqli_num_rows($rsGrupos);
        if ($cantidad > 0)
        {
            $col = 1;
            while ($dato = mysqli_fetch_array ($rsGrupos))
            {
                if ($col == 1)
                {
                    echo "<div class='row'>";
                }
                echo "<div align='center' class='col-xs-12 col-md-6'>";
                echo "<div class='thumbnail'>";
                echo "<p><a href='productos_carro.php?Id_Rubro=".$dato["Id_Rubro"]."&Rubro=".$Rubro."&Id_SubRubro=".$dato["Id_SubRubro"]."&SubRubro=".$SubRubro."&Id_Grupo=".$dato["Id_Grupo"]."&Grupo=".$dato["Nombre"]."'><img src='../images/carrito_40.png'></a></p>";
                echo "<p><a href='productos_carro.php?Id_Rubro=".$dato["Id_Rubro"]."&Rubro=".$Rubro."&Id_SubRubro=".$dato["Id_SubRubro"]."&SubRubro=".$SubRubro."&Id_Grupo=".$dato["Id_Grupo"]."&Grupo=".$dato["Nombre"]."'>
                <strong>".$dato["Nombre"]."</strong></a></p></div>";
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
        mysqli_free_result($rsGrupos);
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
                </p>
            </div>
        </div>

        <?php require("footer.php"); ?>
    </div>
</body>
</html>