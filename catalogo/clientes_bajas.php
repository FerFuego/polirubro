<?php
session_start();

if ($_SESSION["id_user"] != session_id())
{
	header("Location: login.php");
}

require ("cnn.php");

$id = $_GET["Id"];
$err = false;
	
$sql = "DELETE FROM clientes WHERE Id_Cliente = '$id'";
if (!@mysqli_query ($cnn, $sql)) {
	$err = true;
	$error_baja = "$err_img<p><b>Error MySQL</b>: ".mysqli_error($cnn)."</p>\r\n
	<p><b>Comando SQL</b>: ".$sql."</p>\r\n";
}

mysqli_close($cnn);

// Si hubo algún error lo muestro.
if ($err == "true")
{
	echo "<p><font color='ff0000'><h1>Han ocurrido errores!!!</h1></font></p>";
	echo $error_baja;
	echo "<p><b>Volver a</b>: <a href='clientes_listado.php'>Listado de CLIENTES</a></p>";
}
else
{
	header("Location: clientes_listado.php"); // Si todo OK, vuelvo al listado.
}
?>