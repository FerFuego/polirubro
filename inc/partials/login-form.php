<div class="header__top__right__auth">
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
            <div class="g-recaptcha" data-sitekey="<?php echo Polirubro::get_site_key(); ?>"></div>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Entrar">
        </div>

        <div class="js-login-message"></div>
    </form>
</div>