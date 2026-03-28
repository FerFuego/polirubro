<div class="sidebar sidebar-cpanel col-md-4 col-lg-3 d-none d-md-block">
    <div class="sidebar-container">
        <div class="sidebar__item text-center pt-3">
            <h3 class="text-white">Mi Cuenta</h3>
        </div>
        <div class="sidebar__item">
            <ul>
                <li><a href="mi-cuenta.php" class="<?php echo (!isset($opcion) || $opcion == 'perfil') ? 'active' : '';?> item">Mis Datos</a></li>
                <li><a href="mi-cuenta.php?opcion=pedidos" class="<?php echo (isset($opcion) && $opcion == 'pedidos') ? 'active' : '';?> item">Mis Pedidos</a></li>
                <li><a href="logout.php" class="item">Cerrar Sesión</a></li>
            </ul>
        </div>
    </div>
</div>
