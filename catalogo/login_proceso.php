<?php
session_start();

include '../inyesql.php';

if ($_POST["cmdLogin"] == "Login")
{
    // Antes que nada, valido el Captcha.
    if (isset($_POST['g-recaptcha-response']))
    {
        $captcha = $_POST['g-recaptcha-response'];
    }
    $captcha = $_POST['g-recaptcha-response'];
    
    if (!$captcha)
    {
        header("Location: login.php?login_ok=400"); // Captcha incorrecto! Redirijo a Contacto con aviso.
        //echo '<h2>Please check the the captcha form.</h2>';
        exit;
    }
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LehItsUAAAAAJgi5I6XbtuH6sRzbFhiYNQwZSed&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
    
    if ($response.success == false)
    {
		header("Location: login.php?login_ok=400"); // Captcha incorrecto! Redirijo a Contacto con aviso.
    }
    else
    {
		$usuario = $_POST["usuario"];
		$password = $_POST["password"];
		$log_ok = false;

        switch ($usuario)
        {
			case "poli":
                if ($password == "meli_peti")
                {
					$log_ok = true;
				}
				break;
			case "lucianoc":
                if ($password == "lucianoc2006")
                {
					$log_ok = true;
				}
				break;
			default:
				break;
		}
        if ($log_ok == true)
        {
			$log_ok = 0;
			$_SESSION["id_user"] = session_id();
			$_SESSION["user"] = $usuario;
			header("Location: sistema.php");
		}
		else
		{
			$_SESSION["id_user"] = "no";
			header("Location: login.php?login_ok=401");
		}
	}
}
else
{
	header("Location: login.php");
}
?>