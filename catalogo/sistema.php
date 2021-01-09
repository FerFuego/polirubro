<?php
session_start();

if ($_SESSION["id_user"] != session_id())
{
	header("Location: login.htm");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Polirrubros Garro - Productos</title>
    <?php require("head.php"); ?>
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
                <a href="productos_importar.php" class="myButton">Importar Productos</a>&nbsp;&nbsp;
                <a href="productos_editar.php" class="myButton">Editar Productos</a>&nbsp;&nbsp;
                <a href="clientes_listado.php" class="myButton">ABM Clientes</a>&nbsp;&nbsp;
                <a href="logout.php" class="myButton">Cerrar Sesi&oacute;n</a>
                <br>
            </div>
        </div>

        <div class="row">
            <div align="center" class="col-md-12">
                <h2>Sistema</h2>
                <hr>
            </div>
        </div>

        <div class="row">
            <div align="center" class="col-xs-12 col-md-4">
                <a href="productos_importar.php"><img src="images/importar-prod.png"></a>
                <h3>Importar Productos</h3>
            </div>
            <div align="center" class="col-xs-12 col-md-4">
                <a href="productos_editar.php"><img src="images/edicion-prod.png"></a>
                <h3>Editar Productos</h3>
            </div>
            <div align="center" class="col-xs-12 col-md-4">
                <a href="clientes_listado.php"><img src="images/clientes.png"></a>
                <h3>ABM Clientes</h3>
            </div>
        </div>

        <?php require("footer.php"); ?>
    </div>
</body>
</html>