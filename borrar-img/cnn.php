<?php
$cnn = Conectar();
mysqli_set_charset($cnn, "utf8");

function Conectar()
{
	$host = "localhost";
	$base = "u923860411_polirrubros";
	$user = "u923860411_polirrubros";
	$pass = "Nacho2021EsUnCapoDiTutti";
	
    if (!($cnn = mysqli_connect($host, $user, $pass)))
    {
		echo "Error al conectar al servidor de bases de datos.";
		exit();
	}

    if (!mysqli_select_db($cnn, $base))
    {
		echo "Error al seleccionar la base de datos.";
		exit();
	}
	
	//mysqli_query ("SET NAMES 'utf8'");
    return $cnn;
}
?>