<?php
session_start();

if ($_SESSION["id_user"] != session_id())
{
	header("Location: login.htm");
}

header("Content-Type: text/html;charset=utf-8");

require ("cnn.php");

if (isset($_POST["Grabar"]) == "Grabar")
{
	$codproducto = $_POST["CodProducto"];
	$observaciones = $_POST["Observaciones"];
	$form = 1;
	
	$sql = "UPDATE productos SET Observaciones = '$observaciones' WHERE CodProducto = '$codproducto'";
	$rsUpdate = mysqli_query($cnn, $sql) or die (mysqli_error($cnn));
}
elseif (isset($_POST["Buscar"]) == "Buscar")
{
	$codproducto = $_POST["CodProducto"];
	$form = 0;
	
	$sql = "SELECT * FROM productos WHERE CodProducto = '$codproducto'";
	$rsProductos = mysqli_query($cnn, $sql) or die (mysqli_error($cnn));
}
else
{
	$form = 1;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Polirrubros Garro - Productos</title>
    <?php require("head.php"); ?>
    <style>
	    label { display:block; }
    </style>
</head>
<body>
    <div class="container" align="center" style="background-color: #FFF;">
        <header>
            <h1>Polirrubros Garro</h1>
        </header>
    </div>

    <div class="container" style="background-color: #FFF;">
        <div class="row">
            <div align="center" class="col-md-12">
                <br>
                <a href="sistema.php" class="myButton">Inicio</a>&nbsp;&nbsp;
                <a href="productos_importar.php" class="myButton">Importar Productos</a>&nbsp;&nbsp;
                <a href="productos_editar.php" class="myButton">Editar Productos</a>&nbsp;&nbsp;
                <a href="clientes_listado.php" class="myButton">ABM Clientes</a>&nbsp;&nbsp;
                <a href="logout.php" class="myButton">Cerrar Sesi&oacute;n</a>
                <br>
            </div>
        </div>

        <div class="row">
            <div align="center" class="col-md-12">
                <h2>Edici&oacute;n de Productos</h2>
                <hr>
            </div>
        </div>

        <?php
        if ($form == 1)
        {
        ?>

        <div class="row">
            <div align="center" class="col-md-12">
                <form name="frmBuscar" method="post" action="productos_editar.php">
                    <div class="form-group">
                        <label for="CodProducto">Ingrese el c&oacute;digo del producto y haga clic en buscar</label>
                        <input type="text" name="CodProducto" id="usuario" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" name="Buscar" id="Buscar"class="btn btn-primary" value="Buscar">
                    </div>
                </form>
            </div>
        </div>
        
        <?php
        }
        else
        {
        ?>
        <div class="row">
            <div align="center" class="col-md-12">
            <?php
            $cantidad = mysqli_num_rows($rsProductos);
            if ($cantidad == 0)
            {
                echo "<p>No se encontraron registros...<br><a href='productos_editar.php'>
                    <img src='../images/ico_buscar_48.png' title='Buscar Producto'><br>Nueva b&uacute;squeda</a></p>";
            }
            else
            {
                echo "<p><a href='productos_editar.php'><img src='../images/ico_buscar_48.png' title='Buscar Producto'><br>Nueva b&uacute;squeda</a></p>";
                while ($dato = mysqli_fetch_array ($rsProductos))
                {
                    $img = "../fotos/".$dato["CodProducto"].".JPG";
                    if (file_exists($img))
                    {
                        $img = $dato["CodProducto"].".JPG";
                    }
                    else
                    {
                        $img = "../fotos/".$dato["CodProducto"].".jpg";
                        if (file_exists($img))
                        {
                            $img = $dato["CodProducto"].".jpg";
                        }							
                    }
                    echo "<img src='../fotos/".$img."' class='img-responsive'><br>";
            ?>
                <form name="frmEditar" method="post" action="productos_editar.php">
                    <div class="form-group">
                        <label for="CodProducto">C&oacute;digo</label>
                        <input type="text" name="CodProducto" class="form-control" value="<?php echo $dato["CodProducto"] ?>" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="Nombre">Nombre</label>
                        <input type="text" name="Nombre" class="form-control" value="<?php echo $dato["Nombre"]?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="Observaciones">Observaciones</label>
                        <textarea name="Observaciones" id="Observaciones" class="form-control"><?php echo $dato["Observaciones"]; ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" name="Grabar" id="Grabar" class="btn btn-primary" value="Grabar">
                    </div>
                </form>
            <?php
            }
            }
            mysqli_free_result($rsProductos);
            mysqli_close($cnn);
            ?>
            </div>
        </div>
        <?php
        }
        ?>

        <?php require("footer.php"); ?>
    </div>
</body>
</html>