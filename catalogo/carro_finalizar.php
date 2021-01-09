<?php 
session_start();

if (isset($_SESSION["Id_Cliente"]))
{
    if ($_SESSION["Id_Cliente"] <= 1)
    {
		header("Location:rubros.php");
	}
}
else
{
	header("Location:rubros.php");
}

header("Content-Type: text/html;charset=utf-8");

require("cnn.php");
require("class.phpmailer.php");
require("class.smtp.php");

$msgEnvio = "";

// ----- Consulto cabecera del pedido -----
$sql = "SELECT * FROM PEDIDOS_CABE WHERE (Id_Cliente = ".$_SESSION["Id_Cliente"].") AND (Cerrado = 0)";
if (!$rsPedCab = mysqli_query($cnn, $sql))
{
	$_SESSION["Id_Pedido"] = 0;
	mysqli_free_result($rsPedCab);
	mysqli_close($cnn);	
	header("Location: rubros.php");
}
else
{
	$cantiPedCab = mysqli_num_rows($rsPedCab);
	// Si el cliente tiene al menos un pedido abierto, tomo los datos.
	if ($cantiPedCab > 0) {
		while ($datoPedCab = mysqli_fetch_array($rsPedCab)) {
			$_SESSION["Id_Pedido"] = $datoPedCab["Id_Pedido"];
			// Cierro el pedido
			CerrarPedido($_SESSION["Id_Pedido"]);
		}
	}
	else {
		$_SESSION["Id_Pedido"] = 0;
		mysqli_free_result($rsPedCab);
		mysqli_close($cnn);	
		header("Location: rubros.php");
	}
	mysqli_free_result($rsPedCab);
}
// ---------------

function Enviar_Mail($cuerpo) {
	// Datos de la cuenta de correo utilizada para enviar vía SMTP
	$smtpHost = "hu000235.ferozo.com";  // Dominio alternativo brindado en el email de alta 
	$smtpUsuario = "web@polirrubrosgarro.com.ar";  // Mi cuenta de correo
    $smtpClave = "DLG*nTf2fG";  // Mi contraseña
    $nombre = "Web Polirrubros Garro";
	
	// Email donde se enviaran los datos cargados en el formulario de contacto
	$emailDestino = "info@polirrubrosgarro.com.ar";
	
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->Port = 587; 
	$mail->IsHTML(true); 
	$mail->CharSet = "utf-8";
	
	$mail->Host = $smtpHost; 
	$mail->Username = $smtpUsuario; 
	$mail->Password = $smtpClave;
	
	$mail->From = $smtpUsuario; // Email desde donde envío el correo.
	$mail->FromName = $nombre;
	$mail->AddAddress($emailDestino); // Copia para el vendedor.
	$mail->AddAddress($_SESSION["Mail"]); // Copia para el cliente.
	$mail->AddReplyTo($emailDestino); // Esto es para que al recibir el correo y poner Responder, lo haga a la cuenta del vendedor.
	$mail->Subject = "Web Polirrubros - Pedido: ".$_SESSION["Id_Pedido"]; // Este es el titulo del email.
	$mensajeHtml = $cuerpo;
	$mail->Body = "{$mensajeHtml}"; // Texto del email en formato HTML
	//$mail->AltBody = "{$mensaje} \n\n Formulario de ejemplo Web Polirrubros"; // Texto sin formato HTML
	
	$mail->SMTPOptions = array(
		'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
		)
	);
	
	$estadoEnvio = $mail->Send(); 
    if ($estadoEnvio)
    {
		$msgEnvio = "Una copia del pedido fue enviada al correo ".$_SESSION["Mail"];
    }
    else
    {
		$msgEnvio = "Ocurrió un error inesperado al enviar el correo.";
	}
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Polirrubros Garro - Ayuda</title>
    <?php require("head.php"); ?>
    <script type="text/javascript">
        function imprimePedido(muestra)
        {
            var ficha = document.getElementById(muestra);
            var ventimp = window.open(' ', 'popimpr');
            ventimp.document.write(ficha.innerHTML);
            ventimp.document.close();
            ventimp.print();
            ventimp.close();
        }
    </script>
</head>
<body>
    <div class="container" style="background-color: #FFF;">
        <?php require("header.php"); ?>
        <?php require("navbar.php"); ?>
    
        <div class="row">
            <div align="right" class="col-md-12">
            <?php
            if ($_SESSION["Id_Cliente"] != 0)
            {
                echo "<br><p>Conectado como: <strong>"
                .$_SESSION["Id_Cliente"]." | ".$_SESSION["NombreCliente"]."</strong>&nbsp;|&nbsp;
                <a href='../clientes_logout.php'><img src='../images/cerrar_sesion_16.png' title='Cerrar Sesi&oacute;n'></a>
                &nbsp;<a href='../clientes_logout.php'>Cerrar Sesi&oacute;n</a></p>";
            }
            ?>
            </div>
        </div>

        <div class="row">
            <div align="center" class="col-md-12">
            <?php
            if ($_SESSION["Id_Pedido"] != 0)
            {
                // ----- DETALLE DEL PEDIDO -----
                $sql = "SELECT * FROM PEDIDOS_DETA WHERE (Id_Pedido = ".$_SESSION["Id_Pedido"].")";
                if (!$rsPedDet = mysqli_query($cnn, $sql))
                {
                    $detalle = 0;
                    echo "<h3>Error al consultar el detalle del pedido.</h3>";
                }
                else
                {
                    echo "<h1><font color='#990000'>Enviando pedido. Por favor, espere...</font></h1><hr>";
                    $cantiPedDet = mysqli_num_rows($rsPedDet);
                    if ($cantiPedDet > 0)
                    {
                        $fecha = date("Y-m-d");
                        $ip = $_SERVER['REMOTE_ADDR'];
                        
                        // Construyo el Cuerpo del Mail.
                        $cuerpo = "<h2>Pedido Web Polirrubros Garro</h2>
                                    <p align='center'><strong>Polirrubros de Miguel Garro</strong><br>
                                    Pasaje Bujados 173 - 2550 Bell Ville, Córdoba<br>
                                    Tel.: (03537) 410102 - E-Mail: 
                                    <a href='mailto:info@polirrubrosgarro.com.ar'>info@polirrubrosgarro.com.ar</a>
                                    </p>
                                    <p align='left'>
                                    <strong>Pedido</strong>: ".$_SESSION["Id_Pedido"]."
                                    <br><strong>Cliente</strong>: ".$_SESSION["Id_Cliente"]." - ".$_SESSION["NombreCliente"]."
                                    <br><strong>Localidad</strong>: ".$_SESSION["Localidad"]."
                                    <br><strong>E-Mail</strong>: ".$_SESSION["Mail"]."
                                    <br><strong>Fecha de este registro (A&ntilde;o-Mes-D&iacute;a)</strong>: ".$fecha."
                                    <br><strong>IP del cliente</strong>: ".$ip."
                                    </p>
                                    <p>
                                    <table width='100%' border='0' cellspacing='0' cellpadding='5' align='left'>
                                    <tr bgcolor='#CCCCCC'>
                                    <th width='10%' height='20' align='right' valign='middle'><b>C&oacute;d. Producto</b></th>
                                    <th width='10%' height='20' align='center' valign='middle'><b>Cantidad</b></th>
                                    <th width='40%' height='20' align='left' valign='middle'><b>Producto</b></th>
                                    <th width='20%' height='20' align='left' valign='middle'><b>Notas</b></th>
                                    <th width='10%' height='20' align='right' valign='middle'><b>Pre. Uni.</b></th>
                                    <th width='10%' height='20' align='right' valign='middle'><b>Pre. Tot.</b></th>
                                    </tr>";
                        $color = array("#FFCC33","#F0F0F0");
                        $contador = 0;
                        $suma = 0;
                        
                        while ($datoPedDet = mysqli_fetch_array($rsPedDet))
                        {
                            $subto = $datoPedDet["Cantidad"] * $datoPedDet['PreVtaFinal1'];
                            $suma = $suma + $subto;
                            $contador ++;
            
                            $cuerpo = $cuerpo."<tr bgcolor='".$color[$contador % 2]."'>
                                        <td width='10%' height='20' align='right' valign='middle'><b>".$datoPedDet['CodProducto']."</b></td>
                                        <td width='10%' height='20' align='center' valign='middle'><b>".$datoPedDet['Cantidad']."</b></td>
                                        <td width='40%' height='20' align='left' valign='middle'>".$datoPedDet['Nombre']."</td>
                                        <td width='20%' height='20' align='left' valign='middle'>".$datoPedDet['Notas']."</td>
                                        <td width='10%' height='20' align='right' valign='middle'>".
                                        number_format($datoPedDet['PreVtaFinal1'], 2, '.', ',')."</td>
                                        <td width='10%' height='20' align='right' valign='middle'>".
                                        number_format($datoPedDet['ImpTotal'], 2, '.', ',')."</td>
                                        </tr>";
                        }
                        $cuerpo = $cuerpo."<tr>
                                        <td colspan='6' height='20' align='left' valign='middle'>
                                        <strong>Total de art&iacute;culos</strong>: ".$contador."
                                        <br><strong>Importe total del pedido</strong>: $".number_format($suma, 2, '.', ',')."
                                        </td>
                                        </tr>
                                        </table></p>";
                    
                        Enviar_Mail($cuerpo); // Llamo a la función para enviar el mail con los datos.
                        mysqli_free_result($rsPedDet);
                        mysqli_close($cnn);
                        echo "<h1>El pedido ha sido enviado!</h1>";
                        echo "<h3>".$msgEnvio."</h3>";
                    }
                }
            }
            ?>
            </div>
        </div>

        <div class="row">
            <div align="center" class="col-md-12">
                <div id="areaImpresion"> 
                    <?php echo $cuerpo; ?>
                </div>
                <p>
                    <a href="javascript:imprimePedido('areaImpresion')"><img src="images/ico_imprimir_48.png" title="Imprimir"></a>
                </p>
            </div>
        </div>

        <div class="row">
            <div align="center" class="col-md-12"><hr></div>
        </div>

        <div class="row">
            <div align="center" class="col-md-12">
                <p>
                    <a href="rubros.php"><button name="cmdRubros" type="button" class="btn btn-success" value="Rubros">Volver a Rubros</button></a>
                </p>
            </div>
        </div>    
            
        <?php require("footer.php"); ?>
    </div>
</body>
</html>