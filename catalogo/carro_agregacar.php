<?php 
session_start();
extract($_REQUEST);

$_SESSION["ErrMsg"] = "";

require ("cnn.php");

if (!isset($cantidad)) { $cantidad = 1; } // Si la cantidad no está definida por algún motivo, la establezco en 1.
if (!isset($notas)) { $notas = ""; } // Si no hay observaciones definidas establezco ''.

if ($Pagina == "carro_vercarrito.php")
{
	$editar = 1;
}
else
{
	$editar = 0;
}

// *************** BUSCO EL REGISTRO DEL PRODUCTO A AGREGAR ***************
$sql = "SELECT * FROM productos WHERE Id_Producto = ".$id;
$rsProductos = mysqli_query($cnn, $sql);
$cantiProducto = mysqli_num_rows($rsProductos);
if ($cantiProducto > 0)
{
	$row = mysqli_fetch_array($rsProductos);
	$ancla = "#".$id;
}
else
{
	$_SESSION["ErrMsg"] = "<h3>No se ha encontrado el producto que intenta agregar. Verifique.</h3>";
}
// *********************************************


// *************** CABECERA DEL PEDIDO ***************

// Primero verifico si el cliente tiene un pedido activo:
$_SESSION["Id_Pedido"] = ConsultarID_Pedido($_SESSION["Id_Cliente"]);

// Si el Id_Pedido es cero, debo crear un pedido primero.
if ($_SESSION["Id_Pedido"] == 0)
{
	$FechaIni = date ("Y-m-d");
	$IP = $_SERVER['REMOTE_ADDR'];	
	$sql = "INSERT INTO PEDIDOS_CABE (Id_Cliente, Nombre, Localidad, Mail, Usuario, FechaIni, ImpTotal, Cerrado, IP) 
			VALUES (".$_SESSION["Id_Cliente"].", '".$_SESSION["NombreCliente"]."', '".$_SESSION["Localidad"]."', '".$_SESSION["Mail"]."', '".$_SESSION["Usuario"]."', '$FechaIni', 0, 0, '$IP')";
	
    if (!@mysqli_query ($cnn, $sql))
    {
		$_SESSION["ErrMsg"] = "<h3>Error al generar el pedido. Reintente o contacte a la empresa.</h3>";
	}

	// Ahora utilizo la función ConsultarId_Pedido para saber el ID del nuevo pedido generado.
	$_SESSION["Id_Pedido"] = ConsultarId_Pedido($_SESSION["Id_Cliente"]);
}
// *********************************************


// *************** DETALLE DEL PEDIDO ***************
$ImpTotal = number_format($cantidad * $row['PreVtaFinal1'], 2, '.', '');
if ($editar == 1)
{
	$sql = "UPDATE PEDIDOS_DETA SET Cantidad = $cantidad, ImpTotal = $ImpTotal, Notas = '$notas' 
			WHERE Id_Pedido = ".$_SESSION["Id_Pedido"]." AND Id_Producto = ".$row['Id_Producto'];
}
else
{
	// Si es un insert primero debo verificar que el c�digo no exista ya en el pedido.
	$CodExiste = ConsultarCodExistente($_SESSION["Id_Pedido"], $row['CodProducto']);
    if ($CodExiste == 0)
    {
		$sql = "INSERT INTO PEDIDOS_DETA (Id_Pedido, Id_Producto, CodProducto, Nombre, PreVtaFinal1, Cantidad, ImpTotal, Notas) 
				VALUES (".$_SESSION["Id_Pedido"].", ".$row['Id_Producto'].", '".$row['CodProducto']."', '".$row['Nombre']."', ".$row['PreVtaFinal1'].", $cantidad, $ImpTotal, '$notas')";
	}
}
if (!@mysqli_query ($cnn, $sql))
{
	$_SESSION["ErrMsg"] = "<h3>Error al agregar el producto al carrito. Reintente o contacte a la empresa.</h3>";
}
// *********************************************


mysqli_close($cnn);

switch ($Pagina)
{
    case "productos_carro.php":
        $filtro = "&Id_Rubro=".$Id_Rubro."&Rubro=".$Rubro."&Id_SubRubro=".$Id_SubRubro."&SubRubro=".
		$SubRubro."&Id_Grupo=".$Id_Grupo."&Grupo=".$Grupo;
		header("Location:".$Pagina."?".SID.$filtro.$ancla);
        break;
    case "productos_nov-ofe_carro.php":
        $filtro = "&Oferta=".$Oferta."&Novedad=".$Novedad."&Id_Rubro=".$Id_Rubro."&Rubro=".$Rubro;
        header("Location:".$Pagina."?".SID.$filtro."&pagina=".$pagina."&cant_reg=".$cant_reg."&cant_pag=".$cant_pag.$ancla);
        break;
    case "productos_rubros_carro.php":
        $filtro = "&Id_Rubro=".$Id_Rubro."&Rubro=".$Rubro;
        header("Location:".$Pagina."?".SID.$filtro."&pagina=".$pagina."&cant_reg=".$cant_reg."&cant_pag=".$cant_pag.$ancla);
        break;
    case "productos_subrubros_carro.php":
        $filtro = "&Id_Rubro=".$Id_Rubro."&Rubro=".$Rubro."&Id_SubRubro=".$Id_SubRubro."&SubRubro=".$SubRubro;
        header("Location:".$Pagina."?".SID.$filtro."&pagina=".$pagina."&cant_reg=".$cant_reg."&cant_pag=".$cant_pag.$ancla);
        break;
    case "productos_bus.php":
		$criterio = $_GET["Criterio"];
		$claves = $_GET["Claves"];
		$pagina = $_GET["pagina"];
		$cant_reg = $_GET["cant_reg"];
		$cant_pag = $_GET["cant_pag"];
		$Param = "&Buscar="."Buscar"."&Criterio=".$criterio."&Claves=".$claves."&pagina=".
				 $pagina."&cant_reg=".$cant_reg."&cant_pag=".$cant_pag.$ancla;
        header("Location:".$Pagina."?".SID.$Param);
        break;
    case "rubros.php":
        $filtro = "";
        header("Location:rubros.php?".SID.$filtro);
        break;		
    case "carro_vercarrito.php":
        $filtro = "";
		$Param = "&pagina=".$pagina."&cant_reg=".$cant_reg."&cant_pag=".$cant_pag;		
        header("Location:carro_vercarrito.php?".SID.$filtro.$Param);
        break;		
    case "":
        $filtro = "";
        header("Location:rubros.php?".SID.$filtro);
        break;
}
?>