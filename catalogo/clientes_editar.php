<?php
session_start();

if ($_SESSION["id_user"] != session_id())
{
	header("Location: login.htm");
}

header("Content-Type: text/html;charset=utf-8");

require ("cnn.php"); // En esta pgina hago la conexin.

if (isset($_POST["cmdGrabar"]) == "Grabar")
{
	// Asigno las variables pasadas por la url a otras variables.
	$id = $_POST["Id_Cliente"];
	$nombre = $_POST["Nombre"];
	$localidad = $_POST["Localidad"];
	$mail = $_POST["Mail"];
	$usuario = $_POST["Usuario"];
	$password = $_POST["Password"];

	$err = 0;
	
	// Armo el SQL. No incluyo ni fecha ni hora, ya que son los de creacin del registro.
	$sql = "UPDATE clientes SET Nombre = '$nombre', Localidad = '$localidad', Mail = '$mail', Usuario = '$usuario', 
			Password = '$password' WHERE Id_Cliente = $id";
	
	if (!@mysqli_query ($cnn, $sql)) {
		$err = 1;
		$msg_err = "<p>Error MySQL: ".mysqli_error($cnn)."</p><p>Comando SQL: ".$sql."</p>";
	}
	
	mysqli_close($cnn);
	
	// Si hubo algn error lo muestro.
    if ($err == 1)
    {
		echo "<h2>ERROR al grabar!</h2>";
		echo $msg_err;
		echo "<p>Volver a: <a href='clientes_listado.php'>Listado de CLIENTES</a></p>";
	}
    else
    {
		header("Location: clientes_listado.php"); // Si todo OK, vuelvo al listado.
	}
}
else
{
	$id = (int)$_GET["Id"];
	$sql = "SELECT * FROM clientes WHERE Id_Cliente = $id";
	$rs = mysqli_query($cnn, $sql);
	$dato = mysqli_fetch_array($rs);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Polirrubros Garro - Clientes</title>
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
                <h2>Edici&oacute;n de Cliente</h2>
                <hr>
            </div>
        </div>

        <div class="row">
            <div align="center" class="col-md-12">
                <form action="clientes_editar.php" method="POST" enctype="multipart/form-data" name="frmEditar">
                    <div class="form-group">
                        <label for="Id_Cliente">Id Cliente</label>
                        <input type="number" name="Id_Cliente" id="Id_Cliente" class="form-control" value="<?php echo $dato["Id_Cliente"]; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="Nombre">Nombre</label>
                        <input type="text" name="Nombre" id="Nombre" class="form-control" maxlength="50" value="<?php echo $dato["Nombre"]; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="Localidad">Localidad</label>
                        <input type="text" name="Localidad" id="Localidad" class="form-control" maxlength="50" value="<?php echo $dato["Localidad"]; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="Mail">E-Mail</label>
                        <input type="email" name="Mail" id="Mail" class="form-control" maxlength="50" value="<?php echo $dato["Mail"]; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="Usuario">Usuario</label>
                        <input type="text" name="Usuario" id="usuario" class="form-control" maxlength="20" value="<?php echo $dato["Usuario"]; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="Password">Contrase&ntilde;a</label>
                        <input type="password" name="Password" id="password" class="form-control" maxlength="20" value="<?php echo $dato["Password"]; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" name="cmdGrabar" id="cmdGrabar" class="btn btn-primary" value="Grabar"> <a href="clientes_listado.php" class="btn btn-warning">Volver a Listado</a>
                    </div>
                </form>
            </div>
        </div>

        <?php require("footer.php"); ?>
    </div>
</body>
</html>
<?php
	mysqli_free_result($rs);
	mysqli_close($cnn);
}
?>