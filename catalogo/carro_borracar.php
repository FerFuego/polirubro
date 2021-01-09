<?php
session_start();
extract($_GET);

require ("cnn.php");

BorrarProductoDetallePedido($_SESSION["Id_Pedido"], $id);
$ancla = "#".$id;

// Según de donde venga...
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
		// Defino $Param para que no me de error carro_vercarrito.php
		$Param = "&pagina=".$pagina."&cant_reg=".$cant_reg."&cant_pag=".$cant_pag;		
        header("Location:carro_vercarrito.php?".SID.$filtro.$Param);
        break;		
    case "":
        $filtro = "";
        header("Location:rubros.php?".SID.$filtro);
        break;
}
?>