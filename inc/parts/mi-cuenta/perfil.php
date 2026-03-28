<?php
    $user = new Usuarios($_SESSION["Id_Cliente"]);
?>
<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h4 class="mb-0">Mis Datos Personales</h4>
    </div>
    <div class="card-body">
        <form action="#" id="js-form-my-account">
            <input type="hidden" name="action" value="updateMyAccount">
            
            <div class="checkout__input">
                <p>Nombre Completo<span>*</span></p>
                <input type="text" name="user_name" id="user_name" placeholder="Roberto Perez" value="<?php echo htmlspecialchars($user->Nombre); ?>" required>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="checkout__input">
                        <p>Correo Electrónico<span>*</span></p>
                        <input type="email" name="email" id="email" placeholder="mail@ejemplo.com" value="<?php echo htmlspecialchars($user->Mail); ?>" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="checkout__input">
                        <p>Teléfono<span>*</span></p>
                        <input type="text" name="user_phone" id="user_phone" placeholder="11 0000 0000" value="<?php echo htmlspecialchars($user->Telefono); ?>" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="checkout__input">
                        <p>Dirección<span>*</span></p>
                        <input type="text" name="user_address" id="user_address" placeholder="Av. Siempre Viva 123" value="<?php echo htmlspecialchars($user->Direccion); ?>" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="checkout__input">
                        <p>Localidad<span>*</span></p>
                        <input type="text" name="user_locality" id="user_locality" placeholder="Buenos Aires" value="<?php echo htmlspecialchars($user->Localidad); ?>" required>
                    </div>
                </div>
            </div>

            <div class="checkout__input">
                <p>Contraseña <span>(Dejar en blanco para no cambiarla)</span></p>
                <input type="password" name="pass_cli" id="pass_cli">
            </div>

            <div class="d-flex justify-content-end mt-4">
                <span class="custom-loader btn-loader" style="display: none;"></span>
                <button type="button" class="site-btn" id="btn-update-account" onclick="updateMyAccount()">GUARDAR CAMBIOS</button>
            </div>
        </form>
    </div>
</div>
