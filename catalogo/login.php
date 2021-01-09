<?php
$login_log = "";
if (isset($_GET["login_ok"]))
{
    if ($_GET["login_ok"] == 400)
    {
        $login_log = "Debe resolver en CAPTCHA. Intente nuevamente o cont&aacute;ctese con el Polirrubros Garro.";
    }
    elseif ($_GET["login_ok"] == 401)
    {
        $login_log = "Usuario, Clave incorrectos. Intente nuevamente o cont&aacute;ctese con Polirrubros Garro.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Polirrubros Garro</title>
    <?php require("head.php"); ?>
    <style>
	    label { display:block; }
    </style>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
                <h2>Login</h2>
                <hr>
            </div>
        </div>

        <div class="row">
            <div align="center" class="col-md-12">
                <?php if ($login_log != "") { echo "<h3>".$login_log."</h3>"; } ?>
                <p>Ingrese su nombre de usuario y contrase&ntilde;a, y luego haga clic en el bot&oacute;n &quot;Login&quot; para ingresar al sistema.</p>
            </div>
        </div>

        <div class="row">
            <div align="center" class="col-md-12">
                <form name="form1" method="post" action="login_proceso.php">
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input type="text" name="usuario" id="usuario" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Contrase&ntilde;a</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="6LehItsUAAAAAKkyZXB_Aon0DNX7zqMl8OE7jgAO"></div>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="cmdLogin" id="cmdLogin" class="btn btn-primary" value="Login">
                    </div>
                </form>
            </div>
        </div>
      
        <div class="row">
            <div align="center" class="col-md-12">
                <p><a href="http://www.polirrubrosgarro.com.ar/">Volver al Sitio de Polirrubros Garro</a></p>
            </div>
        </div>
        
        <?php require("footer.php"); ?>
    </div>
</body>
</html>