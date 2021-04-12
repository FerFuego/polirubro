<?php
session_start();

if ($_SESSION["id_user"] != session_id())
{
	header("Location: login.php");
}

header("Content-Type: text/html;charset=utf-8");

if (isset($_POST["cmdGrabar"]) == "Grabar")
{
	require ("cnn.php");
	$id_cliente = $_POST["Id_Cliente"];
	$nombre = $_POST["Nombre"];
	$localidad = $_POST["Localidad"];
	$mail = $_POST["Mail"];
	$usuario = $_POST["Usuario"];
	$password = $_POST["Password"];
	
	$err = 0;
	
	$sql = "INSERT INTO clientes (Id_Cliente, Nombre, Localidad, Mail, Usuario, Password) 
			VALUES ($id_cliente, '$nombre', '$localidad', '$mail', '$usuario', '$password')";
	
	if (!@mysqli_query ($cnn, $sql)) {
		$err = 1;
		$msg_err = "<p>Error MySQL: ".mysqli_error($cnn)."</p><p>Comando SQL: ".$sql."</p>";
	}

	mysqli_close($cnn);

	// Si hubo algún error lo muestro.
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
                <h2>Alta de Cliente</h2>
                <hr>
            </div>
        </div>

        <div class="row">
            <div align="center" class="col-md-12">
                <form action="clientes_altas.php" method="POST" enctype="multipart/form-data" name="frmAltas">
                    <div class="form-group">
                        <label for="Id_Cliente">Id Cliente</label>
                        <input type="number" name="Id_Cliente" id="Id_Cliente" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="Nombre">Nombre</label>
                        <input type="text" name="Nombre" id="Nombre" class="form-control" maxlength="50" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="Localidad">Localidad</label>
                        <input type="text" name="Localidad" id="Localidad" class="form-control" maxlength="50" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="Mail">E-Mail</label>
                        <input type="email" name="Mail" id="Mail" class="form-control" maxlength="50" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="Usuario">Usuario</label>
                        <input type="text" name="Usuario" id="usuario" class="form-control" maxlength="20" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="Password">Contrase&ntilde;a</label>
                        <input type="password" name="Password" id="password" class="form-control" maxlength="20" required>
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
}
?>