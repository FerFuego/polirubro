<?php
/**
 * Global class
 */
Class Polirubro {

    public function __construct() {
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        
        require('autoload.php');

        $this->getItemsSession();
    }

    public static function get_google_api() {
        return getenv('GOOGLE_API');
    }

    public static function get_site_key() {
        return getenv('SITE_KEY');
    }

    public static function normalize_title() {
        $base = explode( '?', $_SERVER['REQUEST_URI'] );
        return ucfirst( str_replace( ['/','nuevo','.php'], ['','',''], $base[0] ) );
    }

    public static function get_slug($string) {
        return strtolower( str_replace( ' ', '-', $string ) );
    }

    public static function getItemsSession() {

        if (isset ($_SESSION["user"])) {

            ob_start();
            include ('inc/partials/item-session.php');
            $html = ob_get_contents();
            ob_end_clean();

        } else {

            if (!isset($_SESSION["Id_Cliente"]) || $_SESSION["Id_Cliente"] == 0) {
                $_SESSION["Id_Cliente"] = date('YmdHis');
            }
            
            ob_start();
            include ('inc/partials/login-form.php');
            $html = ob_get_contents();
            ob_end_clean();
        }

        return $html;
    }

    public static function getResumenCart() {

        $html = '';

        if ( isset($_SESSION["Id_Cliente"]) ) :

            $pedido = new Pedidos();
            $result = $pedido->getPedidoAbierto($_SESSION["Id_Cliente"]);

            if ( $result && $result['num_rows'] > 0 ) : 

                $detalle = new Detalles();
                $resumen = $detalle->getPedidoResumen($result['Id_Pedido']);

                $html .='<div class="header__cart" id="js-dynamic-cart">
                    <ul id="js-data-cart">
                        <li><a href="./carrito.php" title="Ver Carrito"><b>Pedido</b> <i class="fa fa-shopping-bag"></i> <span>' .$resumen.'</span></a></li>
                    </ul>
                </div>';
            endif;

        endif;

        return $html;
    }

    public function getBodyEmail($id_pedido) {

        $total = 0;
        $pedido = new Pedidos($id_pedido);
        
        // Construyo el Cuerpo del Mail.
        $body = "<h2>Pedido Web Nuestro Polirrubros</h2>
                <p align='center'><strong>Nuestro Polirrubros de Alejandra Barzabal</strong><br>
                Sargento Cabral 234 - 2550 Bell Ville, C&oacute;rdoba<br>
                Tel.: (03537) 410102 | WhatsApp: 3537-536991 | E-Mail: 
                <a href='mailto:nuestropoli@gmail.com'>nuestropoli@gmail.com</a>
                </p>
                <p align='left'>
                <strong>Pedido</strong>: ".$id_pedido."
                <br><strong>Cliente</strong>: ".$pedido->getIDCliente()." - ".$pedido->getNombre()."
                <br><strong>Localidad</strong>: ".$pedido->getLocalidad()."
                <br><strong>E-Mail</strong>: ".$pedido->getMail()."
                <br><strong>Fecha de este registro (A&ntilde;o-Mes-D&iacute;a)</strong>: ".$pedido->getFechaFin()."
                <br><strong>IP del cliente</strong>: ".$pedido->getIP()."
                </p>
                <p>
                <table width='100%' border='0' cellspacing='0' cellpadding='5' align='left'>
                <tr bgcolor='#CDCDCD'>
                <th width='10%' height='20' align='right' valign='middle'><b>C&oacute;d. Producto</b></th>
                <th width='10%' height='20' align='center' valign='middle'><b>Cantidad</b></th>
                <th width='40%' height='20' align='left' valign='middle'><b>Producto</b></th>
                <th width='20%' height='20' align='left' valign='middle'><b>Notas</b></th>
                <th width='10%' height='20' align='right' valign='middle'><b>Pre. Uni.</b></th>
                <th width='10%' height='20' align='right' valign='middle'><b>Pre. Tot.</b></th>
                </tr>";
        
        $detalle = new Detalles();
        $results = $detalle->getDetallesPedido($id_pedido);

        if ( $results->num_rows > 0 ) :
            while ( $product = $results->fetch_object() ) :

                $total = $pedido->sumTotalCart($product->ImpTotal);

                $body .= "<tr>
                        <td width='10%' height='20' align='right' valign='middle'><b>".$product->CodProducto."</b></td>
                        <td width='10%' height='20' align='center' valign='middle'><b>".$product->Cantidad."</b></td>
                        <td width='40%' height='20' align='left' valign='middle'>".$product->Nombre."</td>
                        <td width='20%' height='20' align='left' valign='middle'>".$product->Notas."</td>
                        <td width='10%' height='20' align='right' valign='middle'>".number_format(Productos::PreVtaFinal($product->PreVtaFinal1), 2,',','.')."</td>
                        <td width='10%' height='20' align='right' valign='middle'>".number_format($product->ImpTotal, 2, '.', ',')."</td>
                        </tr>";
            endwhile;
        endif;

        $body .= "<tr>
                <td colspan='6' height='20' align='left' valign='middle'>
                <strong>Total de art&iacute;culos</strong>: ".$results->num_rows."
                <br><strong>Importe total del pedido</strong>: $".number_format($total, 2, '.', ',')."
                </td>
                </tr>
                </table></p>";

        return $body;
    }

    public function sendMail($id_pedido, $emailCopia, $cuerpo) {

        $smtpHost = getenv('SMTP_HOST'); // Dominio alternativo brindado en el email de alta 
        $smtpUsuario = getenv('SMTP_USURIO'); // Mi cuenta de correo
        $smtpClave = getenv('SMTP_KEY');
        $nombre =  getenv('SMTP_FROM');
        
        $emailDestino = getenv('SMTP_EMAIL_DESTINO');
        $emailDestino2 = getenv('SMTP_EMAIL_DESTINO_2');
        
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Port = 587; 
        $mail->IsHTML(true); 
        $mail->SMTPDebug = 2;
        $mail->CharSet = "utf-8";
        
        $mail->Host = $smtpHost; 
        $mail->Username = $smtpUsuario; 
        $mail->Password = $smtpClave;
        
        $mail->From = $smtpUsuario; // Email desde donde envío el correo.
        $mail->FromName = $nombre;
        $mail->AddAddress($emailDestino); // Copia para el vendedor.
        $mail->AddAddress($emailDestino2); // Copia 2 para el vendedor.
        $mail->AddAddress($emailCopia); // Copia para el cliente.
        $mail->AddReplyTo($emailDestino); // Esto es para que al recibir el correo y poner Responder, lo haga a la cuenta del vendedor.
        $mail->Subject = "Nuestro Polirrubros - Pedido: ".$id_pedido; // Este es el titulo del email.
        $mail->Body = "{$cuerpo}"; // Texto del email en formato HTML
        //$mail->AltBody = "{$mensaje} \n\n Formulario de ejemplo Web Polirrubros"; // Texto sin formato HTML
        
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        ); 

        if ( $mail->Send() ) {
            $msgEnvio = "Una copia del pedido fue enviada al correo ".$emailCopia;
        } else {
            $msgEnvio = "Ocurrió un error inesperado al enviar el correo.";
        }

        //return $msgEnvio; // crash response json
    }

    public static function is_Admin() {

        if (!isset($_SESSION["id_user"])) {
            return false;
        }
        
        // if is Admin return true 
        $user = new Usuarios($_SESSION["Id_Cliente"]);
        return $user->is_Admin();
    }

    public static function checkUserCapabilities($product) {

        $precio  = 0;
        $config  = new Configuracion();
        $aumento = $config->getAumento();
        
        // Usuario logueado
        if (isset($_SESSION["user"])) {
            return number_format($product->PreVtaFinal1(), 2,',','.');
        }
        
        // Usuario no logueado o tipo 2
        if ($aumento) {
            // aumento %
            $precio = $product->PreVtaFinal1() + ($product->PreVtaFinal1() * ($aumento / 100));
        }

        return number_format($precio, 2,',','.');
    }
}

new Polirubro;