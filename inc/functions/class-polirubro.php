<?php
/**
 * Global class
 */
Class Polirubro {

    const GOOGLE_API = '6LehItsUAAAAAJgi5I6XbtuH6sRzbFhiYNQwZSed';
    const SITE_KEY = '6LehItsUAAAAAKkyZXB_Aon0DNX7zqMl8OE7jgAO';

    public function __construct() {

        require('autoload.php');

        $this->getItemsSession();

    }

    public static function normalize_title() {
        $base = explode( '?', $_SERVER['REQUEST_URI'] );
        return ucfirst( str_replace( ['/','nuevo','.php'], ['','',''], $base[0] ) );
    }

    public static function get_slug($string) {
        return strtolower( str_replace( ' ', '-', $string ) );
    }

    public static function getItemsSession() {

        $html = '';

        if (isset ($_SESSION["user"])) {

            $html .= '<div class="header__top__right__auth">'.
                        '<strong>'.$_SESSION['user'].'</strong>'.
                        '<a href="logout.php"><i class="fa fa-sign-out"></i> Cerrar Sesi&oacute;n</a>'.
                    '</div>';
        } else {

            $html .= '<div class="header__top__right__auth">
                <a href="#" onclick="formToggle();"><i class="fa fa-user"></i> Ingresar</a>
                <form class="form-login d-none" id="js-formx-login">
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input type="text" name="user" class="form-control user" id="user" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Contrase&ntilde;a</label>
                        <input type="password" name="pass" class="form-control pass" id="pass" required>
                    </div>

                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="'.self::SITE_KEY.'"></div>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Entrar">
                    </div>

                    <div class="js-login-message"></div>
                </form>
            </div>';
        }

        return $html;
    }

    public static function getResumenCart() {

        $html = '';

        if ( isset($_SESSION["id_user"]) ) :

            $pedido = new Pedidos();
            $result = $pedido->getPedidoAbierto($_SESSION["Id_Cliente"]);

            if ( $result && $result['num_rows'] > 0 ) : 

                $detalle = new Detalles();
                $resumen = $detalle->getPedidoResumen($result['Id_Pedido']);

                $html .='<div class="header__cart" id="js-dynamic-cart">
                    <ul id="js-data-cart">
                        <li><a href="/carrito.php" title="Ver Carrito"><b>Pedido</b> <i class="fa fa-shopping-bag"></i> <span>' .$resumen.'</span></a></li>
                    </ul>
                </div>';

                $detalle->closeConnection();

            endif;

            $pedido->closeConnection();
            
        endif;

        return $html;
    }

    public function getBodyEmail($id_pedido, $user) {

        $date = date("Y-m-d");
        $ip = $_SERVER['REMOTE_ADDR'];
        $total = 0;
        
        // Construyo el Cuerpo del Mail.
        $body = "<h2>Pedido Web Polirrubros Garro</h2>
                <p align='center'><strong>Polirrubros de Miguel Garro</strong><br>
                Pasaje Bujados 173 - 2550 Bell Ville, Córdoba<br>
                Tel.: (03537) 410102 - E-Mail: 
                <a href='mailto:info@polirrubrosgarro.com.ar'>info@polirrubrosgarro.com.ar</a>
                </p>
                <p align='left'>
                <strong>Pedido</strong>: ".$id_pedido."
                <br><strong>Cliente</strong>: ".$user->getID()." - ".$user->getNombre()."
                <br><strong>Localidad</strong>: ".$user->getLocalidad()."
                <br><strong>E-Mail</strong>: ".$user->getMail()."
                <br><strong>Fecha de este registro (A&ntilde;o-Mes-D&iacute;a)</strong>: ".$date."
                <br><strong>IP del cliente</strong>: ".$ip."
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
  
        $pedido = new Pedidos();
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
                        <td width='10%' height='20' align='right' valign='middle'>".number_format($product->PreVtaFinal1, 2, '.', ',')."</td>
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
        
        $detalle->closeConnection();     

        return $body;
    }

    public function sendMail($id_pedido, $user, $cuerpo) {
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
        $mail->AddAddress($user->getMail()); // Copia para el cliente.
        $mail->AddReplyTo($emailDestino); // Esto es para que al recibir el correo y poner Responder, lo haga a la cuenta del vendedor.
        $mail->Subject = "Web Polirrubros - Pedido: ".$id_pedido; // Este es el titulo del email.
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
            $msgEnvio = "Una copia del pedido fue enviada al correo ".$user->getMail();
        } else {
            $msgEnvio = "Ocurrió un error inesperado al enviar el correo.";
        }

        return $msgEnvio;
    }

    public static function is_Admin() {

        if (! isset($_SESSION["Id_Cliente"])) {
            return false;
        }
        
        // if is Admin return true 
        $user = new Usuarios($_SESSION["Id_Cliente"]);
        $result = $user->is_Admin();
        return $result; 
    }

}

new Polirubro;
?>