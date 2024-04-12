<?php
/**
 * Contact class
 */
class Contact {
    
    public $id;
    public $nombre;
    public $direccion;
    public $localidad;
    public $provincia;
    public $telefono;
    public $mail;
    public $comentario;
    public $fecha;
    public $hora;
    public $obj;
    public $ip;

    public function __construct($id=0) {

        if ($id != 0) {
            $this->obj = new sQuery();
            $result = $this->obj->executeQuery("SELECT * FROM contacto WHERE id = '$id' ORDER BY nombre");
            $row = mysqli_fetch_assoc($result);
    
            $this->id = $row['id'];
            $this->nombre = $row['nombre'];
            $this->direccion = $row['direccion'];
            $this->localidad = $row['localidad'];
            $this->provincia = $row['provincia'];
            $this->telefono = $row['telefono'];
            $this->mail = $row['mail'];
            $this->comentario = $row['comentario'];
            $this->fecha = $row['fecha'];
            $this->hora = $row['hora'];
            $this->ip = $row['ip'];
        }
    }

    public function getID(){ return $this->id; }
    public function getNombre(){ return $this->nombre; }
    public function getDireccion(){ return $this->direccion; }
    public function getLocalidad(){ return $this->localidad; }
    public function getProvincia(){ return $this->provincia; }
    public function getTelefono(){ return $this->telefono; }
    public function getMail(){ return $this->mail; }
    public function getComentario(){ return $this->comentario; }
    public function getFecha(){ return $this->fecha; }
    public function getHora(){ return $this->hora; }
    public function getIP(){ return $this->ip; }

    public function insert() {
        $this->obj = new sQuery();
        $this->obj->executeQuery("INSERT INTO contacto (nombre, direccion, localidad, provincia, telefono, mail, comentario, fecha, hora, ip) VALUES ('$this->nombre', '$this->direccion', '$this->localidad', '$this->provincia', '$this->telefono', '$this->mail', '$this->comentario', '$this->fecha', '$this->hora', '$this->ip')");
    }

    public function send() {
        
        $smtpHost = "";  // Dominio alternativo brindado en el email de alta 
        $smtpUsuario = "";  // Mi cuenta de correo
        $smtpClave = "";
        $nombre = "";
        
        $emailDestino = "";
        $emailDestino2 = "";
        
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
        $mail->AddReplyTo($emailDestino2); // Copia 2 para el vendedor.
        //$mail->AddAddress($user->getMail()); // Copia para el cliente.
        //$mail->AltBody = "{$mensaje} \n\n Formulario de ejemplo Web Polirrubros"; // Texto sin formato HTML
        $mail->Subject = "Nuestro Polirrubros - Contacto desde la web"; // Este es el titulo del email.
        $mail->Body = " 
        <html>
        <head>
        <title>Contacto desde la web</title>
        </head>
        <body>
            <p>Nombre: ". $this->nombre ."</p>
            <p>Direccion: ". $this->direccion ."</p>
            <p>Localidad: ". $this->localidad ."</p>
            <p>Provincia: ". $this->provincia ."</p>
            <p>Telefono: ". $this->telefono ."</p>
            <p>Mail: ". $this->mail ."</p>
            <p>Comentario: ". $this->comentario ."</p>
        </body>
        </html>"; // Texto del email en formato HTML
        
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer'       => false,
                'verify_peer_name'  => false,
                'allow_self_signed' => true
        )); 

        if ( $mail->Send() ) {
            $msgEnvio = "Mensaje enviado correctamente";
        } else {
            $msgEnvio = "Ocurrió un error inesperado al enviar el correo.";
        }

        return $msgEnvio;
    }

    public function closeConnection(){
        $this->obj->Clean();
		$this->obj->Close();
	} 

}