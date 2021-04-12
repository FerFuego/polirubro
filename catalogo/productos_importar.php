<?php
session_start();

if ($_SESSION["id_user"] != session_id())
{
	header("Location: login.php");
}

header("Content-Type: text/html;charset=utf-8");

$msg_ok = "";

if (isset($_POST["cmdImportar"]) == "Importar")
{
	echo "<div class='container' align='center' style='background-color: #FFF;'>";
	
	$fileSQL = $_FILES["fileSQL"];
	$err = 0;
	$msg_err_file = "";
	$msg_err_del = "";
	$msg_err_ins = "";	
	$ruta_img = $_SERVER['DOCUMENT_ROOT']."/catalogo/";
	
	$sql = file_get_contents($fileSQL['tmp_name']);
	$sql = utf8_encode($sql);	
	
    if (!$sql)
    {
		$err = 1;
		$msg_err_file = "<p>No se pudo abrir el archivo ".$ruta_img."importar.txt. Verifique.</p>";
	}
    else
    {
		require ("cnn.php");
		
        if (!@mysqli_query ($cnn, "TRUNCATE TABLE productos"))
        {
			$err = 1;
			$msg_err_del = "<p>Error MySQL: ".mysqli_error($cnn)."</p><p>Comando SQL: TRUNCATE TABLE productos</p>";
		}
	
		if (!@mysqli_query ($cnn, $sql)) {
			$err = 1;
			$msg_err_ins = "<p>Error MySQL: ".mysqli_error($cnn)."</p><p>Comando SQL: ".$sql."</p>";
		}
		
		mysqli_close($cnn);
	}
	
	// Si hubo algn error lo muestro.
    if ($err == 1)
    {
		echo "<h2>ERROR al grabar!</h2>";
		echo $msg_err_file.$msg_err_del.$msg_err_ins;
		echo "<p>Volver a: <a href='sistema.php'>INICIO</a></p>";
	}
    else
    {
		$msg_ok = "Los productos se importaron con &eacute;xito!";
	}
	
	echo "<div";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Polirrubros Garro</title>
    <?php require("head.php"); ?>
    <style>
	    label { display: block; }
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
                <h2>Importar Productos</h2>
                <hr>
            </div>
        </div>

        <div class="row">
            <div align="center" class="col-md-12">
            <?php
            if ($msg_ok != "")
            {
                echo "<p><img src='images/import-ok.png'></p>";
                echo "<h3>$msg_ok</h3>";
            }
            else
            {
            ?>
            <form action="productos_importar.php" method="post" enctype="multipart/form-data" name="frmImportar">
                <div class="form-group">
                    <label for="fileSQL">Seleccione archivo para importar los productos</label>
                    <input type="file" name="fileSQL" id="fileSQL" class="form-control" required>
                </div>

                <div class="form-group">
                    <input type="submit" name="cmdImportar" id="Importar" class="btn btn-primary" value="Importar">
                </div>
            </form>
            <?php
            }
            ?>
            </div>
        </div>

        <?php require("footer.php"); ?>
    </div>
</body>
</html>