<?php require_once('inc/layout/head.php');

$error = null;

if (!empty($_POST) && isset($_POST['action']) && $_POST['action'] == 'directLogin') {
    $user = (isset($_POST['user']) ? filter_var($_POST['user'], FILTER_UNSAFE_RAW) : null);
    $pass = (isset($_POST['pass']) ? filter_var($_POST['pass'], FILTER_UNSAFE_RAW) : null);
    $csrf = (isset($_POST['csrf']) ? filter_var($_POST['csrf'], FILTER_UNSAFE_RAW) : null);
    $recaptcha = (isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : null);

    // CSRF Protection
    if ($csrf !== $_SESSION["token"]) {
        $error = 'Error de validación (CSRF).';
    } else {
        // ReCaptcha Protection
        $captchaValid = true;
        if (getenv('ENVIRONMENT') == 'production') {
            $verifyUrl = "https://www.google.com/recaptcha/api/siteverify?secret=" . Polirubro::get_google_api() . "&response=" . $recaptcha . "&remoteip=" . $_SERVER['REMOTE_ADDR'];
            $request = @file_get_contents($verifyUrl);
            $response = $request ? json_decode($request) : null;

            if (!$response || !isset($response->success) || $response->success === false) {
                $captchaValid = false;
                $error = 'Captcha Incorrecto!';
            }
        }

        if ($captchaValid) {
            $access = new Login($user, $pass);
            $result = $access->loginProcess();

            if ($result && $result->num_rows > 0) {
                $userData = $result->fetch_object();

                $_SESSION["id_user"] = rand(0, 999);
                $_SESSION["Id_Cliente"] = $userData->Id_Cliente;
                $_SESSION["user"] = $userData->Usuario;

                if ($userData->is_admin == '1') {
                    header("Location: cpanel.php");
                } else {
                    // Update open order if exists
                    $order = new Pedidos();
                    $orderResult = $order->getPedidoAbierto($_SESSION["Id_Cliente"]);
                    if ($orderResult['num_rows'] > 0) {
                        $order->ActualizarPedido($orderResult['Id_Pedido']);
                    }
                    header("Location: index.php");
                }
                die();
            } else {
                $error = 'Usuario o contraseña Incorrecto!';
            }
        }
    }
}
?>

<!-- Header Section Begin -->
<?php require_once('inc/layout/header.php'); ?>
<!-- Header Section End -->

<div class="registro">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="section-title">
                    <h2>Ingreso de Clientes</h2>
                </div>
            </div>

            <div class="col-lg-6 mx-auto mb-5">
                <form class="form-cli" method="post" action="login.php">
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="user">Usuario</label>
                        <input type="text" name="user" id="user"
                            value="<?php echo isset($_POST['user']) ? htmlspecialchars($_POST['user']) : ''; ?>"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="pass">Contraseña</label>
                        <input type="password" name="pass" id="pass" required>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="action" value="directLogin">
                        <input type="hidden" name="csrf" id="csrf" value="<?php echo $_SESSION["token"]; ?>">
                        <div class="g-recaptcha" id="g-recaptcha"
                            data-sitekey="<?php echo Polirubro::get_site_key(); ?>"></div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary w-100" value="Entrar">
                    </div>
                    <div class="js-login-message mt-3"></div>

                    <?php
                    $general = new Configuracion();
                    if ($general->active_register): ?>
                        <div class="mt-4 text-center">
                            <p>¿No tienes cuenta? <a href="registro.php"><strong>Regístrate aquí</strong></a></p>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Footer Section Begin -->
<?php require_once('inc/layout/footer.php'); ?>
<!-- Footer Section End -->